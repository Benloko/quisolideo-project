<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:512',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['stock'] = (int) ($data['stock'] ?? 0);

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit créé');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string|max:512',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        $data['is_active'] = $request->has('is_active');
        $data['stock'] = (int) ($data['stock'] ?? 0);

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé');
    }
}
