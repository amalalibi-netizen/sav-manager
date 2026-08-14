@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    @php
        $activeTickets = \App\Models\Ticket::whereIn('status', ['received', 'diagnosis', 'repairing', 'waiting_parts'])->count();
        $completedRepairs = \App\Models\Repair::where('status', 'completed')->count();
        $lowStockParts = \App\Models\SparePart::whereColumn('quantity_in_stock', '<=', 'minimum_stock')->count();
        $urgentTickets = \App\Models\Ticket::where('priority', 'urgent')->count();
        $recentTickets = \App\Models\Ticket::with('client')->latest('received_at')->take(5)->get();
        $recentRepairs = \App\Models\Repair::with(['ticket', 'technician'])->latest()->take(5)->get();
    @endphp

    <div class="mb-4">
        <h1 class="h3 mb-1">Bienvenue, {{ auth()->user()->name }} !</h1>
        <p class="text-muted mb-0">Tableau de bord - Gestion SAV Manager</p>
    </div>

    @include('partials.flash')

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Clients</h6>
                            <p class="h4 mb-0 text-primary">{{ \App\Models\Client::count() }}</p>
                        </div>
                        <span class="badge bg-primary-subtle text-primary rounded-circle p-3 fs-6">👥</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Appareils</h6>
                            <p class="h4 mb-0 text-info">{{ \App\Models\Device::count() }}</p>
                        </div>
                        <span class="badge bg-info-subtle text-info rounded-circle p-3 fs-6">📱</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Tickets actifs</h6>
                            <p class="h4 mb-0 text-warning">{{ $activeTickets }}</p>
                        </div>
                        <span class="badge bg-warning-subtle text-warning rounded-circle p-3 fs-6">🧾</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Interventions</h6>
                            <p class="h4 mb-0 text-success">{{ \App\Models\Repair::count() }}</p>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-circle p-3 fs-6">🔧</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 text-muted">Réparations terminées</h6>
                        <span class="badge bg-success">{{ $completedRepairs }}</span>
                    </div>
                    <p class="mb-0 small text-muted">Suivi des réparations closes</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 text-muted">Pièces faibles</h6>
                        <span class="badge bg-danger">{{ $lowStockParts }}</span>
                    </div>
                    <p class="mb-0 small text-muted">Stock en dessous du seuil</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0 text-muted">Tickets urgents</h6>
                        <span class="badge bg-primary">{{ $urgentTickets }}</span>
                    </div>
                    <p class="mb-0 small text-muted">À traiter en priorité</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Derniers tickets</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Ticket</th>
                            <th>Client</th>
                            <th>Priorité</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentTickets as $ticket)
                            <tr>
                                <td>{{ $ticket->ticket_number }}</td>
                                <td>{{ $ticket->client?->first_name }} {{ $ticket->client?->last_name }}</td>
                                <td>
                                    @php
                                        $priorityClass = match($ticket->priority) {
                                            'urgent' => 'bg-danger',
                                            'high' => 'bg-warning text-dark',
                                            'medium' => 'bg-primary',
                                            default => 'bg-secondary',
                                        };
                                    @endphp
                                    <span class="badge {{ $priorityClass }}">{{ $ticket->priority }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">Aucun ticket récent</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Dernières interventions</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Ticket</th>
                            <th>Technicien</th>
                            <th>Statut</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($recentRepairs as $repair)
                            <tr>
                                <td>{{ $repair->ticket?->ticket_number ?? '—' }}</td>
                                <td>{{ $repair->technician?->name ?? '—' }}</td>
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
                                <td colspan="3" class="text-center py-3 text-muted">Aucune intervention</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
