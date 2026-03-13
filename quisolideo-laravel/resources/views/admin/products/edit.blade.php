@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier produit</h2>
  <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Courte description</label>
      <input name="short_description" class="form-control" value="{{ old('short_description', $product->short_description) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="6">{{ old('description', $product->description) }}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Image (URL)</label>
      <input name="image" class="form-control" value="{{ old('image', $product->image) }}">
    </div>
    <div class="row">
      <div class="col-md-3 mb-3"><label class="form-label">Prix (FCFA)</label><input name="price" class="form-control" type="number" step="0.01" value="{{ old('price', $product->price) }}" required></div>
      <div class="col-md-3 mb-3"><label class="form-label">Stock</label><input name="stock" class="form-control" type="number" min="0" value="{{ old('stock', $product->stock) }}"></div>
      <div class="col-md-3 mb-3 d-flex align-items-end">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
          <label class="form-check-label" for="is_active">Actif</label>
        </div>
      </div>
    </div>
    <button class="btn btn-primary">Enregistrer</button>
    <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Annuler</a>
  </form>
</div>
@endsection
