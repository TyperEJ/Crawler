<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineBotProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $channelToken = config('line.message_token');
        $channelSecret = config('line.message_secret');

        $this->app->bind(HTTPClient::class,function() use ($channelToken){
            return new CurlHTTPClient($channelToken);
        });

        $args = ['channelSecret'=>$channelSecret];

        $this->app->when(LineBot::class)
            ->needs('$args')
            ->give($args);
    }
}
