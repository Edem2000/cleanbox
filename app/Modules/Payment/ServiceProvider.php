<?php

namespace App\Modules\Payment;

use App\Modules\Payment\Services\PaymentService;
use Illuminate\Support\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadTranslationsFrom(__DIR__.'/Lang', 'payment');

        $this->loadViewsFrom(__DIR__.'/Views', 'payment');

        $this->publishes([
            __DIR__.'/Config/gateways.php' => config_path('gateways.php')
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(PaymentService::class, function () {
            return new PaymentService;
        });

        $this->app->alias(PaymentService::class, 'payment');
    }
}