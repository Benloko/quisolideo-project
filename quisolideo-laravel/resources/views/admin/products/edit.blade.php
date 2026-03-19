@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier produit</h2>
  <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Catégorie</label>
      <select name="product_category_id" class="form-select" required>
        @foreach($categories as $c)
          <option value="{{ $c->id }}" {{ (string)old('product_category_id', $product->product_category_id) === (string)$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
        @endforeach
      </select>
      @error('product_category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
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
      <label class="form-label">Image</label>
      @if($product->image)
        <div class="mb-2">
          <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-width:220px;max-height:140px;object-fit:cover;border-radius:12px">
        </div>
      @endif
      <input type="file" name="image" class="form-control" accept="image/*">
      <div class="text-muted small mt-1">Laisser vide pour conserver l'image actuelle.</div>
      @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Galerie (plusieurs images)</label>
      @if($product->images && $product->images->count())
        <div class="mb-2 d-flex flex-wrap gap-2">
          @foreach($product->images as $img)
            <img src="{{ $img->path }}" alt="{{ $product->name }}" style="width:90px;height:70px;object-fit:cover;border-radius:12px">
          @endforeach
        </div>
      @endif
      <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
      <div class="text-muted small mt-1">Les nouvelles images s'ajoutent à la galerie existante.</div>
      @php
        $firstGalleryItemError = null;
        foreach ($errors->getMessages() as $key => $messages) {
            if (str_starts_with($key, 'gallery_images.') && isset($messages[0])) {
                $firstGalleryItemError = $messages[0];
                break;
            }
        }
      @endphp
      @if($firstGalleryItemError)
        <div class="text-danger small mt-1">{{ $firstGalleryItemError }}</div>
      @endif
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
