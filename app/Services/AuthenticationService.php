<?php

namespace App\Services;

use App\DataTransferObjects\UserCreateDto;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\DataTransferObjects\UserCredentialDto;

class AuthenticationService
{
    private static AuthenticationService $instance;

    public static function instantiate(): self
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function jwtLogin(UserCredentialDto $userCredentialDto): string
    {
        return Auth::attempt([
            'email' => $userCredentialDto->get('email'),
            'password' => $userCredentialDto->get('password')
        ]);
    }

    public function registerUser(UserCreateDto $userCreateDto): User|Model
    {
        return UserRepository::instantiate()->createNewUser($userCreateDto, false);
    }
}
