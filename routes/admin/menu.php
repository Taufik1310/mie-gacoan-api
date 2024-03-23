<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/menu', [MenuController::class, 'index'])
        ->name('menu.index');

    Route::get('/menu/{uuid}', [MenuController::class, 'show'])
        ->name('menu.show');
});

Route::middleware(['auth:api', 'verified', 'role:0'])->group(function () {
    Route::post('/menu', [MenuController::class, 'store'])
        ->name('menu.store');

    Route::delete('/menu/{uuid}', [MenuController::class, 'destroy'])
        ->name('menu.destroy');
});

Route::middleware(['auth:api', 'verified', 'role:0,1'])->group(function () {
    Route::patch('/menu/{uuid}', [MenuController::class, 'update'])
        ->name('menu.update');
});
