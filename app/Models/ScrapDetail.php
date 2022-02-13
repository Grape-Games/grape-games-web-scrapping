<?php

namespace App\Models;

use App\Traits\UUIDTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapDetail extends Model
{
    use HasFactory, UUIDTrait;
    protected $fillable = [
        'url',
        'details',
        'dated'
    ];
}
