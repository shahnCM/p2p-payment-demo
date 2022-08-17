<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\InitiatedTransactionRepository;

class TransactionReportService
{
    public function userWhoUsedHighestConversion(): ?array
    {
        return InitiatedTransactionRepository::instantiate()->findUserWithCalculatedConversions();
    }

    public function totalAmountConvertedForParticularUser(int $userId = null): ?array
    {
        return InitiatedTransactionRepository::instantiate()->findUserWithCalculatedConversions($userId);
    }

    public function userWhoUsedMostConversion(): ?array
    {
        return InitiatedTransactionRepository::Instantiate()->findUserWithMaxConversions();
    }

    public function thirdHighestAmountOfTransactionByUser(int $userId): ?array
    {
        return UserRepository::instantiate()->getNthHighestTransaction($userId, 3);
    }
}
