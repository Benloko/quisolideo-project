<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Checkout\Session as StripeCheckoutSession;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use UnexpectedValueException;

class CheckoutController extends Controller
{
    private function cartKey(): string
    {
        return 'shop_cart';
    }

    private function getCart(Request $request): array
    {
        $cart = $request->session()->get($this->cartKey(), []);
        return is_array($cart) ? $cart : [];
    }

    private function computeLines(array $cart): array
    {
        $productIds = array_keys($cart);
        $products = count($productIds)
            ? Product::whereIn('id', $productIds)->get()->keyBy('id')
            : collect();

        $lines = [];
        $subtotal = 0;

        foreach ($cart as $productId => $qty) {
            $product = $products->get((int) $productId);
            if (!$product || !$product->is_active) {
                continue;
            }

            $quantity = max(1, (int) $qty);
            $lineTotal = (float) $product->price * $quantity;
            $subtotal += $lineTotal;

            $lines[] = [
                'product' => $product,
                'quantity' => $quantity,
                'line_total' => $lineTotal,
            ];
        }

        return [$lines, $subtotal];
    }

    private function generateOrderNumber(): string
    {
        return 'QSO-' . now()->format('Ymd-His') . '-' . random_int(100, 999);
    }

    private function stripeEnabled(): bool
    {
        return (bool) config('services.stripe.secret');
    }

    private function stripeCurrency(): string
    {
        // FCFA (Bénin) — West African CFA franc
        return 'xof';
    }

    private function stripeUnitAmount(float $amount): int
    {
        // XOF is a zero-decimal currency.
        return (int) round($amount);
    }

    public function show(Request $request)
    {
        $cart = $this->getCart($request);
        if (!count($cart)) {
            return redirect()->route('shop.index')->with('success', 'Votre panier est vide.');
        }

        [$lines, $subtotal] = $this->computeLines($cart);
        if (!count($lines)) {
            return redirect()->route('shop.index')->with('success', 'Votre panier est vide.');
        }

        $shipping = 0;
        $total = $subtotal + $shipping;

        return view('shop.checkout', compact('lines', 'subtotal', 'shipping', 'total'));
    }

