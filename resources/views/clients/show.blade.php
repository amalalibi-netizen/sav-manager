@extends('layouts.app')

@section('title', 'Détail client')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">{{ $client->first_name }} {{ $client->last_name }}</h1>
            <p class="text-muted mb-0">Fiche client</p>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('clients.edit', $client) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Informations</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Prénom</dt>
                        <dd class="col-sm-8">{{ $client->first_name }}</dd>

                        <dt class="col-sm-4">Nom</dt>
                        <dd class="col-sm-8">{{ $client->last_name }}</dd>

                        <dt class="col-sm-4">Téléphone</dt>
                        <dd class="col-sm-8">{{ $client->phone ?? '—' }}</dd>

                        <dt class="col-sm-4">Email</dt>
                        <dd class="col-sm-8">{{ $client->email ?? '—' }}</dd>

                        <dt class="col-sm-4">Ville</dt>
                        <dd class="col-sm-8">{{ $client->city ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Adresse</h5>
                    <p class="mb-0">{{ $client->address ?? 'Aucune adresse renseignée.' }}</p>
                    <hr>
                    <h5 class="card-title">Notes</h5>
                    <p class="mb-0">{{ $client->notes ?? 'Aucune note.' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
