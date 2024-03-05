<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Models\Category;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class VideoController extends Controller
{
    public $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $appends = [
            'category_id' => request('category_id'),
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $db = Video::select('*');
            if (request('category_id')) {
                $db = $db->join('video_category', 'id', 'video.id');
                $db->where('category_id', request('category_id'));
            }
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            // $data_post = $db->get();
            $data = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        } else {
            $data = Video::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(20)
                ->appends($appends);
            $count_item = Video::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.video.index')->with(['data' => $data, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.video.single', $this->data);
    }

    public function edit($id)
    {

        $this->data['video'] = Video::find($id);
        if ($this->data['video']) {
            return view('admin.video.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang', 'custom_field']);

        //id post
        $sid = $request->id ?? 0;

        $data['slug'] = addslashes($request->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        // $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Video::where("id", $sid)->update($data);
        } else {
            $respons = Video::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // // if sort = 0 => update sort
            Video::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';
        if ($category_id != '') {
            $video = Video::find($post_id);
            $video->categories()->sync($category_id);
        }

        if ($save == 'apply') {
            $msg = "Post has been Updated";
            $url = route('admin.videoEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.videoList'));
        }
    }
}
