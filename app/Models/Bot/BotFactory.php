<?php

namespace App\Models\Bot;

use App\Models\Entities\LineMember;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class BotFactory
{
    public static function make(LineMember $lineMember)
    {
        $httpClient = new CurlHTTPClient($lineMember->channel_token);

        return new LINEBot($httpClient, ['channelSecret' => $lineMember->channel_secret]);
    }
}