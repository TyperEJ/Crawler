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
        $lineMember = auth()->user();

        $channelToken = $lineMember->channel_token;

        $this->app->bind(HTTPClient::class,function() use ($channelToken){
            return new CurlHTTPClient($channelToken);
        });

        $channelSecret = $lineMember->channel_secret;

        $args = ['channelSecret'=>$channelSecret];
        $this->app->when(LineBot::class)
            ->needs('$args')
            ->give($args);
    }
}