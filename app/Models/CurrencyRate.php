<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'country',
        'symbol',
        'units_per_usd',
        'usd_per_unit',
        'dated'
    ];
}
