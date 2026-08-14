@extends('layouts.app')

@section('title', 'Détail appareil')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">{{ $device->brand }} {{ $device->model }}</h1>
            <p class="text-muted mb-0">Fiche appareil</p>
        </div>
        <div class="btn-group" role="group">
            <a href="{{ route('devices.edit', $device) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Informations</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Client</dt>
                        <dd class="col-sm-8">{{ $device->client?->first_name }} {{ $device->client?->last_name }}</dd>

                        <dt class="col-sm-4">Type</dt>
                        <dd class="col-sm-8">{{ $device->type }}</dd>

                        <dt class="col-sm-4">Marque</dt>
                        <dd class="col-sm-8">{{ $device->brand }}</dd>

                        <dt class="col-sm-4">Modèle</dt>
                        <dd class="col-sm-8">{{ $device->model }}</dd>

                        <dt class="col-sm-4">Série</dt>
                        <dd class="col-sm-8">{{ $device->serial_number ?? '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title">Détails</h5>
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Date d’achat</dt>
                        <dd class="col-sm-7">{{ $device->purchase_date ? $device->purchase_date->format('d/m/Y') : '—' }}</dd>

                        <dt class="col-sm-5">Garantie</dt>
                        <dd class="col-sm-7">{{ $device->warranty_status }}</dd>
                    </dl>
                    <hr>
                    <h5 class="card-title">Notes</h5>
                    <p class="mb-0">{{ $device->notes ?? 'Aucune note.' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
