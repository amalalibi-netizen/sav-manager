@extends('layouts.app')

@section('title', 'Rapports')

@section('content')

<div class="mb-4">
    <h1 class="h3 mb-1">Rapports SAV</h1>
    <p class="text-muted mb-0">Vue globale de l'activité du service après-vente</p>
</div>

<div class="row g-4 mb-4">

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Clients</h6>
                <h2>{{ $totalClients }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Tickets</h6>
                <h2>{{ $totalTickets }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Interventions</h6>
                <h2>{{ $totalRepairs }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Pièces</h6>
                <h2>{{ $totalParts }}</h2>
            </div>
        </div>
    </div>

</div>

<div class="row g-4">

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Tickets terminés</h5>
                <p class="display-6">{{ $completedTickets }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Main d'œuvre</h5>
                <p class="display-6">
                    {{ number_format((float) $totalLabor, 2, ',', ' ') }} DT
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h5>Coût total</h5>
                <p class="display-6">
                    {{ number_format((float) $totalRevenue, 2, ',', ' ') }} DT
                </p>
            </div>
        </div>
    </div>

</div>

<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">
        <h5 class="mb-3">Résumé financier</h5>

        <div class="row">
            <div class="col-md-6">
                <strong>Coût main d'œuvre :</strong>
                {{ number_format((float) $totalLabor, 2, ',', ' ') }} DT
            </div>

            <div class="col-md-6">
                <strong>Coût pièces :</strong>
                {{ number_format((float) $totalPartsCost, 2, ',', ' ') }} DT
            </div>
        </div>
    </div>
</div>

@endsection