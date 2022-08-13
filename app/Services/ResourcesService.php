<?php

namespace App\Services;

use App\Models\Country;
use App\Models\Resource;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class ResourcesService
{
    protected $scrapSites;

    public function __construct()
    {
        $this->scrapSites['gasoline'] = 'https://globalpetrolprices.com/gasoline_prices/';
        $this->scrapSites['diesel'] = 'https://www.globalpetrolprices.com/diesel_prices/';
        $this->scrapSites['lpg'] = 'https://www.globalpetrolprices.com/lpg_prices/';
        $this->scrapSites['electricity'] = 'https://www.globalpetrolprices.com/electricity_prices/';
        $this->scrapSites['natural_gas'] = 'https://www.globalpetrolprices.com/natural_gas_prices/';
        $this->scrapSites['kerosene_oil'] = 'https://www.globalpetrolprices.com/kerosene_prices/';
        $this->scrapSites['heating_oil'] = 'https://www.globalpetrolprices.com/heating_oil_prices/';
    }

    public function execute($type = 'no')
    {
        $resultant = [];

        $client = new Client(HttpClient::create(['verify_peer' => false]));
        if ($client) {
            // scrap first
            if ($type == 'default')
                foreach ($this->scrapSites as $key => $url)
                    $resultant[$key] = ScrappingService::scrapNow($client, $url);
            else
                $resultant[$type] = ScrappingService::scrapNow($client, $this->scrapSites[$type]);

            // store now
            return self::store($resultant, $this->scrapSites);
        }
        return false;
    }

    public static function store(array $sitesData, array $sites)
    {
        $dbCountries = Country::all();

        foreach ($sitesData as $type => $siteData) {

            // inserting only if prices and countries are equal in number
            if (count($siteData['countries']) == count($siteData['prices'])) {
                $countries = $siteData['countries'];
                $prices = $siteData['prices'];

                foreach ($countries as $key => $country) {
                    $record = $dbCountries->where('name', $country)->first();

                    if ($record)
                        Resource::updateOrCreate([
                            'country_id' => $record->id,
                            'type' => $type
                        ], [
                            'url' => $sites[$type],
                            'price' => $prices[$key],
                            'dated' => $siteData['dated'][0]
                        ]);
                }
            }
        }
        return true;
    }
}
