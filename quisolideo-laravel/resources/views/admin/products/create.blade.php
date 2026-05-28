@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Nouveau produit</h1>
      <p class="admin-sub mb-0">Ajoutez un produit au catalogue.</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label">Categorie</label>
          <select name="product_category_id" class="form-select" required>
            @foreach($categories as $c)
              <option value="{{ $c->id }}" {{ (string)old('product_category_id') === (string)$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
          </select>
          @error('product_category_id')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label">Nom</label>
          <input name="name" class="form-control" value="{{ old('name') }}" required>
          @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
        </div>
      </div>

      <div>
        <label class="form-label">Slug</label>
        <input name="slug" class="form-control" value="{{ old('slug') }}" required>
        @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="form-label">Courte description</label>
        <input name="short_description" class="form-control" value="{{ old('short_description') }}">
      </div>

      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="6">{{ old('description') }}</textarea>
      </div>

      <div>
        <label class="form-label">Image principale</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div>
        <label class="form-label">Galerie (plusieurs images)</label>
        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
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
          <input name="price" class="form-control" type="number" step="0.01" value="{{ old('price') }}" required>
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">Stock</label>
          <input name="stock" class="form-control" type="number" min="0" value="{{ old('stock') }}">
        </div>
        <div class="col-12 col-md-3">
          <div class="form-check mt-2">
            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" {{ old('is_active', 1) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Produit actif</label>
          </div>
        </div>
      </div>

      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Creer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.products.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
