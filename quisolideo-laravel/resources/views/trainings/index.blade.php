@extends('layouts.app')

@section('content')
@php
  $tab = ($tab ?? request()->query('tab')) === 'programmes' ? 'programmes' : 'formations';
@endphp

<section class="page-hero page-hero--trainings trainings-catalog-hero pt-4 pb-3">
  <div class="container px-3 px-md-4">
    <div class="trainings-catalog-head">
      <div>
        <span class="section-badge mb-2">{{ $tab === 'programmes' ? 'Programmes' : 'Formations' }}</span>
        <h1 class="mb-2 trainings-catalog-title">{{ $tab === 'programmes' ? 'Nos programmes d accompagnement' : 'Nos formations professionnelles' }}</h1>
        <p class="text-muted mb-0 trainings-catalog-sub">
          {{
            $tab === 'programmes'
              ? 'Programme LIME / EQD: des parcours structures pour l insertion, l employabilite et le developpement d activites durables.'
              : 'Des parcours concrets, pratiques et orientes resultats pour passer de l idee a l execution.'
          }}
        </p>
      </div>

      <div class="catalog-search" role="search" aria-label="Rechercher dans les formations">
        <label class="visually-hidden" for="trainingsSearch">Rechercher</label>
        <div class="catalog-search-field">
          <span class="catalog-search-icon" aria-hidden="true">⌕</span>
          <input id="trainingsSearch" type="search" class="catalog-search-input" placeholder="Rechercher une {{ $tab === 'programmes' ? 'programme' : 'formation' }}..." autocomplete="off">
        </div>
      </div>
    </div>

    <div class="mt-2 trainings-tabs" role="tablist" aria-label="Navigation formations et programmes">
      <a
        href="{{ route('trainings.index') }}"
        class="trainings-tab {{ $tab === 'formations' ? 'is-active' : '' }}"
        role="tab"
        aria-selected="{{ $tab === 'formations' ? 'true' : 'false' }}"
      >Formations</a>
      <a
        href="{{ route('trainings.index', ['tab' => 'programmes']) }}"
        class="trainings-tab {{ $tab === 'programmes' ? 'is-active' : '' }}"
        role="tab"
        aria-selected="{{ $tab === 'programmes' ? 'true' : 'false' }}"
      >Programmes</a>
    </div>
  </div>
</section>

<section class="pt-2 pb-5 trainings-page trainings-catalog-section">
  <div class="container px-3 px-md-4">
    <div class="row g-4">
      @forelse($trainings as $idx => $t)
        @php
          $summary = $t->short_description ?: strip_tags((string) $t->content);
          $isLimeEqd = \Illuminate\Support\Str::startsWith((string) $t->slug, 'lime-eqd-');
          $hasPrice = !empty($t->price) && (float) $t->price > 0;
        @endphp

        <div
          class="col-12 col-md-6 col-xl-4"
          data-training-item
          data-search-text="{{ \Illuminate\Support\Str::lower((string) ($t->title.' '.strip_tags($summary))) }}"
        >
          <a href="{{ route('trainings.show', $t->slug) }}" class="training-catalog-card reveal" data-reveal-delay="{{ $idx * 60 }}">
            <div class="training-catalog-media">
              @if($t->image)
                <img src="{{ $t->image }}" alt="{{ $t->title }}" loading="lazy" decoding="async" />
              @else
                <div class="training-catalog-placeholder" aria-hidden="true"></div>
              @endif
              <span class="training-catalog-kicker">{{ $isLimeEqd ? 'Programme LIME / EQD' : 'Formation' }}</span>
            </div>

            <div class="training-catalog-body">
              <h3 class="training-catalog-title">{{ $t->title }}</h3>
              <p class="training-catalog-desc mb-0">{{ \Illuminate\Support\Str::limit($summary, 140) }}</p>

              <div class="training-catalog-meta">
                <span class="training-catalog-chip">
                  @if(!empty($t->seats) && (int) $t->seats > 0)
                    {{ (int) $t->seats }} places
                  @else
                    Places sur demande
                  @endif
                </span>
                <span class="training-catalog-chip">Sur inscription</span>
              </div>

              <div class="training-catalog-foot">
                <span class="training-catalog-price">
                  @if($hasPrice)
                    {{ number_format((float) $t->price, 0, ',', ' ') }} FCFA
                  @else
                    Tarif sur demande
                  @endif
                </span>
                <span class="training-catalog-cta">Voir details</span>
              </div>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-secondary mb-0">Aucune formation disponible pour le moment.</div>
        </div>
      @endforelse
    </div>

    <div id="trainingsSearchEmpty" class="alert alert-light border d-none mt-4 mb-0">Aucun resultat pour cette recherche.</div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('trainingsSearch');
    if (!input) return;

    const items = Array.from(document.querySelectorAll('[data-training-item]'));
    const empty = document.getElementById('trainingsSearchEmpty');
    if (!items.length) return;

    const normalize = (value) => (value || '').toString().toLowerCase().trim();

    input.addEventListener('input', function () {
      const query = normalize(input.value);
      let visibleCount = 0;

      items.forEach((item) => {
        const haystack = normalize(item.getAttribute('data-search-text'));
        const visible = haystack.includes(query);
        item.classList.toggle('d-none', !visible);
        if (visible) visibleCount += 1;
      });

      if (empty) empty.classList.toggle('d-none', visibleCount !== 0);
    });
  });
</script>

@endsection
