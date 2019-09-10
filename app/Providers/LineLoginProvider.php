<?php

namespace App\Providers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use TyperEJ\LineLogin\Login;

class LineLoginProvider extends ServiceProvider
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
        $channelId = config('line.line_login.channel_id');

        $channelSecret = config('line.line_login.channel_secret');

        $this->app->when(Login::class)
            ->needs('$clientId')
            ->give($channelId);
        $this->app->when(Login::class)
            ->needs('$clientSecret')
            ->give($channelSecret);
    }
}
