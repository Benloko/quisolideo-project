@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">{{ $training->title }}</h1>
    <p class="text-muted small">{{ Str::limit($training->short_description, 160) }}</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row g-4">
      <div class="col-lg-7">
        <div class="card rounded-3 shadow-sm overflow-hidden">
          @if($training->image)
            <img src="{{ $training->image }}" class="w-100" style="height:420px;object-fit:cover;" alt="{{ $training->title }}">
          @endif
          <div class="p-4">
            {!! $training->content !!}
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="p-4 bg-white border rounded-3 shadow-sm">
          <h5>Détails</h5>
          <ul class="list-unstyled">
            @if($training->seats)<li><strong>Places :</strong> {{ $training->seats }}</li>@endif
            @if($training->price)<li><strong>Tarif :</strong> Sur demande</li>@endif
            <li><strong>Inscription :</strong> Contactez-nous pour réserver</li>
          </ul>
          <a href="/contact" class="btn btn-success mt-3">S'inscrire / Nous contacter</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
