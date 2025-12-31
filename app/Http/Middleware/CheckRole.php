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
        // Try to get user from default guard, then admin guard
        $user = Auth::user() ?: Auth::guard('admin')->user();

        if (!$user) {
            abort(403);
        }

        $roles = collect($roles)->map(fn($r) => trim($r))->filter()->all();
        if (empty($roles)) {
            return $next($request);
        }

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        abort(403);
    }
}
