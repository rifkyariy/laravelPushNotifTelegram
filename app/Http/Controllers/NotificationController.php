<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Telegram ;
use App\User;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function sendToTelegram()
    {
        $reciept = '@aritestroom';

        $img = (object)[
            'receipt' => $reciept, 
            'type' => 'img',
            'content' => 'https://file-examples-com.github.io/uploads/2017/10/file_example_JPG_1MB.jpg'
        ];

        $textButton = (object)[
            'receipt' => $reciept, 
            'type' => 'textButton',
            'content' => (object) [
                'text' => "*Buku Baru Nih*!\nSudah siap buat pinjem ?",
                'button' => 'Kunjungi Halaman',
                'url' => 'https://google.com',
            ]
        ];


        Notification::send($img ,new Telegram());         
        Notification::send($textButton ,new Telegram());        
    }
}
