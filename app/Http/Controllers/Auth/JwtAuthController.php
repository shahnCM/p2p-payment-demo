<?php

namespace App\Http\Controllers\Auth;

use App\DataTransferObjects\UserCreateDto;
use App\DataTransferObjects\UserCredentialDto;
use App\DataTransferObjects\WalletCreateDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Services\AuthenticationService;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
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
        $userCredentialDto = UserCredentialDto::instantiate()->preciseDto($request->only('email', 'password'));

        $token = AuthenticationService::instantiate()->jwtLogin($userCredentialDto);

        if (!$token) {
            return $this->errorResponse([
                'credential-error' => 'Credentials do not match'
            ], 'Unauthorized', 401);
        }

        $responseData = [
            'user' => Auth::user(),
            'authorization' => [
                'token' => $token,
                'type' => 'bearer'
            ]
        ];

        return $this->successResponse($responseData, 'Sign in successful');
    }

    public function register(
        RegistrationRequest $request, WalletService $walletService): JsonResponse
    {
        $userCreateDto = UserCreateDto::instantiate()->preciseDto([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'currency' => $request->get('currency')
        ]);

        $walletCreateDto = WalletCreateDto::instantiate()->preciseDto([
            'userId' => $user['id'] ?? 0,
            'currency' => $userCreateDto->get('currency'),
            'amount' => '0.00',
        ]);

        $user = AuthenticationService::instantiate()->registerUser($userCreateDto);

        $wallet = $walletService->createNewWallet($walletCreateDto);

        $responseData = [
            'user' => $user,
            'wallet' => $wallet,
            'authorization' => [
                'token' => Auth::login($user),
                'type' => 'bearer'
            ]
        ];

        return $this->successResponse($responseData, 'Sign up successful', 201);
    }

    public function refresh(): JsonResponse
    {
        $responseData = [
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ];

        return $this->successResponse($responseData, 'Refresh successful');
    }

    public function logout(): JsonResponse
    {
        Auth::logout();
        return $this->successResponse([], 'Sign out successful');
    }
}
