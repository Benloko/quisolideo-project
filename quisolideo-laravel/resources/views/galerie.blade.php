@extends('layouts.app')

@section('content')
@php
  $images = glob(public_path('assets/gallery/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
  sort($images, SORT_NATURAL | SORT_FLAG_CASE);
  $count = count($images);
  $per = $count ? (int) ceil($count / 3) : 0;
  $moments = $count ? array_slice($images, 0, $per) : [];
  $projets = $count ? array_slice($images, $per, $per) : [];
  $communaute = $count ? array_slice($images, $per * 2) : [];
@endphp

<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Galerie</h1>
    <p class="text-muted small mb-0">Ateliers, projets et moments forts — découvrez l’énergie Quisolideo en images.</p>
    <div class="mt-3 d-flex flex-wrap gap-2">
      <a href="#moments" class="btn btn-success btn-sm">Moments forts</a>
      <a href="#projets" class="btn btn-success btn-sm">Projets concrets</a>
      <a href="#communaute" class="btn btn-success btn-sm">Communauté</a>
    </div>
  </div>
</section>

<section id="moments" class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <span class="section-badge">Moments forts</span>
    <h2 class="h4 mb-1" style="color:var(--brand-dark);font-weight:900">Ateliers, démonstrations, rencontres</h2>
    <p class="text-muted mb-4" style="max-width:70ch">Des instants clés qui illustrent la progression, la pratique et le partage.</p>

    @if(count($moments))
      <div class="row g-3">
        @foreach($moments as $img)
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ asset('assets/gallery/' . basename($img)) }}" target="_blank" rel="noopener" class="d-block text-decoration-none">
              <div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
                <img src="{{ asset('assets/gallery/' . basename($img)) }}" alt="Galerie — Moments forts" class="w-100" style="height:190px;object-fit:cover;">
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-secondary">Aucune image disponible dans cette section pour le moment.</div>
    @endif
  </div>
</section>

<section id="projets" class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <span class="section-badge">Projets concrets</span>
    <h2 class="h4 mb-1" style="color:var(--brand-dark);font-weight:900">Du concept à l’action</h2>
    <p class="text-muted mb-4" style="max-width:70ch">Des réalisations qui montrent le savoir-faire, les résultats et la montée en compétence.</p>

    @if(count($projets))
      <div class="row g-3">
        @foreach($projets as $img)
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ asset('assets/gallery/' . basename($img)) }}" target="_blank" rel="noopener" class="d-block text-decoration-none">
              <div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
                <img src="{{ asset('assets/gallery/' . basename($img)) }}" alt="Galerie — Projets" class="w-100" style="height:190px;object-fit:cover;">
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-secondary">Aucune image disponible dans cette section pour le moment.</div>
    @endif
  </div>
</section>

<section id="communaute" class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <span class="section-badge">Communauté</span>
    <h2 class="h4 mb-1" style="color:var(--brand-dark);font-weight:900">Événements, partenariats, retours</h2>
    <p class="text-muted mb-4" style="max-width:70ch">Une communauté active : échanges, collaborations et témoignages.</p>

    @if(count($communaute))
      <div class="row g-3">
        @foreach($communaute as $img)
          <div class="col-6 col-md-4 col-lg-3">
            <a href="{{ asset('assets/gallery/' . basename($img)) }}" target="_blank" rel="noopener" class="d-block text-decoration-none">
              <div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
                <img src="{{ asset('assets/gallery/' . basename($img)) }}" alt="Galerie — Communauté" class="w-100" style="height:190px;object-fit:cover;">
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-secondary">Aucune image disponible dans cette section pour le moment.</div>
    @endif
  </div>
</section>
@endsection
