<div>
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Set The Countries Currency
                        {{ $toUpdate ?? 'Not Set' }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div wire:ignore class="form-group mb-1 col-12">
                        <select class="form-select select2" id="currencies" data-placeholder="Please select a value">
                            <option value=""></option>
                            @forelse ($currencies as $currency)
                                <option value="{{ $currency->id }}">
                                    {{ $currency->country . ' ' . $currency->symbol . ' ' . $currency->units_per_usd }}
                                </option>
                            @empty
                                <option value="">No options available</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('extended-js')
    <script>
        $(document).ready(function() {
            $('#currencies').select2({
                placeholder: $(this).data('placeholder'),
                dropdownAutoWidth: true,
                width: '100%',
            });
            $("#currencies").change(function(e) {
                e.preventDefault();
                @this.finalTouch(e.target.value)

            });
            Livewire.on('toggleModal', () => {
                $(".modal").modal('hide');
                Livewire.emit('mainTableUpdate');
            })
        });
    </script>
@endpush
