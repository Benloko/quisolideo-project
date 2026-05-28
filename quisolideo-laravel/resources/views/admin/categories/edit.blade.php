@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Modifier categorie</h1>
      <p class="admin-sub mb-0">Mettez a jour la fiche categorie.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      @method('PUT')

      <div>
        <label class="form-label">Nom</label>
        <input name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Slug</label>
        <input name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
        @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
        @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Image</label>
        @if($category->image)
          <div class="mb-2">
            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="admin-preview-image">
          </div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Laisser vide pour conserver l'image actuelle.</div>
        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Enregistrer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.categories.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
