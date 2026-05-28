@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Inscriptions formations</p>
      <h1 class="admin-title mb-1">{{ $registration->first_name }} {{ $registration->last_name }}</h1>
      <p class="admin-sub mb-0">Recu le {{ $registration->created_at?->format('d/m/Y a H:i') }}</p>
    </div>
    <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row g-3">
    <div class="col-12 col-lg-7">
      <section class="admin-card p-3 p-md-4">
        <h2 class="admin-card-title">Profil candidat</h2>

        <div class="admin-data-grid mt-3">
          <div>
            <span>Prenom</span>
            <strong>{{ $registration->first_name }}</strong>
          </div>
          <div>
            <span>Nom</span>
            <strong>{{ $registration->last_name }}</strong>
          </div>
          <div>
            <span>Email</span>
            <strong>{{ $registration->email }}</strong>
          </div>
          <div>
            <span>Telephone</span>
            <strong>{{ $registration->phone ?: 'Non renseigne' }}</strong>
          </div>
          <div>
            <span>Niveau d'etude</span>
            <strong>{{ $registration->education_level ?: 'Non renseigne' }}</strong>
          </div>
          <div>
            <span>Formation</span>
            <strong>{{ $registration->training?->title ?? 'Formation supprimee' }}</strong>
          </div>
        </div>

        <hr>
        <h3 class="admin-subtitle">Message</h3>
        <div class="admin-note-block">{{ $registration->message ?: 'Aucun message.' }}</div>
      </section>
    </div>

    <div class="col-12 col-lg-5">
      <section class="admin-card p-3 p-md-4">
        <h2 class="admin-card-title">Documents</h2>

        @if($registration->photo_path)
          <div class="mt-3">
            <img src="{{ $registration->photo_path }}" alt="Photo candidat" class="img-fluid rounded-4 border">
          </div>
        @endif

        <div class="d-grid gap-2 mt-3">
          @if($registration->photo_path)
            <a href="{{ $registration->photo_path }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm admin-pill-btn">Voir la photo</a>
          @endif

          @if($registration->cv_path)
            <a href="{{ $registration->cv_path }}" target="_blank" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm admin-pill-btn">Telecharger le CV</a>
          @else
            <div class="small text-muted">Aucun CV joint.</div>
          @endif

          <a href="mailto:{{ $registration->email }}" class="btn btn-success btn-sm admin-pill-btn">Repondre par email</a>
        </div>
      </section>
    </div>
  </div>
</div>
@endsection
