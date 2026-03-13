@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Commande</h1>
    <p class="text-muted small mb-0">Remplissez vos informations de livraison. Choisissez ensuite votre méthode de paiement.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">

    @if($errors->any())
      <div class="alert alert-danger">Veuillez corriger les champs en erreur.</div>
    @endif

    <div class="row g-4">
      <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <h2 class="h5 mb-4" style="color:var(--brand-dark);font-weight:900">Informations client</h2>

            <form method="POST" action="{{ route('checkout.place') }}">
              @csrf
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Nom complet</label>
                  <input name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                  @error('customer_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" required>
                  @error('customer_email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Téléphone (optionnel)</label>
                  <input name="customer_phone" class="form-control" value="{{ old('customer_phone') }}">
                  @error('customer_phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Adresse</label>
                  <input name="address_line1" class="form-control" value="{{ old('address_line1') }}" required>
                  @error('address_line1')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Complément d’adresse (optionnel)</label>
                  <input name="address_line2" class="form-control" value="{{ old('address_line2') }}">
                  @error('address_line2')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Ville</label>
                  <input name="city" class="form-control" value="{{ old('city') }}" required>
                  @error('city')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Pays</label>
                  <input name="country" class="form-control" value="{{ old('country','Bénin') }}">
                  @error('country')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Note (optionnel)</label>
                  <textarea name="notes" class="form-control" rows="4">{{ old('notes') }}</textarea>
                  @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Méthode de paiement</label>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_cod" value="cod" {{ old('payment_method','cod') === 'cod' ? 'checked' : '' }}>
                    <label class="form-check-label" for="pay_cod">Paiement à la livraison</label>
                  </div>

                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payment_method" id="pay_stripe" value="stripe" {{ old('payment_method') === 'stripe' ? 'checked' : '' }} {{ !$stripeEnabled ? 'disabled' : '' }}>
                    <label class="form-check-label" for="pay_stripe">Carte bancaire (Stripe)</label>
                  </div>

                  @if(!$stripeEnabled)
                    <div class="text-muted small mt-1">Carte indisponible pour le moment (Stripe non configuré).</div>
                  @endif

                  @error('payment_method')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2 mt-2">
                  <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Retour panier</a>
                  <button class="btn btn-success px-4">Confirmer la commande</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>

      <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4">
            <h2 class="h5 mb-3" style="color:var(--brand-dark);font-weight:900">Récapitulatif</h2>

            <div class="list-group mb-3">
              @foreach($lines as $line)
                @php($p = $line['product'])
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <div>
                    <div class="fw-semibold">{{ $p->name }}</div>
                    <div class="text-muted small">Qté {{ $line['quantity'] }}</div>
                  </div>
                  <div class="text-muted small">{{ number_format((float)$line['line_total'], 0, ',', ' ') }} FCFA</div>
                </div>
              @endforeach
            </div>

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
              <span style="color:var(--brand-dark);font-weight:900">{{ number_format((float)$total, 0, ',', ' ') }} FCFA</span>
            </div>

            @php($pm = old('payment_method', 'cod'))
            <div class="text-muted small mt-3">Méthode de paiement : <strong>{{ $pm === 'stripe' ? 'Carte bancaire' : 'Paiement à la livraison' }}</strong></div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>
@endsection
