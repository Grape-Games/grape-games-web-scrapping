<?php

namespace App\Http\Livewire\Triggers;

use App\Actions\MapPivotsAction;
use App\Services\CountryService;
use App\Services\ExchangeRateService;
use App\Services\ResourcesService;
use App\Traits\EventDispatchMessages;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class TriggerPrices extends Component
{
    use EventDispatchMessages;

    public function __construct(public string $type, public bool $exchange = false)
    {
    }

    public function scrapNow(
        ResourcesService $resourcesService,
        ExchangeRateService $exchangeService,
        CountryService $countryService,
        MapPivotsAction $action,
    ) {
        try {
            DB::beginTransaction();
            $countryService->populateDatabase();

            if ($this->exchange)
                $exchangeService->execute();
            else
                $resourcesService->execute($this->type);

            $action->execute();
            DB::commit();

            $this->emit('response-toast', $this->successMessage("Scrapping and mapping was done successfully. ✅", "✅"));
            $this->emit('dt');
        } catch (Exception $exception) {
            DB::rollBack();
            $this->emit('response-toast', $this->exceptionMessage($exception));
        }
    }

    public function render()
    {
        return view('livewire.triggers.trigger-prices');
    }
}
