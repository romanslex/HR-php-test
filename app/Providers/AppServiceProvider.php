<?php

namespace App\Providers;

use App\Implementations\Weather\YandexWeatherService;
use App\IWeatherService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IWeatherService::class, YandexWeatherService::class);
    }
}
