@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Partenaires</h2>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-success">Nouveau partenaire</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="list-group">
    @foreach($partners as $p)
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $p->name }}</strong>
          <div class="text-muted">{{ $p->website }}</div>
        </div>
        <div>
          <a href="{{ $p->website }}" class="btn btn-outline-primary btn-sm" target="_blank">Site</a>
          <a href="{{ route('admin.partners.edit', $p->id) }}" class="btn btn-primary btn-sm">Modifier</a>
          <form action="{{ route('admin.partners.destroy', $p->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ?')">
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
