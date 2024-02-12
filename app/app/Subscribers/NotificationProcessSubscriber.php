<?php

namespace App\Subscribers;

use Illuminate\Notifications\Events\NotificationFailed;
use Illuminate\Notifications\Events\NotificationSending;
use Illuminate\Notifications\Events\NotificationSent;
use Psr\Log\LoggerInterface;

class NotificationProcessSubscriber
{
    public function __construct(private readonly LoggerInterface $logger)
    {}
    
    public function sending(NotificationSending $event): void
    {
        $this->logger->info('Message is sending. #' . $event->notification->id);
    
    }
    
    public function sent(NotificationSent $event): void
    {
        $this->logger->info('Message was sent via ['. $event->channel .']. #' . $event->notification->id);
    }
    
    public function failed(NotificationFailed $event): void
    {
        $this->logger->error('Message was not sent #' . $event->notification->id . ', reason: ' . $event->data['error']);
    }
}
