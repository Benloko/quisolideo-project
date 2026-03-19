<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:512',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        }

        $data['is_active'] = $request->has('is_active');
        $data['stock'] = (int) ($data['stock'] ?? 0);

        $product = Product::create($data);

        $firstGalleryPath = null;
        if ($request->hasFile('gallery_images')) {
            $sortOrder = 0;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $publicPath = '/storage/' . $path;
                $product->images()->create([
                    'path' => $publicPath,
                    'sort_order' => $sortOrder++,
                ]);

                if ($firstGalleryPath === null) {
                    $firstGalleryPath = $publicPath;
                }
            }
        }

        if (!$product->image && $firstGalleryPath) {
            $product->update(['image' => $firstGalleryPath]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit créé');
    }

    public function edit(Product $product)
    {
        $product->load('images');
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string|max:512',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = '/storage/' . $path;
        } else {
            unset($data['image']);
        }

        $data['is_active'] = $request->has('is_active');
        $data['stock'] = (int) ($data['stock'] ?? 0);

        $product->update($data);

        $firstNewGalleryPath = null;
        if ($request->hasFile('gallery_images')) {
            $nextSortOrder = (int) ($product->images()->max('sort_order') ?? -1) + 1;
            foreach ($request->file('gallery_images') as $file) {
                $path = $file->store('products/gallery', 'public');
                $publicPath = '/storage/' . $path;
                $product->images()->create([
                    'path' => $publicPath,
                    'sort_order' => $nextSortOrder++,
                ]);

                if ($firstNewGalleryPath === null) {
                    $firstNewGalleryPath = $publicPath;
                }
            }
        }

        if (!$product->image && $firstNewGalleryPath) {
            $product->update(['image' => $firstNewGalleryPath]);
        }

        return redirect()->route('admin.products.index')->with('success', 'Produit mis à jour');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produit supprimé');
    }
}
