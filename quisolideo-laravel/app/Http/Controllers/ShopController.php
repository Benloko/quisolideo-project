<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::query()
            ->whereHas('products', function ($q) {
                $q->where('is_active', true);
            })
            ->withCount([
                'products as products_count' => function ($q) {
                    $q->where('is_active', true);
                },
            ])
            ->addSelect([
                'min_price' => Product::query()
                    ->selectRaw('MIN(price)')
                    ->whereColumn('products.product_category_id', 'product_categories.id')
                    ->where('products.is_active', true),
            ])
            ->orderBy('name')
            ->get();

        return view('shop.index', [
            'categories' => $categories,
        ]);
    }

    public function category(string $slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = Product::where('product_category_id', $category->id)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('shop.category', compact('category', 'products'));
    }

    public function show(string $slug)
    {
        $product = Product::with('images')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('shop.show', compact('product'));
    }
}
