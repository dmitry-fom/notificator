<?php

namespace App\Enums;

enum Channels: string
{
    case SMS = 'sms';
    case SLACK = 'slack';
    case WEBHOOK = 'webhook';
    case TEAMS = 'teams';
    case MAIL = 'mail';
}
