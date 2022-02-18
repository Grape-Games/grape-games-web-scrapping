<?php

namespace App\Http\Livewire\WebScrapping;

use App\Models\CurrencyRate;
use App\Models\ScrappedData;
use Livewire\Component;

class CurrencyModal extends Component
{
    protected $listeners = ['updateMyId'];
    public $currencyId, $toUpdate;

    public function updateMyId($id)
    {
        $this->toUpdate = $id;
    }

    public function finalTouch($value)
    {
        ScrappedData::where('id', $this->toUpdate)->update([
            'currency_rate_id' => $value
        ]);
        $this->emit('toggleModal');
        $this->emit('updateScrappedData');
    }

    public function render()
    {
        return view('livewire.web-scrapping.currency-modal', [
            'currencies' => CurrencyRate::all()
        ]);
    }
}
