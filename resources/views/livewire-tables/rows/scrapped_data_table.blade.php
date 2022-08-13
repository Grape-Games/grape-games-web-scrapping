<x-livewire-tables::bs5.table.cell>
    {{ $row->country_name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->gasoline_price }}
</x-livewire-tables::bs5.table.cell>


<x-livewire-tables::bs5.table.cell>
    @isset($row->rate)
        {{ $row->rate->units_per_usd }} {{ $row->rate->symbol }}
        <button wire:click="emitUpdateEvent('{{ $row->id }}')" wire:loading.attr="disabled" wire:loading.remove
            type="button" class="bx-flashing badge badge-info ml-2"><i class="fas fa-edit"></i>
        </button>
        <div class="bx-flashing badge badge-info ml-2" wire:loading wire:target="emitUpdateEvent('{{ $row->id }}')">
            Loading Please wait...
        </div>
    @else
        <button wire:click="emitUpdateEvent('{{ $row->id }}')" wire:loading.attr="disabled" wire:loading.remove
            type="button" class="bx-flashing badge badge-danger ml-2"><i class="fas fa-plus"></i>
        </button>
        <div class="bx-flashing badge badge-info ml-2" wire:loading wire:target="emitUpdateEvent('{{ $row->id }}')">
            Loading Please wait...
        </div>
    @endisset
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->info->details }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->info->dated }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->info->url }}
</x-livewire-tables::bs5.table.cell>
