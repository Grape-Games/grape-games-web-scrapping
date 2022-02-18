<?php

namespace App\Http\Livewire;

use App\Models\CurrencyRate;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class CurrenciesTable extends DataTableComponent
{
    protected $listeners = ['updateCurrenciesTable' => '$refresh'];
    public function columns(): array
    {
        return [
            Column::make('Country Name', 'country')
                ->sortable()
                ->searchable(),
            Column::make('Symbol', 'symbol')
                ->sortable()
                ->searchable(),
            Column::make('Units Per USD', 'units_per_usd')
                ->sortable()
                ->searchable(),
            Column::make('USD per unit', 'usd_per_unit')
                ->sortable()
                ->searchable(),
            Column::make('Dated', 'dated')
                ->sortable()
                ->searchable(),
            Column::make('Website', 'url')
                ->sortable()
                ->searchable(),
        ];
    }
    public function query(): Builder
    {
        return CurrencyRate::query();
    }
}
