<?php

namespace App\Providers;

use App\Http\Routing\ResourceRegistrar;
use Illuminate\Routing\Router;
use Illuminate\Routing\ResourceRegistrar as BaseResourceRegistrar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(BaseResourceRegistrar::class, ResourceRegistrar::class);
    }
}
