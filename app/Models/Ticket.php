<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'client_id',
        'device_id',
        'problem_description',
        'diagnosis',
        'status',
        'priority',
        'received_at',
        'estimated_completion_at',
        'completed_at',
        'delivered_at',
        'notes',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'estimated_completion_at' => 'datetime',
        'completed_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
