@extends('layouts.app')

@section('title', 'Appareils')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Appareils</h1>
            <p class="text-muted mb-0">Gestion des appareils clients</p>
        </div>
        <a href="{{ route('devices.create') }}" class="btn btn-primary">Nouveau appareil</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('devices.index') }}" class="row g-2 align-items-end">
                <div class="col-md-10">
                    <label class="form-label">Recherche</label>
                    <input type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Marque, modèle, série, type...">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit" class="btn btn-outline-primary">Rechercher</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Séries</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($devices as $device)
                    <tr>
                        <td>{{ $device->client ? $device->client->first_name.' '.$device->client->last_name : '—' }}</td>
                        <td>{{ ucfirst($device->type) }}</td>
                        <td>{{ $device->brand }}</td>
                        <td>{{ $device->model }}</td>
                        <td>{{ $device->serial_number ?? '—' }}</td>
                        <td class="text-end">
                            <div class="btn-group" role="group">
                                <a href="{{ route('devices.show', $device) }}" class="btn btn-sm btn-outline-info">Voir</a>
                                <a href="{{ route('devices.edit', $device) }}" class="btn btn-sm btn-outline-warning">Modifier</a>
                                <form action="{{ route('devices.destroy', $device) }}" method="POST" onsubmit="return confirm('Supprimer cet appareil ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">Aucun appareil trouvé.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    
    </div>
@endsection
