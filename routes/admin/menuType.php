<?php

use App\Http\Controllers\MenuTypeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/menu-type', [MenuTypeController::class, 'index'])
        ->name('menu-type.index');
});

Route::middleware(['auth:api', 'verified'])->group(function () {
    Route::post('/menu-type', [MenuTypeController::class, 'store'])
        ->name('menu-type.store');

    Route::patch('/menu-type/{uuid}', [MenuTypeController::class, 'update'])
        ->name('menu-type.update');

    Route::delete('/menu-type/{uuid}', [MenuTypeController::class, 'destroy'])
        ->name('menu-type.destroy');
});
