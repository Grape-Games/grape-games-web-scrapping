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
    Route::view('/prices-list', 'pages.prices.index')->middleware(['auth'])->name('prices.index');
    Route::view('/currency-rates', 'pages.currency-rates.index')->name('currency-rates.index');
});


require __DIR__ . '/auth.php';
