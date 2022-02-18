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

class MainComponent extends Component
{
    use EventDispatchMessages, WithPagination;
    public $url, $toUpdate;

    protected $rules = [
        'url' => 'required|url',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function scrapNow()
    {
        $this->validate();
        try {
            DB::beginTransaction();
            $client = new Client();
            if ($client) {
                $this->emit('response-toast', $this->successMessage("Successfully created a client to the url.", "✅"));

                // scrap first
                $result = PetrolPricesScrappingService::scrapNow($client, $this->url);

                if (count($result['prices']) != count($result['countries'])) {
                    $this->emit('response-toast', $this->errorMessage("Count of Countries and Prices are not equal."));
                    return;
                }
                // store now
                if (PetrolPricesScrappingService::store($result, $this->url))
                    DB::commit();

                $this->emit('response-toast', $this->successMessage("Scrapping was done successfully ✅", "✅"));
                $this->emit('updateScrappedData');
            } else {
                DB::rollBack();
                throw ValidationException::withMessages(['URL' => 'Failed to set up the Goutte Client. 😞']);
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
