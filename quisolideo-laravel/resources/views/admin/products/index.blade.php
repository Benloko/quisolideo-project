@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="mb-0">Produits</h2>
      <div class="text-muted small">Gérez le catalogue boutique.</div>
    </div>
    <div>
      <a href="{{ route('admin.products.create') }}" class="btn btn-success">Nouveau produit</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="list-group">
    @forelse($products as $p)
      <div class="list-group-item d-flex justify-content-between align-items-center">
        <div>
          <strong>{{ $p->name }}</strong>
          <div class="text-muted small">/{{ $p->slug }} · {{ number_format((float)$p->price, 0, ',', ' ') }} FCFA · Stock: {{ $p->stock }}</div>
          @if(!$p->is_active)
            <span class="badge text-bg-light">Inactif</span>
          @endif
        </div>
        <div>
          <a href="{{ route('shop.show', $p->slug) }}" class="btn btn-outline-secondary btn-sm">Voir</a>
          <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-primary btn-sm">Modifier</a>
          <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Supprimer</button>
          </form>
        </div>
      </div>
    @empty
      <div class="list-group-item">Aucun produit.</div>
    @endforelse
  </div>
</div>
@endsection
