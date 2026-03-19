@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <a href="{{ route('shop.index') }}" class="text-decoration-none small" style="color:var(--brand-dark)">← Retour boutique</a>
    <h1 class="mb-1 mt-2">{{ $product->name }}</h1>
    <p class="text-muted small mb-0">{{ number_format((float)$product->price, 0, ',', ' ') }} FCFA</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-4 align-items-start">
      <div class="col-12 col-lg-6">
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
        <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden">
          @if(count($galleryImages))
            <img id="productMainImage" src="{{ $galleryImages[0] }}" alt="{{ $product->name }}" class="w-100" style="height:420px;object-fit:cover">
          @else
            <div style="height:420px;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06))"></div>
          @endif
        </div>

        @if(count($galleryImages) > 1)
          <div class="mt-3 d-flex flex-wrap gap-2">
            @foreach($galleryImages as $idx => $src)
              <button
                type="button"
                data-product-thumb
                data-src="{{ $src }}"
                class="p-0 border-0 bg-transparent"
                aria-label="Voir l'image {{ $idx + 1 }}"
                @if($idx === 0) aria-current="true" @endif
              >
                <img
                  src="{{ $src }}"
                  alt="{{ $product->name }}"
                  loading="lazy"
                  style="width:92px;height:70px;object-fit:cover;border-radius:12px;border:2px solid {{ $idx === 0 ? 'var(--brand-green)' : 'transparent' }}"
                >
              </button>
            @endforeach
          </div>
        @endif
      </div>

      <div class="col-12 col-lg-6">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <span class="section-badge">Produit</span>
            <h2 class="h4 mb-2" style="color:var(--brand-dark);font-weight:900">{{ $product->name }}</h2>
            <div class="text-muted mb-3">Prix : <strong>{{ number_format((float)$product->price, 0, ',', ' ') }} FCFA</strong></div>

            @if($product->short_description)
              <p class="text-muted" style="line-height:1.7">{{ $product->short_description }}</p>
            @endif

            @if($product->description)
              <div class="text-muted" style="white-space:pre-wrap;line-height:1.7">{{ $product->description }}</div>
            @endif

            <div class="mt-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
              <form method="POST" action="{{ route('cart.add') }}" class="d-flex align-items-center gap-2" data-add-to-cart>
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="number" name="quantity" min="1" max="99" value="1" class="form-control form-control-sm" style="width:90px">
                <button class="btn btn-success">Ajouter au panier</button>
              </form>

              <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Voir le panier</a>
            </div>

            @error('product_id')
              <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
            @error('quantity')
              <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
          </div>
        </div>
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

          thumbs.forEach((b) => {
            b.removeAttribute('aria-current');
            const img = b.querySelector('img');
            if (img) img.style.borderColor = 'transparent';
          });
          btn.setAttribute('aria-current', 'true');
          const activeImg = btn.querySelector('img');
          if (activeImg) activeImg.style.borderColor = 'var(--brand-green)';
        });
      });
    });
  </script>
@endif
@endsection
