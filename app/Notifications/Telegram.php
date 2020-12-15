<?php

namespace App\Notifications;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramLocation;
use Illuminate\Notifications\Notification;

class Telegram extends Notification
{
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($data)
    {   
        switch ($data->type) {
            case 'text':
                $notification = TelegramMessage::create();
                $notification->content($data->content);
                break;

            case 'textButton':
                $notification = TelegramMessage::create();
                $notification->content($data->content->text);
                $notification->button($data->content->button, $data->content->url);
                break;

            case 'img':
                $notification = TelegramFile::create();
                $notification->file($data->content, 'photo');
                break;
            
            default:
                # code...
                break;
        }
        
        $notification->to($data->receipt);
        return $notification;
    }

    public function sendMessage($data)
    {
        $notification = TelegramMessage::create();

        $notification->content($data['text']);
        // if($data['text']){
        // }

        if($data['button']){
            foreach ($data['button'] as $key => $button) {
                $notification->button($button['text'], $button['url']);
            }
        }   

        return $notification;
    }

    public function sendFile($file, $type)
    {
        $notification = TelegramFile::create();

        switch ($type) {
            case 'img':
                $notification->file($file, 'photo');
                break;
            
            case 'document':
                $notification->document($file['url'], $file['title']);
                break;

            case 'video':
                $notification->video($file);
                break;

            case 'gif':
                $notification->animation($file);
                break;
            
            default:
                return 'error';
                break;
        }
        
        return $notification;
    }

    public function sendLocation($data) 
    {
        $notification = TelegramLocation::create();

        if($data['longitude'] && $data['latitude']){
            $notification->longitude($data['longitude']);
            $notification->latitude($data['latitude']);
        }

        return $notification;
    }

}
