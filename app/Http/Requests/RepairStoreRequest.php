<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'exists:tickets,id'],
            'technician_id' => ['required', 'exists:technicians,id'],
            'diagnosis' => ['required', 'string'],
            'repair_description' => ['required', 'string'],
            'parts_used' => ['nullable', 'string'],
            'labor_cost' => ['nullable', 'numeric'],
            'parts_cost' => ['nullable', 'numeric'],
            'total_cost' => ['nullable', 'numeric'],
            'status' => ['required', 'in:pending,in_progress,completed,waiting_parts,cancelled'],
        ];
    }

    public function attributes(): array
    {
        return [
            'ticket_id' => 'ticket',
            'technician_id' => 'technicien',
            'diagnosis' => 'diagnostic',
            'repair_description' => 'description de l’intervention',
            'parts_used' => 'pièces utilisées',
            'labor_cost' => 'coût de main d’œuvre',
            'parts_cost' => 'coût des pièces',
            'total_cost' => 'coût total',
            'status' => 'statut',
        ];
    }
}
