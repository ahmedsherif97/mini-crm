<?php

use Illuminate\Support\Facades\Route;
use Modules\Activity\App\Http\Controllers\Dashboard\ActivityController;

Route::prefix('activity')->as('activity.')->group(function () {
    Route::get('datatable',  [ActivityController::class, 'datatable'])->name('datatable');
});
Route::resource('activity', ActivityController::class)->only('index', 'show', 'destroy');
