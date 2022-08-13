<?php

namespace App\Http\Livewire\CurrencyRates;

use App\Models\CurrencyRate;
use App\Services\ExchangeRateService;
use App\Services\ScrappingService;
use App\Traits\EventDispatchMessages;
use Exception;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MainComponent extends Component
{
    use EventDispatchMessages, WithPagination;

    public function scrapNow(ExchangeRateService $exchangeService)
    {
        try {
            DB::beginTransaction();

            if ($exchangeService->execute()) {
                DB::commit();
                $this->emit('response-toast', $this->successMessage("Scrapping was done successfully ✅", "✅"));
                $this->emit('dt');
            }

            $this->emit('response-toast', $this->errorMessage("Failed to scrap exchange rates."));
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
