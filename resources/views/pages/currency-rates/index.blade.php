@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">Exchange Rates</h5>
            <livewire:triggers.trigger-prices type='prices' exchange=true />
        </div>
        <div class="card-body">
            @livewire('tables.currencies-table')
        </div>
    </div>
@endsection
