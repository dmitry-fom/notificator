<?php

namespace App\Jobs;

use App\DTO\Message;
use App\Components\ChannelNotificator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMessageJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;
    
    public function __construct(public readonly Message $message)
    {}
    
    public function handle(ChannelNotificator $notificator)
    {
        $notificator->send($this->message);
    }
}
