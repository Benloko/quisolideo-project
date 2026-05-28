@extends('layouts.app')

@section('content')
<div class="container py-5 admin-shell">
  <div class="row justify-content-center">
    <div class="col-12 col-md-7 col-lg-5">
      <section class="admin-card p-4 p-md-5">
        <p class="admin-eyebrow mb-2">Authentification</p>
        <h1 class="admin-title mb-2">{{ $spaceTitle ?? 'Admin - Connexion' }}</h1>
        <p class="admin-sub mb-4">Connectez-vous pour gerer votre espace.</p>

        @if($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route($postRouteName ?? 'admin.entreprenariat.login.post') }}" class="d-grid gap-3">
          @csrf
          <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
          </div>
          <div>
            <label class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <button class="btn btn-success btn-sm admin-pill-btn">Se connecter</button>
        </form>
      </section>
    </div>
  </div>
</div>
@endsection
