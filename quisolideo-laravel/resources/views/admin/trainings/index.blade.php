@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Formations</h2>
    <a href="{{ route('admin.trainings.create') }}" class="btn btn-success">Nouvelle formation</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="list-group">
    @foreach($trainings as $t)
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $t->title }}</strong>
          <div class="text-muted">{{ $t->short_description }}</div>
        </div>
        <div>
          <a href="{{ route('trainings.show', $t->slug) }}" class="btn btn-outline-primary btn-sm">Voir</a>
          <a href="{{ route('admin.trainings.edit', $t->id) }}" class="btn btn-primary btn-sm">Modifier</a>
          <form action="{{ route('admin.trainings.destroy', $t->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Supprimer</button>
          </form>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
