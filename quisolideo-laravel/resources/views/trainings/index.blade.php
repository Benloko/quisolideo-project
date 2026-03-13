@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <div class="row">
      <div class="col-12">
        <h1 class="mb-1">Nos formations</h1>
        <p class="text-muted small mb-0">Parcourez nos parcours pratiques, pensés pour vous donner des compétences opérationnelles.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="mb-0">Catalogue</h2>
        <div class="text-muted small">Des formations intensives et modulaires — sélectionnez pour en savoir plus.</div>
      </div>
      <div>
        <a href="/contact" class="btn btn-success">Nous contacter</a>
      </div>
    </div>

    <div class="row g-4">
      @forelse($trainings as $idx => $t)
      <div class="col-12 col-md-6 col-lg-4">
        <article class="training-card h-100 reveal" data-reveal-delay="{{ $idx * 80 }}">
          <a href="{{ route('trainings.show', $t->slug) }}" class="text-decoration-none text-reset">
            <div class="training-media">
              @if($t->image)
                <img src="{{ $t->image }}" alt="{{ $t->title }}" />
              @else
                <div style="width:100%;height:100%;background:linear-gradient(180deg,rgba(31,143,74,0.03),rgba(31,143,74,0.06))"></div>
              @endif
              <div class="training-overlay">
                <div style="font-weight:700">{{ Str::limit($t->title, 36) }}</div>
                @if(!empty($t->seats))<div class="training-badge">{{ $t->seats }} places</div>@endif
              </div>
            </div>
            <div class="training-body">
              <div class="training-sub">{{ Str::limit($t->short_description, 140) }}</div>
              <div class="training-meta mt-3">
                @if(!empty($t->duration))<span class="muted">{{ $t->duration }}</span>@endif
                @if(!empty($t->level))<span class="muted">• {{ $t->level }}</span>@endif
              </div>
              <div class="training-cta">
                <a href="{{ route('trainings.show', $t->slug) }}" class="btn btn-primary btn-sm">En savoir plus</a>
                <a href="/contact" class="btn btn-outline-secondary btn-sm ms-2">S'informer</a>
              </div>
            </div>
          </a>
        </article>
      </div>
      @empty
      <div class="col-12">Aucune formation pour le moment.</div>
      @endforelse
    </div>

  </div>
</section>

@endsection
