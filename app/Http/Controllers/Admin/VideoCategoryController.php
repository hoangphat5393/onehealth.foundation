<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use DB, File, Image, Config;

class VideoCategoryController extends Controller
{
    public $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['title_head'] = __('Danh mục video');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Category::where(['type' => 'video', 'parent' => 0])->orderBy('sort', 'asc')->paginate(20);

        $total_item = $categories->count();

        return view('admin.video-category.index', compact('categories', 'total_item'));
    }


    public function create()
    {
        return view('admin.video-category.single', ['data' => $this->data]);
    }

    public function edit($id)
    {
        $this->data['category'] = Category::find($id);
        if ($this->data['category']) {
            return view('admin.video-category.single', ['data' => $this->data]);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang', 'custom_field']);

        // id post
        $sid = $request->id ?? 0;

        $data['slug'] = addslashes($request->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        // $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];
        $data['type'] = 'video';

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Category::where("id", $sid)->update($data);
        } else {
            $respons = Category::create($data);
            $insert_id = $respons->id;

            // if sort = 0 => update sort
            Category::where("id", $insert_id)->update(['sort' => $insert_id]);
        }

        if ($save == 'apply') {
            $msg = "Category has been Updated";
            $url = route('admin.videoCategoryEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.videoCategoryList'));
        }
    }
}
