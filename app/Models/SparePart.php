<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'reference_code',
        'unit_cost',
        'quantity_in_stock',
        'minimum_stock',
        'supplier',
        'notes',
    ];

    protected $casts = [
        'unit_cost' => 'decimal:2',
    ];
}
