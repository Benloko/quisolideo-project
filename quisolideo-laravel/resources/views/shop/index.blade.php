@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
      <div>
        <h1 class="mb-1">Boutique</h1>
        <p class="text-muted small mb-0">Choisissez une catégorie, puis ajoutez vos produits au panier.</p>
      </div>
      <div>
        <a href="{{ route('cart.show') }}" class="btn btn-success">Voir le panier</a>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($categories->count())
      <div class="row g-4">
        @foreach($categories as $idx => $c)
          <div class="col-12 col-md-6 col-lg-4">
            <article class="training-card h-100 reveal" data-reveal-delay="{{ $idx * 70 }}">
              <a href="{{ route('shop.category', $c->slug) }}" class="text-decoration-none text-reset">
                <div class="training-media">
                  @if($c->image)
                    <img src="{{ $c->image }}" alt="{{ $c->name }}" />
                  @else
                    <div style="width:100%;height:100%;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06))"></div>
                  @endif
                  <div class="training-overlay">
                    <div style="font-weight:800">{{ \Illuminate\Support\Str::limit($c->name, 38) }}</div>
                    @if($c->min_price !== null)
                      <div class="training-badge">Dès {{ number_format((float)$c->min_price, 0, ',', ' ') }} FCFA</div>
                    @endif
                  </div>
                </div>
              </a>

              <div class="p-3 p-md-4">
                <div class="training-sub">
                  {{ \Illuminate\Support\Str::limit((string)($c->description ?? ''), 150) }}
                </div>

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3">
                  <a href="{{ route('shop.category', $c->slug) }}" class="btn btn-outline-secondary btn-sm">Voir les produits</a>
                  <span class="text-muted small">{{ (int)$c->products_count }} produit{{ (int)$c->products_count > 1 ? 's' : '' }}</span>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-secondary">Aucune catégorie disponible pour le moment.</div>
    @endif

  </div>
</section>
@endsection
