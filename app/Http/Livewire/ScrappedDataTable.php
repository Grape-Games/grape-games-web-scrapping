<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ScrappedData;

class ScrappedDataTable extends DataTableComponent
{

    protected $listeners = [
        'updateScrappedData' => '$refresh',
    ];


    public function emitUpdateEvent($id)
    {
        $this->emit('updateMyId', $id);
        $this->emit('openModal');
    }

    public function columns(): array
    {
        return [
            Column::make("Country name", "country_name")
                ->searchable()
                ->sortable(),
            Column::make("Code", "code")
                ->searchable()
                ->sortable(),
            Column::make("Code3", "code3")
                ->searchable()
                ->sortable(),
            Column::make("Phone Prefix", "phone_prefix")
                ->searchable()
                ->sortable(),
            Column::make("Gasoline", "gasoline_price")
                ->searchable()
                ->sortable(),
            Column::make("Conversion Rate", "rate.units_per_usd")
                ->searchable()
                ->sortable(),
            Column::make("Type", "info.details")
                ->searchable()
                ->sortable(),

        ];
    }

    public function query(): Builder
    {
        return ScrappedData::query();
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.scrapped_data_table';
    }
}
