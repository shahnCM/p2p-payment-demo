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
        $data = [];

        $data['thirdHighestAmountOfTransactionByUser'] =
            $transactionReportService->thirdHighestAmountOfTransactionByUser(2);
        $data['userWhoUsedMostConversion'] =
            $transactionReportService->userWhoUsedMostConversion();
        $data['userWhoUsedHighestConversion'] =
            $transactionReportService->userWhoUsedHighestConversion();
        $data['totalAmountConvertedForParticularUser'] =
            $transactionReportService->totalAmountConvertedForParticularUser(2);


        return $this->successResponse($data, 'All Query Data');
    }
}
