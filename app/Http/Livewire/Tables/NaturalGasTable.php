<?php

namespace App\Http\Livewire\Tables;

use App\Models\Resource;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class NaturalGasTable extends DataTableComponent
{

    protected $listeners = ['dt' => '$refresh'];

    public function columns(): array
    {
        return [
            Column::make("Price", "price")
                ->searchable()
                ->sortable(),
            Column::make("Country", "country.name")
                ->searchable()
                ->sortable(),
            Column::make("Dated", "dated"),
            Column::make("Last Updated", "updated_at")
                ->sortable(),
        ];
    }
    public function query(): Builder
    {
        return Resource::query()->type('natural_gas');
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.natural_gas_table';
    }
}
