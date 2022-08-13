<?php

namespace App\Services;

use App\Models\CurrencyRate;
use App\Traits\CustomStringTrait;
use Goutte\Client;

class ScrappingService
{
    use CustomStringTrait;

    public static function scrapNow(Client $client, $url)
    {
        $crawler = $client->request('GET', $url);
        $dated = $crawler->filter('#titleGraphic')->each(function ($node) {
            return $node->text();
        });
        $countries = $crawler->filter('.graph_outside_link')->each(function ($node) {
            $str = trim(html_entity_decode($node->text()), " \t\n\r\0\x0B\xC2\xA0");
            return str_replace("*", '', $str);
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
}
