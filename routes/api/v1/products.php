<?php

use App\Http\Controllers\v1\Products\PriceRequests\PriceRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\Products\ProductController;

/*
|--------------------------------------------------------------------------
| Products Routes
|--------------------------------------------------------------------------
|
*/

Route::prefix('products')->name('products.')->group(function () {
    Route::get('', [ProductController::class, 'list'])->name('list');
    Route::post('', [ProductController::class, 'create'])->middleware(['auth:sanctum'])->name('create');
    Route::prefix('{product:uuid}')->name('product.')
        ->where(['uuid' => '[a-f0-9]{8}-?[a-f0-9]{4}-?4[a-f0-9]{3}-?[89ab][a-f0-9]{3}-?[a-f0-9]{12}'])
        ->group(function () {
            Route::get('', [ProductController::class, 'view'])->name('view');
            Route::put('', [ProductController::class, 'update'])->middleware(['auth:sanctum'])->name('update');
            Route::delete('', [ProductController::class, 'delete'])->middleware(['auth:sanctum'])->name('delete');
        });
});
