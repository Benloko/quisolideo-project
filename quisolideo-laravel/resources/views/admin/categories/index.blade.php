@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h2 class="mb-0">Catégories</h2>
      <div class="text-muted small">Organisez les produits par catégories.</div>
    </div>
    <div>
      <a href="{{ route('admin.categories.create') }}" class="btn btn-success">Nouvelle catégorie</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="list-group">
    @forelse($categories as $c)
      <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
          @if($c->image)
            <img src="{{ $c->image }}" alt="{{ $c->name }}" style="width:54px;height:54px;object-fit:cover;border-radius:12px">
          @else
            <div style="width:54px;height:54px;border-radius:12px;background:rgba(31,143,74,0.10)"></div>
          @endif
          <div>
            <strong>{{ $c->name }}</strong>
            <div class="text-muted small">/{{ $c->slug }}</div>
          </div>
        </div>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.categories.edit', $c->id) }}" class="btn btn-primary btn-sm">Modifier</a>
          <form action="{{ route('admin.categories.destroy', $c->id) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Supprimer</button>
          </form>
        </div>
      </div>
    @empty
      <div class="list-group-item">Aucune catégorie.</div>
    @endforelse
  </div>
</div>
@endsection
