<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Dashboard\ProfileController;
use Modules\User\App\Http\Controllers\Dashboard\UserController;

Route::prefix('user')->as('user.')->group(function () {

    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/',  [ProfileController::class, 'profile'])->name('show');
        Route::post('update',  [ProfileController::class, 'update'])->name('update');
        Route::post('avatar',  [ProfileController::class, 'uploadAvatar'])->name('avatar.upload');
    });

    Route::post('avatar',  [UserController::class, 'uploadAvatar'])->name('avatar.upload');
    Route::get('datatable',  [UserController::class, 'datatable'])->name('datatable');
});
Route::resource('user', UserController::class);
