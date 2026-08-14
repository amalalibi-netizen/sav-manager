@extends('layouts.app')

@section('title', 'Ajouter une pièce')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Ajouter une pièce de rechange</h1>
            <p class="text-muted mb-0">Créer un nouvel article en stock</p>
        </div>
        <a href="{{ route('spare-parts.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('spare-parts.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="reference_code" class="form-label">Code de référence *</label>
                        <input type="text" name="reference_code" id="reference_code" value="{{ old('reference_code') }}" class="form-control @error('reference_code') is-invalid @enderror" required>
                        @error('reference_code')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="unit_cost" class="form-label">Prix unitaire (DT) *</label>
                        <input type="number" step="0.01" name="unit_cost" id="unit_cost" value="{{ old('unit_cost') }}" class="form-control @error('unit_cost') is-invalid @enderror" required>
                        @error('unit_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="quantity_in_stock" class="form-label">Quantité en stock *</label>
                        <input type="number" name="quantity_in_stock" id="quantity_in_stock" value="{{ old('quantity_in_stock', 0) }}" class="form-control @error('quantity_in_stock') is-invalid @enderror" required>
                        @error('quantity_in_stock')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="minimum_stock" class="form-label">Stock minimum</label>
                        <input type="number" name="minimum_stock" id="minimum_stock" value="{{ old('minimum_stock', 0) }}" class="form-control @error('minimum_stock') is-invalid @enderror">
                        @error('minimum_stock')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="supplier" class="form-label">Fournisseur</label>
                        <input type="text" name="supplier" id="supplier" value="{{ old('supplier') }}" class="form-control @error('supplier') is-invalid @enderror">
                        @error('supplier')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" rows="2" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('spare-parts.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
