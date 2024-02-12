<?php

namespace App\Notifications;

use App\DTO\Message;
use App\Enums\Types;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\SlackMessage;
use Illuminate\Support\Str;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;
use NotificationChannels\Webhook\WebhookMessage;

abstract class BaseNotification extends Notification
{
    private array $providers;
    
    public function __construct(public readonly Message $message)
    {
    }
    
    public function via(): array
    {
        return $this->providers;
    }
    
    public function setVia(array $providers): self
    {
        $this->providers = $providers;
        
        return $this;
    }
    
    public static function make(Message $message): self
    {
        $notification = match ($message->type) {
            Types::BIRTHDAY => new BirthdayNotification($message),
            Types::INVITATION => new InvitationNotification($message),
            Types::REMINDER => new ReminderNotification($message),
        };
        
        $notification->id = Str::uuid()->toString();
        
        return $notification;
    }
    
    abstract public function toSlack($notifiable): SlackMessage;
    
    abstract public function toMicrosoftTeams($notifiable): MicrosoftTeamsMessage;
    
    abstract public function toMail($notifiable): MailMessage;
    
    abstract public function toWebhook($notifiable): WebhookMessage;
    
    abstract public function toVonage($notifiable): VonageMessage;
}
