@extends('layouts.app')

@section('title', 'Nouveau ticket')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Nouveau ticket</h1>
            <p class="text-muted mb-0">Créer un dossier SAV</p>
        </div>
        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="client_id" class="form-label">Client</label>
                        <select name="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                            <option value="">Sélectionnez un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->first_name }} {{ $client->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="device_id" class="form-label">Appareil</label>
                        <select name="device_id" id="device_id" class="form-select @error('device_id') is-invalid @enderror">
                            <option value="">Aucun appareil</option>
                            @foreach($devices as $device)
                                <option value="{{ $device->id }}" {{ old('device_id') == $device->id ? 'selected' : '' }}>
                                    {{ $device->brand }} {{ $device->model }} - {{ $device->client?->first_name }} {{ $device->client?->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('device_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="problem_description" class="form-label">Description du problème</label>
                        <textarea name="problem_description" id="problem_description" rows="4" class="form-control @error('problem_description') is-invalid @enderror" required>{{ old('problem_description') }}</textarea>
                        @error('problem_description') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="received" {{ old('status', 'received') == 'received' ? 'selected' : '' }}>Reçu</option>
                            <option value="diagnosis" {{ old('status') == 'diagnosis' ? 'selected' : '' }}>Diagnostic</option>
                            <option value="waiting_parts" {{ old('status') == 'waiting_parts' ? 'selected' : '' }}>En attente pièces</option>
                            <option value="repairing" {{ old('status') == 'repairing' ? 'selected' : '' }}>En réparation</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                            <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Livré</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                        </select>
                        @error('status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="priority" class="form-label">Priorité</label>
                        <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror" required>
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Faible</option>
                            <option value="medium" {{ old('priority', 'medium') == 'medium' ? 'selected' : '' }}>Moyenne</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Élevée</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgente</option>
                        </select>
                        @error('priority') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="received_at" class="form-label">Date de réception</label>
                        <input type="datetime-local" name="received_at" id="received_at" value="{{ old('received_at', now()->format('Y-m-d\TH:i')) }}" class="form-control @error('received_at') is-invalid @enderror">
                        @error('received_at') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="estimated_completion_at" class="form-label">Date de livraison estimée</label>
                        <input type="datetime-local" name="estimated_completion_at" id="estimated_completion_at" value="{{ old('estimated_completion_at') }}" class="form-control @error('estimated_completion_at') is-invalid @enderror">
                        @error('estimated_completion_at') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="diagnosis" class="form-label">Diagnostic</label>
                        <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control @error('diagnosis') is-invalid @enderror">{{ old('diagnosis') }}</textarea>
                        @error('diagnosis') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes') }}</textarea>
                        @error('notes') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
