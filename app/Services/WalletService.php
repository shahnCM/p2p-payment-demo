<?php

namespace App\Services;

use App\DataTransferObjects\WalletCreateDto;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Database\Eloquent\Model;

class WalletService
{
    private static WalletService $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function createNewWallet(WalletCreateDto $walletCreateDto): Wallet|Model
    {
        return WalletRepository::instantiate()->createNewWallet($walletCreateDto, false);
    }
}
