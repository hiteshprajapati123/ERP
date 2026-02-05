<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isTeacher()) {
            if ($request->user()) {
                // Redirect based on role
                if ($request->user()->isAdmin()) {
                    return redirect('/admin');
                }
                if ($request->user()->isStudent()) {
                    return redirect()->route('user.dashboard');
                }
            }

            return redirect()->route('user-login');
        }

        return $next($request);
    }
}
