@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Mentions légales</h1>
    <p class="text-muted small mb-0">Informations légales du site (à compléter).</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <p class="text-muted" style="line-height:1.7">
              Cette page est un modèle de structure. Renseignez ici vos informations (raison sociale, adresse, SIRET/RCCM, directeur de publication, hébergeur, etc.).
            </p>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Éditeur du site</h2>
            <ul class="text-muted">
              <li>Nom / Raison sociale : à compléter</li>
              <li>Adresse : à compléter</li>
              <li>Immatriculation : à compléter</li>
              <li>Email : à compléter</li>
            </ul>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Hébergement</h2>
            <ul class="text-muted">
              <li>Hébergeur : à compléter</li>
              <li>Adresse : à compléter</li>
              <li>Téléphone : à compléter</li>
            </ul>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Propriété intellectuelle</h2>
            <p class="text-muted mb-0" style="line-height:1.7">
              Les contenus (textes, images, logos) sont protégés. Conditions d’utilisation à compléter.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
