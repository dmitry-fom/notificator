<?php

namespace App\Console\Commands;

use App\DTO\Message;
use App\Enums\Channels;
use App\Enums\Types;
use App\Jobs\SendMessageJob;
use Illuminate\Console\Command;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\ValidationException;

class NotificationPublish extends Command
{
    protected $signature = 'notification:publish {channel} {type} {text}';
    
    public function handle(): void
    {
        try {
            $this->validate();
    
            $message = $this->getMessage();
    
            dispatch(new SendMessageJob($message))
                ->onQueue($message->channel->value);
            
            $this->info('notification pushed to queue');
        } catch (ValidationException $e) {
            $this->error($e->getMessage());
        }
    }
    
    private function getMessage(): Message
    {
        return new Message(
            Channels::tryFrom($this->argument('channel')),
            Types::tryFrom($this->argument('type')),
            $this->argument('text'),
        );
    }
    
    /**
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validate(): void
    {
        validator(
            $this->arguments(),
            [
                'channel' => ['required', Rule::enum(Channels::class)],
                'type'    => ['required', Rule::enum(Types::class)],
                'text'    => ['required', 'string', 'min:3']
            ],
            [
                'type.' . Enum::class    => ':attribute allow '. $this->readEnumValues(Types::class),
                'channel.' . Enum::class => ':attribute allow '. $this->readEnumValues(Channels::class),
            ],
        )->validate();
    }
    
    private function readEnumValues($enum): string
    {
        return implode(',', array_column($enum::cases(), 'value'));
    }
}
