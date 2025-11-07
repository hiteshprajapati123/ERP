<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        auth()->logout();
        
        // Use Filament's notification system
        Notification::make()
            ->title('Access Denied')
            ->body('You do not have permission to access the admin panel.')
            ->danger()
            ->persistent()
            ->send();
        
        return redirect()->route('filament.Madarsa-AdminSide.auth.login');
    }
}
