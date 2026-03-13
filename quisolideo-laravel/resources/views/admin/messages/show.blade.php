@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-start mb-3 flex-wrap gap-2">
    <div>
      <h2 class="mb-1">Message — {{ $message->name }}</h2>
      <div class="text-muted small">
        {{ $message->email }} · Reçu le {{ $message->created_at?->format('d/m/Y à H:i') }}
        @if($message->read_flag)
          · <span class="badge text-bg-light">Lu</span>
        @else
          · <span class="badge text-bg-success">Nouveau</span>
        @endif
      </div>
    </div>

    <div class="text-nowrap">
      <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary btn-sm">Retour</a>

      <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST" style="display:inline">
        @csrf
        @method('PATCH')
        <button class="btn btn-outline-secondary btn-sm">{{ $message->read_flag ? 'Marquer non lu' : 'Marquer lu' }}</button>
      </form>

      <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ce message ?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger btn-sm">Supprimer</button>
      </form>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card border-0 shadow-sm">
    <div class="card-body p-4">
      <div style="white-space:pre-wrap;line-height:1.7">{{ $message->message }}</div>
    </div>
  </div>
</div>
@endsection
