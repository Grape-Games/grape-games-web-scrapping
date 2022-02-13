<?php

namespace App\Services;

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
}
