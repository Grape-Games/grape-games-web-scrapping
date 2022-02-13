<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUIDTrait
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($imageModel) {               //it is getting a model ie imagemodel ka jo collection add ho rha h 
            if (empty($imageModel->{$imageModel->getKeyName()})) {          //yeh check krta isli key empty tu nhe ..
                $imageModel->{$imageModel->getKeyName()} = Str::uuid()->toString();
            }
        });
    }           //yeh function tb call hota h jab aap k model mai koi entry ho rhi hoti h so woh us k andar ja kr uuid save kr rha h ..it can be done in observer as well

    public function getIncrementing()
    {
        return false;           //because we are using uuid so we set auto incrementing false of the model 
    }

    public function getKeyType()
    {
        return 'string';  //this says k yeh iski primary key as a string save hogui
    }
}
