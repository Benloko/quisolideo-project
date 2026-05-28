@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="container px-3 px-md-4">
    <div class="row align-items-center g-4">
      <div class="col-12 col-lg-8 text-white">
        <div class="hero-content reveal" data-reveal-delay="0">
          <h1 class="hero-title mt-3 mb-3">Transformez vos idees en projets solides</h1>
          <p class="hero-lead mb-0">Des parcours pratiques, un accompagnement humain et des ressources claires pour avancer avec confiance.</p>
          <div class="hero-actions mt-4 d-flex flex-wrap gap-2">
            <a href="{{ route('trainings.index') }}" class="btn hero-btn hero-btn-primary">Decouvrir les formations</a>
            <a href="{{ route('shop.index') }}" class="btn hero-btn hero-btn-secondary">Aller a la boutique</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-overview py-5">
  <div class="container px-3 px-md-4">
    <div class="row g-4 g-lg-5 align-items-start">
      <div class="col-12 col-lg-6">
        <span class="section-badge mb-2">A propos</span>
        <h2 class="home-section-title mb-3">Quisolideo, partenaire de votre progression</h2>
        <p class="home-section-copy mb-0">
          Nous accompagnons les jeunes, porteurs de projets et entrepreneurs avec des formations pratiques,
          du mentorat et un suivi oriente resultats.
        </p>
      </div>

      <div class="col-12 col-lg-6">
        <div class="home-value-grid">
          <article class="home-value-card">
            <h3>Formations utiles</h3>
            <p>Des contenus concrets, applicables des les premieres semaines.</p>
          </article>
          <article class="home-value-card">
            <h3>Mentorat cible</h3>
            <p>Un accompagnement adapte a votre niveau et a vos objectifs.</p>
          </article>
          <article class="home-value-card">
            <h3>Reseau actif</h3>
            <p>Des liens avec des partenaires, opportunites et acteurs locaux.</p>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-paths pb-5">
  <div class="container px-3 px-md-4">
    <div class="row g-3 g-md-4">
      <div class="col-12 col-lg-6">
        <article class="home-path-card h-100">
          <div class="home-path-kicker">Formations</div>
          <h3>Des parcours adaptes a vos objectifs</h3>
          <p>Debutant ou deja en activite, vous suivez une methode claire pour avancer et structurer vos projets.</p>
          <a href="{{ route('trainings.index') }}" class="home-path-link">Voir les formations →</a>
        </article>
      </div>

      <div class="col-12 col-lg-6">
        <article class="home-path-card h-100">
          <div class="home-path-kicker">Boutique</div>
          <h3>Ressources et produits utiles</h3>
          <p>Supports, kits et outils pratiques pour apprendre, produire et accelerer votre progression.</p>
          <a href="{{ route('shop.index') }}" class="home-path-link">Acceder a la boutique →</a>
        </article>
      </div>
    </div>

    <div class="home-impact mt-4 mt-lg-5">
      <div class="home-impact-item">
        <strong>+120</strong>
        <span>apprenants accompagnes</span>
      </div>
      <div class="home-impact-item">
        <strong>+35</strong>
        <span>projets suivis</span>
      </div>
      <div class="home-impact-item">
        <strong>+20</strong>
        <span>partenaires mobilises</span>
      </div>
    </div>
  </div>
</section>

<section class="featured-gallery py-5">
  <?php
    $galleryFiles = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
    sort($galleryFiles);
    $galleryUrls = array_map(fn ($path) => asset('assets/gallery/' . basename($path)), array_slice($galleryFiles, 0, 18));
  ?>

  <div class="container px-3 px-md-4">
    <div class="gallery-showcase reveal" data-reveal-delay="0">
      <div class="row g-4 g-lg-5 align-items-center">
        <div class="col-12 col-lg-5">
          <span class="section-badge mb-2">Galerie</span>
          <h2 class="gallery-showcase-title mb-2">L'aventure Quisolideo en images</h2>
          <p class="gallery-showcase-copy mb-3">Photos terrain, ateliers et moments forts. La previsualisation defile automatiquement, cliquez pour ouvrir la galerie complete.</p>
          <a href="{{ route('gallery') }}" class="gallery-showcase-link">Ouvrir la galerie →</a>
        </div>

        <div class="col-12 col-lg-7">
          @if(count($galleryUrls))
            <a
              href="{{ route('gallery') }}"
              class="gallery-slider"
              data-gallery-slider='@json($galleryUrls)'
              aria-label="Voir la galerie Quisolideo"
            >
              <div class="gallery-slider-stage">
                <img src="{{ $galleryUrls[0] }}" alt="Photo Quisolideo" class="gallery-slide is-active" data-gallery-primary loading="lazy" decoding="async">
                <img src="{{ $galleryUrls[0] }}" alt="" class="gallery-slide" data-gallery-secondary loading="lazy" decoding="async" aria-hidden="true">
              </div>
              <div class="gallery-slider-footer">
                <span>Galerie Quisolideo</span>
                <span class="gallery-slider-cta">Cliquer pour explorer</span>
              </div>
            </a>
          @else
            <a href="{{ route('gallery') }}" class="gallery-slider gallery-slider--empty" aria-label="Voir la galerie Quisolideo">
              <div class="gallery-empty">Bientot des photos ici. Cliquer pour ouvrir la galerie.</div>
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const sliders = Array.from(document.querySelectorAll('[data-gallery-slider]'));
    if (!sliders.length) return;

    const reducedMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    sliders.forEach((slider) => {
      let images = [];
      try {
        images = JSON.parse(slider.getAttribute('data-gallery-slider') || '[]') || [];
      } catch (e) {
        images = [];
      }

      if (!Array.isArray(images) || images.length < 2) return;

      const primary = slider.querySelector('[data-gallery-primary]');
      const secondary = slider.querySelector('[data-gallery-secondary]');
      if (!primary || !secondary) return;

      let index = 0;
      let active = primary;
      let standby = secondary;
      let busy = false;

      const transitionMs = 900;
      const slideIntervalMs = 4200;

      const swap = (nextSrc) => {
        if (busy) return;
        busy = true;

        standby.src = nextSrc;
        standby.classList.add('is-active');
        active.classList.remove('is-active');

        const temp = active;
        active = standby;
        standby = temp;

        setTimeout(() => {
          busy = false;
        }, transitionMs);
      };

      if (reducedMotion) return;

      setInterval(() => {
        index = (index + 1) % images.length;
        swap(images[index]);
      }, slideIntervalMs);
    });
  });
</script>

@endsection
