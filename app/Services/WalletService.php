<?php

namespace App\Services;

use App\DataTransferObjects\WalletCreateDto;
use App\Models\Wallet;
use App\Repositories\WalletRepository;
use Illuminate\Database\Eloquent\Model;

class WalletService
{
    public function createNewWallet(WalletCreateDto $walletCreateDto): Wallet|Model
    {
        return WalletRepository::instantiate()->createNewWallet($walletCreateDto);
    }
}
