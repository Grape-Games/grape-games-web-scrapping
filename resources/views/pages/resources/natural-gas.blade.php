@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">Natural Gas Prices</h5>
            <livewire:triggers.trigger-prices type='natural_gas' />
        </div>
        <div class="card-body">
            @livewire('tables.natural-gas-table')
        </div>
    </div>
@endsection
