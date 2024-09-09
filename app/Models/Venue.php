<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Venue extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'country',
        'city',
        'place',
        'location',
    ];
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }
}
