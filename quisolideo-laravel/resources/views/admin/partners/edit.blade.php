@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Modifier partenaire</h1>
      <p class="admin-sub mb-0">Mettez a jour les informations du partenaire.</p>
    </div>
    <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      @method('PUT')
      <div>
        <label class="form-label">Nom</label>
        <input name="name" class="form-control" value="{{ old('name',$partner->name) }}" required>
        @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Site web</label>
        <input name="website" class="form-control" value="{{ old('website',$partner->website) }}">
        @error('website')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4">{{ old('description',$partner->description) }}</textarea>
        @error('description')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Logo</label>
        @if($partner->logo)
          <div class="mb-2">
            <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" class="admin-preview-image admin-preview-image--contain">
          </div>
        @endif
        <input type="file" name="logo" class="form-control" accept="image/*">
        <div class="form-text">Laisser vide pour conserver le logo actuel.</div>
        @error('logo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Enregistrer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.partners.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
