<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Size\SizeController;

/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('sizes')->name('sizes.')->group(function () {
    Route::get('', [SizeController::class, 'list'])->name('list');
    Route::post('', [SizeController::class, 'create'])->middleware(['auth:sanctum'])->name('create');
    Route::prefix('{size}')->name('product.')
        ->group(function () {
            Route::get('', [SizeController::class, 'view'])->name('view');
            Route::put('', [SizeController::class, 'update'])->middleware(['auth:sanctum'])->name('update');
            Route::delete('', [SizeController::class, 'delete'])->middleware(['auth:sanctum'])->name('delete');
        });
});
