@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Tableau de bord — Admin</h1>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="btn btn-outline-secondary">Se déconnecter</button>
    </form>
  </div>

  <div class="row">
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Formations</h5>
        <p>Créer, modifier et publier les formations.</p>
        <a href="{{ route('admin.trainings.index') }}" class="btn btn-success btn-sm">Gérer</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Partenaires</h5>
        <p>Ajouter et mettre à jour les partenaires.</p>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-success btn-sm">Gérer</a>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Messages</h5>
        <p>Consulter les demandes envoyées via le formulaire de contact.</p>
        <a href="{{ route('admin.messages.index') }}" class="btn btn-success btn-sm">Voir</a>
      </div>
    </div>

    <div class="col-md-4 mt-3">
      <div class="card p-3">
        <h5>Produits</h5>
        <p>Créer et gérer les produits de la boutique.</p>
        <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-sm">Gérer</a>
      </div>
    </div>
    <div class="col-md-4 mt-3">
      <div class="card p-3">
        <h5>Commandes</h5>
        <p>Consulter les commandes et mettre à jour leur statut.</p>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-sm">Voir</a>
      </div>
    </div>
  </div>
</div>
@endsection
