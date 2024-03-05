<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Libraries\Helpers;
use Illuminate\Support\Str;

use App\Models\SettingCost;

class SettingCostController extends Controller
{
    public function index()
    {
        $data['settings'] = \App\Models\SettingCost::orderBy('sort')->get();
        $data['url_action'] = route('admin_setting_cost');
        $data['title'] = 'Cài đặt thành viên';

        return view('admin.setting-cost.index', $data);
    }

    public function store()
    {
        $data = request()->all();
        // dd($data);
        $data_option = $data['header_option'];
        $i = 0;
        $list_option = [];
        // dd($data_option);
        if ($data_option) {
            foreach ($data_option as $key => $option) {
                $type = $key;
                foreach ($option['name'] as $index => $item) {
                    $content = htmlspecialchars($option['value'][$index]);
                    if ($type == 'editor')
                        $content = htmlspecialchars($content);
                    $option_db = SettingCost::updateOrCreate(
                        [
                            'name'  => $item
                        ],
                        [
                            'content'   => $content,
                            'title'   => $option['title'][$index],
                            'type'   => $type,
                            'sort'   => $i,
                        ]
                    );
                    $list_option[] = $option_db->id;
                    $i++;
                }
            }
        }
        //delete;
        SettingCost::whereNotIn('id', $list_option)->delete();
        $msg = "Option has been registered";
        $url = route('admin_setting_cost');
        Helpers::msg_move_page($msg, $url);
    }
}
