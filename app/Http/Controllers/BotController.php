<?php

namespace App\Http\Controllers;

use App\Models\Entities\LineMember;

class BotController extends Controller
{
    public function index()
    {
        $lineMember = auth('api')->user();

        if(!$lineMember)
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        return response()
            ->json($lineMember);
    }

    public function update()
    {
        $lineMember = auth('api')->user();

        if(!$lineMember)
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        $lineMember->channel_secret = request()->get('channelSecret');
        $lineMember->channel_token = request()->get('channelToken');

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
