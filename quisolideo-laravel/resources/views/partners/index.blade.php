@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Partenaires</h1>
    <p class="text-muted small mb-0">Des collaborations solides pour amplifier l’impact et créer des projets concrets.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
      <div>
        <span class="section-badge">Réseau</span>
        <h2 class="mb-1" style="color:var(--brand-dark);font-weight:800">Ils nous font confiance</h2>
        <div class="text-muted small">Institutions, acteurs locaux, entreprises et experts.</div>
      </div>
      <div>
        <a href="/contact" class="btn btn-success">Devenir partenaire</a>
      </div>
    </div>

    <div class="row g-4">
      @forelse($partners as $idx => $p)
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card h-100 border-0 shadow-sm reveal" data-reveal-delay="{{ $idx * 60 }}" style="border-radius:16px">
          <div class="card-body p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
              @if(!empty($p->logo))
                <img src="{{ $p->logo }}" alt="{{ $p->name }}" style="width:56px;height:56px;object-fit:cover;border-radius:14px;border:1px solid rgba(0,0,0,.06)">
              @else
                <div style="width:56px;height:56px;border-radius:14px;background:rgba(31,143,74,0.10);display:flex;align-items:center;justify-content:center;color:var(--brand-dark);font-weight:900;font-size:1.2rem">
                  {{ mb_strtoupper(mb_substr($p->name ?? 'P', 0, 1)) }}
                </div>
              @endif

              <div class="flex-grow-1">
                <div class="fw-bold" style="color:var(--brand-dark)">{{ $p->name }}</div>
                @if(!empty($p->website))
                  <a href="{{ $p->website }}" target="_blank" rel="noopener" class="small text-decoration-none" style="color:var(--brand-dark)">Visiter le site →</a>
                @else
                  <div class="text-muted small">Partenaire Quisolideo</div>
                @endif
              </div>
            </div>

            <p class="text-muted mb-0" style="line-height:1.65">
              {{ $p->description ?: 'Partenaire de confiance engagé à nos côtés.' }}
            </p>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12">
        <div class="text-muted">Aucun partenaire affiché pour le moment.</div>
      </div>
      @endforelse
    </div>

  </div>
</section>
@endsection
