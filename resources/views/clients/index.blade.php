@extends('layouts.app')

@section('title', 'Clients')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Clients</h1>
            <p class="text-muted mb-0">Gestion des clients SAV</p>
        </div>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouveau client
        </a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="GET" action="{{ route('clients.index') }}" class="row g-2 align-items-end">
                <div class="col-md-10">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Nom, email, téléphone, ville...">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0 mt-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($clients as $client)
                    <tr>
                        <td>
                            <strong>{{ $client->first_name }} {{ $client->last_name }}</strong>
                        </td>
                        <td>{{ $client->phone ?? '—' }}</td>
                        <td>{{ $client->email ?? '—' }}</td>
                        <td>{{ $client->city ?? '—' }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('clients.show', $client) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('clients.edit', $client) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Aucun client trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        @if($clients->hasPages())
            <div class="card-footer bg-white">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
@endsection
