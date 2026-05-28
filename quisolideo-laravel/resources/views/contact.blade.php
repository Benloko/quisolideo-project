@extends('layouts.app')

@section('content')
<section class="page-hero page-hero--contact py-4">
  <div class="container px-3 px-md-4 contact-page-head">
    <div>
      <span class="section-badge mb-2">Contact</span>
      <h1 class="mb-1">Parlons de votre besoin</h1>
      <p class="text-muted mb-0">Question, inscription ou partenariat: envoyez votre message et nous revenons vers vous rapidement.</p>
    </div>
  </div>
</section>

<section class="pt-2 pb-5">
  <div class="container px-3 px-md-4 contact-shell">
    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger mb-4">
        <div class="fw-semibold">Veuillez corriger les champs en erreur.</div>
      </div>
    @endif

    <div class="row g-4 align-items-start">
      <div class="col-12 col-xl-5">
        <aside class="contact-side-card">
          <h2>Nous contacter</h2>
          <p>
            Decrivez votre besoin en quelques lignes. Nous vous orientons vers la solution la plus adaptee
            et vous proposons un suivi clair.
          </p>

          <div class="contact-points">
            <div class="contact-point">
              <strong>Formations</strong>
              <span>Informations, disponibilites et inscriptions.</span>
            </div>
            <div class="contact-point">
              <strong>Partenariats</strong>
              <span>Actions communes, interventions et appuis.</span>
            </div>
            <div class="contact-point">
              <strong>Boutique</strong>
              <span>Produits, commandes et accompagnement.</span>
            </div>
          </div>

          <div class="contact-quick-links">
            <a href="{{ route('trainings.index') }}" class="btn btn-outline-secondary btn-sm">Voir les formations</a>
            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">Voir la boutique</a>
          </div>
        </aside>
      </div>

      <div class="col-12 col-xl-7">
        <article class="contact-form-card">
          <h3>Envoyer un message</h3>

          <form method="POST" action="{{ route('contact.submit') }}" class="contact-form-grid">
            @csrf
            <div class="col-12 col-md-6">
              <label class="form-label">Nom</label>
              <input name="name" class="form-control" value="{{ old('name') }}" required>
              @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
              @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label">Message</label>
              <textarea name="message" class="form-control" rows="7" placeholder="Expliquez-nous votre besoin..." required>{{ old('message') }}</textarea>
              @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="col-12 contact-submit-row">
              <div class="contact-consent">En envoyant ce formulaire, vous acceptez d etre recontacte.</div>
              <button class="btn btn-success contact-submit-btn" type="submit">Envoyer le message</button>
            </div>
          </form>
        </article>
      </div>
    </div>
  </div>
</section>
@endsection
