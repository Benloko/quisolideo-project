@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Nouvelle formation</h1>
      <p class="admin-sub mb-0">Ajoutez une formation avec contenus medias.</p>
    </div>
    <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      <div>
        <label class="form-label">Titre</label>
        <input name="title" class="form-control" value="{{ old('title') }}" required>
        @error('title')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
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
        <label class="form-label">Contenu</label>
        <textarea name="content" class="form-control" rows="7">{{ old('content') }}</textarea>
      </div>
      <div>
        <label class="form-label">Image principale</label>
        <input type="file" name="image" class="form-control" accept="image/*">
        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Galerie images</label>
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
      <div>
        <label class="form-label">Vidéos</label>
        <input type="file" name="gallery_videos[]" class="form-control" accept="video/*" multiple>
        @php
          $firstVideoItemError = null;
          foreach ($errors->getMessages() as $key => $messages) {
              if (str_starts_with($key, 'gallery_videos.') && isset($messages[0])) {
                  $firstVideoItemError = $messages[0];
                  break;
              }
          }
        @endphp
        @if($firstVideoItemError)
          <div class="text-danger small mt-1">{{ $firstVideoItemError }}</div>
        @endif
        <div class="form-text">Formats acceptes: MP4 / WebM / MOV (max 50 Mo par video).</div>
      </div>
      <div class="row g-3">
        <div class="col-12 col-md-3">
          <label class="form-label">Places</label>
          <input name="seats" class="form-control" type="number" value="{{ old('seats') }}">
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">Prix</label>
          <input name="price" class="form-control" type="number" step="0.01" value="{{ old('price') }}">
        </div>
      </div>
      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Creer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.trainings.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
