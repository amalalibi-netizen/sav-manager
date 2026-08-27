<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'device_id' => ['nullable', 'exists:devices,id'],
            'problem_description' => ['required', 'string'],
            
            'status' => ['required', 'in:received,diagnosis,waiting_parts,repairing,completed,delivered,cancelled'],
            'priority' => ['required', 'in:low,medium,high,urgent'],
            'received_at' => ['nullable', 'date'],
            'estimated_completion_at' => ['nullable', 'date'],
            'completed_at' => ['nullable', 'date'],
            'delivered_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'client_id' => 'client',
            'device_id' => 'appareil',
            'problem_description' => 'description du problème',
        
            'status' => 'statut',
            'priority' => 'priorité',
            'received_at' => 'date de réception',
            'estimated_completion_at' => 'date de livraison estimée',
            'completed_at' => 'date de fin',
            'delivered_at' => 'date de livraison',
            'notes' => 'notes',
        ];
    }
}
