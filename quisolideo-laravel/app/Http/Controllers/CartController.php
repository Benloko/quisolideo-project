<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
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

    private function saveCart(Request $request, array $cart): void
    {
        $request->session()->put($this->cartKey(), $cart);
    }

    public function show(Request $request)
    {
        $cart = $this->getCart($request);
        $productIds = array_keys($cart);

        $products = count($productIds)
            ? Product::whereIn('id', $productIds)->get()->keyBy('id')
            : collect();

        $lines = [];
        $subtotal = 0;

        foreach ($cart as $productId => $qty) {
            $product = $products->get((int) $productId);
            if (!$product) {
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

        return view('shop.cart', [
            'lines' => $lines,
            'subtotal' => $subtotal,
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $productId = (string) $data['product_id'];
        $quantity = (int) ($data['quantity'] ?? 1);

        $cart = $this->getCart($request);
        $cart[$productId] = (int) ($cart[$productId] ?? 0) + $quantity;

        $this->saveCart($request, $cart);

        return redirect()->route('cart.show')->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0|max:99',
        ]);

        $cart = $this->getCart($request);

        foreach ($data['quantities'] as $productId => $qty) {
            $productId = (string) $productId;
            $qty = (int) $qty;
            if ($qty <= 0) {
                unset($cart[$productId]);
            } else {
                $cart[$productId] = $qty;
            }
        }

        $this->saveCart($request, $cart);

        return back()->with('success', 'Panier mis à jour.');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|integer',
        ]);

        $cart = $this->getCart($request);
        unset($cart[(string) $data['product_id']]);
        $this->saveCart($request, $cart);

        return back()->with('success', 'Produit retiré du panier.');
    }

    public function clear(Request $request)
    {
        $this->saveCart($request, []);

        return back()->with('success', 'Panier vidé.');
    }
}
