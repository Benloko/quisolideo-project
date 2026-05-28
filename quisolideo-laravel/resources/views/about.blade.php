@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--about py-4 pb-3">
  <div class="container px-3 px-md-4">
    <div class="about-hero">
      <span class="section-badge mb-2">A propos</span>
      <h1 class="mb-2 about-hero-title">Quisolideo, un cadre concret pour progresser</h1>
      <p class="text-muted mb-0">
        Nous accompagnons les jeunes, porteurs de projets et entrepreneurs avec des formations pratiques,
        du mentorat et des ressources utiles pour passer de l idee a l action.
      </p>
    </div>
  </div>
</section>

<section class="pt-2 pb-5">
  <div class="container px-3 px-md-4 about-shell">
    <div class="row g-4 align-items-start">
      <div class="col-12 col-xl-7">
        <article class="about-main-card">
          <h2>Notre mission</h2>
          <p>
            Offrir un accompagnement clair, progressif et applicable a la realite du terrain.
            Nous misons sur des contenus utiles, des cas concrets et un suivi humain qui aide
            chacun a avancer avec methode.
          </p>

          <div class="about-values-grid">
            <div class="about-value-item">
              <strong>Pratique</strong>
              <span>Des apprentissages orientés action et resultats.</span>
            </div>
            <div class="about-value-item">
              <strong>Humain</strong>
              <span>Un accompagnement de proximite, adapte a votre niveau.</span>
            </div>
            <div class="about-value-item">
              <strong>Durable</strong>
              <span>Des bases solides pour evoluer sur le long terme.</span>
            </div>
          </div>
        </article>
      </div>

      <div class="col-12 col-xl-5">
        <aside class="about-side-card">
          <h3>Nos axes d accompagnement</h3>
          <ul class="about-list mb-0">
            <li>Formations professionnelles et programmes terrain.</li>
            <li>Mentorat et suivi de projets.</li>
            <li>Ressources et outils via la boutique.</li>
            <li>Mise en relation avec des partenaires utiles.</li>
          </ul>

          <div class="about-side-actions">
            <a href="{{ route('trainings.index') }}" class="btn btn-success btn-sm">Voir les formations</a>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">Voir la boutique</a>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
@endsection
