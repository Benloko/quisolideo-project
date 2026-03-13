@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
    <div>
      <h2 class="mb-1">Commande {{ $order->order_number }}</h2>
      <div class="text-muted small">{{ $order->created_at?->format('d/m/Y à H:i') }} · Paiement: {{ $order->payment_method }} · Statut paiement: {{ $order->payment_status ?? 'unpaid' }}</div>
    </div>
    <div>
      <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row g-4">
    <div class="col-12 col-lg-7">
      <div class="card">
        <div class="card-body">
          <h5>Client</h5>
          <div><strong>{{ $order->customer_name }}</strong></div>
          <div class="text-muted">{{ $order->customer_email }}</div>
          @if($order->customer_phone)<div class="text-muted">{{ $order->customer_phone }}</div>@endif

          <hr>
          <h5>Livraison</h5>
          <div class="text-muted">{{ $order->address_line1 }}</div>
          @if($order->address_line2)<div class="text-muted">{{ $order->address_line2 }}</div>@endif
          <div class="text-muted">{{ $order->city }} · {{ $order->country }}</div>

          @if($order->notes)
            <hr>
            <h5>Note</h5>
            <div class="text-muted" style="white-space:pre-wrap">{{ $order->notes }}</div>
          @endif
        </div>
      </div>

      <div class="card mt-3">
        <div class="card-body">
          <h5>Articles</h5>
          <div class="list-group">
            @foreach($order->items as $it)
              <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                  <strong>{{ $it->product_name }}</strong>
                  <div class="text-muted small">{{ number_format((float)$it->unit_price, 0, ',', ' ') }} FCFA · Qté {{ $it->quantity }}</div>
                </div>
                <div class="text-muted">{{ number_format((float)$it->line_total, 0, ',', ' ') }} FCFA</div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-12 col-lg-5">
      <div class="card">
        <div class="card-body">
          <h5>Statut</h5>
          <form method="POST" action="{{ route('admin.orders.update', $order) }}">
            @csrf
            @method('PATCH')
            <select name="status" class="form-select">
              @foreach(['pending' => 'En attente', 'confirmed' => 'Confirmée', 'shipped' => 'Expédiée', 'cancelled' => 'Annulée'] as $k => $label)
                <option value="{{ $k }}" {{ $order->status === $k ? 'selected' : '' }}>{{ $label }}</option>
              @endforeach
            </select>
            <button class="btn btn-primary mt-2">Mettre à jour</button>
          </form>

          <hr>
          <h5>Totaux</h5>
          <div class="d-flex justify-content-between"><span class="text-muted">Sous-total</span><strong>{{ number_format((float)$order->subtotal, 0, ',', ' ') }} FCFA</strong></div>
          <div class="d-flex justify-content-between mt-2"><span class="text-muted">Livraison</span><strong>{{ number_format((float)$order->shipping, 0, ',', ' ') }} FCFA</strong></div>
          <div class="d-flex justify-content-between mt-2"><span class="text-muted">Total</span><strong>{{ number_format((float)$order->total, 0, ',', ' ') }} FCFA</strong></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
