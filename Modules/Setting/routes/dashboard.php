<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\App\Http\Controllers\Dashboard\SettingController;

Route::prefix('setting')->as('setting.')->group(function () {
    Route::get('datatable',  [SettingController::class, 'datatable'])->name('datatable');
    Route::post('upload',  [SettingController::class, 'upload'])->name('upload');
});
Route::resource('setting', SettingController::class)->except('show');
Route::post('financials/setting', [SettingController::class, 'financials'])->name('setting.financials');
Route::post('site/setting', [SettingController::class, 'siteSettings'])->name('setting.siteSettings');
Route::post('my/setting', [SettingController::class, 'mySetting'])->name('my.setting');