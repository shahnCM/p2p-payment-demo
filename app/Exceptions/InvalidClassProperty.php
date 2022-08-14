<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class InvalidClassProperty extends BaseException
{
    protected $code = 422;
    protected $message = 'Property does not exist in the class';
    private string $exceptionName = 'InvalidClassProperty';

    public function render(): View|JsonResponse
    {
        return $this->errorResponse([
            'error' =>$this->message
        ], $this->exceptionName, $this->code);
    }
}
