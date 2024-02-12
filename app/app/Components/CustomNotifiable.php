<?php

namespace App\Components;

use App\Enums\Channels;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Notifiable;

class CustomNotifiable extends AnonymousNotifiable
{
    use Notifiable;
    
    public function routeNotificationForMail()
    {
        return config('notificator.channels.' . Channels::MAIL->value . '.route');
    }
    
    public function routeNotificationForMicrosoftTeams()
    {
        return config('notificator.channels.' . Channels::TEAMS->value . '.route');
    }
    
    public function routeNotificationForWebhook()
    {
        return config('notificator.channels.' . Channels::WEBHOOK->value . '.route');
    }
    
    public function routeNotificationForSlack()
    {
        return config('notificator.channels.' . Channels::SLACK->value . '.route');
    }
    
    public function routeNotificationForVonage()
    {
        return config('notificator.channels.' . Channels::SMS->value . '.route');
    }
}
