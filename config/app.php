<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    'name' => env('APP_NAME', 'Laravel'),
    'company_name' => env('COMPANY_NAME', 'Laravel'),
    'env' => env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),

    'url' => env('APP_URL', 'http://localhost'),
    'landing_page' => env('LANDING_APP_URL', 'http://localhost:3001'),
    'app_page' => env('EXPERT_APP_URL', 'http://localhost:8080'),

    'timezone' => 'UTC',

    'locale' => 'en',

    'fallback_locale' => 'en',

    'faker_locale' => 'en_US',

    'key' => env('APP_KEY'),
    'cipher' => 'AES-256-CBC',

    'maintenance' => [
        'driver' => 'file',
    ],

    'providers' => ServiceProvider::defaultProviders()->merge([
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Yajra\DataTables\DataTablesServiceProvider::class,
        \Torann\GeoIP\GeoIPServiceProvider::class,
        Jenssegers\Agent\AgentServiceProvider::class,
    ])->toArray(),

    'aliases' => Facade::defaultAliases()->merge([
        'DataTables' => Yajra\DataTables\Facades\DataTables::class,
        'GeoIP' => \Torann\GeoIP\Facades\GeoIP::class,
        'Agent' => Jenssegers\Agent\Facades\Agent::class,
    ])->toArray(),

];
