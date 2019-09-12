<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * @param GateContract $gate
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies();

        try {
            if (Schema::hasTable('permissions')) {
                foreach ($this->getPermissions() as $permission) {
                    $gate->define($permission->name, static function ($user) use ($permission) {
                        return $user->hasPermission($permission);
                    });
                }
            }
        } catch (QueryException $e) {
            return;
        }
    }

    /**
     * @return Collection
     */
    protected function getPermissions(): Collection
    {
        return Permission::with('roles')->get();
    }
}
