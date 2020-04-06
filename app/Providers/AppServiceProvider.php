<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

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
            Schema::defaultStringLength(191);
            $menuCategories = \App\MenuCategory::all();
            view()->share('menuCategories', $menuCategories);
        } catch (\Exception $e) {
            echo 'Be right back...';
            exit;
        }

        $file = base_path('resources/menus.json');
        if (File::exists($file)) {
            view()->share('adminMenus', json_decode(File::get($file), false));
        }
    }
}
