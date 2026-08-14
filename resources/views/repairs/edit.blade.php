@extends('layouts.app')

@section('title', 'Modifier l’intervention')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Modifier l’intervention</h1>
            <p class="text-muted mb-0">Mettre à jour les informations de réparation</p>
        </div>
        <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('repairs.update', $repair) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="ticket_id" class="form-label">Ticket</label>
                        <select name="ticket_id" id="ticket_id" class="form-select @error('ticket_id') is-invalid @enderror" required>
                            <option value="">Choisir un ticket</option>
                            @foreach($tickets as $ticket)
                                <option value="{{ $ticket->id }}" {{ old('ticket_id', $repair->ticket_id) == $ticket->id ? 'selected' : '' }}>
                                    {{ $ticket->ticket_number }} - {{ $ticket->client?->first_name }} {{ $ticket->client?->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('ticket_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="technician_id" class="form-label">Technicien</label>
                        <select name="technician_id" id="technician_id" class="form-select @error('technician_id') is-invalid @enderror" required>
                            <option value="">Choisir un technicien</option>
                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}" {{ old('technician_id', $repair->technician_id) == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('technician_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="diagnosis" class="form-label">Diagnostic</label>
                        <textarea name="diagnosis" id="diagnosis" rows="3" class="form-control @error('diagnosis') is-invalid @enderror" required>{{ old('diagnosis', $repair->diagnosis) }}</textarea>
                        @error('diagnosis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="repair_description" class="form-label">Description de l’intervention</label>
                        <textarea name="repair_description" id="repair_description" rows="3" class="form-control @error('repair_description') is-invalid @enderror" required>{{ old('repair_description', $repair->repair_description) }}</textarea>
                        @error('repair_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label for="parts_used" class="form-label">Pièces utilisées</label>
                        <textarea name="parts_used" id="parts_used" rows="2" class="form-control @error('parts_used') is-invalid @enderror">{{ old('parts_used', $repair->parts_used) }}</textarea>
                        @error('parts_used')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="labor_cost" class="form-label">Coût main d’œuvre</label>
                        <input type="number" step="0.01" name="labor_cost" id="labor_cost" value="{{ old('labor_cost', $repair->labor_cost) }}" class="form-control @error('labor_cost') is-invalid @enderror">
                        @error('labor_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="parts_cost" class="form-label">Coût pièces</label>
                        <input type="number" step="0.01" name="parts_cost" id="parts_cost" value="{{ old('parts_cost', $repair->parts_cost) }}" class="form-control @error('parts_cost') is-invalid @enderror">
                        @error('parts_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="total_cost" class="form-label">Coût total</label>
                        <input type="number" step="0.01" name="total_cost" id="total_cost" value="{{ old('total_cost', $repair->total_cost) }}" class="form-control @error('total_cost') is-invalid @enderror">
                        @error('total_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="status" class="form-label">Statut</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', $repair->status) === 'pending' ? 'selected' : '' }}>En attente</option>
                            <option value="in_progress" {{ old('status', $repair->status) === 'in_progress' ? 'selected' : '' }}>En cours</option>
                            <option value="waiting_parts" {{ old('status', $repair->status) === 'waiting_parts' ? 'selected' : '' }}>En attente pièces</option>
                            <option value="completed" {{ old('status', $repair->status) === 'completed' ? 'selected' : '' }}>Terminé</option>
                            <option value="cancelled" {{ old('status', $repair->status) === 'cancelled' ? 'selected' : '' }}>Annulé</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Annuler</a>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
