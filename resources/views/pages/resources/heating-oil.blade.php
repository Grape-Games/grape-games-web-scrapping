@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">Heating Oil Prices</h5>
            <livewire:triggers.trigger-prices type='heating_oil' />
        </div>
        <div class="card-body">
            @livewire('tables.heating-oil-table')
        </div>
    </div>
@endsection

