@extends('layouts.app')

@section('content')
@php
  $trainings = (int) ($kpis['trainings'] ?? 0);
  $partners = (int) ($kpis['partners'] ?? 0);
  $messagesUnread = (int) ($kpis['messages_unread'] ?? 0);
  $messagesTotal = (int) ($kpis['messages_total'] ?? 0);
  $registrationsTotal = (int) ($kpis['registrations_total'] ?? 0);
  $registrationsToday = (int) ($kpis['registrations_today'] ?? 0);
@endphp

<div class="container py-4 py-lg-5 admin-shell">
  <section class="admin-main-panel admin-entre-panel">
    <div class="admin-entre-hero">
      <div>
        <p class="admin-eyebrow mb-2">Centre de pilotage</p>
        <h1 class="admin-title mb-2">Tableau de bord Entreprenariat</h1>
        <p class="admin-sub mb-0">Suivi global des contenus, messages et inscriptions de votre espace.</p>
      </div>
      <div class="admin-entre-hero-badges">
        <span>{{ $registrationsToday }} inscription{{ $registrationsToday > 1 ? 's' : '' }} aujourd'hui</span>
        <span>{{ $messagesUnread }} message{{ $messagesUnread > 1 ? 's' : '' }} non lu{{ $messagesUnread > 1 ? 's' : '' }}</span>
      </div>
    </div>

    <div class="admin-entre-stats-grid mt-3">
      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">FD</div>
        <div class="admin-entre-stat-body">
          <p>Formations</p>
          <strong>{{ $trainings }}</strong>
          <small>Catalogue actif</small>
        </div>
      </article>

      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">PT</div>
        <div class="admin-entre-stat-body">
          <p>Partenaires</p>
          <strong>{{ $partners }}</strong>
          <small>Reseau disponible</small>
        </div>
      </article>

      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">MS</div>
        <div class="admin-entre-stat-body">
          <p>Messages non lus</p>
          <strong>{{ $messagesUnread }}</strong>
          <small>Priorite du jour</small>
        </div>
      </article>

      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">TM</div>
        <div class="admin-entre-stat-body">
          <p>Messages total</p>
          <strong>{{ $messagesTotal }}</strong>
          <small>Historique contact</small>
        </div>
      </article>

      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">IN</div>
        <div class="admin-entre-stat-body">
          <p>Inscriptions total</p>
          <strong>{{ $registrationsTotal }}</strong>
          <small>Candidatures recues</small>
        </div>
      </article>

      <article class="admin-entre-stat-card">
        <div class="admin-entre-stat-icon" aria-hidden="true">AJ</div>
        <div class="admin-entre-stat-body">
          <p>Inscriptions aujourd'hui</p>
          <strong>{{ $registrationsToday }}</strong>
          <small>Flux du jour</small>
        </div>
      </article>
    </div>

    <div class="mt-4">
      <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-2">
        <h2 class="admin-section-title">Actions rapides</h2>
        <span class="admin-entre-note">Passez rapidement d'une zone a l'autre</span>
      </div>

      <div class="admin-entre-actions-grid">
        <a href="{{ route('admin.trainings.index') }}" class="admin-entre-action-card">
          <div class="admin-entre-action-top">
            <strong>Gerer les formations</strong>
            <span>01</span>
          </div>
          <p>Creer, modifier et structurer vos parcours.</p>
          <span class="admin-entre-action-link">Ouvrir la section</span>
        </a>

        <a href="{{ route('admin.registrations.index') }}" class="admin-entre-action-card">
          <div class="admin-entre-action-top">
            <strong>Voir les inscriptions</strong>
            <span>02</span>
          </div>
          <p>Suivre les demandes et recontacter rapidement.</p>
          <span class="admin-entre-action-link">Consulter la liste</span>
        </a>

        <a href="{{ route('admin.messages.index') }}" class="admin-entre-action-card">
          <div class="admin-entre-action-top">
            <strong>Traiter les messages</strong>
            <span>03</span>
          </div>
          <p>Prioriser les messages non lus et repondre vite.</p>
          <span class="admin-entre-action-link">Voir les messages</span>
        </a>

        <a href="{{ route('admin.partners.index') }}" class="admin-entre-action-card">
          <div class="admin-entre-action-top">
            <strong>Mettre a jour partenaires</strong>
            <span>04</span>
          </div>
          <p>Renforcer la visibilite et la credibilite du reseau.</p>
          <span class="admin-entre-action-link">Acceder aux partenaires</span>
        </a>
      </div>
    </div>
  </section>
</div>
@endsection
