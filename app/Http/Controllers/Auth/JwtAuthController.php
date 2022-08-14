<?php

namespace App\Http\Controllers\Auth;

use App\DataTransferObjects\UserCreateDto;
use App\DataTransferObjects\WalletCreateDto;
use App\Enums\Currency;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\WalletRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JwtAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return $this->errorResponse([
                'credential-error' => 'Credentials do not match'
            ],'Unauthorized', 401);
        }

        $user = Auth::user();

        return $this->successResponse([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ], 'Sign in successful');
    }

    public function register(RegistrationRequest $request): JsonResponse
    {
        $userCreateDto = UserCreateDto::instantiate()->preciseDto([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'currency' => $request->get('currency')
        ]);

        $user = UserRepository::instantiate()->createNewUser($userCreateDto, false);

        $walletCreateDto = WalletCreateDto::instantiate()->preciseDto([
            'userId' => $user['id'] ?? 0,
            'currency' => $userCreateDto->get('currency'),
            'amount' => '0.00',
        ]);

        $wallet = WalletRepository::instantiate()->createNewWallet($walletCreateDto);

        $token = Auth::login($user);

        return $this->successResponse([
            'user' => $user,
            'wallet' => $wallet,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ], 'Sign up successful', 201);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return $this->successResponse([], 'Sign out successful');
    }

    public function refresh(): JsonResponse
    {
        return $this->successResponse([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ], 'Refresh successful');
    }
}
