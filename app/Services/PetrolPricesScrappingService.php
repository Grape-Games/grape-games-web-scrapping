<?php

namespace App\Services;

use App\Models\CurrencyRate;
use App\Models\ScrapDetail;
use App\Models\ScrappedData;
use App\Traits\CustomStringTrait;
use Carbon\Carbon;
use Goutte\Client;

class PetrolPricesScrappingService
{
    use CustomStringTrait;
    public static function scrapNow(Client $client, $url)
    {
        $crawler = $client->request('GET', $url);
        $dated = $crawler->filter('#titleGraphic')->each(function ($node) {
            return $node->text();
        });
        $countries = $crawler->filter('.graph_outside_link')->each(function ($node) {
            return $node->text();
        });
        $prices = $crawler->filter('#graphic')->each(function ($node) {
            return $node->text();
        });
        $explodedPrices = explode(' ', $prices[0]);

        // removing the last extra index
        unset($explodedPrices[count($explodedPrices) - 1]);

        return [
            'dated' => $dated,
            'countries' => $countries,
            'prices' => $explodedPrices
        ];
    }

    public static function scrapNowRates(Client $client, $url)
    {
        $final = []; // contains all currencies along filtered data

        $crawler = $client->request('GET', $url);
        $content = $crawler->filter('td')->eq(1)->text(); // getting the string to act upon
        $replaceContent = str_replace("\xc2\xa0", ' ', $content);
        $dated = $crawler->filter('.blueboldtext')->text(); // getting the date
        $topCurrencies = self::get_string_between($replaceContent, 'USD per Unit  ', '(adsbygoogle');
        $otherCurrencies = self::get_string_between(
            $replaceContent,
            'Other Currencies Currency Symbol Units per USD USD per Unit  ',
            'Inter Bank Rates'
        );

        $explodedTop10 = explode('    ', $topCurrencies); // getting the value on each index
        array_splice($explodedTop10, 0, 1);
        array_splice($explodedTop10, count($explodedTop10) - 1, 1);

        foreach ($explodedTop10 as $value) {
            $temp = preg_split('/(?=\d)/', $value, 2);
            $symbol = substr(trim($temp[0]), -3);
            $country = substr($temp[0], 0, -5);
            $prices = explode(' ', $temp[1]);
            array_push($final, [
                'symbol' => $symbol,
                'country' => $country,
                'units_per_usd' => $prices[0],
                'usd_per_unit' => $prices[1],
            ]);
        }

        $explodedOther = explode('    ', $otherCurrencies);
        array_splice($explodedOther, 0, 1);

        foreach ($explodedOther as $value) {
            $temp = preg_split('/(?=\d)/', $value, 2);
            $symbol = substr(trim($temp[0]), -3);
            $country = substr($temp[0], 0, -5);
            $prices = explode(' ', $temp[1]);
            array_push($final, [
                'symbol' => $symbol,
                'country' => $country,
                'units_per_usd' => $prices[0],
                'usd_per_unit' => $prices[1],
            ]);
        }

        return [
            'dated' => $dated,
            'final' => $final,
        ];
    }

    public static function store(array $data, $url)
    {
        $date = trim(self::get_string_between($data['dated'][0], ",", "("));
        $create = ScrapDetail::firstOrCreate([
            'details' => $data['dated'][0],
            'dated' => Carbon::parse($date)->format('Y-m-d'),
            'url' => $url,
        ]);

        foreach ($data['countries'] as $key => $country) {
            ScrappedData::updateOrCreate([
                'country_name' => $country,
                'price' => $data['prices'][$key],
                'scrap_detail_id' => $create->id
            ]);
        }
        return true;
    }

    public static function storeRates(array $currencies, $dated, $url)
    {
        foreach ($currencies as $currency) {
            CurrencyRate::updateOrCreate([
                'country' => $currency['country'],
                'symbol' => $currency['symbol'],
                'units_per_usd' => $currency['units_per_usd'],
                'usd_per_unit' => $currency['usd_per_unit'],
                'dated' => $dated
            ]);
        }
        return true;
    }
}
