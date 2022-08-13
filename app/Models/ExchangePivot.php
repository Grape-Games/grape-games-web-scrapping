<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExchangePivot extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'currency_rate_id'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function exchange(): BelongsTo
    {
        return $this->belongsTo(CurrencyRate::class, 'currency_rate_id', 'id');
    }
}
