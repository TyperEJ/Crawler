<?php

namespace App\Providers;

use App\Models\Pusher\NotifyPusher;
use App\Models\Pusher\Pusher;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    }
}
