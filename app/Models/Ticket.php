<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date_time',
        'country',
        'city',
        'place',
        'price',
        'image',
        'discount',
        'tax',
        'reserved_bool'
    ];

    public function reservation(): BelongsTo
    {
        return $this->belongsTo(Reservation::class);
    }

}