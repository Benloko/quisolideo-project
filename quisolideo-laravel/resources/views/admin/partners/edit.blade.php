@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier partenaire</h2>
  <form method="POST" action="{{ route('admin.partners.update', $partner->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nom</label>
      <input name="name" class="form-control" value="{{ old('name',$partner->name) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Site web</label>
      <input name="website" class="form-control" value="{{ old('website',$partner->website) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Description</label>
      <textarea name="description" class="form-control" rows="4">{{ old('description',$partner->description) }}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Logo</label>
      @if($partner->logo)
        <div class="mb-2">
          <img src="{{ $partner->logo }}" alt="{{ $partner->name }}" style="max-width:220px;max-height:140px;object-fit:contain;border-radius:12px;background:#fff">
        </div>
      @endif
      <input type="file" name="logo" class="form-control" accept="image/*">
      <div class="text-muted small mt-1">Laisser vide pour conserver le logo actuel.</div>
      @error('logo')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Enregistrer</button>
    <a class="btn btn-secondary" href="{{ route('admin.partners.index') }}">Annuler</a>
  </form>
</div>
@endsection
