<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\TransactionDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TransactionController extends Controller
{
    use ApiResponser;

    public function TransactionInitiate(TransactionRequest $request): JsonResponse
    {
        $transactionPayloadDto = TransactionDto::instance()->dirtyDto($request->all());
//        dd($transactionPayloadDto);

        return $this->successResponse($transactionPayloadDto, 'Dto creation successful');
    }
}
