@extends('layouts.app')

@section('content')
<section class="py-5">
  <div class="container-fluid px-3 px-md-4">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-5">
        <div class="card border-0 shadow-sm" style="border-radius:16px">
          <div class="card-body p-4 p-md-5">
            <h1 class="h4 mb-1" style="color:var(--brand-dark);font-weight:900">Créer un compte</h1>
            <p class="text-muted small mb-4">Inscription rapide pour pouvoir commander.</p>

            @if($errors->any())
              <div class="alert alert-danger">Veuillez corriger les champs en erreur.</div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
              @csrf

              <div class="mb-3">
                <label class="form-label">Nom</label>
                <input name="name" class="form-control" value="{{ old('name') }}" autocomplete="name" required>
                @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" autocomplete="email" required>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" autocomplete="new-password" required>
                @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" autocomplete="new-password" required>
              </div>

              <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                <a href="{{ route('login') }}" class="small" style="color:var(--brand-dark)">J’ai déjà un compte</a>
              </div>

              <button class="btn btn-success w-100 mt-4">Créer mon compte</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
