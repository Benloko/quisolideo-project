@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Nouvelle catégorie</h2>
  <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input name="slug" class="form-control" value="{{ old('slug') }}" required>
      @error('slug')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Message / description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
      @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      <input type="file" name="image" class="form-control" accept="image/*">
      @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>

    <button class="btn btn-success">Créer</button>
    <a class="btn btn-secondary" href="{{ route('admin.categories.index') }}">Annuler</a>
  </form>
</div>
@endsection
