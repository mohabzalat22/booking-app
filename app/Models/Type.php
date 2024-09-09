<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Type extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'type',
    ];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function quantity(): HasOne
    {
        return $this->hasOne(Quantity::class);
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class);
    }
}
