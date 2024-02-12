<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsMessage;
use NotificationChannels\Webhook\WebhookMessage;

class ReminderNotification extends BaseNotification
{
    const TITLE = 'Reminder';
    
    public function toSlack($notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->text(self::TITLE)
            ->sectionBlock(function (SectionBlock $block) {
                $block->text($this->message->text);
            });
    }
    
    public function toMicrosoftTeams($notifiable): MicrosoftTeamsMessage
    {
        return (new MicrosoftTeamsMessage)
            ->title(self::TITLE)
            ->content($this->message->text);
    }
    
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line(self::TITLE)
            ->line($this->message->text);
    }
    
    public function toWebhook($notifiable): WebhookMessage
    {
        return (new WebhookMessage())
            ->data([
                'title' => self::TITLE,
                'body' => $this->message->text
            ]);
    }
    
    public function toVonage($notifiable): VonageMessage
    {
        return (new VonageMessage())
            ->content(self::TITLE . ', ' . $this->message->text);
    }
}
