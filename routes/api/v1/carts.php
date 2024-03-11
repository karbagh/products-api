<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\CartLists\CartController;

/*
|--------------------------------------------------------------------------
| Branches Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('carts')->name('carts.')->group(function () {
    Route::get('', [CartController::class, 'index'])->name('list');
    Route::delete('', [CartController::class, 'clear'])->name('clear');
    Route::delete('{product:uuid}', [CartController::class, 'remove'])->name('remove');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::post('reduce', [CartController::class, 'reduce'])->name('reduce');
    Route::post('change', [CartController::class, 'change'])->name('change');
});
