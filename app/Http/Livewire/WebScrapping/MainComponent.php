<?php

namespace App\Http\Livewire\WebScrapping;

use App\Services\ResourcesService;
use App\Traits\EventDispatchMessages;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class MainComponent extends Component
{
    use EventDispatchMessages, WithPagination;
    public $scrapSites, $toUpdate;

    public function scrapNow()
    {
        try {
            DB::beginTransaction();
            $resources = new ResourcesService();

            if ($resources->execute()) {
                DB::commit();

                $this->emit('response-toast', $this->successMessage("Scrapping and mapping was done successfully. ✅", "✅"));
                $this->emit('dt');
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
