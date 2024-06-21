<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Payment\CreateController as CreatePaymentController;
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

Route::middleware('auth:api')->group(function () {
    //access control route
    Route::delete('auth', [LogoutController::class, 'logout']);

    //payment routes
    Route::post('payment', [CreatePaymentController::class, 'store']);
});
