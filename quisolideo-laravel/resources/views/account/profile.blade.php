@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Profil</h1>
    <p class="text-muted small mb-0">Votre compte client.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row g-4">
      <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <h2 class="h5 mb-3" style="color:var(--brand-dark);font-weight:900">Informations</h2>

            <div class="mb-2"><span class="text-muted">Nom :</span> <strong>{{ auth()->user()->name }}</strong></div>
            <div class="mb-3"><span class="text-muted">Email :</span> <strong>{{ auth()->user()->email }}</strong></div>

            <div class="d-flex gap-2 flex-wrap">
              <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Voir le panier</a>
              <a href="{{ route('shop.index') }}" class="btn btn-primary">Retour boutique</a>
            </div>

            <hr>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-secondary">Se déconnecter</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-6">
        <div class="p-4 p-md-5 rounded-4" style="background:rgba(31,143,74,0.06);border:1px solid rgba(31,143,74,0.14)">
          <div class="fw-semibold" style="color:var(--brand-dark)">Astuce</div>
          <div class="text-muted" style="line-height:1.7">
            Pour commander, ajoutez vos produits au panier puis cliquez sur <strong>Commander sur WhatsApp</strong>.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
