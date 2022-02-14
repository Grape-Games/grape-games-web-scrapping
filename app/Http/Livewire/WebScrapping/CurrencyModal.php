<?php

namespace App\Http\Livewire\WebScrapping;

use App\Models\CurrencyRate;
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
        CurrencyRate::where('id', $value)->update([
            'scrapped_data_id' => $this->toUpdate
        ]);
        $this->emit('toggleModal');
    }

    public function render()
    {
        return view('livewire.web-scrapping.currency-modal', [
            'currencies' => CurrencyRate::all()
        ]);
    }
}
