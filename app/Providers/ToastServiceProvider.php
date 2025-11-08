<?php

namespace App\Providers;

use Filament\Notifications\Notification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Session;

class ToastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share toast data with all views
        view()->composer('*', function ($view) {
            if (Session::has('toast')) {
                $toast = Session::get('toast');
                Notification::make()
                    ->title($toast['message'])
                    ->danger()
                    ->send();
                
                // Clear the toast from the session
                Session::forget('toast');
            }
        });
    }
}
