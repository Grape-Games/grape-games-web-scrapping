<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});

// routes
Route::middleware('auth')->group(function () {
    Route::view('/gasoline-prices-list', 'pages.resources.gasoline')->name('prices.gasoline');
    Route::view('/diesel-prices-list', 'pages.resources.diesel')->name('prices.diesel');
    Route::view('/lpg-prices-list', 'pages.resources.lpg')->name('prices.lpg');
    Route::view('/eletricity-prices-list', 'pages.resources.eletricity')->name('prices.eletricity');
    Route::view('/natural-gas-prices-list', 'pages.resources.natural-gas')->name('prices.natural-gas');
    Route::view('/kerosine-oil-prices-list', 'pages.resources.kerosine-oil')->name('prices.kerosine-oil');
    Route::view('/heating-oil-prices-list', 'pages.resources.heating-oil')->name('prices.heating-oil');
    Route::view('/currency-rates', 'pages.currency-rates.index')->name('currency-rates.index');
});


require __DIR__ . '/auth.php';
