<?php

namespace App\Providers;

use App\Models\MenuCategory;
use App\Models\Permission;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
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
        Paginator::useBootstrapFour();

        $this->definePermissionGates();

        if (PHP_SAPI === 'cli') {
            return;
        }

        try {
            Schema::defaultStringLength(191);
            $menuCategories = MenuCategory::all();
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

    /**
     * @return void
     */
    protected function definePermissionGates()
    {
        try {
            if (Schema::hasTable('permissions')) {
                foreach (Permission::with('roles')->get() as $permission) {
                    Gate::define($permission->name, static function ($user) use ($permission) {
                        return $user->hasPermission($permission);
                    });
                }
            }
        } catch (QueryException $e) {
            return;
        }
    }
}
