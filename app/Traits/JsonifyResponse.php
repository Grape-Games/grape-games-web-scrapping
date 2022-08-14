<?php

namespace App\Traits;

use Exception;

trait JsonifyResponse
{
    public static function success($data = null, int $code = 200, array $errors = [], string $message = 'Action Successful')
    {
        return response()->json([
            'message' => $message,
            'code' => $code,
            'data' => $data,
            'errors' => $errors
        ], $code);
    }

    public static function error($data = null, int $code = 400, string $error)
    {
        return response()->json([
            'message' => 'Error occured.',
            'code' => $code,
            'data' => $data,
            'errors' => $error
        ], $code);
    }

    public static function exception(Exception $exception, int $code = 500, $errors = null)
    {
        return response()->json([
            'message' => 'Exception occured : ' . $exception->getMessage(),
            'code' => $code,
            'data' => [],
            'errors' => $errors
        ], $code);
    }
}
