@extends('layouts.app')

@section('title', 'Interventions SAV')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Interventions SAV</h1>
            <p class="text-muted mb-0">Suivi des interventions et réparations</p>
        </div>
        <a href="{{ route('repairs.create') }}" class="btn btn-primary">Nouvelle intervention</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('repairs.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Ticket, diagnostic, technicien...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Statut</label>
                    <select name="status" class="form-select">
                        <option value="">Tous</option>
                        <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="in_progress" {{ $status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="waiting_parts" {{ $status === 'waiting_parts' ? 'selected' : '' }}>En attente pièces</option>
                        <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="cancelled" {{ $status === 'cancelled' ? 'selected' : '' }}>Annulé</option>
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
                    <th>Technicien</th>
                    <th>Diagnostic</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($repairs as $repair)
                    <tr>
                        <td>{{ $repair->ticket?->ticket_number ?? '—' }}</td>
                        <td>{{ $repair->technician?->name ?? '—' }}</td>
                        <td>{{ Str::limit($repair->diagnosis, 60) }}</td>
                        <td><span class="badge bg-secondary">{{ $repair->status }}</span></td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('repairs.show', $repair) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('repairs.edit', $repair) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('repairs.destroy', $repair) }}" method="POST" onsubmit="return confirm('Supprimer cette intervention ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Aucune intervention trouvée.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($repairs->hasPages())
            <div class="card-footer bg-white">{{ $repairs->links() }}</div>
        @endif
    </div>
@endsection
