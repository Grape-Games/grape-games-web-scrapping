<?php

namespace App\Http\Livewire\Tables;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CurrencyRate;

class CurrenciesTable extends DataTableComponent
{
    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Country", "country")
                ->searchable()
                ->sortable(),
            Column::make("Symbol", "symbol")
                ->searchable()
                ->sortable(),
            Column::make("Currency/USD", "units_per_usd")
                ->searchable()
                ->sortable(),
            Column::make("USD/Currency", "usd_per_unit")
                ->searchable()
                ->sortable(),
            Column::make("Dated", "dated"),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function query(): Builder
    {
        return CurrencyRate::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.currencies_table';
    }
}
