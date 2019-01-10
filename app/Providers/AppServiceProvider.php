<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::disableForeignKeyConstraints();
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();
        Schema::enableForeignKeyConstraints();
        Blade::if('member', function () {
            return false;
        });
        Blade::directive('welcome', function () {
            return '<h1 class="text-align: center"> Welcome to our website </h1>';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Contracts\Shape', function ($app) {
            return new \App\Helpers\Shape;
        });
    }
}