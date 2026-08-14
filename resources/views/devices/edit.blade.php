@extends('layouts.app')

@section('title', 'Modifier appareil')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Modifier l'appareil</h1>
            <p class="text-muted mb-0">{{ $device->brand }} {{ $device->model }}</p>
        </div>
        <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    @include('partials.flash')

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('devices.update', $device) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="client_id" class="form-label">Client</label>
                        <select name="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror" required>
                            <option value="">Sélectionnez un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id', $device->client_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->first_name }} {{ $client->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('client_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" id="type" value="{{ old('type', $device->type) }}" class="form-control @error('type') is-invalid @enderror" required>
                        @error('type') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Marque</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand', $device->brand) }}" class="form-control @error('brand') is-invalid @enderror" required>
                        @error('brand') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label">Modèle</label>
                        <input type="text" name="model" id="model" value="{{ old('model', $device->model) }}" class="form-control @error('model') is-invalid @enderror" required>
                        @error('model') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="serial_number" class="form-label">Numéro de série</label>
                        <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $device->serial_number) }}" class="form-control @error('serial_number') is-invalid @enderror">
                        @error('serial_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="purchase_date" class="form-label">Date d’achat</label>
                        <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date', $device->purchase_date?->format('Y-m-d')) }}" class="form-control @error('purchase_date') is-invalid @enderror">
                        @error('purchase_date') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="warranty_status" class="form-label">Statut garantie</label>
                        <select name="warranty_status" id="warranty_status" class="form-select @error('warranty_status') is-invalid @enderror">
                            <option value="not_applicable" {{ old('warranty_status', $device->warranty_status) == 'not_applicable' ? 'selected' : '' }}>Non applicable</option>
                            <option value="in_warranty" {{ old('warranty_status', $device->warranty_status) == 'in_warranty' ? 'selected' : '' }}>Sous garantie</option>
                            <option value="expired" {{ old('warranty_status', $device->warranty_status) == 'expired' ? 'selected' : '' }}>Garantie expirée</option>
                        </select>
                        @error('warranty_status') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $device->notes) }}</textarea>
                        @error('notes') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('devices.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
@endsection
