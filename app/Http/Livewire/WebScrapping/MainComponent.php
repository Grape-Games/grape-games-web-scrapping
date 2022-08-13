<?php

namespace App\Http\Livewire\WebScrapping;

use App\Models\ScrappedData;
use App\Services\PetrolPricesScrappingService;
use App\Traits\EventDispatchMessages;
use Exception;
use Livewire\Component;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;
use Symfony\Component\HttpClient\HttpClient;

class MainComponent extends Component
{
    use EventDispatchMessages, WithPagination;
    public $url = 'https://globalpetrolprices.com/gasoline_prices/', $toUpdate;

    public function scrapNow()
    {
        try {
            DB::beginTransaction();
            $client = new Client(HttpClient::create(['verify_peer' => false]));
            if ($client) {
                // scrap first
                $result = PetrolPricesScrappingService::scrapNow($client, $this->url);

                if (count($result['prices']) != count($result['countries'])) {
                    $this->emit('response-toast', $this->errorMessage("Count of countries and prices is not equal."));
                    return;
                }
                // store now
                if (PetrolPricesScrappingService::store($result, $this->url))
                    DB::commit();

                $this->emit('response-toast', $this->successMessage("Scrapping and mapping was done successfully. ✅", "✅"));
                $this->emit('updateScrappedData');
            } else {
                DB::rollBack();
                throw ValidationException::withMessages(['URL' => 'Failed to set up the crawler. 😞']);
            }
        } catch (Exception $exception) {
            DB::rollBack();
            $this->emit('response-toast', $this->exceptionMessage($exception));
        }
    }

    public function render()
    {
        return view('livewire.web-scrapping.main-component');
    }
}
