<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScrappedData extends Model
{
    use HasFactory;
    protected $table = "scrapped_datas";
    protected $fillable = [
        'country_name',
        'price',
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
     * Get the rate associated with the ScrappedData
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rate(): HasOne
    {
        return $this->hasOne(CurrencyRate::class);
    }
}
