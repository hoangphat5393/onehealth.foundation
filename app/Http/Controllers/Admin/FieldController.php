<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class FieldController extends Controller
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
            // 'category_id' => request('category_id'),
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $db = Field::select('*');
            // if (request('category_id')) {
            //     $db = $db->join('post_category', 'id', 'post.id');
            //     $db->where('category_id', request('category_id'));
            // }
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        } else {
            $data_post = Field::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(20)
                ->appends($appends);
            $count_item = Field::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.field.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        $listSection = range(1, 10);
        $listType = ['text', 'image'];
        return view('admin.field.single', compact('listSection', 'listType'));
    }


    public function edit($id)
    {
        $this->data['field'] = Field::find($id);
        $this->data['listType'] = ['text', 'image'];
        $this->data['listSection'] = range(1, 10);
        if ($this->data['field']) {
            return view('admin.field.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang']);

        // Field id
        $sid = $request->id ?? 0;

        // dd($data);

        // $data['slug'] = addslashes($request->slug);
        // if ($data['slug'] == '') **
        // $data['handleId'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        // if (empty($slug) || $slug == '')
        //     $slug = Str::slug($data['name']);

        $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';

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
            $respons = Field::where("id", $sid)->update($data);
        } else {
            $respons = Field::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // if sort = 0 => update sort
            Field::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        // $category_id = $request->category_id ?? '';
        // if ($category_id != '') {
        //     $product = Field::find($post_id);
        //     $product->categories()->sync($category_id);
        // }

        if ($save == 'apply') {
            $msg = "Field has been Updated";
            $url = route('admin.fieldEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.fieldList'));
        }
    }
}
