<?php

namespace App\Http\Controllers;

use App\Models\Entities\LineMember;
use App\Models\Entities\MemberBoardKeyword;
use Illuminate\Http\Request;

class LineMemberController extends Controller
{
    public function show($uid)
    {
        $lineMember = LineMember::query()
            ->with('keywords')
            ->firstOrCreate(['uid' => $uid]);

        return $lineMember;
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
