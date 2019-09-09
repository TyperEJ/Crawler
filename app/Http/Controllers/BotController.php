<?php

namespace App\Http\Controllers;

use App\Models\Entities\LineMember;

class BotController extends Controller
{
    public function index($uid)
    {
        $queryMember = LineMember::query()
            ->select(['channel_secret','channel_token'])
            ->where(['uid' => $uid]);

        if(!$queryMember->exists())
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        $lineMember = $queryMember->first();

        return response()
            ->json($lineMember);
    }

    public function update($uid)
    {
        $queryMember = LineMember::query()
            ->where(['uid' => $uid]);

        if(!$queryMember->exists())
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        $lineMember = $queryMember->first();

        $lineMember->channel_secret = request()->get('channelSecret');
        $lineMember->channel_token = request()->get('channelToken');

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
