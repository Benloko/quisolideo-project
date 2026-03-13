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

        $stripeEnabled = $this->stripeEnabled();

        return view('shop.checkout', compact('lines', 'subtotal', 'shipping', 'total', 'stripeEnabled'));
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

        $data = $request->validate([
            'customer_name' => 'required|string|max:120',
            'customer_email' => 'required|email|max:190',
            'customer_phone' => 'nullable|string|max:60',
            'address_line1' => 'required|string|max:190',
            'address_line2' => 'nullable|string|max:190',
            'city' => 'required|string|max:120',
            'country' => 'nullable|string|max:120',
            'notes' => 'nullable|string|max:2000',
            'payment_method' => 'nullable|string|in:cod,stripe',
        ]);

        $paymentMethod = (string) ($data['payment_method'] ?? 'cod');
        if ($paymentMethod === 'stripe' && !$this->stripeEnabled()) {
            return back()
                ->withErrors(['payment_method' => 'Paiement par carte indisponible (Stripe non configuré).'])
                ->withInput();
        }

        $shipping = 0;
        $total = $subtotal + $shipping;

        $order = DB::transaction(function () use ($data, $lines, $subtotal, $shipping, $total, $paymentMethod) {
            $orderNumber = $this->generateOrderNumber();

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_name' => $data['customer_name'],
                'customer_email' => $data['customer_email'],
                'customer_phone' => $data['customer_phone'] ?? null,
                'address_line1' => $data['address_line1'],
                'address_line2' => $data['address_line2'] ?? null,
                'city' => $data['city'],
                'country' => $data['country'] ?? 'Bénin',
                'status' => 'pending',
                'payment_method' => $paymentMethod,
                'payment_status' => 'unpaid',
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
                'notes' => $data['notes'] ?? null,
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

        if ($paymentMethod === 'cod') {
            $request->session()->forget($this->cartKey());

            return redirect()
                ->route('shop.thankyou')
                ->with('order_number', $order->order_number);
        }

        try {
            Stripe::setApiKey((string) config('services.stripe.secret'));

            $lineItems = [];
            foreach ($lines as $line) {
                $product = $line['product'];
                $quantity = (int) $line['quantity'];

                $lineItems[] = [
                    'price_data' => [
                        'currency' => $this->stripeCurrency(),
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $this->stripeUnitAmount((float) $product->price),
                    ],
                    'quantity' => $quantity,
                ];
            }

            $session = StripeCheckoutSession::create([
                'mode' => 'payment',
                'line_items' => $lineItems,
                'customer_email' => $data['customer_email'],
                'client_reference_id' => (string) $order->id,
                'metadata' => [
                    'order_id' => (string) $order->id,
                    'order_number' => (string) $order->order_number,
                ],
                'success_url' => route('checkout.stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('checkout.stripe.cancel'),
                'locale' => 'fr',
            ]);

            $order->update([
                'stripe_session_id' => $session->id,
            ]);

            return redirect()->away($session->url);
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withErrors(['payment_method' => 'Impossible de démarrer le paiement Stripe.'])
                ->withInput();
        }
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
        return view('shop.thankyou', compact('orderNumber'));
    }
}
