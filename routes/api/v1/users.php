<?php

use App\Http\Controllers\v1\Address\AddressController;
use App\Http\Controllers\v1\Users\UserSettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Users\UserController;


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
Route::prefix('users')->middleware(['auth:sanctum'])->name('users.')->group(function () {
    Route::delete('', [UserController::class, 'delete'])->name('delete');
    Route::get('orders', [UserController::class, 'orders'])->name('orders');
    Route::get('gifts', [UserController::class, 'gifts'])->name('gifts');
    Route::prefix('addresses')->name('addresses.')->group(function () {
        Route::get('', [AddressController::class, 'index'])->name('index');
        Route::post('', [AddressController::class, 'create'])->name('create');
        Route::prefix('{address:id}')->name('address.')->group(function () {
            Route::delete('', [AddressController::class, 'delete'])->name('delete');
            Route::put('', [AddressController::class, 'update'])->name('update');
            Route::put('set-default', [AddressController::class, 'setDefault'])->name('set-default');
        });
    });
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('', [UserController::class, 'settings'])->name('index');
        Route::put('', [UserSettingsController::class, 'update'])->name('update');
        Route::prefix('password')->name('password.')->group(function () {
            Route::put('', [UserSettingsController::class, 'changePassword'])->name('update');
        });
    });
});
