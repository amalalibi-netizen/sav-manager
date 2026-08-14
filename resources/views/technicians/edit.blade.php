@extends('layouts.app')

@section('title', 'Modifier le technicien')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Modifier le technicien</h1>
            <p class="text-muted mb-0">Mettre à jour les informations</p>
        </div>
        <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('technicians.update', $technician) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nom complet *</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $technician->name) }}" class="form-control @error('name') is-invalid @enderror" required>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $technician->email) }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $technician->phone) }}" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('technicians.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
