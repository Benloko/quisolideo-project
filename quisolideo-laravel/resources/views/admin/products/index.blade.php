@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Boutique</p>
      <h1 class="admin-title mb-1">Produits</h1>
      <p class="admin-sub mb-0">Gerer le catalogue, les prix et le stock.</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm admin-pill-btn">Nouveau produit</a>
  </div>

  <form method="GET" class="admin-filter mb-3 admin-filter--wide">
    <input type="search" name="q" class="form-control" value="{{ request('q') }}" placeholder="Nom, slug, description...">
    <select name="category_id" class="form-select">
      <option value="">Toutes categories</option>
      @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
      @endforeach
    </select>
    <select name="status" class="form-select">
      <option value="">Tous statuts</option>
      <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs</option>
      <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs</option>
    </select>
    <button class="btn btn-success btn-sm admin-pill-btn">Filtrer</button>
    @if(request()->hasAny(['q', 'category_id', 'status']))
      <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Reset</a>
    @endif
  </form>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="admin-list">
    @forelse($products as $p)
      <article class="admin-list-item">
        <div>
          <h2>{{ $p->name }}</h2>
          <p>
            {{ $p->category?->name ?? 'Sans categorie' }} ·
            {{ number_format((float)$p->price, 0, ',', ' ') }} FCFA ·
            Stock: {{ (int) $p->stock }}
          </p>
          @if(!$p->is_active)
            <span class="badge text-bg-light">Inactif</span>
          @endif
        </div>
        <div class="admin-actions-inline">
          <a href="{{ route('shop.show', $p->slug) }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Voir</a>
          <a href="{{ route('admin.products.edit', $p->id) }}" class="btn btn-success btn-sm admin-pill-btn">Modifier</a>
          <form action="{{ route('admin.products.destroy', $p->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
          </form>
        </div>
      </article>
    @empty
      <div class="admin-empty">Aucun produit disponible.</div>
    @endforelse
  </div>
</div>
@endsection
