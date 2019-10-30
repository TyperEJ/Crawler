<?php

namespace App\Models\Pusher;

use App\Models\Entities\LineMember;
use App\Models\Entities\PttArticle;
use TyperEJ\LineNotify\Message;
use TyperEJ\LineNotify\Notify;

class NotifyPusher implements Pusher
{
    public static function push(LineMember $lineMember, PttArticle $pttArticle)
    {
        $message = new Message($pttArticle->getText());

        Notify::sendMessage($lineMember->notify_token,$message);
    }
}