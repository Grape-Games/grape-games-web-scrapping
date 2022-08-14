<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Country;
use App\Models\ExchangePivot;
use App\Models\Resource;
use App\Models\User;
use Livewire\Component;

class IndexComponent extends Component
{
    public $statistics, $availableColors = ['bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-secondary'];

    public function mount()
    {
        $this->statistics['users'] = User::count();
        $this->statistics['countries'] = Country::count();
        $this->statistics['conversions'] = ExchangePivot::count();
        $this->statistics['prices'] = Resource::count();
    }

    public function render()
    {
        return view('livewire.dashboard.index-component');
    }
}
