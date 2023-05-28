<?php

namespace App\Providers;

use App\paymentGetWay\GetWayInterface;
use App\paymentGetWay\Zarinpal;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::usebootstrap();
        app()->singleton(GetWayInterface::class,Zarinpal::class);
    }
}
