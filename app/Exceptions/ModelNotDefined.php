<?php

namespace App\Exceptions;

use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ModelNotDefined extends BaseException
{
    protected $code = 422;
    protected $message = 'Model or Model Name is not defined';
    private string $exceptionName = 'InvalidClassProperty';

    public function render(): View|JsonResponse
    {
        return $this->errorResponse([
            'error' =>$this->message
        ], $this->exceptionName, $this->code);
    }
}

