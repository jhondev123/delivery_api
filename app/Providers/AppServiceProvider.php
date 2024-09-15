<?php

namespace App\Providers;

use App\Services\DbConfigService;
use Illuminate\Support\ServiceProvider;
use App\Domain\interfaces\AddressValidator;
use App\Infra\services\AddressValidator\ViacepAddressValidator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('dbconfig', function ($app) {
            return new DbConfigService();
        });
        $this->app->bind(AddressValidator::class, ViacepAddressValidator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
