<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Libraries\Helpers;
use Auth, DB, File, Image;



class PageController extends Controller
{
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
        $data_page = Page::orderby('sort', 'asc')->paginate(20);
        return view('admin.page.index')->with(['pages' => $data_page]);
    }

    public function create()
    {
        return view('admin.page.single');
    }

    public function edit($id)
    {
        $page_detail = Page::where('page.id', '=', $id)->first();

        if ($page_detail) {
            return view('admin.page.single')->with(['page_detail' => $page_detail]);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang', 'custom_field']);

        //id post
        $sid = $request->id ?? 0;

        if ($request->slug) {
            $data['slug'] = addslashes($request->slug);
        } else {
            $data['slug'] = Str::slug($data['title']);
        }

        // $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        // $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['title'];

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

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;

            // POST ADMIN ID
            $data['admin_id'] = Auth::guard('admin')->user()->id;

            $respons = Page::where("id", $sid)->update($data);
        } else {
            $respons = Page::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // if sort = 0 => update sort
            Page::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        // $category_id = $request->category_id ?? '';
        // if ($category_id != '') {
        //     $product = Post::find($post_id);
        //     $product->categories()->sync($category_id);
        // }

        if ($save == 'apply') {
            $msg = "Page has been Updated";
            $url = route('admin.pageEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.pageList'));
        }
    }
}
