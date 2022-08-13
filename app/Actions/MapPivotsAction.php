<?php

namespace App\Actions;

use App\Models\Country;
use App\Models\CurrencyRate;

class MapPivotsAction
{
    public function execute()
    {
        $countries = self::getCountries();
        $rates = self::getExchangeRates();

        $countries->each(function ($country) use ($rates) {
            $record = $rates->where('symbol', $country->currency)->first();

            if (!$record)
                $record = $rates->where('country', 'LIKE', $country->name)->first();

            if ($record) {
                $country->pivot()->updateOrCreate(['currency_rate_id' => $record->id]);
            }
        });
    }

    public function getCountries()
    {
        return Country::all();
    }

    public function getExchangeRates()
    {
        return CurrencyRate::all();
    }
}
