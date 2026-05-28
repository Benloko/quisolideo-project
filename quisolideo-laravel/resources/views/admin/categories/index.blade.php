@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Categories</h1>
      <p class="admin-sub mb-0">Organiser les familles de produits.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-sm admin-pill-btn">Nouvelle categorie</a>
  </div>

  <form method="GET" class="admin-filter mb-3">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Rechercher une categorie...">
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->has('q'))
      <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list">
    @forelse($categories as $c)
      <article class="admin-list-item">
        <div class="d-flex align-items-center gap-3">
          @if($c->image)
            <img src="{{ $c->image }}" alt="{{ $c->name }}" class="admin-thumb">
          @else
            <span class="admin-thumb admin-thumb--empty" aria-hidden="true"></span>
          @endif
          <div>
            <h2>{{ $c->name }}</h2>
            <p>/{{ $c->slug }}</p>
          </div>
        </div>
        <div class="admin-actions-inline">
          <a href="{{ route('admin.categories.edit', $c->id) }}" class="btn btn-success btn-sm admin-pill-btn">Modifier</a>
          <form action="{{ route('admin.categories.destroy', $c->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
          </form>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucune categorie disponible.</div>
    @endforelse
  </div>
</div>
@endsection
