<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\Telegram ;
use Illuminate\Notifications\Notifiable;
use App\User;

class NotificationController extends Controller
{
    public function sendToTelegram()
    {
        $user = User::create([
            'name' => "n",
            'email' => "ahsan@apik.com",
            'password' => "hellomydamnworld",
        ]);

        $user->notify(new Telegram());
    }
}
