<?php

namespace App\Http\Controllers\Api\v1;

use App\DataTransferObjects\TransactionDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\UserWithThirdHighestTransactionResource;
use App\Services\TransactionReportService;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class TransactionReportController extends Controller
{
    use ApiResponser;

    public function TransactionReports(TransactionReportService $transactionReportService): JsonResponse
    {
        $thirdHighestAmountOfTransactionByUser =
            $transactionReportService->thirdHighestAmountOfTransactionByUser(2);
        $userWhoUsedMostConversion =
            $transactionReportService->userWhoUsedMostConversion();
        $userWhoUsedHighestConversion =
            $transactionReportService->userWhoUsedHighestConversion();
        $totalAmountConvertedForParticularUser =
            $transactionReportService->totalAmountConvertedForParticularUser(2);

        return $this->successResponse(new UserWithThirdHighestTransactionResource($thirdHighestAmountOfTransactionByUser));

        dd(
            $thirdHighestAmountOfTransactionByUser,
            $userWhoUsedMostConversion,
            $userWhoUsedHighestConversion,
            $totalAmountConvertedForParticularUser
        );

        return $this->successResponse($transactionPayloadDto, 'Dto creation successful');
    }
}
