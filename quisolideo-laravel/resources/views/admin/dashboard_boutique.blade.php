@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="mb-1">Tableau de bord — Admin Boutique</h1>
      @if(session('admin_name'))
        <div class="text-muted small">Connecté : {{ session('admin_name') }}</div>
      @endif
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="btn btn-outline-secondary">Se déconnecter</button>
    </form>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Produits</h5>
        <p>Créer et gérer les produits de la boutique.</p>
        <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-sm">Gérer</a>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-3">
        <h5>Commandes</h5>
        <p>Consulter les commandes et mettre à jour leur statut.</p>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-sm">Voir</a>
      </div>
    </div>
  </div>
</div>
@endsection
