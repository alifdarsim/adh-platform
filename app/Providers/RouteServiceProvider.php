<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\PendingResourceRegistration;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->prefix('admin')
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->prefix('expert')
                ->group(base_path('routes/expert.php'));

            Route::middleware('web')
                ->prefix('client')
                ->group(base_path('routes/client.php'));
        });

        if (! PendingResourceRegistration::hasMacro('withDatatable')) {
            PendingResourceRegistration::macro('withDatatable', function () {
                $name = Str::replace('/', '', $this->name);
                Route::get(
                    "{$name}/datatables",
                    [$this->controller, 'datatable']
                )->name("{$this->options['names']}.datatable");

                return $this;
            });
        }
    }
}
