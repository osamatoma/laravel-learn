<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;

class ObserveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}