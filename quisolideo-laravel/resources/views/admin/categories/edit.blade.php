@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier catégorie</h2>
  <form method="POST" action="{{ route('admin.categories.update', $category->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
      @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input name="slug" class="form-control" value="{{ old('slug', $category->slug) }}" required>
      @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Message / description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description', $category->description) }}</textarea>
      @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      @if($category->image)
        <div class="mb-2">
          <img src="{{ $category->image }}" alt="{{ $category->name }}" style="max-width:220px;max-height:140px;object-fit:cover;border-radius:12px">
        </div>
      @endif
      <input type="file" name="image" class="form-control" accept="image/*">
      <div class="text-muted small mt-1">Laisser vide pour conserver l'image actuelle.</div>
      @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>

    <button class="btn btn-primary">Enregistrer</button>
    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Annuler</a>
  </form>
</div>
@endsection
