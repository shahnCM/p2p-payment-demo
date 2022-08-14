<?php

namespace App\Http\Requests;

use App\Traits\ApiResponser;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class BaseRequest extends \Illuminate\Foundation\Http\FormRequest
{
    use ApiResponser;

    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException($this->errorResponse($validator->messages()->toArray(), 'Validation Error',422));
    }
}
