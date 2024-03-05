<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use DB, File, Image, Config;

class PostCategoryController extends Controller
{
    public $data = [];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->data['title_head'] = __('Danh mục tin tức');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $categories = Category::where(['type' => 'post', 'parent' => 0])->orderBy('sort', 'asc')->paginate(20);

        $total_item = $categories->count();

        return view('admin.post-category.index', compact('categories', 'total_item'));
    }


    public function create()
    {
        return view('admin.post-category.single', ['data' => $this->data]);
    }

    public function edit($id)
    {
        $this->data['category'] = Category::find($id);
        if ($this->data['category']) {
            return view('admin.post-category.single', ['data' => $this->data]);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token', 'tab_lang', 'gallery', 'category_id', 'created_at', 'submit', 'custom_field']);

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
        $data['type'] = 'post';

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Category::where("id", $sid)->update($data);
        } else {
            $respons = Category::create($data);
            $post_id = $respons->id;

            // if sort = 0 => update sort
            Category::where("id", $post_id)->update(['sort' => $post_id]);
        }

        if ($save == 'apply') {
            $msg = "Category has been Updated";
            $url = route('admin.postCategoryEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.postCategoryList'));
        }
    }
}
