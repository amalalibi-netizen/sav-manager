<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepairUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_id' => ['sometimes', 'required', 'exists:tickets,id'],
            'technician_id' => ['sometimes', 'required', 'exists:technicians,id'],
            'diagnosis' => ['sometimes', 'required', 'string'],
            'repair_description' => ['sometimes', 'required', 'string'],
            'parts_used' => ['nullable', 'string'],
            'labor_cost' => ['nullable', 'numeric'],
            'parts_cost' => ['nullable', 'numeric'],
            'total_cost' => ['nullable', 'numeric'],
            'status' => ['sometimes', 'required', 'in:pending,in_progress,completed,waiting_parts,cancelled'],
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
