@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Commande</h1>
    <p class="text-muted small mb-0">Choisissez retrait ou livraison, puis ouvrez WhatsApp pour confirmer la commande.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">

    @if($errors->any())
      <div class="alert alert-danger">Veuillez corriger les champs en erreur.</div>
    @endif

    @error('whatsapp')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="row g-4">
      <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <h2 class="h5 mb-4" style="color:var(--brand-dark);font-weight:900">Informations & mode de réception</h2>

            <form method="POST" action="{{ route('checkout.place') }}">
              @csrf
              <div class="row g-3">

                <div class="col-12">
                  <label class="form-label">Je veux</label>

                  @php($fm = old('fulfillment_method', 'pickup'))
                  <div class="d-flex flex-wrap gap-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="fulfillment_method" id="fm_pickup" value="pickup" {{ $fm === 'pickup' ? 'checked' : '' }}>
                      <label class="form-check-label" for="fm_pickup">Retrait</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="fulfillment_method" id="fm_delivery" value="delivery" {{ $fm === 'delivery' ? 'checked' : '' }}>
                      <label class="form-check-label" for="fm_delivery">Livraison</label>
                    </div>
                  </div>

                  @error('fulfillment_method')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Nom complet</label>
                  <input name="customer_name" class="form-control" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required>
                  @error('customer_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Email</label>
                  <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required>
                  @error('customer_email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 col-md-6">
                  <label class="form-label">Téléphone</label>
                  <input name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                  @error('customer_phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12" id="deliveryFields">
                  <div class="p-3 rounded-3" style="background:rgba(31,143,74,0.05);border:1px solid rgba(31,143,74,0.14)">
                    <div class="fw-semibold mb-2" style="color:var(--brand-dark)">Informations de livraison</div>
                    <div class="row g-3">
                      <div class="col-12">
                        <label class="form-label">Lieu / description</label>
                        <input name="address_line1" class="form-control" value="{{ old('address_line1') }}" data-required-delivery>
                        @error('address_line1')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                      </div>
                      <div class="col-12">
                        <label class="form-label">Complément (repères, optionnel)</label>
                        <input name="address_line2" class="form-control" value="{{ old('address_line2') }}">
                        @error('address_line2')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label">Ville / commune</label>
                        <input name="city" class="form-control" value="{{ old('city') }}" data-required-delivery>
                        @error('city')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                      </div>
                      <div class="col-12 col-md-6">
                        <label class="form-label">Pays</label>
                        <input name="country" class="form-control" value="{{ old('country','Bénin') }}">
                        @error('country')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                      </div>
                      <div class="col-12">
                        <label class="form-label">Localisation (lien, optionnel)</label>
                        <input name="location_link" class="form-control" value="{{ old('location_link') }}" placeholder="Ex: https://maps.google.com/...">
                        @error('location_link')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <label class="form-label">Paiement (optionnel)</label>
                  <select class="form-select" name="payment_method">
                    <option value="">Choisir…</option>
                    <option value="mtn" {{ old('payment_method') === 'mtn' ? 'selected' : '' }}>MTN Mobile Money</option>
                    <option value="moov" {{ old('payment_method') === 'moov' ? 'selected' : '' }}>Moov Money</option>
                    <option value="celtis" {{ old('payment_method') === 'celtis' ? 'selected' : '' }}>Celtis Cash</option>
                  </select>
                  @error('payment_method')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                  <label class="form-label">Note (optionnel)</label>
                  <textarea name="notes" class="form-control" rows="4" placeholder="Précisions sur la commande (taille, couleur, etc.)">{{ old('notes') }}</textarea>
                  @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>

                <div class="col-12 d-flex align-items-center justify-content-between flex-wrap gap-2 mt-2">
                  <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary">Retour panier</a>
                  <button class="btn btn-success px-4">Continuer sur WhatsApp</button>
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
            <div class="text-muted small mt-3">La confirmation finale se fait sur WhatsApp.</div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const deliveryWrap = document.getElementById('deliveryFields');
    if (!deliveryWrap) return;

    const requiredFields = Array.from(deliveryWrap.querySelectorAll('[data-required-delivery]'));
    const radios = Array.from(document.querySelectorAll('input[name="fulfillment_method"]'));

    const apply = () => {
      const selected = (document.querySelector('input[name="fulfillment_method"]:checked') || {}).value || 'pickup';
      const isDelivery = selected === 'delivery';
      deliveryWrap.style.display = isDelivery ? '' : 'none';
      requiredFields.forEach((el) => {
        if (isDelivery) {
          el.setAttribute('required', 'required');
        } else {
          el.removeAttribute('required');
        }
      });
    };

    radios.forEach((r) => r.addEventListener('change', apply));
    apply();
  });
</script>
@endsection
