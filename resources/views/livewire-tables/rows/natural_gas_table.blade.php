<x-livewire-tables::bs5.table.cell>
    <p>{{ $row->price }} USD</p>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->country->name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->dated }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->updated_at->diffForHumans() }}
</x-livewire-tables::bs5.table.cell>
