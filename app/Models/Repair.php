<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Repair extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'technician_id',
        'diagnosis',
        'repair_description',
        'parts_used',
        'labor_cost',
        'parts_cost',
        'total_cost',
        'status',
    ];

    protected $casts = [
        'labor_cost' => 'decimal:2',
        'parts_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function technician(): BelongsTo
    {
        return $this->belongsTo(Technician::class);
    }
}
