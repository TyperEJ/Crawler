<?php

namespace App\Http\Controllers;

class PttAccountController extends Controller
{
    public function index()
    {
        $lineMember = auth('api')->user();

        return response()
            ->json([
                'account' => $lineMember->ptt_account,
                'password' => decrypt($lineMember->ptt_password),
            ]);
    }

    public function update()
    {
        $lineMember = auth('api')->user();

        $lineMember->ptt_account = request()->post('account');
        $lineMember->ptt_password = encrypt(request()->post('password'));

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
