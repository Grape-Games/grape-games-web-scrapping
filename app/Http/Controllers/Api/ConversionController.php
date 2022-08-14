<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Conversion\ConvertByCodeRequest;
use App\Http\Requests\Conversion\ConvertByCountryRequest;
use App\Http\Requests\Conversion\ConvertCurrencyRequest;
use App\Http\Resources\Collections\ConversionsCollection;
use App\Models\CurrencyRate;
use App\Services\ConversionService;
use App\Traits\JsonifyResponse;
use Exception;

class ConversionController extends Controller
{
    use JsonifyResponse;

    public function index()
    {
        $data = (new ConversionsCollection(CurrencyRate::all()));

        return $this->success(
            $data,
            message: 'Available conversion are below. Use these symbols to convert currencies. You can also try with country names which may result in more results.'
        );
    }

    public function conversionByCode(ConvertByCodeRequest $request, ConversionService $conversionService)
    {
        try {
            $result = $conversionService->convert($request->from, $request->to, $request->amount ?? 1);

            return $this->success($result, message: 'Successfully converted.');
        } catch (Exception $e) {
            return $this->exception($e);
        }
    }

    public function conversionByCountry(ConvertByCountryRequest $request, ConversionService $conversionService)
    {
        try {
            $result = $conversionService->convert(
                $conversionService->getCountryCurrencyCode($request->from),
                $conversionService->getCountryCurrencyCode($request->to),
                $request->amount ?? 1
            );

            return $this->success($result, message: 'Successfully converted.');
        } catch (Exception $e) {
            return $this->exception($e);
        }
    }
}
