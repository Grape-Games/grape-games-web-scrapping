<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScrappedData extends Model
{
    use HasFactory;
    protected $table = "scrapped_datas";

    protected $fillable = [
        'country_name',
        'price',
        'currency_rate_id',
        'scrap_detail_id',
    ];

    /**
     * Get the details that owns the ScrappedData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info(): BelongsTo
    {
        return $this->belongsTo(ScrapDetail::class, 'scrap_detail_id', 'id');
    }

    /**
     * Get the rate that owns the ScrappedData
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate(): BelongsTo
    {
        return $this->belongsTo(CurrencyRate::class, 'currency_rate_id', 'id');
    }
}
