<?php

namespace App\Http\Controllers;

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

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
