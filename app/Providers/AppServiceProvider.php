<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\WoocommerceService;
use App\Services\Contracts\WoocommerceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WoocommerceInterface::class, WoocommerceService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
