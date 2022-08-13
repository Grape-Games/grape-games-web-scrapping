<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form novalidate>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="https://www.forex.pk/foreign-exchange-rate.htm"
                disabled>
        </div>
        <button wire:click.prevent="scrapNow" wire:loading.attr="disabled" type="submit" class="btn btn-primary mt-4">
            <span wire:loading.remove wire:target="scrapNow">Start Scrapping</span>
            <span class="d-none" wire:loading.class.remove="d-none" wire:target="scrapNow">
                Scrapping...
                <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status" aria-hidden="true">
                </span>
            </span>
        </button>
    </form>

    <div class="mt-4">
        @livewire('currencies-table')
    </div>
</div>

@push('extended-js')
    <script src="{{ asset('js/front/web-scrapping/events.js') }}"></script>
@endpush
