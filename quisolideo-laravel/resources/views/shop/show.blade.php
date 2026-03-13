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
        <div class="card border-0 shadow-sm" style="border-radius:16px;overflow:hidden">
          @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-100" style="height:420px;object-fit:cover">
          @else
            <div style="height:420px;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06))"></div>
          @endif
        </div>
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
              <form method="POST" action="{{ route('cart.add') }}" class="d-flex align-items-center gap-2">
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
@endsection
