<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class PostController extends Controller
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
        // if (Auth::guard('admin')->user()->admin_level == 99999) {
        //     $db = Post::select('*');
        //     if (request('category_id')) {
        //         $db = $db->join('post_category', 'post_id', 'post.id');
        //         $db->where('category_id', request('category_id'));
        //     }
        //     if (request('search_name') != '') {
        //         $db->where('name', 'like', '%' . request('search_name') . '%');
        //     }
        //     $count_item = $db->count();
        //     $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        // } else {
        //     $data_post = Post::where('admin_id', '=', Auth::guard('admin')->user()->id)
        //         ->orderByDesc('sort')
        //         ->paginate(20)
        //         ->appends($appends);
        //     $count_item = Post::where('admin_id', '=', Auth::guard('admin')->user()->id)
        //         ->count();
        // }

        $db = Post::select('*');
        if (request('category_id')) {
            $db = $db->join('post_category', 'post_id', 'post.id');
            $db->where('category_id', request('category_id'));
        }
        if (request('search_name') != '') {
            $db->where('name', 'like', '%' . request('search_name') . '%');
        }
        $count_item = $db->count();
        $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);

        return view('admin.post.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.post.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['edit_data'] = Post::find($id);
        if ($this->data['edit_data']) {
            return view('admin.post.single', $this->data);
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
        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

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

        $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Post::where("id", $sid)->update($data);
        } else {
            $respons = Post::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // // if sort = 0 => update sort
            Post::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';
        if ($category_id != '') {
            $product = Post::find($post_id);
            $product->categories()->sync($category_id);
        }

        if ($save == 'apply') {
            $msg = "Post has been Updated";
            $url = route('admin.postEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.postList'));
        }
    }
}
