<x-livewire-tables::bs5.table.cell>
    {{ $row->country_name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->code ?? '-' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->code3 ?? '-' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->phone_prefix ?? '-' }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <p>{{ $row->gasoline_price }} USD</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    @isset($row->rate)
        <p>{{ $row->rate->units_per_usd }} {{ $row->rate->symbol }}</p>
    @else
        <p class="text-danger">UN-MAPPED</p>
    @endisset
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <button wire:click.prevent="emitUpdateEvent('{{ $row->id }}')" wire:loading.attr="disabled"
        class="badge @isset($row->rate) bg-info @else bg-danger @endisset">
        <span wire:loading.remove wire:target="emitUpdateEvent('{{ $row->id }}')">
            <i class="fas @isset($row->rate) fa-edit @else fa-plus @endisset"></i>
        </span>
        <span class="d-none" wire:loading.class.remove="d-none" wire:target="emitUpdateEvent('{{ $row->id }}')">
            <span class="spinner-border spinner-border-sm btn-spinner"></span>
        </span>
    </button>
</x-livewire-tables::bs5.table.cell>
