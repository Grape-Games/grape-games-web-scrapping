<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait RequestValidatable
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'data'    => [],
            'message' => "Validation failed.",
            'errors'  => $validator->errors(),
        ]), 422);
    }
}
