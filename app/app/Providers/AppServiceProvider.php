<?php

namespace App\Providers;

use App\Components\ChannelNotificator;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ChannelNotificator::class, function (Application $app) {
            return new ChannelNotificator(
                config('notificator'),
                $app->make(Dispatcher::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    
    }
}
