<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])
        ->name('menu.index');

    Route::get('/menu/{uuid}', [MenuController::class, 'show'])
        ->name('menu.show');
});

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::post('/menu', [MenuController::class, 'store'])
        ->name('menu.store');

    Route::patch('/menu/{uuid}', [MenuController::class, 'update'])
        ->name('menu.update');

    Route::delete('/menu/{uuid}', [MenuController::class, 'destroy'])
        ->name('menu.destroy');
});
