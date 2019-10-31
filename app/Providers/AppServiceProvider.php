<?php

namespace App\Providers;

use App\Models\Pusher\NotifyPusher;
use App\Models\Pusher\Pusher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->bind(Pusher::class,NotifyPusher::class);

        $this->app->bind(HTTPClient::class, function () {
            return new CurlHTTPClient(config('line.line_bot.channel_token'));
        });

        $args = ['channelSecret' => config('line.line_bot.channel_secret')];

        $this->app->when(LineBot::class)
            ->needs('$args')
            ->give($args);
    }
}
