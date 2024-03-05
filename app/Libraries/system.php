<?php


use App\Models\Setting;
use App\Models\SettingCost;
use App\Models\ShopCurrency;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
// use App\Models\Product;
// use App\Models\ProductPromotion;


if (!function_exists('setting_option')) {
    function setting_option($variable = '')
    {
        if (Cache::has('theme_option'))
            $data = Cache::get('theme_option');
        else {
            $data = Setting::get();
            Cache::forever('theme_option', $data);
        }
        if ($data) {
            $option = $data->where('name', $variable)->first();
            // dd($option);
            if ($option) {
                $content = $option->content;
                if ($option->type == 'editor' || $option->type == 'text')
                    $content = htmlspecialchars_decode(htmlspecialchars_decode($content));
                return $content;
            }
        }
    }
}

if (!function_exists('setting_cost')) {
    function setting_cost($variable = '')
    {
        $data = SettingCost::get();
        if ($data) {
            $option = $data->where('name', $variable)->first();
            // dd($option);
            if ($option) {
                $content = $option->content;
                if ($option->type == 'editor' || $option->type == 'text')
                    $content = htmlspecialchars_decode(htmlspecialchars_decode($content));
                return $content;
            }
        }
    }
}

if (!function_exists('get_template')) {
    function get_template()
    {
        return Helpers::getTemplatePath();
    }
}

if (!function_exists('render_price')) {
    function render_price(float $money, $currency = null, $rate = null, $space_between_symbol = false, $useSymbol = true)
    {
        return ShopCurrency::render($money, $currency, $rate, $space_between_symbol, $useSymbol);
    }
}
if (!function_exists('render_option_name')) {
    function render_option_name($att)
    {
        if ($att) {
            $att_array = explode('__', $att);
            if (isset($att_array[0]))
                return $att_array[0];
        }
    }
}
if (!function_exists('render_option_price')) {
    function render_option_price($att)
    {
        if ($att) {
            $att_array = explode('__', $att);
            if (isset($att_array[2]))
                return render_price($att_array[2]);
            elseif (isset($att_array[1]))
                return render_price($att_array[1]);
        }
    }
}
if (!function_exists('auto_code')) {
    function auto_code($code = 'Order', $cart_id = 0)
    {
        $number_start = 5000;
        // $strtime_conver=strtotime(date('d-m-Y H:i:s'));
        // $strtime=substr($strtime_conver,-4);
        // $rand=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4);
        $string_rand = $code . '-' . ($number_start + $cart_id);
        return $string_rand;
    }
}

if (!function_exists('get_image')) {
    function get_image($item_image = '')
    {
        $image = asset('images/placeholder.png');

        // replace space code
        $item_image = str_replace('%20', ' ', $item_image);

        // if ($item_image && File::exists(public_path($item_image))) {
        if ($item_image && file_exists(public_path($item_image))) {
            // Nếu host chưa trỏ vào thư mục public
            // $image = '/public/' . $item_image;
            // Host đã trỏ vào thư mục public
            $image = $item_image;
        }
        return $image;
    }
}

if (!function_exists('setting_phone')) {
    function setting_phone($phone = '')
    {
        // $re = '~\s|\([^)]*\)~m';
        // $phone = preg_replace($re, '', $phone);
        $string = Str::swap([
            '(' => '',
            ')' => '',
            '.' => '',
            ' ' => '',
        ], $phone);

        return $string;
    }
}
