<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class NotEloquentModel extends BaseException
{
    protected $code = 422;
    protected $message = 'Model must be an instance of Illuminate\Database\Eloquent\Model';
    private string $exceptionName = 'NotEloquentModel';

    public function render(): View|JsonResponse
    {
        return $this->errorResponse([
            'error' =>$this->message
        ], $this->exceptionName, $this->code);
    }
}

