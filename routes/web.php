<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;

Route::group(['prefix'  => 'auth', 'as' => 'auth.'], function ($prefix) {
    Auth::routes(['logout' => false, 'verify' => true]);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('change/password', [ChangePasswordController::class, 'changePassword'])->name('password.change');
    Route::post('change/password', [ChangePasswordController::class, 'doChangePassword'])->name('password.doChange');
});

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('redirect.home');
