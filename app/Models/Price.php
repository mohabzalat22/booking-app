<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'price',
        'discount',
        'tax',
    ];
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
