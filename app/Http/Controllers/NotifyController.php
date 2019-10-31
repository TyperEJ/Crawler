<?php

namespace App\Http\Controllers;

use TyperEJ\LineNotify\Notify;

class NotifyController extends Controller
{
    public function register(Notify $notify)
    {
        $options = [
            'state' => 'default',
            'redirect_uri' => request()->get('url'),
        ];

        $url = $notify->generateSubscribeUrl($options);

        return $url;
    }

    public function callback(Notify $notify)
    {
        if (!request()->exists('code')) {
            return response()
                ->json('code is required')
                ->setStatusCode(400);
        }

        $code = request()->get('code');

        try {

            $token = $notify->requestToken($code, request()->get('url'));

        } catch (\Exception $e) {
            return response()
                ->json('please try register notify again')
                ->setStatusCode(400);
        }

        $lineMember = auth('api')->user();

        $lineMember->notify_token = $token;

        $lineMember->save();

        return response()
            ->json('success')
            ->setStatusCode(200);
    }

    public function isRegistered()
    {
        $lineMember = auth('api')->user();

        $boolean =  $lineMember->notify_token ? true : false;

        return response()
            ->json($boolean)
            ->setStatusCode(200);
    }
}
