<?php

namespace App\Http\Controllers;

use App\Enums\BoardListEnum;
use App\Models\Entities\LineMember;

class SubscribeController extends Controller
{
    public function listBoard()
    {
        return response()
            ->json(BoardListEnum::getList());
    }

    public function index($uid)
    {
        $queryMember = LineMember::query()
            ->where(['uid' => $uid]);

        if(!$queryMember->exists())
        {
            return response()
                ->json('not found line member')
                ->setStatusCode(404);
        }

        $keywords = $queryMember->first()->keywords;

        return response()
            ->json($keywords);
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

        $lineMember->keywords()->delete();

        $keywords = request()->get('subscribes');

        $lineMember->keywords()->createMany($keywords);

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
