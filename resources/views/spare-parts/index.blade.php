@extends('layouts.app')

@section('title', 'Pièces de rechange')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Pièces de rechange</h1>
            <p class="text-muted mb-0">Gestion du stock de pièces</p>
        </div>
        <a href="{{ route('spare-parts.create') }}" class="btn btn-primary">Ajouter une pièce</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('spare-parts.index') }}" class="row g-2 align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Nom, code, fournisseur...">
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
                    <th>Code</th>
                    <th>Prix unitaire</th>
                    <th>Stock</th>
                    <th>Fournisseur</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($spareParts as $part)
                    <tr>
                        <td>{{ $part->name }}</td>
                        <td><code>{{ $part->reference_code }}</code></td>
                        <td>{{ number_format((float) $part->unit_cost, 2, ',', ' ') }} DT</td>
                        <td>
                            <span class="badge @if($part->quantity_in_stock < $part->minimum_stock) bg-warning @else bg-success @endif">
                                {{ $part->quantity_in_stock }} / {{ $part->minimum_stock }}
                            </span>
                        </td>
                        <td>{{ $part->supplier ?? '—' }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('spare-parts.show', $part) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('spare-parts.edit', $part) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('spare-parts.destroy', $part) }}" method="POST" onsubmit="return confirm('Supprimer cette pièce ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucune pièce trouvée.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if($spareParts->hasPages())
            <div class="card-footer bg-white">{{ $spareParts->links() }}</div>
        @endif
    </div>
@endsection
