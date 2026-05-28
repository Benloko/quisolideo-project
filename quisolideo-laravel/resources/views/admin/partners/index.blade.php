@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Partenaires</h1>
      <p class="admin-sub mb-0">Mettre a jour le reseau de partenaires et leurs liens.</p>
    </div>
    <a href="{{ route('admin.partners.create') }}" class="btn btn-success btn-sm admin-pill-btn">Nouveau partenaire</a>
  </div>

  <form method="GET" class="admin-filter mb-3">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Rechercher un partenaire...">
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->has('q'))
      <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list">
    @forelse($partners as $p)
      <article class="admin-list-item">
        <div>
          <h2>{{ $p->name }}</h2>
          <p>{{ $p->website ?: 'Aucun site renseigne' }}</p>
        </div>
        <div class="admin-actions-inline">
          @if($p->website)
            <a href="{{ $p->website }}" class="btn btn-outline-secondary btn-sm admin-pill-btn" target="_blank" rel="noopener noreferrer">Site</a>
          @endif
          <a href="{{ route('admin.partners.edit', $p->id) }}" class="btn btn-success btn-sm admin-pill-btn">Modifier</a>
          <form action="{{ route('admin.partners.destroy', $p->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
          </form>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucun partenaire pour le moment.</div>
    @endforelse
  </div>
</div>
@endsection
