<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SparePartUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'reference_code' => ['sometimes', 'required', 'string', 'max:100', 'unique:spare_parts,reference_code,' . $this->sparePart->id],
            'unit_cost' => ['sometimes', 'required', 'numeric', 'min:0'],
            'quantity_in_stock' => ['sometimes', 'required', 'integer', 'min:0'],
            'minimum_stock' => ['nullable', 'integer', 'min:0'],
            'supplier' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nom',
            'description' => 'description',
            'reference_code' => 'code de référence',
            'unit_cost' => 'prix unitaire',
            'quantity_in_stock' => 'quantité en stock',
            'minimum_stock' => 'stock minimum',
            'supplier' => 'fournisseur',
            'notes' => 'notes',
        ];
    }
}
