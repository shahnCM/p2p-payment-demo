<?php

namespace App\Traits;

trait ApiResponser
{
    protected function successResponse(array $data, string $message = '', int $code = 200) : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'status' => 'Success',
            'message' => $message,
            'data' => $data,
        ], $code, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    protected function errorResponse(array $errors = [], string $message, int $code) : \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status_code' => $code > 511 ? 500 : $code,
            'status' => 'Error',
            'message' => !env('APP_DEBUG') && $code >= 500 ? 'Internal Server Error' : $message,
            'errors' => $errors,
        ], $code, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

}
