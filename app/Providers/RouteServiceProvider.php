<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
<<<<<<< HEAD
     * The path to the "home" route for your application.
=======
     * The path to your application's "home" route.
>>>>>>> fbbc4ac (init)
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
<<<<<<< HEAD
    public const HOME = '/home';
=======
    public const HOME = '/dashboard';
>>>>>>> fbbc4ac (init)

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        $this->configureRateLimiting();
=======
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
>>>>>>> fbbc4ac (init)

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
<<<<<<< HEAD

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
=======
>>>>>>> fbbc4ac (init)
}
