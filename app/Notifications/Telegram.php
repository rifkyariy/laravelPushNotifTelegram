<?php

namespace App\Notifications;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class Telegram extends Notification
{
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($post)
    {
        return TelegramMessage::create()
            ->to('@aritestroom')
            ->content("Duar MM");
    }
}
