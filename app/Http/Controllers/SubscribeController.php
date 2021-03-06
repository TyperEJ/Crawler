<?php

namespace App\Http\Controllers;

use App\Enums\BoardListEnum;

class SubscribeController extends Controller
{
    public function listBoard()
    {
        return response()
            ->json(BoardListEnum::getList());
    }

    public function index()
    {
        $lineMember = auth('api')->user();

        $keywords = $lineMember->keywords;

        return response()
            ->json($keywords);
    }

    public function update()
    {
        $lineMember = auth('api')->user();

        $lineMember->keywords()->delete();

        $keywords = request()->get('subscribes');

        $lineMember->keywords()->createMany($keywords);

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
