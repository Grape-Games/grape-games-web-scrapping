@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">Kerosene Oil Prices</h5>
            <livewire:triggers.trigger-prices type='kerosene_oil' />
        </div>
        <div class="card-body">
            @livewire('tables.kerosene-oil-table')
        </div>
    </div>
@endsection