    public function place(Request $request)
    {
        $cart = $this->getCart($request);
        if (!count($cart)) {
            return redirect()->route('shop.index')->with('success', 'Votre panier est vide.');
        }

        [$lines, $subtotal] = $this->computeLines($cart);
        if (!count($lines)) {
            return redirect()->route('shop.index')->with('success', 'Votre panier est vide.');
        }

        $whatsappNumber = preg_replace('/\D+/', '', (string) config('services.whatsapp.number'));
        if ($whatsappNumber === '') {
            return back()
                ->withErrors(['whatsapp' => 'WhatsApp n\'est pas configuré pour le moment.'])
                ->withInput();
        }

        $data = $request->validate([
            'fulfillment_method' => 'required|string|in:pickup,delivery',
            'customer_name' => 'required|string|max:120',
            'customer_email' => 'required|email|max:190',
            'customer_phone' => 'required|string|max:60',
            'address_line1' => 'required_if:fulfillment_method,delivery|string|max:190',
            'address_line2' => 'nullable|string|max:190',
            'city' => 'required_if:fulfillment_method,delivery|string|max:120',
            'country' => 'nullable|string|max:120',
            'location_link' => 'nullable|string|max:500',
            'payment_method' => 'nullable|string|in:mtn,moov,celtis',
            'notes' => 'nullable|string|max:2000',
        ]);

        $fulfillmentMethod = (string) $data['fulfillment_method'];

        $shipping = 0;
        $total = $subtotal + $shipping;

        $paymentMethodLabel = match ((string) ($data['payment_method'] ?? '')) {
            'mtn' => 'MTN Mobile Money',
            'moov' => 'Moov Money',
            'celtis' => 'Celtis Cash',
            default => '',
        };

        $order = DB::transaction(function () use ($data, $lines, $subtotal, $shipping, $total, $fulfillmentMethod, $paymentMethodLabel) {
            $orderNumber = $this->generateOrderNumber();

            $internalNotes = [];
            $internalNotes[] = 'Mode : ' . ($fulfillmentMethod === 'delivery' ? 'Livraison' : 'Retrait');
            if ($paymentMethodLabel !== '') {
                $internalNotes[] = 'Paiement : ' . $paymentMethodLabel;
            }
            if (!empty($data['location_link'])) {
                $internalNotes[] = 'Localisation : ' . $data['location_link'];
            }
            if (!empty($data['notes'])) {
                $internalNotes[] = (string) $data['notes'];
            }

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'],
                'address_line1' => $fulfillmentMethod === 'delivery' ? $data['address_line1'] : 'Retrait',
                'address_line2' => $fulfillmentMethod === 'delivery' ? ($data['address_line2'] ?? null) : null,
                'city' => $fulfillmentMethod === 'delivery' ? $data['city'] : 'Retrait',
                'country' => $data['country'] ?? 'Bénin',
                'status' => 'pending',
                'payment_method' => 'whatsapp',
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'notes' => count($internalNotes) ? implode("\n", $internalNotes) : null,
            ]);

            foreach ($lines as $line) {
                $product = $line['product'];
                $quantity = (int) $line['quantity'];
                $lineTotal = (float) $line['line_total'];

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'unit_price' => $product->price,
                    'quantity' => $quantity,
                    'line_total' => $lineTotal,
                ]);
            }

            return $order;
        });

        $whatsappLines = [
            'Bonjour Quisolideo 👋',
            '',
            'Je souhaite passer une commande boutique.',
            'Référence : ' . $order->order_number,
            '',
            'Nom : ' . $data['customer_name'],
            'Téléphone : ' . $data['customer_phone'],
            'Email : ' . $data['customer_email'],
            '',
            'Articles :',
        ];

        foreach ($lines as $line) {
            $product = $line['product'];
            $quantity = (int) $line['quantity'];
            $lineTotal = number_format((float) $line['line_total'], 0, ',', ' ');
            $whatsappLines[] = "- {$product->name} × {$quantity} — {$lineTotal} FCFA";
        }

        $whatsappLines[] = '';
        $whatsappLines[] = 'Total : ' . number_format((float) $total, 0, ',', ' ') . ' FCFA';
        $whatsappLines[] = '';
        $whatsappLines[] = 'Mode : ' . ($fulfillmentMethod === 'delivery' ? 'Livraison' : 'Retrait');

        if ($fulfillmentMethod === 'delivery') {
            $whatsappLines[] = 'Adresse : ' . (string) ($data['address_line1'] ?? '');
            if (!empty($data['address_line2'])) {
                $whatsappLines[] = 'Repères : ' . (string) $data['address_line2'];
            }
            $whatsappLines[] = 'Ville : ' . (string) ($data['city'] ?? '');
            if (!empty($data['country'])) {
                $whatsappLines[] = 'Pays : ' . (string) $data['country'];
            }
            if (!empty($data['location_link'])) {
                $whatsappLines[] = 'Localisation : ' . (string) $data['location_link'];
            }
        }

        if ($paymentMethodLabel !== '') {
            $whatsappLines[] = 'Paiement : ' . $paymentMethodLabel;
        }

        if (!empty($data['notes'])) {
            $whatsappLines[] = '';
            $whatsappLines[] = 'Note : ' . (string) $data['notes'];
        }

        $whatsappMessage = implode("\n", $whatsappLines);
        $whatsappUrl = 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode($whatsappMessage);

        $request->session()->forget($this->cartKey());

        return redirect()
            ->route('shop.thankyou')
            ->with([
                'order_number' => $order->order_number,
                'whatsapp_url' => $whatsappUrl,
            ]);
    }

    public function stripeSuccess(Request $request)
    {
        $sessionId = (string) $request->query('session_id', '');
        if ($sessionId === '') {
            return redirect()->route('shop.index');
        }

        if (!$this->stripeEnabled()) {
            return redirect()
                ->route('checkout.show')
                ->withErrors(['payment_method' => 'Stripe non configuré.']);
        }

        $order = Order::where('stripe_session_id', $sessionId)->first();
        if (!$order) {
            return redirect()
                ->route('shop.index')
                ->with('success', 'Commande introuvable.');
        }

        try {
            Stripe::setApiKey((string) config('services.stripe.secret'));
            $session = StripeCheckoutSession::retrieve([
                'id' => $sessionId,
                'expand' => ['payment_intent'],
            ]);
        } catch (\Throwable $e) {
            report($e);
            return redirect()
                ->route('checkout.show')
                ->withErrors(['payment_method' => 'Impossible de vérifier le paiement Stripe.']);
        }

        $paymentStatus = (string) ($session->payment_status ?? '');
        if ($paymentStatus !== 'paid') {
            return redirect()
                ->route('checkout.show')
                ->withErrors(['payment_method' => 'Paiement non confirmé.']);
        }

        $paymentIntentId = null;
        $paymentIntent = $session->payment_intent ?? null;
        if (is_string($paymentIntent)) {
            $paymentIntentId = $paymentIntent;
        } elseif (is_object($paymentIntent) && isset($paymentIntent->id)) {
            $paymentIntentId = (string) $paymentIntent->id;
        }

        if ($order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'stripe_payment_intent_id' => $paymentIntentId,
                'paid_at' => $order->paid_at ?? now(),
                'status' => $order->status === 'pending' ? 'confirmed' : $order->status,
            ]);
        }

        $request->session()->forget($this->cartKey());

        return redirect()
            ->route('shop.thankyou')
            ->with('order_number', $order->order_number);
    }

    public function stripeCancel()
    {
        return redirect()
            ->route('checkout.show')
            ->withErrors(['payment_method' => 'Paiement annulé. Vous pouvez réessayer.']);
    }

    public function stripeWebhook(Request $request)
    {
        $endpointSecret = (string) config('services.stripe.webhook_secret', '');
        $signatureHeader = (string) $request->header('Stripe-Signature', '');

        if ($endpointSecret === '' || $signatureHeader === '') {
            return response('Webhook non configuré', 400);
        }

        $payload = (string) $request->getContent();

        try {
            $event = Webhook::constructEvent($payload, $signatureHeader, $endpointSecret);
        } catch (UnexpectedValueException $e) {
            return response('Invalid payload', 400);
        } catch (SignatureVerificationException $e) {
            return response('Invalid signature', 400);
        }

        $type = (string) ($event->type ?? '');

        if (in_array($type, ['checkout.session.completed', 'checkout.session.async_payment_succeeded'], true)) {
            $session = $event->data->object ?? null;
            $sessionId = is_object($session) && isset($session->id) ? (string) $session->id : '';
            $paymentStatus = is_object($session) && isset($session->payment_status) ? (string) $session->payment_status : '';

            $paymentIntentId = null;
            if (is_object($session) && isset($session->payment_intent)) {
                $pi = $session->payment_intent;
                if (is_string($pi)) {
                    $paymentIntentId = $pi;
                } elseif (is_object($pi) && isset($pi->id)) {
                    $paymentIntentId = (string) $pi->id;
                }
            }

            if ($sessionId !== '' && $paymentStatus === 'paid') {
                $order = Order::where('stripe_session_id', $sessionId)->first();
                if ($order && $order->payment_status !== 'paid') {
                    $order->update([
                        'payment_status' => 'paid',
                        'stripe_payment_intent_id' => $paymentIntentId,
                        'paid_at' => $order->paid_at ?? now(),
                        'status' => $order->status === 'pending' ? 'confirmed' : $order->status,
                    ]);
                }
            }
        }

        return response('ok', 200);
    }

    public function thankyou(Request $request)
    {
        $orderNumber = session('order_number');
        $whatsappUrl = session('whatsapp_url');
        return view('shop.thankyou', compact('orderNumber', 'whatsappUrl'));
    }
}
