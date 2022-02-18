<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form novalidate>
        <div class="form-group">
            <input wire:model.lazy="url" type="text" class="form-control @error('url') is-invalid @enderror"
                placeholder="https://www.globalpetrolprices.com/gasoline_prices/"
                value="https://www.globalpetrolprices.com/gasoline_prices/">
            @error('url')
                <span class="text-danger"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div wire:loading wire:target="scrapNow">
            <h4 class="text-success mt-2"><strong>Scrapping Now Please wait...</strong>
                <i class="fas fa-sync fa-spin ml-2"></i>
            </h4>
        </div>
        <div class="form-group">
            <button wire:click.prevent="scrapNow" wire:loading.attr="disabled" type="button"
                class="btn btn-primary mt-2">Scrap
                Now</button>
        </div>
    </form>

    @livewire('scrapped-data-table')

    @livewire('web-scrapping.currency-modal')
</div>
@once
    @push('extended-js')
        <script src="{{ asset('js/front/web-scrapping/events.js') }}"></script>
        <script>
            Livewire.on('openModal', () => {
                $(".modal").modal('show');
            });
        </script>
    @endpush
@endonce
