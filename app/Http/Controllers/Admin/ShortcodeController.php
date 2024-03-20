<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Libraries\Helpers;
use App\Models\Shortcode;

class ShortcodeController extends Controller
{
    public $data = [];

    public function index()
    {
        $appends = [
            'search_name' => request('search_name'),
        ];

        $db = Shortcode::select('*');
        if (request('search_name') != '') {
            $db->where('name', 'like', '%' . request('search_name') . '%');
        }
        $count_item = $db->count();
        $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);

        return view('admin.shortcode.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.shortcode.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['edit_data'] = Shortcode::find($id);
        if ($this->data['edit_data']) {
            return view('admin.shortcode.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang']);

        // Request ID
        $sid = $request->id ?? 0;

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';

        // $data['description'] = $request->description ? htmlspecialchars($request->description) : '';
        // $data['content'] = $request->content ? htmlspecialchars($request->content) : '';

        // $data['description_en'] = $request->description_en ? htmlspecialchars($request->description_en) : '';
        // $data['content_en'] = $request->content_en ? htmlspecialchars($request->content_en) : '';

        //xử lý gallery
        $galleries = $request->gallery ?? '';
        if ($galleries != '') {
            $galleries = array_filter($galleries);
            $data['gallery'] = $galleries ? serialize($galleries) : '';
        }
        //end xử lý gallery

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Shortcode::where("id", $sid)->update($data);
        } else {
            $respons = Shortcode::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // // if sort = 0 => update sort
            Shortcode::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        if ($save == 'apply') {
            $msg = "Shortcode has been Updated";
            $url = route('admin.shortcodeEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.shortcodeList'));
        }
    }
}
