<?php

namespace App\Console\Commands\Scrapper;

use App\Actions\MapPivotsAction;
use App\Services\CountryService;
use App\Services\ExchangeRateService;
use App\Services\ResourcesService;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
    protected $description = 'This command scraps the data from forex and global prices sites and updates in the database.';

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
    public function handle(
        ResourcesService $resourcesService,
        ExchangeRateService $exchangeService,
        CountryService $countryService,
        MapPivotsAction $action,
    ) {
        try {
            $countryService->populateDatabase();
            $exchangeService->execute();
            $resourcesService->execute();
            $action->execute();

            $this->info('Refreshed site data successfully.');
        } catch (Exception $exception) {
            $this->info($exception->getMessage());
            Log::info("Cron job failure : " . $exception->getMessage());
        }
        return 0;
    }
}
