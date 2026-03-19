@extends('layouts.app')

@section('content')
@php($bg = $category->image ? "url('" . e($category->image) . "')" : 'none')
<div class="shop-category-page" style="--shop-category-bg: {{ $bg }};">
  <section class="page-hero py-4">
    <div class="container-fluid px-3 px-md-4">
      <a href="{{ route('shop.index') }}" class="text-decoration-none small" style="color:var(--brand-dark)">← Retour boutique</a>

      <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mt-2">
        <div>
          <h1 class="mb-1">{{ $category->name }}</h1>
          @if($category->description)
            <p class="text-muted small mb-0" style="max-width:760px">{{ $category->description }}</p>
          @endif
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

      <div class="row g-3 g-md-4">
        @forelse($products as $idx => $p)
          <div class="col-6 col-md-4 col-lg-3">
            <article class="shop-product-card reveal" data-reveal-delay="{{ $idx * 60 }}">
              <div class="shop-product-media">
                <a href="{{ route('shop.show', $p->slug) }}" class="d-block text-decoration-none">
                  @if($p->image)
                    <img src="{{ $p->image }}" alt="{{ $p->name }}" loading="lazy">
                  @else
                    <div class="shop-product-media--placeholder"></div>
                  @endif
                </a>

                <div class="shop-product-price">{{ number_format((float)$p->price, 0, ',', ' ') }} FCFA</div>

                <form method="POST" action="{{ route('cart.add') }}" class="m-0" data-add-to-cart>
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $p->id }}">
                  <input type="hidden" name="quantity" value="1">
                  <button type="submit" class="btn btn-success btn-sm shop-add-btn" aria-label="Ajouter au panier">+</button>
                </form>
              </div>

              <div class="p-2 p-md-3">
                <div class="fw-semibold small" style="color:var(--brand-dark)">
                  {{ \Illuminate\Support\Str::limit($p->name, 46) }}
                </div>
              </div>
            </article>
          </div>
        @empty
          <div class="col-12">
            <div class="alert alert-secondary">Aucun produit dans cette catégorie pour le moment.</div>
          </div>
        @endforelse
      </div>
    </div>
  </section>
</div>
@endsection
