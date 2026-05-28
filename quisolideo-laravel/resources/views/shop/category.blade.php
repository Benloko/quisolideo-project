@extends('layouts.app')

@section('content')
@php($bg = $category->image ? "url('" . e($category->image) . "')" : 'none')
<div class="shop-category-page" style="--shop-category-bg: {{ $bg }};">
  <section class="page-hero page-hero--shop py-4">
    <div class="container px-3 px-md-4">
      <a href="{{ route('shop.index') }}" class="shop-back-link">Retour boutique</a>

      <div class="shop-hero-head mt-2">
        <div>
          <h1 class="mb-0">Tous nos {{ $category->name }}</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="pt-3 pb-5 shop-section">
    <div class="container px-3 px-md-4">
      @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
      @endif

      <div class="shop-list-tools mb-2 mb-md-3">
        <div class="catalog-search catalog-search--wide" role="search" aria-label="Rechercher un produit">
          <label class="visually-hidden" for="shopProductSearch">Rechercher un produit</label>
          <div class="catalog-search-field">
            <span class="catalog-search-icon" aria-hidden="true">⌕</span>
            <input id="shopProductSearch" type="search" class="catalog-search-input" placeholder="Rechercher un produit..." autocomplete="off">
          </div>
        </div>
      </div>

      <div class="row g-3 g-lg-4">
        @forelse($products as $idx => $p)
          <div
            class="col-6 col-md-4 col-xl-3"
            data-shop-product-item
            data-search-text="{{ \Illuminate\Support\Str::lower((string) ($p->name.' '.($p->short_description ?? ''))) }}"
          >
            <article class="shop-product-card reveal" data-reveal-delay="{{ $idx * 60 }}">
              <a href="{{ route('shop.show', $p->slug) }}" class="shop-product-media d-block text-decoration-none" aria-label="{{ $p->name }}">
                @if($p->image)
                  <img src="{{ $p->image }}" alt="{{ $p->name }}" loading="lazy">
                @else
                  <div class="shop-product-media--placeholder"></div>
                @endif
                <div class="shop-product-price">{{ number_format((float)$p->price, 0, ',', ' ') }} FCFA</div>
              </a>

              <div class="shop-product-body">
                <h2 class="shop-product-name">{{ \Illuminate\Support\Str::limit($p->name, 52) }}</h2>

                <div class="shop-product-foot">
                  <a href="{{ route('shop.show', $p->slug) }}" class="shop-product-link">Details</a>

                  <form method="POST" action="{{ route('cart.add') }}" class="m-0" data-add-to-cart>
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $p->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button
                      type="submit"
                      class="btn btn-success btn-sm shop-add-btn shop-add-btn--card"
                      data-product-id="{{ $p->id }}"
                      aria-label="Ajouter {{ $p->name }} au panier"
                    >
                      <span class="shop-add-btn-icon" aria-hidden="true">+</span>
                      <span class="shop-add-btn-label">Ajouter</span>
                    </button>
                  </form>
                </div>
              </div>
            </article>
          </div>
        @empty
          <div class="col-12">
            <div class="shop-empty-card">
              <h2 class="h5 mb-2">Aucun produit pour le moment</h2>
              <p class="text-muted mb-0">Cette categorie sera completee prochainement.</p>
            </div>
          </div>
        @endforelse
      </div>

      <div id="shopProductSearchEmpty" class="alert alert-light border d-none mt-3 mb-0">Aucun produit ne correspond a votre recherche.</div>
    </div>
  </section>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('shopProductSearch');
    if (!input) return;

    const items = Array.from(document.querySelectorAll('[data-shop-product-item]'));
    const empty = document.getElementById('shopProductSearchEmpty');
    if (!items.length) return;

    const normalize = (value) => (value || '').toString().toLowerCase().trim();

    input.addEventListener('input', function () {
      const query = normalize(input.value);
      let visibleCount = 0;

      items.forEach((item) => {
        const haystack = normalize(item.getAttribute('data-search-text'));
        const visible = haystack.includes(query);
        item.classList.toggle('d-none', !visible);
        if (visible) visibleCount += 1;
      });

      if (empty) empty.classList.toggle('d-none', visibleCount !== 0);
    });
  });
</script>
@endsection
