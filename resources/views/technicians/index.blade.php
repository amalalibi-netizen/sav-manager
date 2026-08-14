@extends('layouts.app')

@section('title', 'Techniciens')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Techniciens</h1>
            <p class="text-muted mb-0">Gestion de l'équipe d'intervention</p>
        </div>
        <a href="{{ route('technicians.create') }}" class="btn btn-primary">Ajouter un technicien</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('technicians.index') }}" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Nom, email, téléphone...">
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
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($technicians as $technician)
                    <tr>
                        <td>{{ $technician->name }}</td>
                        <td>{{ $technician->email ?? '—' }}</td>
                        <td>{{ $technician->phone ?? '—' }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('technicians.show', $technician) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('technicians.edit', $technician) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('technicians.destroy', $technician) }}" method="POST" onsubmit="return confirm('Supprimer ce technicien ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Aucun technicien trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($technicians->hasPages())
            <div class="card-footer bg-white">{{ $technicians->links() }}</div>
        @endif
    </div>
@endsection
