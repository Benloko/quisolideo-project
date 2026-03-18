@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Nouvelle formation</h2>
  <form method="POST" action="{{ route('admin.trainings.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Titre</label>
      <input name="title" class="form-control" required>
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
      <label class="form-label">Contenu</label>
      <textarea name="content" class="form-control" rows="6"></textarea>
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
    <div class="mb-3">
      <label class="form-label">Vidéos (plusieurs)</label>
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
      <div class="text-muted small mt-1">Formats acceptés : MP4 / WebM / MOV (max 50 Mo par vidéo).</div>
    </div>
    <div class="row">
      <div class="col-md-3 mb-3"><label class="form-label">Places</label><input name="seats" class="form-control" type="number"></div>
      <div class="col-md-3 mb-3"><label class="form-label">Prix</label><input name="price" class="form-control" type="number" step="0.01"></div>
    </div>
    <button class="btn btn-success">Créer</button>
    <a class="btn btn-secondary" href="{{ route('admin.trainings.index') }}">Annuler</a>
  </form>
</div>
@endsection
