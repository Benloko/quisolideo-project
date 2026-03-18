@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--trainings pt-5 pb-4">
  <div class="container px-3 px-md-4">
    <div class="d-flex justify-content-between align-items-end flex-wrap gap-3">

        <h1 class="mb-2">Des parcours concrets, pensés pour le terrain 🚀</h1>
        <p class="text-muted mb-0" style="max-width:78ch">Clairs, pratiques et orientés résultats. Cliquez sur une formation pour découvrir le programme, les objectifs et le format.</p>
    </div>
  </div>
</section>

<section class="pt-3 pb-5 trainings-page">
  <div class="container px-3 px-md-4">
    <div class="row g-4">
      @forelse($trainings as $idx => $t)
        @php
          $summary = $t->short_description ?: strip_tags((string) $t->content);
        @endphp

        <div class="col-12 col-xl-6">
          <a href="{{ route('trainings.show', $t->slug) }}" class="course-card reveal" data-reveal-delay="{{ $idx * 80 }}">
            <div class="course-media">
              @if($t->image)
                <img src="{{ $t->image }}" alt="{{ $t->title }}" loading="lazy" decoding="async" />
              @else
                <div class="course-media-placeholder" aria-hidden="true"></div>
              @endif
            </div>

            <div class="course-body">
              <div class="course-top">
                <div class="course-kicker">Parcours</div>
                <div class="course-chips">
                  @if(!empty($t->seats) && (int) $t->seats > 0)
                    <span class="course-chip">{{ (int) $t->seats }} places</span>
                  @endif
                  <span class="course-chip">Sur inscription</span>
                </div>
              </div>

              <h3 class="course-title">{{ $t->title }}</h3>
              <p class="course-desc mb-0">{{ \Illuminate\Support\Str::limit($summary, 170) }}</p>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12">
          <div class="alert alert-secondary mb-0">Aucune formation disponible pour le moment.</div>
        </div>
      @endforelse
    </div>
  </div>
</section>

@endsection
