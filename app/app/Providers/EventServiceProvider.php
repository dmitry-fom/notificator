<?php

namespace App\Providers;

use App\Subscribers\NotificationProcessSubscriber;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(NotificationSent::class, [NotificationProcessSubscriber::class, 'sent']);
        Event::listen(NotificationSending::class, [NotificationProcessSubscriber::class, 'sending']);
        Event::listen(NotificationFailed::class, [NotificationProcessSubscriber::class, 'failed']);
    }
    
    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
