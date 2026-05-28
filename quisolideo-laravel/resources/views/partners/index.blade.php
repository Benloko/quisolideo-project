@extends('layouts.app')

@section('content')
@php
  $total = $partners->count();
  $featured = $partners->take(2);
  $others = $partners->slice(2);
@endphp

<section class="page-hero page-hero--partners partners-page-hero pt-4 pb-3">
  <div class="container px-3 px-md-4">
    <div class="partners-page-head">
      <div>
        <span class="section-badge mb-2">Partenaires</span>
        <h1 class="mb-2 partners-page-title">Un reseau d acteurs engages</h1>
        <p class="text-muted mb-0 partners-page-sub">Nous collaborons avec des institutions, entreprises et acteurs locaux pour creer plus d impact sur le terrain.</p>
      </div>
      <div class="partners-page-stat" aria-label="Nombre de partenaires">
        <strong>{{ $total }}</strong>
        <span>{{ $total > 1 ? 'partenaires' : 'partenaire' }}</span>
      </div>
    </div>
  </div>
</section>

<section class="py-5 partners-page-body">
  <div class="container px-3 px-md-4">
    @if($total === 0)
      <div class="partners-empty-card">
        <h2 class="h5 mb-2">Liste en cours de mise a jour</h2>
        <p class="text-muted mb-0">Nos partenaires seront affiches ici tres prochainement.</p>
      </div>
    @else
      <div class="partners-page-intro mb-4 mb-lg-5">
        <h2>Ils nous font confiance</h2>
        <p class="mb-0">Chaque partenariat renforce l accompagnement, la qualite des programmes et l acces aux opportunites pour notre communaute.</p>
      </div>

      <div class="row g-4">
        @foreach($featured as $idx => $p)
          @php
            $initial = mb_strtoupper(mb_substr((string) ($p->name ?: 'P'), 0, 1));
            $siteHost = '';
            if (!empty($p->website)) {
              $siteHost = parse_url((string) $p->website, PHP_URL_HOST) ?: '';
            }
          @endphp

          <div class="col-12 col-lg-6">
            <article class="partners-feature-card reveal" data-reveal-delay="{{ 60 + ($idx * 80) }}">
              <div class="partners-feature-media" aria-hidden="true">
                @if(!empty($p->logo))
                  <img src="{{ $p->logo }}" alt="" loading="lazy" decoding="async">
                @else
                  <div class="partners-feature-fallback">{{ $initial }}</div>
                @endif
              </div>

              <div class="partners-feature-body">
                <div class="partners-feature-chip">Partenaire</div>
                <h3 class="partners-feature-name">{{ $p->name }}</h3>
                <p class="partners-feature-desc mb-0">{{ $p->description ? strip_tags((string) $p->description) : 'Partenaire de confiance engage a nos cotes.' }}</p>

                @if(!empty($p->website))
                  <a href="{{ $p->website }}" target="_blank" rel="noopener noreferrer" class="partners-feature-link">
                    {{ $siteHost !== '' ? $siteHost : 'Visiter le site' }} →
                  </a>
                @endif
              </div>
            </article>
          </div>
        @endforeach
      </div>

      @if($others->count())
        <div class="partners-compact-wrap mt-4 mt-lg-5">
          <div class="partners-compact-title">Autres partenaires</div>
          <div class="partners-compact-grid mt-3">
            @foreach($others as $idx => $p)
              @php
                $initial = mb_strtoupper(mb_substr((string) ($p->name ?: 'P'), 0, 1));
                $hasWebsite = !empty($p->website);
              @endphp

              @if($hasWebsite)
                <a href="{{ $p->website }}" target="_blank" rel="noopener noreferrer" class="partners-compact-card reveal" data-reveal-delay="{{ 60 + ($idx * 40) }}" aria-label="{{ $p->name }}">
                  <div class="partners-compact-logo" aria-hidden="true">
                    @if(!empty($p->logo))
                      <img src="{{ $p->logo }}" alt="" loading="lazy" decoding="async">
                    @else
                      <div class="partners-compact-fallback">{{ $initial }}</div>
                    @endif
                  </div>
                  <div class="partners-compact-name">{{ $p->name }}</div>
                  <div class="partners-compact-link">Visiter le site</div>
                </a>
              @else
                <div class="partners-compact-card reveal" data-reveal-delay="{{ 60 + ($idx * 40) }}">
                  <div class="partners-compact-logo" aria-hidden="true">
                    @if(!empty($p->logo))
                      <img src="{{ $p->logo }}" alt="" loading="lazy" decoding="async">
                    @else
                      <div class="partners-compact-fallback">{{ $initial }}</div>
                    @endif
                  </div>
                  <div class="partners-compact-name">{{ $p->name }}</div>
                  <div class="partners-compact-link">Partenaire Quisolideo</div>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      @endif
    @endif
  </div>
</section>
@endsection
