@extends('layouts.app')

@section('content')
@php
  $galleryImages = [];
  if ($product->image) {
      $galleryImages[] = $product->image;
  }
  if ($product->images) {
      foreach ($product->images as $img) {
          $galleryImages[] = $img->path;
      }
  }
  $galleryImages = array_values(array_unique(array_filter($galleryImages)));
@endphp

<section class="page-hero page-hero--shop py-4 py-md-5">
  <div class="container px-3 px-md-4">
    <a href="{{ route('shop.index') }}" class="shop-back-link">Retour boutique</a>
    <h1 class="mb-1 mt-2">{{ $product->name }}</h1>
    <p class="text-muted mb-0">{{ number_format((float)$product->price, 0, ',', ' ') }} FCFA</p>
  </div>
</section>

<section class="py-4 py-md-5 shop-section">
  <div class="container px-3 px-md-4 shop-detail-wrap">
    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="row g-4 align-items-start">
      <div class="col-12 col-lg-7">
        <article class="shop-detail-card">
          <div class="shop-detail-main-media">
            @if(count($galleryImages))
              <img id="productMainImage" src="{{ $galleryImages[0] }}" alt="{{ $product->name }}">
            @else
              <div class="shop-product-media--placeholder"></div>
            @endif
          </div>

          @if(count($galleryImages) > 1)
            <div class="shop-detail-thumbs" role="list">
              @foreach($galleryImages as $idx => $src)
                <button
                  type="button"
                  data-product-thumb
                  data-src="{{ $src }}"
                  aria-label="Voir image {{ $idx + 1 }}"
                  @if($idx === 0) aria-current="true" @endif
                >
                  <img src="{{ $src }}" alt="{{ $product->name }}" loading="lazy">
                </button>
              @endforeach
            </div>
          @endif
        </article>
      </div>

      <div class="col-12 col-lg-5">
        <aside class="shop-detail-side">
          <span class="section-badge">Produit</span>
          <h2>{{ $product->name }}</h2>
          <div class="shop-detail-price">{{ number_format((float)$product->price, 0, ',', ' ') }} FCFA</div>

          @if($product->short_description)
            <p class="shop-detail-short mb-0">{{ $product->short_description }}</p>
          @endif

          @if($product->description)
            <div class="shop-detail-desc">{{ $product->description }}</div>
          @endif

          <form method="POST" action="{{ route('cart.add') }}" class="shop-detail-form" data-add-to-cart>
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <label for="qty" class="form-label mb-1">Quantite</label>
            <div class="shop-detail-actions">
              <input id="qty" type="number" name="quantity" min="1" max="99" value="1" class="form-control form-control-sm">
              <button class="btn btn-success shop-add-btn shop-add-btn--detail" type="submit" data-product-id="{{ $product->id }}" aria-label="Ajouter {{ $product->name }} au panier">
                <span class="shop-add-btn-icon" aria-hidden="true">+</span>
                <span class="shop-add-btn-label">Ajouter au panier</span>
              </button>
              <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Panier</a>
            </div>
          </form>

          @error('product_id')
            <div class="text-danger small mt-2">{{ $message }}</div>
          @enderror
          @error('quantity')
            <div class="text-danger small mt-2">{{ $message }}</div>
          @enderror
        </aside>
      </div>
    </div>
  </div>
</section>

@if(count($galleryImages) > 1)
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const main = document.getElementById('productMainImage');
      if (!main) return;

      const thumbs = Array.from(document.querySelectorAll('[data-product-thumb]'));
      thumbs.forEach((btn) => {
        btn.addEventListener('click', () => {
          const src = btn.getAttribute('data-src');
          if (!src) return;

          main.setAttribute('src', src);

          thumbs.forEach((b) => b.removeAttribute('aria-current'));
          btn.setAttribute('aria-current', 'true');
        });
      });
    });
  </script>
@endif
@endsection
