<?php

namespace App\Enums;

enum Types: string
{
    case BIRTHDAY = 'birthday';
    case INVITATION = 'invitation';
    case REMINDER = 'reminder';
}
