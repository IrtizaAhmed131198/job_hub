<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PayPal\Checkout\Orders\OrdersCreateRequest;
use PayPal\Checkout\Orders\OrdersCaptureRequest;
use PayPal\Checkout\Orders\OrdersGetRequest;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;

class PayPalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(ApiContext::class, function ($app) {
            return new ApiContext(
                new OAuthTokenCredential(
                    env('PAYPAL_CLIENT_ID'),
                    env('PAYPAL_CLIENT_SECRET')
                )
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
