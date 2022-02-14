<?php

namespace App\Console\Commands\Scrapper;

use App\Services\PetrolPricesScrappingService;
use Exception;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BothSiteCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrap:both';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command scraps the data from both sites and updates in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $client = new Client();
            if ($client) {
                $result = PetrolPricesScrappingService::scrapNow($client, 'https://www.globalpetrolprices.com/gasoline_prices/');

                if (count($result['prices']) != count($result['countries'])) {
                    $this->emit('response-toast', $this->errorMessage("Count of Countries and Prices are not equal."));
                    return;
                }
                // store now
                if (PetrolPricesScrappingService::store($result, 'https://www.globalpetrolprices.com/gasoline_prices/'))
                    DB::commit();

                // scrap first
                $result = PetrolPricesScrappingService::scrapNowRates($client, 'https://www.forex.pk/foreign-exchange-rate.htm');

                // store now
                if (PetrolPricesScrappingService::storeRates($result['final'], $result['dated'], 'https://www.forex.pk/foreign-exchange-rate.htm'))
                    DB::commit();

                $this->info('executed successfully.');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $this->info($exception->getMessage());
        }
        return 0;
    }
}
