<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libraries\Helpers;
use App\Models\Shopeducation;
use App\Jobs\ProcessImportData;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth, DB, File, Image, Config;


class EducationController extends Controller
{

    public $list_promotion;
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

            $db = Education::select('*');
            if (request('category_id')) {
                $db->join('category_education', 'id', 'education_id');
                $db->where('category_id', request('category_id'));
            }

            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }

            $count_item = $db->count();
            $data = $db->orderByDesc('sort')->paginate(40)->appends($appends);
        } else {
            $data = Education::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(40)
                ->appends($appends);
            $count_item = Education::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.education.index')->with(['data' => $data, 'total_item' => $count_item]);
    }

    public function create()
    {
        $data['variables_selected'] = [];
        $data['listUnit'] = $this->listUnit();

        return view('admin.education.single', $data);
    }

    public function edit($id)
    {
        // $variables_join = \App\Models\ThemeVariable::where('theme_id', $id)->get();
        // $variables = \App\Models\ThemeVariable::where('theme_id', $id)->get('variable_id');
        // $variables_selected = [];
        // foreach ($variables as $key => $item) {
        //     $variables_selected[] = $item->variable_id;
        // }

        $listUnit = $this->listUnit();

        $education_detail = Education::find($id);

        if ($education_detail) {
            return view('admin.education.single', compact('education_detail'));
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

        // $data['price'] = $rq->price ? str_replace(',', '', $rq->price) : 0;

        $data['description'] = $rq->description ? htmlspecialchars($rq->description) : '';
        $data['content'] = $rq->content ? htmlspecialchars($rq->content) : '';

        //lang
        $tab_langs = $rq->tab_lang ?? '';
        if (is_array($tab_langs)) {
            foreach ($tab_langs as $key => $lang) {
                $subname_lang = 'subname_' . $lang;
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
            $respons = Education::where("id", $sid)->update($data);
        } else {
            $respons = Education::create($data);
            $id_insert = $respons->id;
            $post_id = $id_insert;

            // if sort = 0 => update sort
            Education::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = Education::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $rq->category_id ?? '';

        if ($category_id != '') {

            $education = Education::find($post_id);
            $education->categories()->sync($category_id);

            // \App\Models\DataCategory::where('data_id', $sid)->where('type', 'education')->delete();

            // $education->categories()->syncWithPivotValues($category_id, ['type' => 'education']);

            // foreach ($category_id as $key => $item) {
            //     $data_item = array(
            //         "category_id" => (int) $item,
            //         "data_id" => $post_id,
            //         "type" => "education"
            //     );
            //     \App\Models\DataCategory::create($data_item);
            // }
        }

        if ($save == 'apply') {
            $msg = "education has been Updated";
            $url = route('admin.educationDetail', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.listEducation'));
        }
    }

    public function listUnit()
    {
        $unit = ['Unit', 'K', '1M', '1 Coin'];
        if (setting_option('price_unit')) {
            // $unit = array_map('trim', explode(',', setting_option('price_unit')));
            $unit = explode(',', setting_option('price_unit'));
        }
        return $unit;
    }

    public function import()
    {
        return view('admin.education.import');
    }
    public function importProcess()
    {
        if (request()->hasFile('file_input')) {
            $file = request()->file('file_input');
            $name = "excel-" . time() . '-' . $file->getClientOriginalName();
            $name = str_replace(' ', '-', $name);
            $url_folder_upload = "/excel-file/";
            $url_full_path = $url_folder_upload . $name;
            $file->move(public_path() . $url_folder_upload, $name);

            $importJob = new ProcessImportData('/public/' . $url_folder_upload . $name);
            $importJob->delay(\Carbon\Carbon::now()->addSeconds(3));
            dispatch($importJob);
            return view('admin.education.import', ['success' => 'File Excel của bạn sẽ được hoàn tất sau 2 phút!']);
        }
    }
}
