@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Commandes</h1>
      <p class="admin-sub mb-0">Suivre les commandes et leur traitement.</p>
    </div>
  </div>

  <form method="GET" class="admin-filter mb-3 admin-filter--wide">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Numero, client, email...">
    <select name="status" class="form-select">
      <option value="">Tous statuts</option>
      @foreach(['pending' => 'En attente', 'confirmed' => 'Confirmee', 'shipped' => 'Expediee', 'cancelled' => 'Annulee'] as $status => $label)
        <option value="{{ $status }}" {{ request('status') === $status ? 'selected' : '' }}>{{ $label }}</option>
      @endforeach
    </select>
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->hasAny(['q', 'status']))
      <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list">
    @forelse($orders as $o)
      <article class="admin-list-item">
        <div>
          <h2>{{ $o->order_number }}</h2>
          <p>
            {{ $o->customer_name }} ·
            {{ number_format((float)$o->total, 0, ',', ' ') }} FCFA ·
            {{ $o->created_at?->format('d/m/Y H:i') }}
          </p>
          <span class="badge text-bg-light">{{ $o->status }}</span>
        </div>
        <div class="admin-actions-inline">
          <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-success btn-sm admin-pill-btn">Voir</a>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucune commande.</div>
    @endforelse
  </div>
</div>
@endsection
