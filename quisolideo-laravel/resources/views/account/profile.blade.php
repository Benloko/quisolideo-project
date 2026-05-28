@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--account py-4">
  <div class="container px-3 px-md-4 account-page-head">
    <div>
      <span class="section-badge mb-2">Mon compte</span>
      <h1 class="mb-1">Profil client</h1>
      <p class="text-muted mb-0">Gerez vos informations et accedez rapidement a vos actions boutique.</p>
    </div>
  </div>
</section>

<section class="pt-2 pb-5 shop-section">
  <div class="container px-3 px-md-4 account-shell">
    <div class="row g-4 align-items-start">
      <div class="col-12 col-xl-8">
        <article class="account-main-card">
          <div class="account-identity">
            <div class="account-avatar" aria-hidden="true">{{ mb_strtoupper(mb_substr((string) auth()->user()->name, 0, 1)) }}</div>
            <div>
              <div class="account-name">{{ auth()->user()->name }}</div>
              <div class="account-email">{{ auth()->user()->email }}</div>
            </div>
          </div>

          <div class="account-grid">
            <div class="account-info-tile">
              <div class="account-info-label">Nom complet</div>
              <div class="account-info-value">{{ auth()->user()->name }}</div>
            </div>
            <div class="account-info-tile">
              <div class="account-info-label">Adresse email</div>
              <div class="account-info-value">{{ auth()->user()->email }}</div>
            </div>
          </div>

          <div class="account-actions-row">
            <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary btn-sm">Voir le panier</a>
            <a href="{{ route('shop.index') }}" class="btn btn-success btn-sm">Retour boutique</a>
          </div>

          <div class="account-logout-row">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button class="btn btn-outline-secondary btn-sm" type="submit">Se deconnecter</button>
            </form>
          </div>
        </article>
      </div>

      <div class="col-12 col-xl-4">
        <aside class="account-tip-card">
          <h2>Astuce</h2>
          <p>
            Pour commander rapidement, ajoutez vos produits au panier puis cliquez sur
            <strong>Commander sur WhatsApp</strong>.
          </p>
          <a href="{{ route('checkout.show') }}" class="btn btn-success btn-sm w-100">Aller a la commande</a>
        </aside>
      </div>
    </div>
  </div>
</section>
@endsection
