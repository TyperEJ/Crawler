<?php

namespace App\Providers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use TyperEJ\LineNotify\Notify;

class LineNotifyProvider extends ServiceProvider
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
        $channelId = config('line.line_notify.channel_id');

        $channelSecret = config('line.line_notify.channel_secret');

        $this->app->when(Notify::class)
            ->needs('$clientId')
            ->give($channelId);
        $this->app->when(Notify::class)
            ->needs('$clientSecret')
            ->give($channelSecret);
    }
}
