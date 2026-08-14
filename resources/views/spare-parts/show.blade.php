@extends('layouts.app')

@section('title', 'Détail de la pièce')

@section('content')
    @php
        $isLowStock = $sparePart->quantity_in_stock <= $sparePart->minimum_stock;
        $stockPercentage = $sparePart->minimum_stock > 0 
            ? min(100, round(($sparePart->quantity_in_stock / $sparePart->minimum_stock) * 100))
            : 100;
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Détail de la pièce</h1>
            <p class="text-muted mb-0">Informations complètes et inventaire</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('spare-parts.edit', $sparePart) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('spare-parts.index') }}" class="btn btn-outline-secondary">Retour</a>
        </div>
    </div>

    @if($isLowStock)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>⚠️ Alerte stock faible</strong> — Quantité en dessous du seuil minimum. Veuillez renouveler votre stock.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <p class="mb-2"><strong>Nom :</strong></p>
                    <p class="h5 mb-0">{{ $sparePart->name }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Code de référence :</strong></p>
                    <p class="mb-0"><code class="bg-light p-2 rounded">{{ $sparePart->reference_code }}</code></p>
                </div>
                <div class="col-md-12">
                    <p class="mb-2"><strong>Description :</strong></p>
                    <p class="mb-0">{{ $sparePart->description ?? '—' }}</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Prix unitaire :</strong></p>
                    <p class="h5 mb-0 text-primary">{{ number_format((float) $sparePart->unit_cost, 2, ',', ' ') }} DT</p>
                </div>
                <div class="col-md-6">
                    <p class="mb-2"><strong>Fournisseur :</strong></p>
                    <p class="mb-0">{{ $sparePart->supplier ?? '—' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Quantité en stock</h6>
                    <p class="h4 mb-3">{{ $sparePart->quantity_in_stock }} unités</p>
                    <div class="progress" style="height: 25px;">
                        @php
                            $barClass = $isLowStock ? 'bg-danger' : ($stockPercentage >= 75 ? 'bg-success' : 'bg-warning');
                        @endphp
                        <div class="progress-bar {{ $barClass }}" role="progressbar" style="width: {{ $stockPercentage }}%;" aria-valuenow="{{ $stockPercentage }}" aria-valuemin="0" aria-valuemax="100">{{ $stockPercentage }}%</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="text-muted mb-3">Stock minimum</h6>
                    <p class="h4 mb-3">{{ $sparePart->minimum_stock }} unités</p>
                    <small class="text-muted">Alerte activée si le stock passe sous ce seuil</small>
                </div>
            </div>
        </div>
    </div>

    @if($sparePart->notes)
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted mb-2">Notes</h6>
                <p class="mb-0">{{ $sparePart->notes }}</p>
            </div>
        </div>
    @endif
@endsection
