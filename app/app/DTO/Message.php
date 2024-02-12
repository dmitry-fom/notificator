<?php

namespace App\DTO;

use App\Enums\Channels;
use App\Enums\Types;

final class Message
{
    public function __construct(
        public readonly Channels $channel,
        public readonly Types $type,
        public readonly string $text
    ) {}
}