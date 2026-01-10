<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudentApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('siswa')->check()) {
            $user = Auth::guard('siswa')->user();
            
            // If they are a student and not approved, they should only see the waiting-approval page
            if ($user->role === 'siswa' && $user->status !== 'approved') {
                if (!$request->routeIs('siswa.waiting_approval') && !$request->routeIs('siswa.logout')) {
                    return redirect()->route('siswa.waiting_approval');
                }
            }
        }

        return $next($request);
    }
}
