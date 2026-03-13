@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="mb-0">Commandes</h2>
      <div class="text-muted small">Suivi des commandes boutique (MVP).</div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="list-group">
    @forelse($orders as $o)
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $o->order_number }}</strong>
          <div class="text-muted small">{{ $o->customer_name }} · {{ number_format((float)$o->total, 0, ',', ' ') }} FCFA · {{ $o->created_at?->format('d/m/Y H:i') }}</div>
          <span class="badge text-bg-light">{{ $o->status }}</span>
        </div>
        <div>
          <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-primary btn-sm">Voir</a>
        </div>
      </div>
    @empty
      <div class="list-group-item">Aucune commande.</div>
    @endforelse
  </div>
</div>
@endsection
