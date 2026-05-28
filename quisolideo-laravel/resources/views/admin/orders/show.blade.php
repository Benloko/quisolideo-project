@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Commande</p>
      <h1 class="admin-title mb-1">{{ $order->order_number }}</h1>
      <p class="admin-sub mb-0">{{ $order->created_at?->format('d/m/Y a H:i') }} · Paiement: {{ $order->payment_method }} ({{ $order->payment_status ?? 'unpaid' }})</p>
    </div>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-12 col-lg-7">
      <section class="admin-card p-3 p-md-4">
        <h2 class="admin-card-title">Client</h2>
        <p class="mb-1"><strong>{{ $order->customer_name }}</strong></p>
        <p class="mb-1">{{ $order->customer_email }}</p>
        <p class="mb-0">{{ $order->customer_phone ?: 'Telephone non renseigne' }}</p>

        <hr>
        <h3 class="admin-subtitle">Livraison</h3>
        <p class="mb-1">{{ $order->address_line1 }}</p>
        @if($order->address_line2)<p class="mb-1">{{ $order->address_line2 }}</p>@endif
        <p class="mb-0">{{ $order->city }} · {{ $order->country }}</p>

        @if($order->notes)
          <hr>
          <h3 class="admin-subtitle">Note client</h3>
          <div class="admin-note-block">{{ $order->notes }}</div>
        @endif
      </section>

      <section class="admin-card p-3 p-md-4 mt-3">
        <h2 class="admin-card-title">Articles</h2>
        <div class="admin-list mt-3">
          @foreach($order->items as $it)
            <article class="admin-list-item">
              <div>
                <h2>{{ $it->product_name }}</h2>
                <p>{{ number_format((float)$it->unit_price, 0, ',', ' ') }} FCFA · Qte {{ $it->quantity }}</p>
              </div>
              <strong>{{ number_format((float)$it->line_total, 0, ',', ' ') }} FCFA</strong>
            </article>
          @endforeach
        </div>
      </section>
    </div>

    <div class="col-12 col-lg-5">
      <section class="admin-card p-3 p-md-4">
        <h2 class="admin-card-title">Statut</h2>
        <form method="POST" action="{{ route('admin.orders.update', $order) }}">
          @csrf
          @method('PATCH')
          <select name="status" class="form-select">
            @foreach(['pending' => 'En attente', 'confirmed' => 'Confirmee', 'shipped' => 'Expediee', 'cancelled' => 'Annulee'] as $k => $label)
              <option value="{{ $k }}" {{ $order->status === $k ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
          </select>
          <button class="btn btn-success btn-sm admin-pill-btn mt-2">Mettre a jour</button>
        </form>

        <hr>
        <h3 class="admin-subtitle">Totaux</h3>
        <div class="d-flex justify-content-between"><span>Sous-total</span><strong>{{ number_format((float)$order->subtotal, 0, ',', ' ') }} FCFA</strong></div>
        <div class="d-flex justify-content-between mt-2"><span>Livraison</span><strong>{{ number_format((float)$order->shipping, 0, ',', ' ') }} FCFA</strong></div>
        <div class="d-flex justify-content-between mt-2"><span>Total</span><strong>{{ number_format((float)$order->total, 0, ',', ' ') }} FCFA</strong></div>
      </section>
    </div>
  </div>
</div>
@endsection
