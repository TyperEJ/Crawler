<?php

namespace App\Models\Bot;

use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class BotService
{
    public static function validate($channelToken,$channelSecret)
    {
        $httpClient = new CurlHTTPClient($channelToken);

        $bot = new LINEBot($httpClient, ['channelSecret' => $channelSecret]);

        try{
            $res = $bot->getFriendDemographics();

            if($res->getHTTPStatus() != 200)
            {
                return false;
            }
        }catch (\Exception $e)
        {
            return false;
        }

        return true;
    }
}
