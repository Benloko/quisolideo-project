@extends('layouts.app')

@section('content')
<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="p-4 p-md-5 rounded-4" style="background:#fff;border:1px solid rgba(11,17,24,0.06);box-shadow:0 18px 45px rgba(11,17,24,0.06)">
          <span class="section-badge">Commande</span>
          <h1 class="mb-2" style="color:var(--brand-dark);font-weight:900">Merci !</h1>
          <p class="text-muted" style="line-height:1.7">
            Votre commande a bien été enregistrée.
            @if($orderNumber)
              <br>Référence : <strong>{{ $orderNumber }}</strong>
            @endif
          </p>
          <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('shop.index') }}" class="btn btn-primary">Retour à la boutique</a>
            <a href="/contact" class="btn btn-outline-secondary">Nous contacter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
