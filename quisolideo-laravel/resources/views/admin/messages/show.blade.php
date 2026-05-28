@extends('layouts.app')

@section('content')
<div class="container py-4 admin-shell">
  <div class="admin-page-head mb-3">
    <div>
      <p class="admin-eyebrow mb-2">Message contact</p>
      <h1 class="admin-title mb-1">{{ $message->name }}</h1>
      <p class="admin-sub mb-0">{{ $message->email }} · Recu le {{ $message->created_at?->format('d/m/Y a H:i') }}</p>
    </div>

    <div class="admin-actions-inline">
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm admin-pill-btn">Retour</a>

      <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST" class="m-0">
        @csrf
        @method('PATCH')
        <button class="btn btn-success btn-sm admin-pill-btn">{{ $message->read_flag ? 'Marquer non lu' : 'Marquer lu' }}</button>
      </form>

      <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="m-0" onsubmit="return confirm('Supprimer ce message ?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger btn-sm admin-pill-btn">Supprimer</button>
      </form>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <section class="admin-card p-3 p-md-4">
    <div class="admin-note-block">{{ $message->message }}</div>
  </section>
</div>
@endsection
