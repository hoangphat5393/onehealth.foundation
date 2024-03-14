<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gornymedia\Shortcodes\Facades\Shortcode;

class ShortcodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // Short code
        Shortcode::add('example', function ($atts, $content, $name) {
            $a = Shortcode::atts([
                'name' => $name,
                'foo' => 'something',
            ], $atts);

            return "foo = {$a['foo']}";
        });

        // Slider
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

        // Staff
        Shortcode::add('staff', function ($atts, $id, $items = 3) {
            $data = Shortcode::atts([
                'id' => $id,
                'items' => $items
            ], $atts);

            $file = 'shortcode/staff'; // ex: resource/views/partials/ $atts['name'] .blade.php
            // dd($data);
            if (view()->exists($file)) {
                return view($file, compact('data'));
            }
        });

        // Campagin list
        Shortcode::add('campagin', function ($atts, $id, $items = 3) {
            // Chuyển đổi $items thành số nguyên
            $items = intval($items);

            $data = Shortcode::atts([
                'items' => $items
            ], $atts);

            // Bỏ giới hạn và chỉ phân trang
            $projects = \App\Campaign::paginate($items);

            $file = 'shortcode/campagin'; // ex: resource/views/partials/ $atts['name'] .blade.php
            // dd($data);
            if (view()->exists($file)) {
                return view($file, compact('projects', 'data'));
            }
        });

        // Shortcode::add('widget', function ($atts, $content, $name) {
        //     $a = Shortcode::atts([
        //         'name' => $name,
        //         'foo' => 'something'
        //     ], $atts);

        //     $file = 'partials/' . $a['name']; // ex: resource/views/partials/ $atts['name'] .blade.php

        //     if (view()->exists($file)) {
        //         return view($file, $a);
        //     }
        // });
    }
}
