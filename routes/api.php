<?php

use App\Http\Controllers\Api\ConversionController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Traits\JsonifyResponse;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// to get a token
Route::post('/tokens/create', TokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'index');
    });

    Route::controller(ConversionController::class)->group(function () {
        Route::get('/conversions', 'index');
        Route::get('/convert/code/{from}/{to}/{amount?}', 'conversionByCode');
        Route::get('/convert/country/{from}/{to}/{amount?}', 'conversionByCountry');
    });

    Route::controller(PriceController::class)->group(function () {
        Route::get('/prices/{type}', 'index');
    });
});

// for invalid routes
Route::any('{path}', function () {
    return JsonifyResponse::error([], code: 404, error: 'Endpoint not found.');
})->where('path', '.*');
