@extends('layouts.app')

@section('content')

<section class="hero">
  <div class="container-fluid px-3 px-md-4">
    <div class="row align-items-center">
      <div class="col-lg-7 text-white">
        <h1>Donnez vie à votre projet — créez un impact demain.</h1>
        <p class="lead">Formations pratiques, mentorat personnalisé et ressources concrètes pour transformer votre idée en une entreprise à impact.</p>
        <div class="mt-4">
          <a href="/formations" class="btn btn-light me-2">Découvrir nos formations</a>
          <a href="/boutique" class="btn btn-outline-light">Boutique</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="featured-gallery py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row g-4 align-items-center">
      <div class="col-lg-5 order-lg-1">
        <div class="p-4">
          <h2 class="mb-3" style="color:var(--brand-dark);">Explorez notre univers visuel</h2>
            <p class="text-muted">Découvrez en images les ateliers, projets et réussites qui animent notre communauté. Chaque photo illustre une étape concrète d'accompagnement et d'impact.</p>

            <ul class="feature-list mt-4">
              <li>
                <strong>Moments forts</strong>
                <div class="muted">Ateliers pratiques, démonstrations et rencontres professionnelles</div>
              </li>
              <li>
                <strong>Projets concrets</strong>
                <div class="muted">Parcours d'apprenants ayant lancé leur activité</div>
              </li>
              <li>
                <strong>Communauté</strong>
                <div class="muted">Événements, partenariats et retours d'expérience</div>
                <a href="/galerie#communaute" class="feature-link">Voir la communauté →</a>
              </li>
            </ul>
        </div>
      </div>

      <div class="col-lg-7 order-lg-2">
        <?php
          $images = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
          $random = count($images) ? $images[array_rand($images)] : null;
        ?>

        @if($random)
          <div class="featured-card">
            <div class="featured-media">
              <img src="{{ asset('assets/gallery/' . basename($random)) }}" alt="Galerie" class="featured-img">
            </div>
            <div class="featured-caption">
              <h3>Qui sommes-nous</h3>
              <p class="muted">Nous formons et accompagnons les entrepreneurs locaux avec un apprentissage concret et un accompagnement opérationnel. Découvrez nos réalisations et moments forts en images.</p>
              <a href="/galerie" class="btn btn-success">Voir plus de photos</a>
            </div>
          </div>
        @else
          <div class="featured-card d-flex align-items-center justify-content-center" style="min-height:360px;">
            <div class="text-center">
              <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden>
                <rect width="24" height="24" rx="4" fill="#f1f3f5"/>
                <path d="M8 14l2.5-3 2 2.5L16 10l4 6H8z" fill="#ced4da"/>
              </svg>
              <div class="mt-3 muted">Aucune image disponible</div>
              <div class="mt-3"><a href="/galerie" class="btn btn-success">Voir la galerie</a></div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
