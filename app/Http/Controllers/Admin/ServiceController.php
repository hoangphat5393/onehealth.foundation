<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use App\Libraries\Helpers;
use Auth, DB, File, Image, Config;

class ServiceController extends Controller
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
            $db = Service::select('*');
            if (request('category_id')) {
                $db = $db->join('service_category', 'service_id', 'service.id');
                $db->where('category_id', request('category_id'));
            }
            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            // $data_post = $db->get();
            $data_post = $db->orderByDesc('sort')->paginate(20)->appends($appends);
        } else {
            $data_post = Service::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('sort')
                ->paginate(20)
                ->appends($appends);
            $count_item = Service::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.service.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }

    public function create()
    {
        return view('admin.service.single', $this->data);
    }

    public function edit($id)
    {
        $this->data['post'] = Service::find($id);
        if ($this->data['post']) {
            return view('admin.service.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'category_id', 'created_at', 'submit', 'tab_lang', 'custom_field', 'custom_field_en']);

        //id post
        $sid = $request->id ?? 0;

        $data['slug'] = addslashes($request->slug);
        // if ($data['slug'] == '') **
        $data['slug'] = Str::slug($data['name']);

        // $slug = addslashes($data['slug']);
        if (empty($slug) || $slug == '')
            $slug = Str::slug($data['name']);

        // $data['description'] = $data['description'] ? htmlspecialchars($data['description']) : '';
        // $data['content'] = $data['content'] ? htmlspecialchars($data['content']) : '';
        // $data['seo_title'] = $data['seo_title'] ? $data['seo_title'] : $data['name'];

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
            $respons = Service::where("id", $sid)->update($data);
        } else {
            $respons = Service::create($data);
            $insert_id = $respons->id;
            $post_id = $insert_id;

            // if sort = 0 => update sort
            Service::where("id", $post_id)->update(['sort' => $post_id]);

            // $db = ShopProduct::find(1);
            // $db->sort = $post_id;
            // $db->save();
        }

        // SAVE CATEGORY
        $category_id = $request->category_id ?? '';
        if ($category_id != '') {
            $service = Service::find($post_id);
            $service->categories()->sync($category_id);
        }

        // process promotion_items
        // $product_promotion = $rq->custom_field ?? '';

        // dd($product_promotion);
        // delete old data
        // \App\Models\ShopProductPromotion::where('shop_product_id', $post_id)->delete();


        // add new data
        // if (!empty($product_promotion)) {
        //     foreach ($product_promotion as $key => $item) {

        //         if ($item['qty_to_promotion'] != null) {
        //             $data_item = array(
        //                 "shop_product_id" => $post_id,
        //                 "name" => $product_promotion[$key]['qty_to_name'],
        //                 "qty_to_promotion" => $product_promotion[$key]['qty_to_promotion'],
        //                 "promotion" => $product_promotion[$key]['promotion'],
        //                 "promotion_unit" => $product_promotion[$key]['promotion_unit']
        //             );
        //             \App\Models\ShopProductPromotion::create($data_item);
        //         }
        //     }
        // }

        // delete old data
        \App\Models\ServiceSetup::where('service_id', $post_id)->delete();
        $table = (new \App\Models\ServiceSetup)->getTable();
        DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");

        // SAVE SETUP
        $service_setup = $request->custom_field ?? '';

        if ($service_setup != '') {
            $service = Service::find($post_id);



            foreach ($service_setup as $key => $item) {
                // dd($service_setup, $item);
                $service->setups()->create($item);
                // $service->setups()->create([
                //     'name' => $item['name'],
                //     'description' => $item['description']
                // ]);
                // $service->setups()->createMany(
                //     ['name' => $item['name']],
                //     ['description' => $item['description']]
                // );
            }
        }

        if ($save == 'apply') {
            $msg = "Service has been Updated";
            $url = route('admin.serviceEdit', array($post_id));
            Helpers::msg_move_page($msg, $url);
        } else {
            return redirect(route('admin.serviceList'));
        }
    }
}
