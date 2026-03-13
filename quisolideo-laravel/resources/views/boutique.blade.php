@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Boutique</h1>
    <p class="text-muted small mb-0">La boutique arrive bientôt. En attendant, contactez-nous pour toute demande.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-8">
        <div class="p-4 p-md-5 rounded-4" style="background:#fff;border:1px solid rgba(11,17,24,0.06);box-shadow:0 18px 45px rgba(11,17,24,0.06)">
          <span class="section-badge">Bientôt</span>
          <h2 class="mb-3" style="color:var(--brand-dark);font-weight:900">Une boutique pensée pour vos projets</h2>
          <p class="text-muted mb-4" style="line-height:1.7">
            Nous préparons un espace dédié aux ressources, outils et supports pédagogiques.
            Vous pourrez y retrouver des contenus utiles pour progresser et passer à l’action.
          </p>
          <div class="d-flex gap-2 flex-wrap">
            <a href="/formations" class="btn btn-primary">Voir les formations</a>
            <a href="/contact" class="btn btn-outline-secondary">Nous contacter</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
