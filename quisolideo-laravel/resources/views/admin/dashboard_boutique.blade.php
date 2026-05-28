@extends('layouts.app')

@section('content')
<div class="container py-4 py-lg-5 admin-shell">
  <div class="admin-page-head">
    <div>
      <p class="admin-eyebrow mb-2">Espace admin</p>
      <h1 class="admin-title mb-1">Tableau de bord Boutique</h1>
      @if(session('admin_name'))
        <p class="admin-sub mb-0">Connecte: {{ session('admin_name') }}</p>
      @endif
    </div>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button class="btn btn-outline-secondary btn-sm admin-pill-btn">Se deconnecter</button>
    </form>
  </div>

  <div class="row g-3 mt-1">
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Categories</p>
        <strong>{{ $kpis['categories'] ?? 0 }}</strong>
      </article>
    </div>
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Produits</p>
        <strong>{{ $kpis['products'] ?? 0 }}</strong>
      </article>
    </div>
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Produits actifs</p>
        <strong>{{ $kpis['products_active'] ?? 0 }}</strong>
      </article>
    </div>
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Commandes total</p>
        <strong>{{ $kpis['orders_total'] ?? 0 }}</strong>
      </article>
    </div>
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Commandes en attente</p>
        <strong>{{ $kpis['orders_pending'] ?? 0 }}</strong>
      </article>
    </div>
    <div class="col-6 col-lg-4">
      <article class="admin-kpi-card">
        <p>Commandes aujourd'hui</p>
        <strong>{{ $kpis['orders_today'] ?? 0 }}</strong>
      </article>
    </div>
  </div>

  <div class="row g-3 mt-1">
    <div class="col-12 col-md-4">
      <div class="admin-action-card">
        <h2>Categories</h2>
        <p>Organiser et mettre a jour les categories.</p>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-success btn-sm admin-pill-btn">Gerer</a>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="admin-action-card">
        <h2>Produits</h2>
        <p>Publier les produits avec images et stock.</p>
        <a href="{{ route('admin.products.index') }}" class="btn btn-success btn-sm admin-pill-btn">Gerer</a>
      </div>
    </div>
    <div class="col-12 col-md-4">
      <div class="admin-action-card">
        <h2>Commandes</h2>
        <p>Suivre les commandes et leurs statuts.</p>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-sm admin-pill-btn">Voir</a>
      </div>
    </div>
  </div>
</div>
@endsection
