<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\MaintenanceSettings;
use Illuminate\Support\Facades\View;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the current path
        $path = $request->path();
        
        // Skip maintenance mode for Filament admin panel and all its routes
        if (str_starts_with($path, 'filament') || 
            str_starts_with($path, 'admin') ||
            $request->is('filament/*') || 
            $request->is('admin/*') ||
            $request->is('filament')) {
            return $next($request);
        }

        // Skip maintenance mode for authentication routes
        if ($request->is('login') || 
            $request->is('register') || 
            $request->is('password/*') ||
            $request->is('logout')) {
            return $next($request);
        }

        // Check if maintenance mode is enabled
        $maintenance = MaintenanceSettings::first();
        if ($maintenance && $maintenance->is_enabled) {
            View::share('maintenance', $maintenance);
            
            return response()->view('errors.503', [], 503);
        }

        return $next($request);
    }
}
