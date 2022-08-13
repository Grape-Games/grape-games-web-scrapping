<div>

    <button wire:click.prevent="scrapNow" wire:loading.attr="disabled" type="submit" class="btn btn-primary">
        <span wire:loading.remove wire:target="scrapNow">Start Scrapping</span>
        <span class="d-none" wire:loading.class.remove="d-none" wire:target="scrapNow">
            Scrapping...
            <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status" aria-hidden="true">
            </span>
        </span>
    </button>

    <div class="mt-4">
        @livewire('tables.resources-table')
    </div>

    @livewire('web-scrapping.currency-modal')
</div>

@push('extended-js')
    <script>
        Livewire.on('openModal', () => {
            $(".modal").modal('show');
        });
    </script>
@endpush
