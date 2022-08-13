<?php

namespace App\Http\Livewire\CurrencyRates;

use App\Models\CurrencyRate;
use App\Services\PetrolPricesScrappingService;
use App\Traits\EventDispatchMessages;
use Exception;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MainComponent extends Component
{
    use EventDispatchMessages, WithPagination;
    public $url = 'https://forex.pk/foreign-exchange-rate.htm';

    public function scrapNow()
    {
        try {
            DB::beginTransaction();
            $client = new Client();
            if ($client) {
                $this->emit('response-toast', $this->successMessage("Successfully created a client to the url.", "✅"));

                // scrap first
                $result = PetrolPricesScrappingService::scrapNowRates($client, $this->url);

                // store now
                if (PetrolPricesScrappingService::storeRates($result['final'], $result['dated'], $this->url))
                    DB::commit();

                $this->emit('response-toast', $this->successMessage("Scrapping was done successfully ✅", "✅"));
                $this->emit('updateCurrenciesTable');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $this->emit('response-toast', $this->exceptionMessage($exception));
        }
    }

    public function render()
    {
        return view('livewire.currency-rates.main-component', [
            'datas' => CurrencyRate::paginate(10)
        ]);
    }
}
