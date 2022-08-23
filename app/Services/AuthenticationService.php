<?php

namespace App\Services;

use App\DataTransferObjects\NewUserWithWalletDto;
use App\DataTransferObjects\UserCreateDto;
use App\DataTransferObjects\WalletCreateDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\DataTransferObjects\UserCredentialDto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationService
{
    private static AuthenticationService $instance;

    private final function __construct() {}

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function jwtAttempt(UserCredentialDto $userCredentialDto): string
    {
        return Auth::attempt([
            'email' => $userCredentialDto->get('email'),
            'password' => $userCredentialDto->get('password')
        ]);
    }

    public function refreshToken(): string
    {
        return Auth::refresh();
    }

    public function loginUser(User $user): string|User
    {
        return Auth::login($user);
    }

    public function logoutUser(): void
    {
        Auth::logout();
    }

    public function registerUser(UserCreateDto $userCreateDto): User|Model
    {
        return UserRepository::instantiate()->createNewUser($userCreateDto, false);
    }

    public function registerUserWithWalletCreation(UserCreateDto $userCreateDto): null|object
    {
        $data = [];

        try {
            DB::beginTransaction();

            $user = AuthenticationService::instantiate()->registerUser($userCreateDto);

            $walletCreateDto = WalletCreateDto::instantiate()->preciseDto([
                'userId' => $user['id'],
                'currency' => $userCreateDto->get('currency'),
                'amount' => '0.00',
            ]);

            $wallet = WalletService::instantiate()->createNewWallet($walletCreateDto);

            DB::commit();

            $data = [
                'user' => $user,
                'wallet' => $wallet
            ];

        } catch (\Exception $e) {
            DB::rollBack();
        }

        if (count($data) <= 0) {
            return null;
        }

        return NewUserWithWalletDto::instantiate()->preciseDto($data);
    }
}
