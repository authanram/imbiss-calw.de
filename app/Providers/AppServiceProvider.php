<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (PHP_SAPI === 'cli') {
            return;
        }

        try {
            \Schema::defaultStringLength(191);
            $menuCategories = \App\MenuCategory::all();
            view()->share('menuCategories', $menuCategories);
        } catch (\Exception $e) {
            abort(503, 'Could not connect to the database.');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() === 'local') {
            $this->app->register('Appzcoder\CrudGenerator\CrudGeneratorServiceProvider');
        }
    }
}
