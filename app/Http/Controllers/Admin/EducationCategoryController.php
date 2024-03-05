<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use App\Libraries\Helpers;
use App\Models\Category;
use App\Models\Shopeducation;
use Illuminate\Support\Str;
use DB, File, Image, Config;
use Illuminate\Support\Facades\Response;

class EducationCategoryController extends Controller
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
        $categories = Category::where('type', 'education')->where('parent', 0)->orderBy('sort', 'asc')->paginate(20);

        $total_item = $categories->count();

        return view('admin.education-category.index', compact('categories', 'total_item'));
    }

    public function create()
    {
        return view('admin.education-category.single');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        if ($category) {
            return view('admin.education-category.single', compact('category'));
        } else {
            return view('404');
        }
    }

    public function post(Request $rq)
    {
        $data = request()->all();

        //id post
        $sid = $data['id'];
        $post_id = $sid;

        $name = $data['name'];

        //xử lý content
        $content = isset($data['content']) ? htmlspecialchars($data['content']) : '';
        $content_en = isset($data['content_en']) ? htmlspecialchars($data['content_en']) : '';

        $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($name);


        $save = $rq->submit ?? 'apply';

        $data_db = array(
            'slug' => $slug,
            'type' => 'education',

            'name' => $name,
            'name_en' => $data['name_en'],

            'description' => $data['description'] ? htmlspecialchars($data['description']) : '',
            'description_en' => $data['description_en'] ? htmlspecialchars($data['description_en']) : '',

            'content' => $content,
            'content_en' => $content_en,

            'sort' => $data['sort'] ?? 0,
            'status' => $data['status'] ?? 0,

            'icon' => $data['icon'] ?? '',
            'image' => $data['image'] ?? '',
            'cover' => $data['cover'] ?? '',

            'parent' => $data['parent'] ?? 0,

            'recommended' => $data['recommended'] ?? 0,
            'hot' => $data['hot'] ?? 0,

            'seo_title' => $data['seo_title'] ?? '',
            'seo_keyword' => $data['seo_keyword'] ?? '',
            'seo_description' => $data['seo_description'] ?? '',
        );


        if ($sid > 0) {
            $respons = Category::where('id', $sid)->update($data_db);
        } else {
            $respons = Category::create($data_db);
            $post_id = $respons->id;
        }
        if ($save == 'apply') {
            $msg = "Category has been Updated";
            $url = route('admin.categoryeducationDetail', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.listCategoryeducation'));
        }
    }

    public function getCategoryCheckList($id = 0)
    {
        $data['success'] = false;
        $data['content'] = '';
        if ($id) {
            $categories = ShopCategory::where('parent', $id)->get();
            $checklist = request()->input('cat', []);
            if ($categories && $categories->count()) {
                $data['success'] = true;
                $data['content'] = view('admin.education-category.category-checklist', ['categories' => $categories, 'checklist' => $checklist])->render();
            }
        }
        return Response::json($data);
    }
}
