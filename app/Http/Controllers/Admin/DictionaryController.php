<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Dictionary;
use App\Models\Category;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class DictionaryController extends Controller
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
            $db = Dictionary::select('*');
            if (request('category_id')) {
                $db = $db->join('dictionary_category', 'dictionary_id', 'id');
                $db->where('category_id', request('category_id'));
                $db->where('type', 'post');
            }
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            // $data_post = $db->get();
            $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        } else {
            $data_post = Dictionary::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(20)
                ->appends($appends);
            $count_item = Dictionary::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.dictionary.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.dictionary.single', $this->data);
    }

    public function edit($id)
    {

        $this->data['dictionary'] = Dictionary::find($id);
        if ($this->data['dictionary']) {
            return view('admin.dictionary.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $rq)
    {
        $data = request()->except(['_token',  'gallery', 'variable', 'category_id', 'created_at', 'submit', 'category_item', 'tab_lang', 'custom_field', 'type']);

        //id post
        $sid = $rq->id ?? 0;

        $data['slug'] = addslashes($rq->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        $data['description'] = $rq->description ? htmlspecialchars($rq->description) : '';
        // $data['content'] = $rq->content ? htmlspecialchars($rq->content) : '';

        //lang
        $tab_langs = $rq->tab_lang ?? '';
        if (is_array($tab_langs)) {
            foreach ($tab_langs as $key => $lang) {
                $title_lang = 'name_' . $lang;
                $description = 'description_' . $lang;
                // $content = 'content_' . $lang;

                $data['description_' . $lang] = $rq->$title_lang ? $rq->$title_lang : '';
                $data['description_' . $lang] = $rq->$description ? htmlspecialchars($rq->$description) : '';
                // $data['content_' . $lang] = $rq->$content ? htmlspecialchars($rq->$content) : '';
            }
        }

        //xử lý gallery
        $galleries = $rq->gallery ?? '';
        if ($galleries != '') {
            $galleries = array_filter($galleries);
            $data['gallery'] = $galleries ? serialize($galleries) : '';
        }
        //end xử lý gallery

        $data['sort'] = $rq->sort ? addslashes($rq->sort) : 0;
        // $data['admin_id'] = Auth::guard('admin')->user()->id;

        $save = $rq->submit ?? 'apply';

        if ($sid > 0) {
            $post_id = $sid;
            $respons = Dictionary::where("id", $sid)->update($data);
        } else {
            $respons = Dictionary::create($data);
            $id_insert = $respons->id;
            $post_id = $id_insert;

            // if sort = 0 => update sort
            Dictionary::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = Dictionary::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $rq->category_id ?? '';

        if ($category_id != '') {
            $dictionary = Dictionary::find($post_id);
            $dictionary->categories()->sync($category_id);
        }

        if ($save == 'apply') {
            $msg = "Từ điễn đã được cập nhật";
            $url = route('admin.dictionaryDetail', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.listDictionary'));
        }
    }
}
