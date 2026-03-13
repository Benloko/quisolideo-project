@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Politique de confidentialité</h1>
    <p class="text-muted small mb-0">Transparence sur la gestion des données (à compléter).</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-9">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <p class="text-muted" style="line-height:1.7">
              Cette page est un texte de base à personnaliser. Elle doit refléter votre usage réel (formulaire de contact, statistiques, cookies, prestataires, conservation, droits des utilisateurs, etc.).
            </p>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Données collectées</h2>
            <p class="text-muted" style="line-height:1.7">
              Via le formulaire de contact, nous collectons les informations que vous nous transmettez (nom, email, message).
            </p>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Finalités</h2>
            <ul class="text-muted">
              <li>Répondre à vos demandes</li>
              <li>Organiser des inscriptions et échanges liés aux formations</li>
              <li>Gérer les partenariats</li>
            </ul>

            <h2 class="h5 mt-4" style="color:var(--brand-dark);font-weight:800">Vos droits</h2>
            <p class="text-muted mb-0" style="line-height:1.7">
              Vous pouvez demander l’accès, la rectification ou la suppression de vos données. Ajoutez ici le contact et la procédure adaptés.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
