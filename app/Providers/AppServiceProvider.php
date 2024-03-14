<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Gornymedia\Shortcodes\Facades\Shortcode;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Verify\Service',
            'App\Services\Twilio\Verification'
        );
        $this->registerRouteMiddleware();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('templatePath', env('APP_THEME', 'theme'));
        view()->share('templateFile', env('APP_THEME', 'theme'));

        Paginator::useBootstrap();
    }

    /**
     * Register the route middleware.
     *
     * @return void
     */
    protected function registerRouteMiddleware()
    {
        // register route middleware.
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
    }

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'currency' => \App\Http\Middleware\Currency::class
    ];
}
