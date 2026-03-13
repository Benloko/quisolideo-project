@extends('layouts.app')

@section('content')
<section class="page-hero py-4">
  <div class="container-fluid px-3 px-md-4">
    <h1 class="mb-1">Contact</h1>
    <p class="text-muted small mb-0">Une question, une inscription, un partenariat ? Écrivez-nous — nous répondons rapidement.</p>
  </div>
</section>

<section class="py-5">
  <div class="container-fluid px-3 px-md-4">

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <div class="fw-semibold">Veuillez corriger les erreurs ci-dessous.</div>
      </div>
    @endif

    <div class="row g-4">
      <div class="col-12 col-lg-5">
        <div class="p-4 rounded-4" style="background:rgba(31,143,74,0.06);border:1px solid rgba(31,143,74,0.10)">
          <span class="section-badge">Nous contacter</span>
          <h2 class="mb-3" style="color:var(--brand-dark);font-weight:800">Parlons de votre besoin</h2>
          <p class="text-muted mb-0" style="line-height:1.7">
            Décrivez votre demande en quelques lignes. Nous vous aiderons à choisir la formation adaptée, à organiser une session, ou à construire un partenariat.
          </p>

          <ul class="feature-list mt-4 mb-0">
            <li>
              <strong>Formations</strong>
              <div class="muted">Informations, disponibilités, inscriptions</div>
            </li>
            <li>
              <strong>Partenariats</strong>
              <div class="muted">Co-construction, sponsoring, interventions</div>
            </li>
            <li>
              <strong>Boutique</strong>
              <div class="muted">Ressources et produits (bientôt)</div>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <h3 class="h5 mb-4" style="color:var(--brand-dark);font-weight:800">Envoyer un message</h3>

            <form method="POST" action="{{ route('contact.submit') }}">
              @csrf
              <div class="mb-3">
                <label class="form-label">Nom</label>
                <input name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                @error('message')
                  <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
              </div>

              <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <button class="btn btn-success px-4">Envoyer</button>
                <div class="text-muted small">En envoyant ce formulaire, vous acceptez d’être recontacté.</div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
@endsection
