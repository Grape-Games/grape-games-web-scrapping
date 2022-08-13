<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Currency Exchange') }}
        </h2>
        <livewire:triggers.trigger-prices type='prices' exchange=true />
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @livewire('tables.currencies-table')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
