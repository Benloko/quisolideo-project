@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Inscriptions formations</h1>
      <p class="admin-sub mb-0">Toutes les demandes recues depuis les fiches formations.</p>
    </div>
    <a href="{{ route('admin.entreprenariat.dashboard') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Dashboard</a>
  </div>

  <form method="GET" class="admin-filter mb-3 admin-filter--wide">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nom, email, telephone...">
    <select name="training_id" class="form-select">
      <option value="">Toutes formations</option>
      @foreach($trainings as $training)
        <option value="{{ $training->id }}" {{ (string) request('training_id') === (string) $training->id ? 'selected' : '' }}>{{ $training->title }}</option>
      @endforeach
    </select>
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->hasAny(['q', 'training_id']))
      <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list">
    @forelse($registrations as $r)
      <article class="admin-list-item">
        <div>
          <h2>{{ $r->first_name }} {{ $r->last_name }}</h2>
          <p>
            {{ $r->email }}
            @if($r->phone)
              · {{ $r->phone }}
            @endif
          </p>
          <p class="small text-muted mb-0">
            Formation: {{ $r->training?->title ?? 'Formation supprimee' }} · Recu le {{ $r->created_at?->format('d/m/Y a H:i') }}
          </p>
        </div>
        <div class="admin-actions-inline">
          <a href="{{ route('admin.registrations.show', $r) }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Voir</a>
          <form action="{{ route('admin.registrations.destroy', $r) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer cette inscription ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
          </form>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucune inscription pour le moment.</div>
    @endforelse
  </div>
</div>
@endsection
