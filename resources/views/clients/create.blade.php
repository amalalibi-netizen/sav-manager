@extends('layouts.app')

@section('title', 'Nouveau client')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Nouveau client</h1>
            <p class="text-muted mb-0">Créer un client SAV</p>
        </div>
        <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label">Prénom</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="form-control @error('first_name') is-invalid @enderror" required>
                        @error('first_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Nom</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="form-control @error('last_name') is-invalid @enderror" required>
                        @error('last_name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror">
                        @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror">
                        @error('city') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Adresse</label>
                        <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('clients.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
