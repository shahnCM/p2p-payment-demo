<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function tokenAgainstCredentials(array $credentials): string
    {
        return Auth::attempt($credentials);
    }

    public function registerUser(): User
    {

    }
}
