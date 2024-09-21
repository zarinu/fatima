<?php

namespace App\Providers;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use App\Notifications\Channels\TelegramChannel as TelegramChannel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers') . '/helper.php';
        // Register custom Telegram channel
        Notification::extend('telegram', function ($app) {
            return new TelegramChannel();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::environment(['staging', 'production'])) {
            URL::forceScheme('https');
        }
    }
}
