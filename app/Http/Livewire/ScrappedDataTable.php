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
            Column::make("Price ( USD )", "price")
                ->searchable()
                ->sortable(),
            Column::make("Conversion Rate", "rate.units_per_usd")
                ->searchable()
                ->sortable(),
            Column::make("Type", "info.details")
                ->searchable()
                ->sortable(),
            Column::make("Dated", "info.dated")
                ->sortable(),
            Column::make("URL", "info.url")
                ->sortable(),

        ];
    }

    public function query(): Builder
    {
        return ScrappedData::query();
    }

    public function rowView(): string
    {
        // Becomes /resources/views/location/to/my/row.blade.php
        return 'livewire-tables.rows.scrapped_data_table';
    }
}
