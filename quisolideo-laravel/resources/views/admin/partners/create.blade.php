@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Nouveau partenaire</h1>
      <p class="admin-sub mb-0">Ajoutez un partenaire avec logo et lien.</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.partners.store') }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      <div>
        <label class="form-label">Nom</label>
        <input name="name" class="form-control" value="{{ old('name') }}" required>
        @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Site web</label>
        <input name="website" class="form-control" value="{{ old('website') }}" placeholder="https://...">
        @error('website')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Logo</label>
        <input type="file" name="logo" class="form-control" accept="image/*">
        @error('logo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>

      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Creer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.partners.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
