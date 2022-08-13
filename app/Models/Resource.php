<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'dated',
        'type',
        'country_id'
    ];

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
