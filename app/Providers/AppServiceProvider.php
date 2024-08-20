<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\Paginator;
use App\Services\ThirdPartyApiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ThirdPartyApiService::class, function ($app) {
            return new ThirdPartyApiService('Q3IGWET6Bl3', 'WaeNBBcSzMvxOoZdPchv');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = request()->segment(1);
        App::setLocale($locale);
        Config::set('app.locale', $locale);
        Paginator::defaultView('vendor.pagination.custom');

        if (!Session::has('country')) {
            // Set the default country in the session
            Session::put('country', 'United Kingdom');
        }
    }
}
