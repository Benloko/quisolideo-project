@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Formations</h1>
      <p class="admin-sub mb-0">Creer et maintenir le catalogue de formations.</p>
    </div>

    <a href="{{ route('admin.trainings.create') }}" class="btn btn-success admin-add-btn" title="Ajouter une formation" aria-label="Ajouter une formation">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M12 5v14"></path>
        <path d="M5 12h14"></path>
      </svg>
    </a>
  </div>

  <form method="GET" class="admin-search-box mb-3" role="search" aria-label="Rechercher une formation">
    <div class="admin-search-field">
      <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <circle cx="11" cy="11" r="7"></circle>
        <path d="m21 21-4.3-4.3"></path>
      </svg>
      <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Rechercher une formation...">
    </div>

    <button class="btn btn-success admin-icon-btn" title="Lancer la recherche" aria-label="Lancer la recherche">
      <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
        <path d="M22 2 11 13"></path>
        <path d="M22 2 15 22 11 13 2 9z"></path>
      </svg>
    </button>

    @if(request()->has('q') && request('q') !== '')
      <a href="{{ route('admin.trainings.index') }}" class="btn btn-outline-secondary admin-icon-btn" title="Effacer la recherche" aria-label="Effacer la recherche">
        <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
          <path d="M18 6 6 18"></path>
          <path d="m6 6 12 12"></path>
        </svg>
      </a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list admin-list--trainings">
    @forelse($trainings as $t)
      <article class="admin-list-item admin-list-item--training">
        <div class="admin-training-cover" @if(!empty($t->image)) style="background-image:url('{{ $t->image }}')" @endif>
        </div>

        <div class="admin-training-main">
          <h2>{{ $t->title }}</h2>
          <p>{{ \Illuminate\Support\Str::limit(strip_tags((string) $t->short_description), 110) ?: 'Description a venir.' }}</p>
        </div>

        <div class="admin-actions-inline admin-actions-inline--training" aria-label="Actions formation">
          <a href="{{ route('trainings.show', $t->slug) }}" class="admin-icon-btn" title="Voir" aria-label="Voir la formation">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
              <circle cx="12" cy="12" r="3"></circle>
            </svg>
          </a>

          <a href="{{ route('admin.trainings.edit', $t->id) }}" class="admin-icon-btn admin-icon-btn--edit" title="Modifier" aria-label="Modifier la formation">
            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M12 20h9"></path>
              <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
            </svg>
          </a>

          <form action="{{ route('admin.trainings.destroy', $t->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="admin-icon-btn admin-icon-btn--delete" title="Supprimer" aria-label="Supprimer la formation">
              <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M3 6h18"></path>
                <path d="M8 6V4h8v2"></path>
                <path d="M19 6l-1 14H6L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
              </svg>
            </button>
          </form>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucune formation disponible.</div>
    @endforelse
  </div>
</div>
@endsection
