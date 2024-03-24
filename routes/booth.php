<?php

use App\Http\Controllers\BoothController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/booth', [BoothController::class, 'index'])
        ->name('booth.index');
});

Route::middleware(['auth:api', 'verified', 'role:0'])->group(function () {
    Route::post('/booth', [BoothController::class, 'store'])
        ->name('booth.store');

    Route::delete('/booth/{uuid}', [BoothController::class, 'destroy'])
        ->name('booth.destroy');
});

Route::middleware(['auth:api', 'verified', 'role:0,1'])->group(function () {
    Route::patch('/booth/{uuid}', [BoothController::class, 'update'])
        ->name('booth.update');
});
