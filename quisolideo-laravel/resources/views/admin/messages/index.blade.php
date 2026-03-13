@extends('layouts.app')

@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
    <div>
      <h2 class="mb-0">Messages — Contact</h2>
      <div class="text-muted small">Demandes envoyées depuis le formulaire de contact.</div>
    </div>
    <div>
      @if(!empty($unreadCount))
        <span class="badge bg-success">{{ $unreadCount }} non lu{{ $unreadCount > 1 ? 's' : '' }}</span>
      @endif
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($messages->count())
    <div class="list-group">
      @foreach($messages as $m)
        <div class="list-group-item d-flex justify-content-between align-items-start gap-3">
          <div style="flex:1">
            <div class="d-flex align-items-center gap-2 flex-wrap">
              <strong>{{ $m->name }}</strong>
              <span class="text-muted small">{{ $m->email }}</span>
              @if(!$m->read_flag)
                <span class="badge bg-success">Nouveau</span>
              @endif
            </div>
            <div class="text-muted" style="line-height:1.45">{{ \Illuminate\Support\Str::limit($m->message, 130) }}</div>
            <div class="text-muted small mt-1">Reçu le {{ $m->created_at?->format('d/m/Y à H:i') }}</div>
          </div>

          <div class="text-nowrap">
            <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-primary btn-sm">Voir</a>

            <form action="{{ route('admin.messages.toggleRead', $m) }}" method="POST" style="display:inline">
              @csrf
              @method('PATCH')
              <button class="btn btn-outline-secondary btn-sm">{{ $m->read_flag ? 'Non lu' : 'Lu' }}</button>
            </form>

            <form action="{{ route('admin.messages.destroy', $m) }}" method="POST" style="display:inline" onsubmit="return confirm('Supprimer ce message ?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger btn-sm">Supprimer</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="alert alert-secondary">Aucun message pour le moment.</div>
  @endif
</div>
@endsection
