<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(\App\Http\Controllers\Auth\JwtAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('v1/')->group(function () {

    Route::post('transaction-initiate', [
        App\Http\Controllers\Api\v1\TransactionController::class, 'TransactionInitiate'
    ])->name('transaction.initiate');

    Route::get('transaction-reports', [
        App\Http\Controllers\Api\v1\TransactionReportController::class, 'TransactionReports'
    ])->name('transaction.reports');

});

