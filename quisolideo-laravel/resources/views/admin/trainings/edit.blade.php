@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier la formation</h2>
  <form method="POST" action="{{ route('admin.trainings.update', $training->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label class="form-label">Titre</label>
      <input name="title" class="form-control" value="{{ old('title',$training->title) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Slug</label>
      <input name="slug" class="form-control" value="{{ old('slug',$training->slug) }}" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Courte description</label>
      <input name="short_description" class="form-control" value="{{ old('short_description',$training->short_description) }}">
    </div>
    <div class="mb-3">
      <label class="form-label">Contenu</label>
      <textarea name="content" class="form-control" rows="6">{{ old('content',$training->content) }}</textarea>
    </div>
    <div class="mb-3">
      <label class="form-label">Image</label>
      @if($training->image)
        <div class="mb-2">
          <img src="{{ $training->image }}" alt="{{ $training->title }}" style="max-width:220px;max-height:140px;object-fit:cover;border-radius:12px">
        </div>
      @endif
      <input type="file" name="image" class="form-control" accept="image/*">
      <div class="text-muted small mt-1">Laisser vide pour conserver l'image actuelle.</div>
      @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Galerie (plusieurs images)</label>
      @if($training->images && $training->images->count())
        <div class="mb-2 d-flex flex-wrap gap-2">
          @foreach($training->images as $img)
            <img src="{{ $img->path }}" alt="{{ $training->title }}" style="width:90px;height:70px;object-fit:cover;border-radius:12px">
          @endforeach
        </div>
      @endif
      <input type="file" name="gallery_images[]" class="form-control" accept="image/*" multiple>
      <div class="text-muted small mt-1">Les nouvelles images s'ajoutent à la galerie existante.</div>
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
      @if($training->videos && $training->videos->count())
        <div class="mb-3">
          @foreach($training->videos as $video)
            <div class="d-flex flex-column flex-md-row gap-3 align-items-start mb-3 p-3" style="border:1px solid rgba(11,17,24,0.08);border-radius:14px;background:#fff">
              <video src="{{ $video->path }}" controls preload="metadata" style="width:240px;max-width:100%;height:150px;object-fit:cover;border-radius:12px;background:#000"></video>
              <div class="flex-grow-1" style="min-width:260px">
                <div class="fw-bold mb-2">Description</div>
                <textarea name="video_descriptions[{{ $video->id }}]" class="form-control" rows="3" placeholder="Décrivez brièvement ce que montre cette vidéo…">{{ old('video_descriptions.' . $video->id, $video->description) }}</textarea>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      <input type="file" name="gallery_videos[]" class="form-control" accept="video/*" multiple>
      <div class="text-muted small mt-1">Les nouvelles vidéos s'ajoutent à la liste existante (MP4 / WebM / MOV, max 50 Mo).</div>
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
      @php
        $firstVideoDescError = null;
        foreach ($errors->getMessages() as $key => $messages) {
            if (str_starts_with($key, 'video_descriptions.') && isset($messages[0])) {
                $firstVideoDescError = $messages[0];
                break;
            }
        }
      @endphp
      @if($firstVideoDescError)
        <div class="text-danger small mt-1">{{ $firstVideoDescError }}</div>
      @endif
    </div>
    <div class="row">
      <div class="col-md-3 mb-3"><label class="form-label">Places</label><input name="seats" class="form-control" type="number" value="{{ old('seats',$training->seats) }}"></div>
      <div class="col-md-3 mb-3"><label class="form-label">Prix</label><input name="price" class="form-control" type="number" step="0.01" value="{{ old('price',$training->price) }}"></div>
    </div>
    <button class="btn btn-primary">Enregistrer</button>
    <a class="btn btn-secondary" href="{{ route('admin.trainings.index') }}">Annuler</a>
  </form>
</div>
@endsection
