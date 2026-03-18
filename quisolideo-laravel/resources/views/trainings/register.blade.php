@extends('layouts.app')

@section('content')
@php
  $heroImage = $training->image ?: optional($training->images->first())->path;
@endphp

<section class="page-hero page-hero--training training-hero" @if($heroImage) style="--training-hero-image: url('{{ $heroImage }}');" @endif>
  <div class="container px-3 px-md-4">
    <a href="{{ route('trainings.show', $training->slug) }}" class="training-hero-back text-decoration-none">← Retour à la formation</a>

    <div class="row g-4 align-items-end mt-2">
      <div class="col-12 col-lg-8">
        <div class="mt-2 d-flex flex-wrap gap-2">
          <span class="section-badge">Inscription <span class="emoji-twinkle" aria-hidden="true">✨</span></span>
          <span class="section-badge">{{ $training->title }}</span>
        </div>
        <h1 class="mt-3 mb-2">S’inscrire à la formation</h1>
        <p class="mb-0" style="max-width:80ch">Laissez vos coordonnées : on vous recontacte rapidement avec une proposition claire (planning, format, tarif si besoin).</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5 training-show">
  <div class="container px-3 px-md-4">
    <div class="row g-4">
      <div class="col-12 col-lg-7">
        <div class="training-content-card">
          <div class="training-content p-4 p-md-5">
            <form method="POST" action="{{ route('trainings.register.submit', $training->slug) }}" class="training-form">
              @csrf
              <div class="row g-3">
                <div class="col-12 col-md-6">
                  <label class="form-label fw-bold">Prénom</label>
                  <input name="first_name" class="form-control" value="{{ old('first_name') }}" required autocomplete="given-name">
                  @error('first_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label fw-bold">Nom</label>
                  <input name="last_name" class="form-control" value="{{ old('last_name') }}" required autocomplete="family-name">
                  @error('last_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">Email</label>
                  <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email">
                  @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">Téléphone (optionnel)</label>
                  <input name="phone" class="form-control" value="{{ old('phone') }}" autocomplete="tel">
                  @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">Message (optionnel)</label>
                  <textarea name="message" class="form-control" rows="5" placeholder="Votre besoin, votre disponibilité, vos questions…">{{ old('message') }}</textarea>
                  @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                  <button class="btn btn-success btn-lg w-100">Envoyer ma demande 🚀</button>
                </div>
                <div class="col-12">
                  <div class="text-muted small">En envoyant ce formulaire, vous acceptez d’être recontacté au sujet de cette formation.</div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-5">
        <aside class="training-side">
          <div class="training-side-card">
            <div class="training-side-title">Récapitulatif ✅</div>
            <div class="training-side-list">
              <div class="training-side-item">
                <div class="training-side-label">Formation</div>
                <div class="training-side-value">{{ $training->title }}</div>
              </div>
              @if(!empty($training->seats) && (int) $training->seats > 0)
                <div class="training-side-item">
                  <div class="training-side-label">Places</div>
                  <div class="training-side-value">{{ (int) $training->seats }}</div>
                </div>
              @endif
              <div class="training-side-item">
                <div class="training-side-label">Réponse</div>
                <div class="training-side-value">Rapide et claire</div>
              </div>
            </div>

            <div class="d-grid gap-2 mt-3">
              <a href="{{ route('contact') }}" class="btn btn-outline-secondary">Passer par le contact</a>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>
</section>
@endsection
