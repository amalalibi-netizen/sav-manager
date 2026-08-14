<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'type',
        'brand',
        'model',
        'serial_number',
        'purchase_date',
        'warranty_status',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'client_id' => 'integer',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
