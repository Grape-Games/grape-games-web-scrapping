@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">Diesel Prices</h5>
            <livewire:triggers.trigger-prices type='diesel' />
        </div>
        <div class="card-body">
            @livewire('tables.diesel-table')
        </div>
    </div>
@endsection

