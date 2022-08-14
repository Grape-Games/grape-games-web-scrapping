@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header border-0 pb-0 d-flex justify-content-between">
            <h5 class="card-title">LPG Prices</h5>
            <livewire:triggers.trigger-prices type='lpg' />
        </div>
        <div class="card-body">
            @livewire('tables.l-p-g-table')
        </div>
    </div>
@endsection
