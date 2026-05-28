@extends('layouts.app')

@section('content')
@php
  $images = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
  sort($images, SORT_NATURAL | SORT_FLAG_CASE);

  $count = count($images);
  $chunkSize = $count ? (int) ceil($count / 3) : 0;

  $sections = [
    [
      'id' => 'moments',
      'badge' => 'Moments',
      'title' => 'Ateliers et moments forts',
      'copy' => 'Des instants de terrain, de pratique et de progression collective.',
      'images' => $count ? array_slice($images, 0, $chunkSize) : [],
    ],
    [
      'id' => 'projets',
      'badge' => 'Projets',
      'title' => 'Projets concrets',
      'copy' => 'Des actions et realisations qui passent de l idee a l execution.',
      'images' => $count ? array_slice($images, $chunkSize, $chunkSize) : [],
    ],
    [
      'id' => 'communaute',
      'badge' => 'Communaute',
      'title' => 'Communaute et partenariats',
      'copy' => 'Rencontres, collaborations et dynamique collective autour des initiatives.',
      'images' => $count ? array_slice($images, $chunkSize * 2) : [],
    ],
  ];
@endphp

<section class="gallery-page-hero py-5">
  <div class="container px-3 px-md-4">
    <div class="gallery-page-head">
      <div>
        <span class="section-badge mb-2">Galerie</span>
        <h1 class="mb-2">Nos actions sur le terrain</h1>
        <p class="mb-0">Photos d ateliers, projets, accompagnements et evenements Quisolideo.</p>
      </div>
      <div class="gallery-page-stats" aria-label="Statistiques galerie">
        <div class="gallery-page-stat">
          <strong>{{ $count }}</strong>
          <span>photos</span>
        </div>
        <div class="gallery-page-stat">
          <strong>3</strong>
          <span>themes</span>
        </div>
      </div>
    </div>

    <div class="gallery-page-nav mt-3">
      @foreach($sections as $s)
        <a href="#{{ $s['id'] }}" class="gallery-page-nav-link">{{ $s['badge'] }}</a>
      @endforeach
    </div>
  </div>
</section>

<section class="gallery-page-body pb-5">
  <div class="container px-3 px-md-4">
    @foreach($sections as $section)
      <div id="{{ $section['id'] }}" class="gallery-group">
        <div class="gallery-group-head">
          <span class="gallery-group-badge">{{ $section['badge'] }}</span>
          <h2>{{ $section['title'] }}</h2>
          <p>{{ $section['copy'] }}</p>
        </div>

        @if(count($section['images']))
          <div class="gallery-grid">
            @foreach($section['images'] as $idx => $img)
              @php
                $url = asset('assets/gallery/' . basename($img));
                $isWide = (($idx + 1) % 5) === 0;
              @endphp
              <button
                type="button"
                class="gallery-card {{ $isWide ? 'gallery-card--wide' : '' }}"
                data-gallery-open
                data-src="{{ $url }}"
                data-alt="{{ $section['title'] }}"
                aria-label="Voir la photo"
              >
                <img src="{{ $url }}" alt="{{ $section['title'] }}" loading="lazy" decoding="async">
              </button>
            @endforeach
          </div>
        @else
          <div class="alert alert-secondary mb-0">Aucune image disponible pour cette section pour le moment.</div>
        @endif
      </div>
    @endforeach
  </div>
</section>

<div class="modal fade" id="galleryLightbox" tabindex="-1" aria-hidden="true" aria-label="Apercu image">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content gallery-lightbox-content">
      <div class="modal-header border-0 pb-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body pt-2">
        <img src="" alt="" class="gallery-lightbox-image" data-gallery-lightbox-image>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const lightboxEl = document.getElementById('galleryLightbox');
    if (!lightboxEl || !window.bootstrap || !window.bootstrap.Modal) return;

    const lightboxImage = lightboxEl.querySelector('[data-gallery-lightbox-image]');
    const modal = window.bootstrap.Modal.getOrCreateInstance(lightboxEl);

    document.querySelectorAll('[data-gallery-open]').forEach((btn) => {
      btn.addEventListener('click', () => {
        const src = btn.getAttribute('data-src') || '';
        const alt = btn.getAttribute('data-alt') || 'Photo galerie';
        if (!src || !lightboxImage) return;

        lightboxImage.src = src;
        lightboxImage.alt = alt;
        modal.show();
      });
    });

    lightboxEl.addEventListener('hidden.bs.modal', () => {
      if (!lightboxImage) return;
      lightboxImage.src = '';
      lightboxImage.alt = '';
    });
  });
</script>
@endsection
