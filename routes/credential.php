<?php

use App\Http\Controllers\CredentialController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    Route::get('/credential', [CredentialController::class, 'index'])
        ->name('credential.index');
});

Route::middleware(['auth:api', 'verified', 'role:0'])->group(function () {
    Route::post('/credential', [CredentialController::class, 'store'])
        ->name('credential.store');

    Route::patch('/credential/{uuid}', [CredentialController::class, 'update'])
        ->name('credential.update');

    Route::delete('/credential/{uuid}', [CredentialController::class, 'destroy'])
        ->name('credential.destroy');
});
