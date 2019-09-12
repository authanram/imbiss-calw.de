<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next): void
    {
        $roles = $this->getRequiredRoleForRoute($request->route());
        if ($request->user()->hasRole($roles) || !$roles) {
            return $next($request);
        }

        abort(404);
    }

    /**
     * @param $route
     * @return mixed|null
     */
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();

        return $actions['roles'] ?? null;
    }
}
