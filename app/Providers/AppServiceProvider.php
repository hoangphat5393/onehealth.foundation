<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
// use Harimayco\Menu\Facades\Menu;
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

        // Short code
        Shortcode::add('example', function ($atts, $content, $name) {
            $a = Shortcode::atts([
                'name' => $name,
                'foo' => 'something',
            ], $atts);

            return "foo = {$a['foo']}";
        });

        // Short code
        Shortcode::add('slider', function ($atts, $id, $items = 3) {
            $data = Shortcode::atts([
                'id' => $id,
                'items' => $items
            ], $atts);

            $file = 'shortcode/slider'; // ex: resource/views/partials/ $atts['name'] .blade.php
            // dd($data);
            if (view()->exists($file)) {
                return view($file, compact('data'));
            }
        });

        Shortcode::add('widget', function ($atts, $content, $name) {
            $a = Shortcode::atts([
                'name' => $name,
                'foo' => 'something'
            ], $atts);

            $file = 'partials/' . $a['name']; // ex: resource/views/partials/ $atts['name'] .blade.php

            if (view()->exists($file)) {
                return view($file, $a);
            }
        });

        Shortcode::add('section', function ($atts, $section, $section_name) {
            $data = Shortcode::atts([
                'section_name' => $section_name,
                'section' => $section,
            ], $atts);

            $file = 'shortcode/' . $data['section_name']; // ex: resource/views/partials/ $atts['name'] .blade.php

            if (view()->exists($file)) {
                return view($file, compact('data'));
            }
        });
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
