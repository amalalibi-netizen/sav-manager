@extends('layouts.app')

@section('title', 'Détail de l’intervention')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Détail de l’intervention</h1>
            <p class="text-muted mb-0">Informations complètes de la réparation</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('repairs.edit', $repair) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <h5 class="mb-3">Ticket</h5>
                    <p class="mb-1"><strong>Numéro :</strong> {{ $repair->ticket?->ticket_number ?? '—' }}</p>
                    <p class="mb-1"><strong>Client :</strong> {{ $repair->ticket?->client?->first_name }} {{ $repair->ticket?->client?->last_name }}</p>
                    <p class="mb-1"><strong>Appareil :</strong> {{ $repair->ticket?->device?->brand ?? '—' }} {{ $repair->ticket?->device?->model ?? '' }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="mb-3">Technicien</h5>
                    <p class="mb-1"><strong>Nom :</strong> {{ $repair->technician?->name ?? '—' }}</p>
                    <p class="mb-1"><strong>Email :</strong> {{ $repair->technician?->email ?? '—' }}</p>
                    <p class="mb-1"><strong>Téléphone :</strong> {{ $repair->technician?->phone ?? '—' }}</p>
                </div>

                <div class="col-12">
                    <h5 class="mb-3">Diagnostic</h5>
                    <p>{{ $repair->diagnosis }}</p>
                </div>

                <div class="col-12">
                    <h5 class="mb-3">Description de l’intervention</h5>
                    <p>{{ $repair->repair_description }}</p>
                </div>

                <div class="col-12">
                    <h5 class="mb-3">Pièces utilisées</h5>
                    <p>{{ $repair->parts_used ?? '—' }}</p>
                </div>

                <div class="col-md-4">
                    <p><strong>Coût main d’œuvre :</strong> {{ number_format((float) $repair->labor_cost, 2, ',', ' ') }} DT</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Coût pièces :</strong> {{ number_format((float) $repair->parts_cost, 2, ',', ' ') }} DT</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Coût total :</strong> {{ number_format((float) $repair->total_cost, 2, ',', ' ') }} DT</p>
                </div>

                <div class="col-md-12">
                    <p><strong>Statut :</strong> <span class="badge bg-secondary">{{ $repair->status }}</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
