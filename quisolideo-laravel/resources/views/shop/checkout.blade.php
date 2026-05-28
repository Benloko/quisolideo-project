@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--shop py-4">
  <div class="container px-3 px-md-4 checkout-page-head">
    <div>
      <span class="section-badge mb-2">Commande</span>
      <h1 class="mb-1">Finaliser votre commande</h1>
      <p class="text-muted mb-0">Renseignez vos informations puis confirmez la commande sur WhatsApp.</p>
    </div>
    <a href="{{ route('cart.show') }}" class="btn btn-outline-secondary btn-sm">Retour panier</a>
  </div>
</section>

<section class="pt-2 pb-5 shop-section">
  <div class="container px-3 px-md-4 checkout-shell">
    @if($errors->any())
      <div class="alert alert-danger mb-4">Veuillez corriger les champs en erreur.</div>
    @endif

    @error('whatsapp')
      <div class="alert alert-danger mb-4">{{ $message }}</div>
    @enderror

    <div class="row g-4 align-items-start">
      <div class="col-12 col-xl-7 order-2 order-xl-1">
        <article class="checkout-form-card">
          <h2>Informations client</h2>

          <form method="POST" action="{{ route('checkout.place') }}" class="checkout-form-grid">
            @csrf

            <div class="col-12">
              <label class="form-label mb-2">Mode de reception</label>

              @php($fm = old('fulfillment_method', 'pickup'))
              <div class="checkout-method-grid">
                <label class="checkout-method-option">
                  <input class="checkout-method-input" type="radio" name="fulfillment_method" value="pickup" {{ $fm === 'pickup' ? 'checked' : '' }}>
                  <span class="checkout-method-ui">
                    <strong>Retrait</strong>
                    <small>Recuperation sur place</small>
                  </span>
                </label>

                <label class="checkout-method-option">
                  <input class="checkout-method-input" type="radio" name="fulfillment_method" value="delivery" {{ $fm === 'delivery' ? 'checked' : '' }}>
                  <span class="checkout-method-ui">
                    <strong>Livraison</strong>
                    <small>Envoi a votre adresse</small>
                  </span>
                </label>
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
              <label class="form-label">Telephone</label>
              <input name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
              @error('customer_phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12" id="deliveryFields">
              <div class="checkout-delivery-box">
                <div class="checkout-delivery-title">Informations de livraison</div>
                <div class="row g-3">
                  <div class="col-12">
                    <label class="form-label">Lieu / description</label>
                    <input name="address_line1" class="form-control" value="{{ old('address_line1') }}" data-required-delivery>
                    @error('address_line1')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label">Complement (optionnel)</label>
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
                    <input name="country" class="form-control" value="{{ old('country','Benin') }}">
                    @error('country')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                  <div class="col-12">
                    <label class="form-label">Localisation (optionnel)</label>
                    <input name="location_link" class="form-control" value="{{ old('location_link') }}" placeholder="https://maps.google.com/...">
                    @error('location_link')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Note (optionnel)</label>
              <textarea name="notes" class="form-control" rows="3" placeholder="Precisions sur la commande...">{{ old('notes') }}</textarea>
              @error('notes')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 checkout-submit-row">
              <button class="btn btn-success checkout-submit-btn" type="submit">Continuer sur WhatsApp</button>
            </div>
          </form>
        </article>
      </div>

      <div class="col-12 col-xl-5 order-1 order-xl-2">
        <aside class="checkout-summary-card">
          <h2>Recapitulatif commande</h2>

          <div class="checkout-lines-list">
            @foreach($lines as $line)
              @php($p = $line['product'])
              <div class="checkout-line">
                <div>
                  <div class="checkout-line-name">{{ $p->name }}</div>
                  <div class="checkout-line-qty">Qte {{ $line['quantity'] }}</div>
                </div>
                <div class="checkout-line-price">{{ number_format((float)$line['line_total'], 0, ',', ' ') }} FCFA</div>
              </div>
            @endforeach
          </div>

          <div class="checkout-totals">
            <div class="checkout-total-line">
              <span>Sous-total</span>
              <strong>{{ number_format((float)$subtotal, 0, ',', ' ') }} FCFA</strong>
            </div>
            <div class="checkout-total-line">
              <span>Livraison</span>
              <strong>Sur demande</strong>
            </div>
            <div class="checkout-grand-total">
              <span>Total</span>
              <strong>{{ number_format((float)$total, 0, ',', ' ') }} FCFA</strong>
            </div>
          </div>

          <p class="checkout-note mb-0">La confirmation finale des details se fait sur WhatsApp.</p>
        </aside>
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
