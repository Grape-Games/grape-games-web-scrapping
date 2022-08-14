<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collections\CountriesCollection;
use App\Models\Country;
use App\Traits\JsonifyResponse;

class CountryController extends Controller
{
    use JsonifyResponse;

    public function index()
    {
        $data = (new CountriesCollection(Country::all()));

        return $this->success($data, message: 'Countries fetched successfully.');
    }
}
