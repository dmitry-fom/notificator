<?php

namespace App\Components;

use App\DTO\Message;
use App\Notifications\BaseNotification;
use Illuminate\Events\Dispatcher;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Events\NotificationFailed;

class ChannelNotificator
{
    public function __construct(
        private readonly array $config,
        private readonly Dispatcher $eventDispatcher
    ) {}
    
    public function send(Message $message, $notifiable = null): void
    {
        $channel = $this->config['channels'][$message->channel->value]['via-provider'];
        
        $notification = $this->getNotification($message, $channel);
        
        try {
            $notifiable = $notifiable ?? $this->getNotifiable();

            $notifiable->notify($notification);
        } catch (\Throwable $e) {
            $this->eventDispatcher->dispatch(
                new NotificationFailed($notifiable, $notification, $channel, [
                    'error' => $e->getMessage(),
                ])
            );
            
            throw new \Exception('Something went wrong');
        }
    }
    
    private function getNotifiable(): AnonymousNotifiable
    {
        return (new CustomNotifiable());
    }
    
    private function getNotification(Message $message, string $channel): BaseNotification
    {
        $notification = BaseNotification::make($message);
        
        return $notification->setVia((array) $channel);
    }
}
