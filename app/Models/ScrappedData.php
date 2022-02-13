<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScrappedData extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_name',
        'price',
        'scrap_detail_id'
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
}
