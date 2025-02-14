<?php

namespace Modules\Activity\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Activity\App\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace . '\Api')
            ->group(module_path('Activity', '/routes/api.php'));

        Route::middleware('web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath')
            ->namespace($this->moduleNamespace)
            ->prefix(LaravelLocalization::setLocale())
            ->group(module_path('Activity', '/routes/web.php'));

        Route::middleware('web', 'auth', 'admin', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath')
            ->namespace($this->moduleNamespace . '\Dashboard')
            ->prefix(LaravelLocalization::setLocale() . '/dashboard')
            ->as('dashboard.')
            ->group(module_path('Activity', '/routes/dashboard.php'));
    }
}
