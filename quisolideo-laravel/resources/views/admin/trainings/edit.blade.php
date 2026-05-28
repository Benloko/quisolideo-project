@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Modifier formation</h1>
      <p class="admin-sub mb-0">Mettez a jour le contenu et les medias.</p>
    </div>
    <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  <section class="admin-card p-3 p-md-4">
    <form method="POST" action="{{ route('admin.trainings.update', $training->id) }}" enctype="multipart/form-data" class="d-grid gap-3">
      @csrf
      @method('PUT')
      <div>
        <label class="form-label">Titre</label>
        <input name="title" class="form-control" value="{{ old('title',$training->title) }}" required>
      </div>
      <div>
        <label class="form-label">Slug</label>
        <input name="slug" class="form-control" value="{{ old('slug',$training->slug) }}" required>
      </div>
      <div>
        <label class="form-label">Courte description</label>
        <input name="short_description" class="form-control" value="{{ old('short_description',$training->short_description) }}">
      </div>
      <div>
        <label class="form-label">Contenu</label>
        <textarea name="content" class="form-control" rows="7">{{ old('content',$training->content) }}</textarea>
      </div>
      <div>
        <label class="form-label">Image principale</label>
        @if($training->image)
          <div class="mb-2"><img src="{{ $training->image }}" alt="{{ $training->title }}" class="admin-preview-image"></div>
        @endif
        <input type="file" name="image" class="form-control" accept="image/*">
        <div class="form-text">Laisser vide pour conserver l'image actuelle.</div>
        @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
      </div>
      <div>
        <label class="form-label">Galerie images</label>
        @if($training->images && $training->images->count())
          <div class="admin-gallery-thumbs mb-2">
            @foreach($training->images as $img)
              <img src="{{ $img->path }}" alt="{{ $training->title }}">
            @endforeach
          </div>
        @endif
        <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
        <div class="form-text">Les nouvelles images s'ajoutent a la galerie existante.</div>
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
        @if($training->videos && $training->videos->count())
          <div class="d-grid gap-2 mb-2">
            @foreach($training->videos as $video)
              <div class="admin-media-item">
                <video src="{{ $video->path }}" controls preload="metadata"></video>
                <div>
                  <label class="form-label">Description video</label>
                  <textarea name="video_descriptions[{{ $video->id }}]" class="form-control" rows="3" placeholder="Description de la video">{{ old('video_descriptions.' . $video->id, $video->description) }}</textarea>
                </div>
              </div>
            @endforeach
          </div>
        @endif
        <input type="file" name="gallery_videos[]" class="form-control" accept="video/*" multiple>
        <div class="form-text">Nouvelles vidéos: MP4 / WebM / MOV (max 50 Mo).</div>
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
      </div>
      <div class="row g-3">
        <div class="col-12 col-md-3">
          <label class="form-label">Places</label>
          <input name="seats" class="form-control" type="number" value="{{ old('seats',$training->seats) }}">
        </div>
        <div class="col-12 col-md-3">
          <label class="form-label">Prix</label>
          <input name="price" class="form-control" type="number" step="0.01" value="{{ old('price',$training->price) }}">
        </div>
      </div>
      <div class="admin-actions-inline">
        <button class="btn btn-success btn-sm admin-pill-btn">Enregistrer</button>
        <a class="btn btn-outline-secondary btn-sm admin-pill-btn" href="{{ route('admin.trainings.index') }}">Annuler</a>
      </div>
    </form>
  </section>
</div>
@endsection
