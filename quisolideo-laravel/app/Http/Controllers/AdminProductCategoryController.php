<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class AdminProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('name')->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug',
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = '/storage/' . $path;
        }

        ProductCategory::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie créée');
    }

    public function edit(ProductCategory $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, ProductCategory $category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $category->id,
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $data['image'] = '/storage/' . $path;
        } else {
            unset($data['image']);
        }

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Catégorie mise à jour');
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Catégorie supprimée');
    }
}
