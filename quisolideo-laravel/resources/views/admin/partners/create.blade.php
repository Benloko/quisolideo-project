@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Nouveau partenaire</h2>
  <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Site web</label>
      <input name="website" class="form-control">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Logo</label>
      <input type="file" name="logo" class="form-control" accept="image/*">
      @error('logo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-success">Créer</button>
    <a class="btn btn-secondary" href="{{ route('admin.partners.index') }}">Annuler</a>
  </form>
</div>
@endsection
