<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        if (mb_strlen($q) > 120) {
            $q = mb_substr($q, 0, 120);
        }

        $products = Product::where('is_active', true)
            ->when($q !== '', function ($query) use ($q) {
                $like = '%' . $q . '%';
                $query->where(function ($sub) use ($like) {
                    $sub->where('name', 'like', $like)
                        ->orWhere('short_description', 'like', $like)
                        ->orWhere('description', 'like', $like);
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shop.index', [
            'products' => $products,
            'q' => $q,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('shop.show', compact('product'));
    }
}
