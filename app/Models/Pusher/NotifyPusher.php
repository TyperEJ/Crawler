<?php

namespace App\Models\Pusher;

use App\Models\Entities\LineMember;
use App\Models\Entities\PttArticle;
use Illuminate\Support\Facades\Log;
use TyperEJ\LineNotify\Message;
use TyperEJ\LineNotify\Notify;

class NotifyPusher implements Pusher
{
    public static function push(LineMember $lineMember, PttArticle $pttArticle)
    {

        if(!$lineMember->notify_token)
        {
            return ;
        }

        Log::channel('push_message')->info($lineMember.'::'.$pttArticle);

        $message = new Message($pttArticle->getText());

        Notify::sendMessage($lineMember->notify_token,$message);
    }
}