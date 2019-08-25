<?php

namespace App\Http\Controllers;

use App\Models\Entities\LineMember;
use App\Models\Entities\MemberBoardKeyword;
use Illuminate\Http\Request;

class LineMemberController extends Controller
{
    public function show($uid)
    {
        $queryMember = LineMember::query()->firstOrCreate(['uid' => $uid]);

        if(!$queryMember->exists())
        {
            return response('Not Found LineMember',404);
        }

        return $queryMember->first();
    }

    public function store(Request $request)
    {
        $uid = $request->get('uid');

        $lineMember = LineMember::firstOrNew(
            [
                'uid' =>$uid
            ]
        );

        $lineMember->keywords()->delete();

        $keywords =  $request->get('keywords');

        $lineMember->keywords()->createMany($keywords);
    }
}
