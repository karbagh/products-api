<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Auth\AuthController;


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
Route::prefix('auth')->name('auth.')->group(function () {
    Route::prefix('subscription')->name('subscription.')->group(function () {
        Route::post('', [AuthController::class, 'subscribe'])->name('create');
        Route::delete('{subscription:uuid}', [AuthController::class, 'unsubscribe'])->name('delete');
    });
    Route::prefix('login')->name('login.')->group(function () {
        Route::post('user', [AuthController::class, 'login'])->name('login');
    });
    Route::prefix('sign-up')->name('login.')->group(function () {
        Route::post('', [AuthController::class, 'register'])->name('register');
    });
    Route::prefix('verification')->middleware(['auth:sanctum'])->name('verification.')->group(function () {
        Route::patch('retry', [AuthController::class, 'retryVerify'])->name('retry');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
    });
});
