<?php

namespace App\Providers;

use App\Contracts\CurrencyConversion;
use App\Support\FloatRatesCurrencyConversion;
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
        $this->app->bind(CurrencyConversion::class, FloatRatesCurrencyConversion::class);
    }
}
