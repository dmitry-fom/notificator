<?php

use App\Enums\Channels;
use NotificationChannels\MicrosoftTeams\MicrosoftTeamsChannel;
use NotificationChannels\Webhook\WebhookChannel;

return [
    'channels' => [
        Channels::MAIL->value    => [
            'via-provider' => 'mail',
            'route'        => env('ROUTE_FOR_MAIL'),
        ],
        Channels::TEAMS->value   => [
            'via-provider' => MicrosoftTeamsChannel::class,
            'route'        => env('ROUTE_FOR_TEAMS'),
        ],
        Channels::SMS->value     => [
            'via-provider' => 'vonage',
            'route'        => env('ROUTE_FOR_SMS'),
        ],
        Channels::WEBHOOK->value => [
            'via-provider' => WebhookChannel::class,
            'route'        => env('ROUTE_FOR_WEBHOOK'),
        ],
        Channels::SLACK->value   => [
            'via-provider' => 'slack',
            'route'        => env('ROUTE_FOR_SLACK'),
        ],
    ],
];
