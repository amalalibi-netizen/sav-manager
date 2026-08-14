@extends('layouts.app')

@section('title', 'Tickets SAV')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Tickets SAV</h1>
            <p class="text-muted mb-0">Suivi des demandes après-vente</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="btn btn-primary">Nouveau ticket</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('tickets.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Numéro, client, problème...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        <option value="">Tous</option>
                        <option value="received" {{ $status === 'received' ? 'selected' : '' }}>Reçu</option>
                        <option value="diagnosis" {{ $status === 'diagnosis' ? 'selected' : '' }}>Diagnostic</option>
                        <option value="waiting_parts" {{ $status === 'waiting_parts' ? 'selected' : '' }}>En attente pièces</option>
                        <option value="repairing" {{ $status === 'repairing' ? 'selected' : '' }}>En réparation</option>
                        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="delivered" {{ $status === 'delivered' ? 'selected' : '' }}>Livré</option>
                        <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Priorité</label>
                    <select name="priority" class="form-select">
                        <option value="">Toutes</option>
                        <option value="low" {{ $priority === 'low' ? 'selected' : '' }}>Faible</option>
                        <option value="medium" {{ $priority === 'medium' ? 'selected' : '' }}>Moyenne</option>
                        <option value="high" {{ $priority === 'high' ? 'selected' : '' }}>Élevée</option>
                        <option value="urgent" {{ $priority === 'urgent' ? 'selected' : '' }}>Urgente</option>
                    </select>
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Filtrer</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Ticket</th>
                    <th>Client</th>
                    <th>Appareil</th>
                    <th>Statut</th>
                    <th>Priorité</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->ticket_number }}</td>
                        <td>{{ $ticket->client?->first_name }} {{ $ticket->client?->last_name }}</td>
                        <td>{{ $ticket->device?->brand ?? '—' }} {{ $ticket->device?->model ?? '' }}</td>
                        <td><span class="badge bg-secondary">{{ $ticket->status }}</span></td>
                        <td><span class="badge bg-warning text-dark">{{ $ticket->priority }}</span></td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('tickets.edit', $ticket) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" onsubmit="return confirm('Supprimer ce ticket ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucun ticket trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($tickets->hasPages())
            <div class="card-footer bg-white">{{ $tickets->links() }}</div>
        @endif
    </div>
@endsection
