<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Category;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class FaqController extends Controller
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
            'page_id' => request('page_id'),
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $db = Faq::select('*');
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            if (request('page_id') != '') {
                $db->where('page_id', request('page_id'));
            }
            $count_item = $db->count();
            $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        } else {
            $data_post = Faq::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(20)
                ->appends($appends);
            $count_item = Faq::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.faq.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.faq.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['faq'] = Faq::find($id);
        if ($this->data['faq']) {
            return view('admin.faq.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'created_at', 'submit', 'tab_lang']);

        //id faq
        $sid = $request->id ?? 0;



        // $data['slug'] = addslashes($request->slug);

        // if ($data['slug'] == '') **
        // $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        // if (empty($slug) || $slug == '')
        //     $slug = Str::slug($data['name']);

        // $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';

        // $data['description'] = $request->description ? htmlspecialchars($request->description) : '';
        // $data['content'] = $request->content ? htmlspecialchars($request->content) : '';

        // $data['description_en'] = $request->description_en ? htmlspecialchars($request->description_en) : '';
        // $data['content_en'] = $request->content_en ? htmlspecialchars($request->content_en) : '';

        //xử lý gallery
        // $galleries = $request->gallery ?? '';
        // if ($galleries != '') {
        //     $galleries = array_filter($galleries);
        //     $data['gallery'] = $galleries ? serialize($galleries) : '';
        // }
        //end xử lý gallery

        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $request->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Faq::where("id", $sid)->update($data);
        } else {
            $respons = Faq::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // // if sort = 0 => update sort
            Faq::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // // SAVE CATEGORY
        // $page_id = $request->page_id ?? '';
        // if ($page_id != '') {
        //     $product = Faq::find($post_id);
        //     $product->page()->sync($page_id);
        // }

        if ($save == 'apply') {
            $msg = "Faq has been Updated";
            $url = route('admin.faqEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.faqList'));
        }
    }
}
