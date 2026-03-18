@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="container-fluid px-3 px-md-4">
    <div class="row align-items-center">
      <div class="col-12 col-lg-5 hero-content text-white">
        <div class="hero-card">
          <div class="hero-pill reveal" data-reveal-delay="0">
            <span class="hero-dot" aria-hidden="true"></span>
            Entrepreneuriat local · Formations · Mentorat <span class="emoji-twinkle" aria-hidden="true">✨</span>
          </div>

          <h1 class="hero-title mt-3 mb-2 reveal" data-reveal-delay="80">Transformez votre idée en entreprise 🚀</h1>

          <p class="lead mb-0 reveal" data-reveal-delay="160">Formations concrètes, mentorat et ressources pour avancer étape par étape — jusqu'à l'impact. 🤝</p>

          <div class="mt-4 d-flex flex-wrap gap-2 hero-cta reveal" data-reveal-delay="240">
            <a href="/formations" class="btn btn-light">Découvrir nos formations</a>
            <a href="/boutique" class="btn btn-outline-light">Boutique</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="hero-floats" aria-hidden="true">
    <span class="hero-float hero-float--1">🚀</span>
    <span class="hero-float hero-float--2">💡</span>
    <span class="hero-float hero-float--3">🤝</span>
    <span class="hero-float hero-float--4">🌿</span>
  </div>
</section>

<section class="featured-gallery py-5">
  <div class="container px-3 px-md-4">
    <div class="row g-5 align-items-center justify-content-between">
      <div class="col-12 col-lg-6 order-lg-1">
        <div class="featured-copy mx-auto p-4 reveal" data-reveal-delay="0">
          <span class="section-badge">Galerie <span class="emoji-twinkle" aria-hidden="true">✨</span></span>
          <h2 class="mb-3" style="color:var(--brand-dark);">L’aventure Quisolideo, en images</h2>
          <p class="text-muted mb-0">Ateliers, mentorat, projets lancés… un aperçu de ce qu’on construit ensemble, sur le terrain.</p>

          <ul class="feature-list mt-4">
            <li>
              <strong>Ateliers qui font avancer</strong>
              <div class="muted">Du concret, des échanges, et des outils applicables dès maintenant.</div>
            </li>
            <li>
              <strong>Projets passés à l’action</strong>
              <div class="muted">Des idées testées, améliorées et lancées — avec méthode et énergie.</div>
            </li>
            <li>
              <strong>Communauté & événements</strong>
              <div class="muted">Rencontres, partenariats et moments qui donnent de l’élan.</div>
            </li>
          </ul>

          <a href="{{ route('gallery') }}" class="feature-link">Explorer la galerie complète →</a>
        </div>
      </div>

      <div class="col-12 col-lg-6 order-lg-2">
        <?php
          $images = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
          $random = count($images) ? $images[array_rand($images)] : null;
        ?>

        <div class="d-flex justify-content-center">
          @if($random)
            <div class="featured-card reveal" data-reveal-delay="120">
              <div class="featured-media">
                <img src="{{ asset('assets/gallery/' . basename($random)) }}" alt="Galerie" class="featured-img" loading="lazy" decoding="async">
              </div>
              <div class="featured-caption">
                <h3>Un aperçu du terrain</h3>
                <p class="text-muted mb-3">Un instant capturé lors de nos ateliers, rencontres et moments de progression. La suite vous attend dans la galerie.</p>
                <a href="{{ route('gallery') }}" class="btn btn-success">Explorer la galerie</a>
              </div>
            </div>
          @else
            <div class="featured-card featured-card--empty reveal" data-reveal-delay="120">
              <div class="featured-empty text-center">
                <div class="featured-empty-icon" aria-hidden="true">📸</div>
                <h3 class="mt-3 mb-2">Bientôt, en images</h3>
                <p class="text-muted mb-3">Ateliers, réussites, communauté… cette section se remplira au fil des photos. En attendant, explorez la galerie complète.</p>
                <a href="{{ route('gallery') }}" class="btn btn-success">Explorer la galerie</a>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
