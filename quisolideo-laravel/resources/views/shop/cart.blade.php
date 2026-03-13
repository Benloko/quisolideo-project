@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2">
      <div>
        <h1 class="mb-1">Panier</h1>
        <p class="text-muted small mb-0">Vérifiez votre sélection avant de confirmer la commande.</p>
      </div>
      <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">Continuer vos achats</a>
        @if(count($lines))
          <form method="POST" action="{{ route('cart.clear') }}" class="m-0">
            @csrf
            <button class="btn btn-outline-secondary">Vider</button>
          </form>
        @endif
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(!count($lines))
      <div class="alert alert-secondary">Votre panier est vide.</div>
    @else
      <div class="row g-4">
        <div class="col-12 col-lg-8">
          <form method="POST" action="{{ route('cart.update') }}">
            @csrf
            <div class="list-group">
              @foreach($lines as $line)
                @php($p = $line['product'])
                <div class="list-group-item d-flex justify-content-between align-items-center gap-3">
                  <div class="d-flex align-items-center gap-3">
                    @if($p->image)
                      <img src="{{ $p->image }}" alt="{{ $p->name }}" style="width:64px;height:64px;object-fit:cover;border-radius:12px">
                    @else
                      <div style="width:64px;height:64px;border-radius:12px;background:rgba(31,143,74,0.10)"></div>
                    @endif
                    <div>
                      <div class="fw-bold" style="color:var(--brand-dark)">{{ $p->name }}</div>
                      <div class="text-muted small">{{ number_format((float)$p->price, 0, ',', ' ') }} FCFA</div>
                    </div>
                  </div>

                  <div class="d-flex align-items-center gap-3">
                    <input type="number" name="quantities[{{ $p->id }}]" min="0" max="99" value="{{ $line['quantity'] }}" class="form-control form-control-sm" style="width:90px">
                    <div class="text-muted small" style="min-width:130px;text-align:right">
                      {{ number_format((float)$line['line_total'], 0, ',', ' ') }} FCFA
                    </div>

                    <button
                      type="submit"
                      name="product_id"
                      value="{{ $p->id }}"
                      formaction="{{ route('cart.remove') }}"
                      class="btn btn-danger btn-sm"
                    >×</button>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="mt-3 d-flex justify-content-end">
              <button class="btn btn-primary">Mettre à jour</button>
            </div>
          </form>
        </div>

        <div class="col-12 col-lg-4">
          <div class="card border-0 shadow-sm" style="border-radius:16px">
            <div class="card-body p-4">
              <h2 class="h5 mb-3" style="color:var(--brand-dark);font-weight:900">Récapitulatif</h2>
              <div class="d-flex justify-content-between">
                <span class="text-muted">Sous-total</span>
                <strong>{{ number_format((float)$subtotal, 0, ',', ' ') }} FCFA</strong>
              </div>
              <div class="d-flex justify-content-between mt-2">
                <span class="text-muted">Livraison</span>
                <strong>Sur demande</strong>
              </div>
              <hr>
              <div class="d-flex justify-content-between">
                <span style="color:var(--brand-dark);font-weight:900">Total</span>
                <span style="color:var(--brand-dark);font-weight:900">{{ number_format((float)$subtotal, 0, ',', ' ') }} FCFA</span>
              </div>

              <a href="{{ route('checkout.show') }}" class="btn btn-success w-100 mt-3">Commander</a>
              <div class="text-muted small mt-2">Paiement à la livraison ou par carte (Stripe).</div>
            </div>
          </div>
        </div>
      </div>
    @endif

  </div>
</section>
@endsection
