@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--shop py-4">
  <div class="container px-3 px-md-4">
    <div class="cart-page-head">
      <div>
        <span class="section-badge mb-2">Panier</span>
        <h1 class="mb-1">Votre selection</h1>
        <p class="text-muted mb-0">Verifiez vos produits avant de passer la commande.</p>
      </div>

      <div class="cart-page-actions">
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">Continuer les achats</a>
        @if(count($lines))
          <form method="POST" action="{{ route('cart.clear') }}" class="m-0">
            @csrf
            <button class="btn btn-outline-secondary btn-sm" type="submit">Vider</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</section>

<section class="pt-2 pb-5 shop-section">
  <div class="container px-3 px-md-4">
    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if(!count($lines))
      <div class="cart-empty-card">
        <div class="cart-empty-icon" aria-hidden="true">🛒</div>
        <h2>Votre panier est vide</h2>
        <p class="mb-0">Ajoutez des produits depuis la boutique pour preparer votre commande.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-success btn-sm mt-3">Explorer la boutique</a>
      </div>
    @else
      <div class="row g-4 align-items-start">
        <div class="col-12 col-xl-8">
          <form method="POST" action="{{ route('cart.update') }}" class="cart-lines-wrap">
            @csrf

            @foreach($lines as $line)
              @php($p = $line['product'])
              <article class="cart-line-item">
                <a href="{{ route('shop.show', $p->slug) }}" class="cart-line-media" aria-label="{{ $p->name }}">
                  @if($p->image)
                    <img src="{{ $p->image }}" alt="{{ $p->name }}" loading="lazy">
                  @else
                    <div class="cart-line-placeholder"></div>
                  @endif
                </a>

                <div class="cart-line-main">
                  <h3 class="cart-line-name">{{ $p->name }}</h3>
                  <div class="cart-line-price">{{ number_format((float)$p->price, 0, ',', ' ') }} FCFA</div>

                  <div class="cart-line-controls">
                    <label class="visually-hidden" for="qty_{{ $p->id }}">Quantite</label>
                    <input
                      id="qty_{{ $p->id }}"
                      type="number"
                      name="quantities[{{ $p->id }}]"
                      min="0"
                      max="99"
                      value="{{ $line['quantity'] }}"
                      class="form-control form-control-sm cart-qty-input"
                    >

                    <div class="cart-line-total">{{ number_format((float)$line['line_total'], 0, ',', ' ') }} FCFA</div>

                    <button
                      type="submit"
                      name="product_id"
                      value="{{ $p->id }}"
                      formaction="{{ route('cart.remove') }}"
                      class="btn btn-outline-danger btn-sm cart-remove-btn"
                      aria-label="Retirer {{ $p->name }}"
                    >
                      ✕
                    </button>
                  </div>
                </div>
              </article>
            @endforeach

            <div class="cart-update-row">
              <button class="btn btn-success cart-update-btn" type="submit">Mettre a jour le panier</button>
            </div>
          </form>
        </div>

        <div class="col-12 col-xl-4">
          <aside class="cart-summary-card">
            <h2>Recapitulatif</h2>

            <div class="cart-summary-line">
              <span>Sous-total</span>
              <strong>{{ number_format((float)$subtotal, 0, ',', ' ') }} FCFA</strong>
            </div>
            <div class="cart-summary-line">
              <span>Livraison</span>
              <strong>Sur demande</strong>
            </div>

            <div class="cart-summary-total">
              <span>Total</span>
              <strong>{{ number_format((float)$subtotal, 0, ',', ' ') }} FCFA</strong>
            </div>

            <a href="{{ route('checkout.show') }}" class="btn btn-success w-100 cart-checkout-btn">Commander sur WhatsApp</a>
            <p class="cart-summary-note mb-0">Vous finaliserez les details de livraison et paiement sur WhatsApp.</p>
          </aside>
        </div>
      </div>
    @endif
  </div>
</section>
@endsection
