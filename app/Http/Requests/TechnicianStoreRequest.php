<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', 'unique:technicians,email'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'phone' => 'téléphone',
            'email' => 'email',
        ];
    }
}
