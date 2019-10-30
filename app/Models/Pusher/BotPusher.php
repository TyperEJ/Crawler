<?php

namespace App\Models\Pusher;

use App\Models\Bot\BotFactory;
use App\Models\Entities\LineMember;
use App\Models\Entities\PttArticle;
use LINE\LINEBot\MessageBuilder;

class BotPusher implements Pusher
{
    public static function push(LineMember $lineMember, PttArticle $pttArticle)
    {
        $bot = BotFactory::make($lineMember);

        $message = new MessageBuilder\TextMessageBuilder($pttArticle->getText());

        $bot->broadcast($message);
    }
}