@extends('layouts.app')

@section('title', 'Détail ticket')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">{{ $ticket->ticket_number }}</h1>
            <p class="text-muted mb-0">Fiche ticket SAV</p>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Informations</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Client</dt>
                        <dd class="col-sm-8">{{ $ticket->client?->first_name }} {{ $ticket->client?->last_name }}</dd>

                        <dt class="col-sm-4">Appareil</dt>
                        <dd class="col-sm-8">{{ $ticket->device?->brand }} {{ $ticket->device?->model }}</dd>

                        <dt class="col-sm-4">Statut</dt>
                        <dd class="col-sm-8">{{ $ticket->status }}</dd>

                        <dt class="col-sm-4">Priorité</dt>
                        <dd class="col-sm-8">{{ $ticket->priority }}</dd>

                        <dt class="col-sm-4">Réception</dt>
                        <dd class="col-sm-8">{{ $ticket->received_at?->format('d/m/Y H:i') ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Détails</h5>
                    <p><strong>Problème :</strong> {{ $ticket->problem_description }}</p>
                    <p><strong>Diagnostic :</strong> {{ $ticket->diagnosis ?? '—' }}</p>
                    <p><strong>Livraison estimée :</strong> {{ $ticket->estimated_completion_at?->format('d/m/Y H:i') ?? '—' }}</p>
                    <p><strong>Date de fin :</strong> {{ $ticket->completed_at?->format('d/m/Y H:i') ?? '—' }}</p>
                    <p><strong>Livraison :</strong> {{ $ticket->delivered_at?->format('d/m/Y H:i') ?? '—' }}</p>
                    <p><strong>Notes :</strong> {{ $ticket->notes ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
