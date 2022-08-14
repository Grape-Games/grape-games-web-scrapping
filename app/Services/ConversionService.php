<?php

namespace App\Services;

use App\Models\Country;
use App\Models\CurrencyRate;
use Illuminate\Validation\ValidationException;

class ConversionService
{
    public function convert($from, $to, $amount): array
    {
        $fromModel = CurrencyRate::whereSymbol($from)->first();
        $toModel = CurrencyRate::whereSymbol($to)->first();

        return [
            'amount' => "$amount $from",
            'result' => round((($fromModel->usd_per_unit * $toModel->units_per_usd) * $amount), 4) . " $to",
            'updated' => $fromModel->updated_at->format('Y-m-d h:i:s A')
        ];
    }

    public function getCountryCurrencyCode(string $countryName): string
    {
        $country = Country::where('name', 'LIKE', "%$countryName%")->with('pivot')->first();

        if ($country)
            return $country->currency;

        throw ValidationException::withMessages([
            'message' => ['Conversion does not exists.'],
        ]);
    }
}
