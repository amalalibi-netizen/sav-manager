<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnicianUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255', 'unique:technicians,email,' . $this->technician->id],
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
