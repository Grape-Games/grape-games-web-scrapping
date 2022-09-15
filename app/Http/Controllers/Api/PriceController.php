<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Prices\GetPriceRequest;
use App\Http\Resources\Collections\ResourcesCollection;
use App\Models\CurrencyRate;
use App\Models\Resource;
use App\Traits\JsonifyResponse;

class PriceController extends Controller
{
    use JsonifyResponse;

    public function index(GetPriceRequest $request)
    {
        $data = (new ResourcesCollection(Resource::type($request->type)->with('country')->get()));

        return $this->success(
            $data,
            message: 'Below are the ' . $request->type . ' rates.'
        );
    }

    public function getAllPrices()
    {
        return $this->success(CurrencyRate::all());
    }
}
