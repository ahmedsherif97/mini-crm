<?php

use App\Http\Controllers\Dashboard\CustomerActionController;
use App\Http\Controllers\Dashboard\CustomerController;
use App\Http\Controllers\Dashboard\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::resource('employees', EmployeeController::class)->only(['index', 'create', 'store', 'destroy']);
Route::resource('customers', CustomerController::class)->only(['index', 'create', 'store', 'destroy']);

Route::prefix('customers/{customer}')->group(function () {
    Route::post('reassign', [CustomerController::class, 'reassign'])->name('customers.reassign');
    Route::get('actions', [CustomerActionController::class, 'index'])->name('customers.actions.index');
    Route::post('actions', [CustomerActionController::class, 'store'])->name('customers.actions.store');
});

Route::patch('actions/{action}/update-result', [CustomerActionController::class, 'updateResult'])
    ->name('actions.update-result');