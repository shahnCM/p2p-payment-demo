<?php

namespace App\Http\Controllers\Auth;

use App\DataTransferObjects\UserCreateDto;
use App\DataTransferObjects\UserCredentialDto;
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

        $token = AuthenticationService::instantiate()->jwtAttempt($userCredentialDto);

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

    public function register(RegistrationRequest $request, WalletService $walletService): JsonResponse
    {
        $userCreateDto = UserCreateDto::instantiate()->preciseDto([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'currency' => $request->get('currency')
        ]);

        $newUserWithWallet = AuthenticationService::instantiate()->registerUserWithWalletCreation($userCreateDto);

        if(is_null($newUserWithWallet)) {
            return $this->errorResponse([
                'registration-error' => 'There is a problem with registration or wallet creation'
            ], 'Failed', 422);
        }

        $responseData = [
            'user' => $newUserWithWallet->get('user'),
            'wallet' => $newUserWithWallet->get('wallet'),
            'authorization' => [
                'token' => AuthenticationService::instantiate()->loginUser($newUserWithWallet->get('user')),
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
                'token' => AuthenticationService::instantiate()->refreshToken(),
                'type' => 'bearer',
            ]
        ];

        return $this->successResponse($responseData, 'Refresh successful');
    }

    public function logout(): JsonResponse
    {
        AuthenticationService::instantiate()->logoutUser();

        return $this->successResponse([], 'Sign out successful');
    }
}
