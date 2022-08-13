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
        'code',
        'code3',
        'phone_prefix',
        'gasoline_price',
        'scrap_detail_id',
    ];

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
