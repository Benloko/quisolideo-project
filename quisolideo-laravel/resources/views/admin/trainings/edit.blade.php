@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2>Modifier la formation</h2>
  <form method="POST" action="{{ route('admin.trainings.update', $training->id) }}">
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
      <label class="form-label">Image (URL)</label>
      <input name="image" class="form-control" value="{{ old('image',$training->image) }}">
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
