@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--partners pt-5 pb-4">
  <div class="container px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">
      <div>
        <h1 class="mb-2">Nos partenaires</h1>
        <p class="text-muted mb-0" style="max-width:78ch">Des collaborations solides pour amplifier l’impact, soutenir des initiatives concrètes et créer de la valeur sur le terrain.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 partners-wall">
  <div class="container px-3 px-md-4">
    <div class="partners-intro mb-4">
      <span class="section-badge">Réseau</span>
      <h2 class="partners-title mb-2">Ils nous font confiance</h2>
      <p class="text-muted mb-0" style="max-width:78ch">Institutions, acteurs locaux, entreprises et experts : ensemble, on accélère l’apprentissage, l’innovation et l’impact local.</p>
    </div>

    @if($partners->count() === 0)
      <div class="partners-empty card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
          <span class="section-badge">Partenaires</span>
          <h3 class="h5 mb-2" style="color:var(--brand-dark);font-weight:900">Bientôt en ligne</h3>
          <p class="text-muted mb-0">Nous mettons à jour la liste de nos partenaires. Revenez bientôt.</p>
        </div>
      </div>
    @elseif($partners->count() <= 3)
      <div class="partner-features">
        @foreach($partners as $idx => $p)
          @php
            $delay = 60 + ($idx * 90);
            $initial = mb_strtoupper(mb_substr($p->name ?? 'P', 0, 1));
          @endphp

          <div class="partner-feature reveal" data-reveal-delay="{{ $delay }}">
            <div class="row g-4 align-items-center {{ $idx % 2 === 1 ? 'flex-lg-row-reverse' : '' }}">
              <div class="col-12 col-lg-5">
                <div class="partner-feature-media" aria-hidden="true">
                  @if(!empty($p->logo))
                    <img src="{{ $p->logo }}" alt="" class="partner-feature-logo" loading="lazy" decoding="async">
                  @else
                    <div class="partner-feature-fallback">{{ $initial }}</div>
                  @endif
                </div>
              </div>

              <div class="col-12 col-lg-7">
                <div class="d-flex flex-wrap gap-2 align-items-center">
                  <span class="section-badge">Partenaire</span>
                  @if(!empty($p->website))
                    <a class="feature-link" href="{{ $p->website }}" target="_blank" rel="noopener noreferrer">Visiter le site →</a>
                  @endif
                </div>

                <h3 class="partner-feature-name mt-2 mb-3">{{ $p->name }}</h3>

                <div class="partner-feature-desc">
                  @if(!empty($p->description))
                    {!! nl2br(e($p->description)) !!}
                  @else
                    <span class="text-muted">Partenaire de confiance engagé à nos côtés.</span>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="partner-grid">
        @foreach($partners as $idx => $p)
          @php
            $delay = $idx * 55;
            $title = $p->description ? strip_tags((string) $p->description) : $p->name;
            $initial = mb_strtoupper(mb_substr($p->name ?? 'P', 0, 1));
          @endphp

          @if(!empty($p->website))
            <a
              href="{{ $p->website }}"
              class="partner-tile reveal"
              data-reveal-delay="{{ $delay }}"
              target="_blank"
              rel="noopener noreferrer"
              aria-label="{{ $p->name }} — visiter le site"
              title="{{ $title }}"
            >
              <div class="partner-logo-wrap" aria-hidden="true">
                @if(!empty($p->logo))
                  <img src="{{ $p->logo }}" alt="" class="partner-logo" loading="lazy" decoding="async">
                @else
                  <div class="partner-fallback">{{ $initial }}</div>
                @endif
              </div>
              <div class="partner-name">{{ $p->name }}</div>
              <div class="partner-site">Visiter le site →</div>
            </a>
          @else
            <div class="partner-tile reveal" data-reveal-delay="{{ $delay }}" title="{{ $title }}">
              <div class="partner-logo-wrap" aria-hidden="true">
                @if(!empty($p->logo))
                  <img src="{{ $p->logo }}" alt="" class="partner-logo" loading="lazy" decoding="async">
                @else
                  <div class="partner-fallback">{{ $initial }}</div>
                @endif
              </div>
              <div class="partner-name">{{ $p->name }}</div>
              <div class="partner-site">Partenaire Quisolideo</div>
            </div>
          @endif
        @endforeach
      </div>
    @endif
  </div>
</section>
@endsection
