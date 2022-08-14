<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use \Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class MethodNotDefined extends BaseException
{
    use ApiResponser;

    protected $code = 422;
    protected $message = 'Method is not defined in the child class';
    private string $exceptionName = 'InvalidClassProperty';

    public function render(): View|JsonResponse
    {
        return $this->errorResponse([
            'error' =>$this->message
        ], $this->exceptionName, $this->code);
    }
}

