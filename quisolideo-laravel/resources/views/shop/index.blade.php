@extends('layouts.app')

@section('content')
<section class="py-4 py-md-5 shop-section">
  <div class="container px-3 px-md-4">
    <div class="shop-topbar mb-3 mb-md-4">
    <p class="shop-intro-note mb-0">
      <span class="shop-intro-kicker">Boutique Quisolideo</span>
      Decouvrez une selection de produits utiles et inspires, pensee pour soutenir vos projets, enrichir vos formations et faciliter votre progression au quotidien.
    </p>

      <div class="catalog-search catalog-search--shop" role="search" aria-label="Rechercher une categorie">
        <label class="visually-hidden" for="shopSearch">Rechercher une categorie</label>
        <div class="catalog-search-field">
          <span class="catalog-search-icon" aria-hidden="true">⌕</span>
          <input id="shopSearch" type="search" class="catalog-search-input" placeholder="Rechercher une categorie..." autocomplete="off">
        </div>
      </div>
    </div>

    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($categories->count())
      <div class="shop-categories-grid">
        @foreach($categories as $idx => $c)
          @php($cardImage = $c->preview_image ?: $c->image)
          <a
            href="{{ route('shop.category', $c->slug) }}"
            class="shop-category-card reveal"
            data-reveal-delay="{{ $idx * 70 }}"
            data-shop-item
            data-search-text="{{ \Illuminate\Support\Str::lower((string) $c->name) }}"
            aria-label="{{ $c->name }}"
          >
            <div class="shop-category-media">
              @if($cardImage)
                <img src="{{ $cardImage }}" alt="{{ $c->name }}" loading="lazy">
              @else
                <div class="shop-category-placeholder"></div>
              @endif
              <h2 class="shop-category-title">{{ \Illuminate\Support\Str::limit((string) $c->name, 44) }}</h2>
            </div>

            <div class="shop-category-foot">
              <span class="shop-category-link">👉 Voir</span>
            </div>
          </a>
        @endforeach
      </div>

      <div id="shopSearchEmpty" class="alert alert-light border d-none mt-3 mb-0">Aucune categorie ne correspond a votre recherche.</div>
    @else
      <div class="shop-empty-card">
        <h2 class="h5 mb-2">Boutique en cours de mise a jour</h2>
        <p class="text-muted mb-0">Les categories et produits seront disponibles tres bientot.</p>
      </div>
    @endif
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('shopSearch');
    if (!input) return;

    const items = Array.from(document.querySelectorAll('[data-shop-item]'));
    const empty = document.getElementById('shopSearchEmpty');
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
