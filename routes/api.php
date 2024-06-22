<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LoggedController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Payment\CreateController as CreatePaymentController;
use App\Http\Controllers\Payment\ListController as ListPaymentController;
use App\Http\Controllers\User\CreateController;
use App\Http\Controllers\User\Wallet\DepositController;
use App\Http\Controllers\User\Wallet\ShowController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth', [LoginController::class, 'login']);
Route::post('user', [CreateController::class, 'store']);

Route::middleware('auth:api')->group(function () {

    //access control route
    Route::get('logged', [LoggedController::class, 'logged']);
    Route::delete('logout', [LogoutController::class, 'logout']);

    //payment routes
    Route::post('payment', [CreatePaymentController::class, 'store']);
    Route::get('payment', [ListPaymentController::class, 'list']);

    //wallet routes
    Route::get('user/{id}/wallet', [ShowController::class, 'show']);
    Route::post('user/{id}/wallet', [DepositController::class, 'store']);
});
