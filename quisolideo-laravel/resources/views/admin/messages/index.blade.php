@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Entreprenariat</p>
      <h1 class="admin-title mb-1">Messages contact</h1>
      <p class="admin-sub mb-0">Demandes recues via le formulaire de contact.</p>
    </div>
    @if(!empty($unreadCount))
      <span class="badge bg-success">{{ $unreadCount }} non lu{{ $unreadCount > 1 ? 's' : '' }}</span>
    @endif
  </div>

  <form method="GET" class="admin-filter mb-3 admin-filter--wide">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nom, email, contenu...">
    <select name="read" class="form-select">
      <option value="">Tous</option>
      <option value="no" {{ request('read') === 'no' ? 'selected' : '' }}>Non lus</option>
      <option value="yes" {{ request('read') === 'yes' ? 'selected' : '' }}>Lus</option>
    </select>
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->hasAny(['q', 'read']))
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($messages->count())
    <div class="admin-list">
      @foreach($messages as $m)
        <article class="admin-list-item">
          <div>
            <h2>
              {{ $m->name }}
              @if(!$m->read_flag)
                <span class="badge bg-success ms-2">Nouveau</span>
              @endif
            </h2>
            <p>{{ $m->email }}</p>
            <p class="small text-muted mb-0">{{ \Illuminate\Support\Str::limit($m->message, 130) }} · {{ $m->created_at?->format('d/m/Y a H:i') }}</p>
          </div>
          <div class="admin-actions-inline">
            <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Voir</a>
            <form action="{{ route('admin.messages.toggleRead', $m) }}" method="POST" class="m-0">
              @csrf
              @method('PATCH')
              <button class="btn btn-success btn-sm admin-pill-btn">{{ $m->read_flag ? 'Non lu' : 'Lu' }}</button>
            </form>
            <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ce message ?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
            </form>
          </div>
        </article>
      @endforeach
    </div>
  @else
    <div class="admin-empty">Aucun message pour le moment.</div>
  @endif
</div>
@endsection
