@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
      <div>
        <h1 class="mb-1">Boutique</h1>
        <p class="text-muted small mb-0">Produits et ressources sélectionnés — commande simple, paiement à la livraison ou par carte.</p>
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

    <form method="GET" action="{{ route('shop.index') }}" class="mb-4">
      <div class="row g-2 align-items-end">
        <div class="col-12 col-md-6 col-lg-4">
          <label class="form-label">Rechercher un article</label>
          <input name="q" class="form-control" placeholder="Ex: carnet, kit, t-shirt…" value="{{ $q ?? '' }}">
        </div>
        <div class="col-12 col-md-auto">
          <button class="btn btn-outline-secondary">Rechercher</button>
          @if(!empty($q))
            <a href="{{ route('shop.index') }}" class="btn btn-link">Réinitialiser</a>
          @endif
        </div>
      </div>
    </form>

    @if($products->count())
      <div class="row g-4">
        @foreach($products as $idx => $p)
          <div class="col-12 col-md-6 col-lg-4">
            <article class="training-card h-100 reveal" data-reveal-delay="{{ $idx * 70 }}">
              <a href="{{ route('shop.show', $p->slug) }}" class="text-decoration-none text-reset">
                <div class="training-media">
                  @if($p->image)
                    <img src="{{ $p->image }}" alt="{{ $p->name }}" />
                  @else
                    <div style="width:100%;height:100%;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06))"></div>
                  @endif
                  <div class="training-overlay">
                    <div style="font-weight:800">{{ \Illuminate\Support\Str::limit($p->name, 38) }}</div>
                    <div class="training-badge">{{ number_format((float)$p->price, 0, ',', ' ') }} FCFA</div>
                  </div>
                </div>
              </a>

              <div class="p-3 p-md-4">
                <div class="training-sub">
                  {{ \Illuminate\Support\Str::limit($p->short_description ?: strip_tags((string)$p->description), 150) }}
                </div>

                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-3">
                  <a href="{{ route('shop.show', $p->slug) }}" class="btn btn-outline-secondary btn-sm">Détails</a>

                  <form method="POST" action="{{ route('cart.add') }}" class="m-0">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button class="btn btn-success btn-sm">Ajouter au panier</button>
                  </form>
                </div>
              </div>
            </article>
          </div>
        @endforeach
      </div>
    @else
      @if(!empty($q))
        <div class="alert alert-secondary">Aucun résultat pour « {{ $q }} ».</div>
      @else
        <div class="alert alert-secondary">Aucun produit disponible pour le moment.</div>
      @endif
    @endif

  </div>
</section>
@endsection
