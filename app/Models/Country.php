<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'code3',
        'currency',
        'phone_prefix',
    ];

    public function pivot()
    {
        return $this->hasOne(ExchangePivot::class, 'country_id', 'id');
    }
}
