@extends('layouts.app')

@section('title', 'Détail du technicien')

@section('content')
    @php
        $totalRepairs = $technician->repairs()->count();
        $completedRepairs = $technician->repairs()->where('status', 'completed')->count();
        $totalCost = $technician->repairs()->sum('total_cost');
        $averageCost = $totalRepairs > 0 ? $totalCost / $totalRepairs : 0;
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Détail du technicien</h1>
            <p class="text-muted mb-0">Informations complètes et statistiques</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('technicians.edit', $technician) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="mb-2"><strong>Nom :</strong></p>
                    <p class="h5 mb-0">{{ $technician->name }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Email :</strong></p>
                    <p class="mb-0">{{ $technician->email ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Téléphone :</strong></p>
                    <p class="mb-0">{{ $technician->phone ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Membre depuis :</strong></p>
                    <p class="mb-0">{{ $technician->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Réparations totales</h6>
                    <p class="h4 mb-0 text-primary">{{ $totalRepairs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Complétées</h6>
                    <p class="h4 mb-0 text-success">{{ $completedRepairs }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Coût moyen</h6>
                    <p class="h5 mb-0 text-info">{{ number_format($averageCost, 2, ',', ' ') }} DT</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted mb-2">Coût total</h6>
                    <p class="h5 mb-0 text-warning">{{ number_format($totalCost, 2, ',', ' ') }} DT</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-light border-bottom">
            <h5 class="mb-0">Historique des réparations</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Ticket</th>
                    <th>Client</th>
                    <th>Diagnostic</th>
                    <th>Coût</th>
                    <th>Statut</th>
                </tr>
                </thead>
                <tbody>
                @forelse($technician->repairs()->with(['ticket.client'])->latest()->get() as $repair)
                    <tr>
                        <td>{{ $repair->ticket?->ticket_number ?? '—' }}</td>
                        <td>{{ $repair->ticket?->client?->first_name }} {{ $repair->ticket?->client?->last_name }}</td>
                        <td>{{ Str::limit($repair->diagnosis, 40) }}</td>
                        <td>{{ number_format((float) $repair->total_cost, 2, ',', ' ') }} DT</td>
                        <td>
                            @php
                                $statusClass = match($repair->status) {
                                    'completed' => 'bg-success',
                                    'in_progress' => 'bg-info',
                                    'waiting_parts' => 'bg-warning text-dark',
                                    default => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $repair->status }}</span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-muted">Aucune réparation attribuée</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
