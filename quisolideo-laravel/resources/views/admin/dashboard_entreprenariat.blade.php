@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="mb-1">Tableau de bord — Admin Entreprenariat</h1>
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
  </div>
</div>
@endsection
