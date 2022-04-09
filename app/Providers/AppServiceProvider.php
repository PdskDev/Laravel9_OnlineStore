<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Stripe\Stripe;


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
     //Use Bootstrap pagination
     Paginator::useBootstrapFive();

     Stripe::setApiKey(env('STRIPE_KEY'));
    }
}
