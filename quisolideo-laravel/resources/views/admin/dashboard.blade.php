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
        <p>Gérer les formations (CRUD à implémenter)</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Partenaires</h5>
        <p>Gérer les partenaires (CRUD à implémenter)</p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Boutique</h5>
        <p>Produits, commandes et paiements (non encore implémentés)</p>
      </div>
    </div>
  </div>
</div>
@endsection
