<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Helpers;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth, DB, File, Image;
use function Aws\filter;

class TeacherController extends Controller
{

    // public $list_promotion;
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
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {

            $db = Teacher::select('*');
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }

            $count_item = $db->count();
            $data_teacher = $db->orderByDesc('sort')->paginate(40)->appends($appends);
        } else {
            $data_teacher = Teacher::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(40)
                ->appends($appends);
            $count_item = Teacher::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.teacher.index')->with(['data' => $data_teacher, 'total_item' => $count_item]);
    }

    public function create()
    {
        // $data['variables_selected'] = [];
        return view('admin.teacher.single');
    }

    public function edit($id)
    {
        $teacher_detail = Teacher::find($id);

        if ($teacher_detail) {
            return view('admin.teacher.single', compact('teacher_detail'));
        } else {
            return view('404');
        }
    }

    public function post(Request $rq)
    {
        $data = request()->except(['_token',  'gallery', 'created_at', 'submit', 'tab_lang', 'custom_field']);

        //id post
        $sid = $rq->id ?? 0;

        $data['slug'] = addslashes($rq->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);


        $data['description'] = $rq->description ? htmlspecialchars($rq->description) : '';
        $data['content'] = $rq->content ? htmlspecialchars($rq->content) : '';

        //lang
        $tab_langs = $rq->tab_lang ?? '';
        if (is_array($tab_langs)) {
            foreach ($tab_langs as $key => $lang) {
                $title_lang = 'name_' . $lang;
                $description = 'description_' . $lang;
                $content = 'content_' . $lang;

                $data['description_' . $lang] = $rq->$title_lang ? $rq->$title_lang : '';
                $data['description_' . $lang] = $rq->$description ? htmlspecialchars($rq->$description) : '';
                $data['content_' . $lang] = $rq->$content ? htmlspecialchars($rq->$content) : '';
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
            $respons = Teacher::where("id", $sid)->update($data);
        } else {
            $respons = Teacher::create($data);
            $id_insert = $respons->id;
            $post_id = $id_insert;

            // if sort = 0 => update sort
            Teacher::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = Teacher::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        if ($save == 'apply') {
            $msg = "Teacher has been Updated";
            $url = route('admin.teacherDetail', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.listTeacher'));
        }
    }
}
