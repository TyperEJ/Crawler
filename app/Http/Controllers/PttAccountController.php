<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PttAccountController extends Controller
{
    public function index()
    {
        $lineMember = auth('api')->user();

        return response()
            ->json([
                'account' => $lineMember->ptt_account,
                'password' => $lineMember->ptt_password ? decrypt($lineMember->ptt_password) : null,
            ]);
    }

    public function update(Request $request)
    {
        $lineMember = auth('api')->user();

        $request->validate([
            'account' => 'required|regex:/^[\pL\pM\pN]+$/u',
            'password' => 'required',
        ]);

        $lineMember->ptt_account = request()->post('account');
        $lineMember->ptt_password = encrypt(request()->post('password'));

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }
}
