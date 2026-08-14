<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeviceUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'type' => ['required', 'string', 'max:100'],
            'brand' => ['required', 'string', 'max:100'],
            'model' => ['required', 'string', 'max:150'],
            'serial_number' => ['nullable', 'string', 'max:150'],
            'purchase_date' => ['nullable', 'date'],
            'warranty_status' => ['nullable', 'in:in_warranty,expired,not_applicable'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'client_id' => 'client',
            'type' => 'type',
            'brand' => 'marque',
            'model' => 'modèle',
            'serial_number' => 'numéro de série',
            'purchase_date' => 'date d’achat',
            'warranty_status' => 'statut de garantie',
            'notes' => 'notes',
        ];
    }
}
