@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Modifier produit</h1>
      <p class="admin-sub mb-0">Mettez a jour la fiche produit.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      @method('PUT')
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Categorie</label>
          <select name="product_category_id" class="form-select" required>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" {{ (string)old('product_category_id', $product->product_category_id) === (string)$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
          </select>
          @error('product_category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Nom</label>
          <input name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
      </div>

      <div>
        <label class="form-label">Slug</label>
        <input name="slug" class="form-control" value="{{ old('slug', $product->slug) }}" required>
        @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="form-label">Courte description</label>
        <input name="short_description" class="form-control" value="{{ old('short_description', $product->short_description) }}">
      </div>

      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="6">{{ old('description', $product->description) }}</textarea>
      </div>

      <div>
        <label class="form-label">Image principale</label>
        @if($product->image)
          <div class="mb-2"><img src="{{ $product->image }}" alt="{{ $product->name }}" class="admin-preview-image"></div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Laisser vide pour conserver l'image actuelle.</div>
        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="form-label">Galerie (plusieurs images)</label>
        @if($product->images && $product->images->count())
          <div class="admin-gallery-thumbs mb-2">
            @foreach($product->images as $img)
              <img src="{{ $img->path }}" alt="{{ $product->name }}">
            @endforeach
          </div>
        @endif
        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
        <div class="form-text">Les nouvelles images s'ajoutent a la galerie existante.</div>
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

      <div class="row g-3 align-items-end">
        <div class="col-12 col-md-3">
          <label class="form-label">Prix (FCFA)</label>
          <input name="price" class="form-control" type="number" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">Stock</label>
          <input name="stock" class="form-control" type="number" min="0" value="{{ old('stock', $product->stock) }}">
        </div>
        <div class="col-12 col-md-3">
          <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Produit actif</label>
          </div>
        </div>
      </div>

      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Enregistrer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.products.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
