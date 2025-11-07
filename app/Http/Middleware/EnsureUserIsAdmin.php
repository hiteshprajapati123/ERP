<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }

        Auth::logout();
        return redirect()->route('filament.Madarsa-AdminSide.auth.login')
            ->with('error', 'You do not have permission to access the admin panel.');
    }
}
