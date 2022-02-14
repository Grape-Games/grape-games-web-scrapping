<div>
    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <form wire:submit.prevent="scrapNow">
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
            <button type="submit" class="btn btn-primary mt-2">Scrap Now</button>
        </div>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Country Name</th>
                <th scope="col">Price ( USD )</th>
                <th scope="col">Conversion Rate</th>
                <th scope="col">Type</th>
                <th scope="col">Dated</th>
                <th scope="col">URL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datas as $data)
                <tr>
                    <td>{{ $data->country_name }}</td>
                    <td>{{ $data->price }} $</td>
                    <td>
                        @isset($data->rate)
                            {{ $data->rate->units_per_usd }}
                        @else
                            <button wire:click="emitUpdateEvent('{{ $data->id }}')" type="button"
                                class="bx-flashing badge badge-danger" data-toggle="modal"
                                data-target="#exampleModalCenter">Click To Set Now</button>
                        @endisset
                    </td>
                    <td>{{ $data->info->details }}</td>
                    <td>{{ $data->info->dated }}</td>
                    <td>{{ $data->info->url }}</td>
                </tr>
            @empty
                <td class="text-center text-danger" colspan="6">No records found.</td>
            @endforelse
        </tbody>
    </table>
    {{ $datas->links() }}

    @livewire('web-scrapping.currency-modal')
</div>
@once
    @push('extended-js')
        <script src="{{ asset('js/front/web-scrapping/events.js') }}"></script>
    @endpush
@endonce
