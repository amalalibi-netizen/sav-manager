@extends('layouts.app')

@section('title', 'Nouvelle intervention')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0">Nouvelle intervention</h1>
            <p class="text-muted mb-0">Créer une intervention de réparation</p>
        </div>
        <a href="{{ route('repairs.index') }}" class="btn btn-outline-secondary">Retour</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="{{ route('repairs.store') }}" method="POST">
                @csrf

                <div class="row g-3">

                    {{-- Ticket --}}
                    <div class="col-md-6">
                        <label for="ticket_id" class="form-label">Ticket</label>
                        <select name="ticket_id" id="ticket_id"
                                class="form-select @error('ticket_id') is-invalid @enderror"
                                required>
                            <option value="">Choisir un ticket</option>

                            @foreach($tickets as $ticket)
                                <option value="{{ $ticket->id }}"
                                    {{ old('ticket_id') == $ticket->id ? 'selected' : '' }}>
                                    {{ $ticket->ticket_number }}
                                    -
                                    {{ $ticket->client?->first_name }}
                                    {{ $ticket->client?->last_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('ticket_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Technicien --}}
                    <div class="col-md-6">
                        <label for="technician_id" class="form-label">Technicien</label>
                        <select name="technician_id" id="technician_id"
                                class="form-select @error('technician_id') is-invalid @enderror"
                                required>
                            <option value="">Choisir un technicien</option>

                            @foreach($technicians as $technician)
                                <option value="{{ $technician->id }}"
                                    {{ old('technician_id') == $technician->id ? 'selected' : '' }}>
                                    {{ $technician->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('technician_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Diagnostic --}}
                    <div class="col-md-12">
                        <label for="diagnosis" class="form-label">Diagnostic</label>
                        <textarea name="diagnosis"
                                  id="diagnosis"
                                  rows="3"
                                  class="form-control @error('diagnosis') is-invalid @enderror"
                                  required>{{ old('diagnosis') }}</textarea>

                        @error('diagnosis')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-md-12">
                        <label for="repair_description" class="form-label">
                            Description de l’intervention
                        </label>

                        <textarea name="repair_description"
                                  id="repair_description"
                                  rows="3"
                                  class="form-control @error('repair_description') is-invalid @enderror"
                                  required>{{ old('repair_description') }}</textarea>

                        @error('repair_description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pièces utilisées --}}
                    <div class="col-md-12">
                        <label for="parts_used" class="form-label">Pièces utilisées</label>

                        <textarea name="parts_used"
                                  id="parts_used"
                                  rows="2"
                                  class="form-control @error('parts_used') is-invalid @enderror">{{ old('parts_used') }}</textarea>

                        @error('parts_used')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Coût main d’œuvre --}}
                    <div class="col-md-4">
                        <label for="labor_cost" class="form-label">
                            Coût main d’œuvre
                        </label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="labor_cost"
                               id="labor_cost"
                               value="{{ old('labor_cost') }}"
                               class="form-control @error('labor_cost') is-invalid @enderror">

                        @error('labor_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Coût pièces --}}
                    <div class="col-md-4">
                        <label for="parts_cost" class="form-label">
                            Coût pièces
                        </label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="parts_cost"
                               id="parts_cost"
                               value="{{ old('parts_cost') }}"
                               class="form-control @error('parts_cost') is-invalid @enderror">

                        @error('parts_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Coût total automatique --}}
                    <div class="col-md-4">
                        <label for="total_cost" class="form-label">
                            Coût total
                        </label>

                        <input type="number"
                               step="0.01"
                               min="0"
                               name="total_cost"
                               id="total_cost"
                               value="{{ old('total_cost') }}"
                               class="form-control @error('total_cost') is-invalid @enderror"
                               readonly>

                        @error('total_cost')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Statut --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label">Statut</label>

                        <select name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>

                            <option value="pending"
                                {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                                En attente
                            </option>

                            <option value="in_progress"
                                {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                En cours
                            </option>

                            <option value="waiting_parts"
                                {{ old('status') === 'waiting_parts' ? 'selected' : '' }}>
                                En attente pièces
                            </option>

                            <option value="completed"
                                {{ old('status') === 'completed' ? 'selected' : '' }}>
                                Terminé
                            </option>

                            <option value="cancelled"
                                {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                                Annulé
                            </option>
                        </select>

                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('repairs.index') }}"
                       class="btn btn-outline-secondary">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Enregistrer
                    </button>
                </div>

            </form>
        </div>
    </div>

    {{-- Calcul automatique du coût total --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const labor = document.getElementById('labor_cost');
            const parts = document.getElementById('parts_cost');
            const total = document.getElementById('total_cost');

            function calculateTotal() {
                const laborCost = parseFloat(labor.value) || 0;
                const partsCost = parseFloat(parts.value) || 0;

                total.value = (laborCost + partsCost).toFixed(2);
            }

            labor.addEventListener('input', calculateTotal);
            parts.addEventListener('input', calculateTotal);

            calculateTotal();
        });
    </script>

@endsection