<?php

namespace App\Http\Controllers;

use App\Models\Bot\BotService;

class BotController extends Controller
{
    public function index()
    {
        $lineMember = auth('api')->user();

        return response()
            ->json($lineMember);
    }

    public function update()
    {
        $lineMember = auth('api')->user();

        $lineMember->channel_secret = request()->get('channelSecret');
        $lineMember->channel_token = request()->get('channelToken');

        if(!BotService::validate($lineMember->channel_token,$lineMember->channel_secret))
        {
            return response()
                ->json('請檢查填寫參數是否正確')
                ->setStatusCode(418);
        }

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
