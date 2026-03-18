@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Nouveau produit</h2>
  <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input name="slug" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Courte description</label>
      <input name="short_description" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="6"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control" accept="image/*">
      @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
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
    <div class="row">
      <div class="col-md-3 mb-3"><label class="form-label">Prix (FCFA)</label><input name="price" class="form-control" type="number" step="0.01" required></div>
      <div class="col-md-3 mb-3"><label class="form-label">Stock</label><input name="stock" class="form-control" type="number" min="0"></div>
      <div class="col-md-3 mb-3 d-flex align-items-end">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="is_active" id="is_active" checked>
          <label class="form-check-label" for="is_active">Actif</label>
        </div>
      </div>
    </div>
    <button class="btn btn-success">Créer</button>
    <a class="btn btn-secondary" href="{{ route('admin.products.index') }}">Annuler</a>
  </form>
</div>
@endsection
