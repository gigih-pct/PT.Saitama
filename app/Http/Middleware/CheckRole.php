<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage: ->middleware('role:sensei') or ->middleware('role:sensei,admin')
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // In multi-guard setups, a user might be logged into different roles simultaneously.
        // We check all authenticated guards to see if any of them satisfy the role requirement.
        $guards = array_keys(config('auth.guards'));
        $authenticatedManagers = [];

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $authenticatedManagers[] = Auth::guard($guard)->user();
            }
        }

        if (empty($authenticatedManagers)) {
            abort(403, 'Unauthorized - No active session found.');
        }

        $roles = collect($roles)->map(fn($r) => trim($r))->filter()->all();
        
        if (empty($roles)) {
            return $next($request);
        }

        foreach ($authenticatedManagers as $user) {
            if (in_array($user->role, $roles)) {
                return $next($request);
            }
        }

        abort(403, 'Forbidden - You do not have the required role (' . implode(', ', $roles) . '). Current roles: ' . implode(', ', array_map(fn($u) => $u->role, $authenticatedManagers)));
    }
}
