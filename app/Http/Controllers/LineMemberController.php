<?php

namespace App\Http\Controllers;

use App\Models\Entities\LineMember;
use TyperEJ\LineLogin\Login;

class LineMemberController extends Controller
{
    public function register(Login $login)
    {
        $options = [
            'state' => 'default',
            'redirect_uri' => request()->get('url'),
        ];

        $url = $login->generateLoginUrl($options);

        return $url;
    }

    public function callback(Login $login)
    {
        if(!request()->exists('code'))
        {
            return response()
                ->json('code is required')
                ->setStatusCode(400);
        }

        $code = request()->get('code');

        try{

            $user = $login->requestToken($code,request()->get('url'));

            $uid = $user->sub;

        }catch (\Exception $e){
            return response()
                ->json('please login again')
                ->setStatusCode(400);
        }

        $lineMember = LineMember::query()->firstOrCreate([
            'uid' => $uid
        ]);

        $token = auth('api')->login($lineMember);

        return response()
            ->json([
                'token' => $token
            ])
            ->setStatusCode(200);
    }
}
