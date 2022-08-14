<?php

namespace App\Repositories;

use App\DataTransferObjects\WalletCreateDto;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Model;

class WalletRepository extends BaseRepository
{
    protected String $modelName = Wallet::class;

    private static WalletRepository $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function findWalletByUserId(int $userId, bool $toArray = true): null|array|Model
    {
        $wallet = $this->model->query()->where('user_id', $userId)->first();
        return $toArray ? $wallet?->toArray() : $wallet;
    }

    public function createNewWallet(WalletCreateDto $walletCreateDto, bool $toArray = true): null|array|Model
    {
        $data = [
            'user_id' => $walletCreateDto->get('userId'),
            'currency' => $walletCreateDto->get('currency'),
            'amount' => $walletCreateDto->get('amount'),
        ];

        $wallet = $this->model->query()->create($data);

        return $toArray ? $wallet?->toArray() : $wallet;
    }
}
