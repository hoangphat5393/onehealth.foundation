<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Libraries\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Rating_Product, App\Models\Page, App\Models\Brand, App\Models\Slider, App\Models\Addtocard, App\Models\Addtocard_Detail, App\Models\Discount_code, App\Models\Admin;
use App\Models\District, App\Models\Ward;
use App\Models\Category;
use App\Models\Product, App\Models\ProductCategory;
use App\Models\DictionaryCategory;
use App\Models\Post, App\Models\PostCategory;
use App\Models\Video, App\Models\VideoCategory;
use App\Models\Education;
use App\Models\Book, App\Models\BookCategory;
use App\Models\Faq;
use Auth, DB, Carbon\Carbon;
use App\Models\Dictionary;
use App\Models\Teacher;
use App\Models\ShopEmailTemplate;
use App\Models\Contact;


class AjaxController extends Controller
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

    public function ajax_delete(Request $rq)
    {
        $type = $rq->type;
        $check_data = $rq->seq_list;
        $arr = array();
        $values = "";
        for ($i = 0; $i < count($check_data); $i++) :
            $values .= (int)$check_data[$i] . ",";
            $arr[] = (int)$check_data[$i];
        endfor;
        $groupID = substr($values, 0, -1);
        switch ($type) {

            case 'page':
                //xóa thumbnail
                $url_upload = $_SERVER['DOCUMENT_ROOT'] . '/images/page/';
                foreach ($arr as $it) {
                    $data_page = Page::where('id', '=', $it)->get();
                    foreach ($data_page as $row) {
                        $img = $row->thubnail;
                        if ($img != '') {
                            $pt = $url_upload . $img;
                            if (file_exists($pt)) {
                                unlink($pt);
                            }
                        }
                    }
                }
                $loadDelete = Page::whereIn('id', $arr)->delete();
                return 1;
                break;
            case 'teacher':
                Teacher::whereIn('id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Teacher)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'dictionary-category':

                Category::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                DictionaryCategory::whereIn('category_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Category)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'post':
                Post::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                PostCategory::whereIn('post_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Post)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'post-category':
                Category::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                PostCategory::whereIn('category_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Category)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'product':

                Product::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                ProductCategory::whereIn('product_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Product)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'product-category':
                Category::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                ProductCategory::whereIn('category_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Category)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'book-category':
                Category::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                BookCategory::whereIn('category_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Category)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'book':
                Book::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                BookCategory::whereIn('book_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Book)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'dictionary':
                Dictionary::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                DictionaryCategory::whereIn('dictionary_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Dictionary)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'faq':
                Faq::whereIn('id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Faq)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'video':
                Video::whereIn('id', $arr)->delete();

                // DELETE DATA FROM PIVOT TABLE
                VideoCategory::whereIn('video_id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Video)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'user_admin':
                //xóa user admin
                $loadDelete = Admin::whereIn('id', $arr)->delete();

                //delete products
                $productDelete = Theme::all();
                if ($loadDelete) {
                    foreach ($productDelete as $value) {
                        foreach ($arr as $value_id) {
                            if ($value->admin_id == $value_id) {
                                $value->delete();
                                break;
                            }
                        }
                    } //foreach
                }
                return 1;
                break;
            case 'order':
                $loadDelete = Addtocard::whereIn('cart_id', $arr)->delete();
                $addToCardDelete = Addtocard_Detail::whereIn('cart_id', $arr)->delete();
                return 1;
                break;
            case 'contact':
                Contact::whereIn('id', $arr)->delete();

                // SET AUTO_INCREMENT TO 1
                $table = (new Contact)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'slider':
                $slider = Slider::whereIn('id', $arr)->get();

                if ($slider->count() > 0) {
                    foreach ($slider as $item) {

                        // DELETE LIST IMAGE
                        if ($item->children->count() > 0) {
                            $image_id = $item->children->pluck('id');
                            Slider::whereIn('id', $image_id)->delete();
                        }

                        // DELETE SLIDER
                        $item->delete();
                    }
                }

                // SET AUTO_INCREMENT TO 1
                $table = (new Slider)->getTable();
                DB::statement("ALTER TABLE $table AUTO_INCREMENT = 1;");
                return 1;
                break;
            case 'email_template':
                \App\Models\ShopEmailTemplate::whereIn('id', $arr)->delete();
                return 1;
                break;
                // case 'rating':
                //     $loadDelete = Rating_Product::whereIn('id', $arr)->delete();
                //     return 1;
                //     break;
            default:
                # code...
                break;
        }
    }

    public function ajax_replicate(Request $rq)
    {
        $type = $rq->type;
        $check_data = $rq->seq_list;
        $arr = array();
        $values = "";

        for ($i = 0; $i < count($check_data); $i++) :
            $values .= (int)$check_data[$i] . ",";
            $arr[] = (int)$check_data[$i];
        endfor;

        // dd($rq, $type, $values);

        // $groupID = substr($values, 0, -1);

        if ($type == 'category-post' || $type == 'category-product') {
            $type = 'category';
        }
        switch ($type) {
                // case 'video':
                //     //xóa thumbnail
                //     $url_upload = $_SERVER['DOCUMENT_ROOT'] . '/images/videos/';
                //     foreach ($arr as $it) {
                //         $data_page = Video_page::where('id', '=', $it)->get();
                //         foreach ($data_page as $row) {
                //             $img = $row->thumb;
                //             if ($img != '') {
                //                 $pt = $url_upload . $img;
                //                 if (file_exists($pt)) {
                //                     unlink($pt);
                //                 }
                //             }
                //         }
                //     }
                //     $loadDelete = Video_page::whereIn('id', $arr)->delete();
                //     return 1;
                //     break;
            case 'page':
                // Replicate Post + Category
                $i = 1;
                $newPage = '';
                foreach ($arr as $id) {
                    $page = Page::find($id);

                    // Replicate post
                    $newPage = $page->replicate();
                    // $newPost->name = $newPost->name . ' ' . $i;
                    // $newPost->slug = Str::slug($newPost->name);
                    $newPage->created_at = Carbon::now(); // changing the created_at date
                    $newPage->save(); // saving it to the database

                    $slug = Str::slug($newPage->name . '-' . $newPage->id);

                    // update sort = id
                    Page::where("id", $newPage->id)->update(['slug' => $slug, 'sort' => $newPage->id]);

                    // Replicate Post Category
                    $newPage = Page::find($newPage->id);
                    $i++;
                }
                return 1;
                break;
            case 'email_template':
                // Replicate Email Template
                $i = 1;
                $newTemplate = '';
                foreach ($arr as $id) {

                    $template = ShopEmailTemplate::find($id);

                    // Replicate post
                    $newTemplate = $template->replicate();
                    $newTemplate->created_at = Carbon::now(); // changing the created_at date
                    $newTemplate->save(); // saving it to the database

                    // update sort = id
                    ShopEmailTemplate::where("id", $newTemplate->id)->update(['sort' => $newTemplate->id]);
                    $i++;
                }
                return 1;
                break;
            case 'category':
                // Replicate Category Product
                $i = 1;
                $newCaterory = '';
                foreach ($arr as $id) {
                    $category = Category::find($id);

                    // Get categories of current post 
                    // $category_id = $post->categories->pluck('id')->toArray();

                    // Replicate post
                    $newCaterory = $category->replicate();
                    $newCaterory->name = $newCaterory->name . ' ' . $i;
                    $newCaterory->slug = Str::slug($newCaterory->name);
                    $newCaterory->created_at = Carbon::now(); // changing the created_at date
                    $newCaterory->save(); // saving it to the database

                    // update sort = id
                    Category::where("id", $newCaterory->id)->update(['sort' => $newCaterory->id]);

                    // Replicate Post Category
                    // $newPost = Post::find($newCaterory->id);
                    // $newPost->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'post':
                // Replicate Post + Category
                $i = 1;
                $newPost = '';
                foreach ($arr as $id) {
                    $post = Post::find($id);

                    // Get categories of current post 
                    $category_id = $post->categories->pluck('id')->toArray();

                    // Replicate post
                    $newPost = $post->replicate();
                    // $newPost->name = $newPost->name . ' ' . $i;
                    // $newPost->slug = Str::slug($newPost->name);
                    $newPost->created_at = Carbon::now(); // changing the created_at date
                    $newPost->save(); // saving it to the database

                    $slug = Str::slug($newPost->name . '-' . $newPost->id);

                    // update sort = id
                    Post::where("id", $newPost->id)->update(['slug' => $slug, 'sort' => $newPost->id]);

                    // Replicate Post Category
                    $newPost = Post::find($newPost->id);
                    $newPost->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'product':
                // Replicate Product + Category
                $i = 1;
                $newProduct = '';
                foreach ($arr as $id) {
                    $product = Product::find($id);

                    // Get categories of current product 
                    $category_id = $product->categories->pluck('id')->toArray();

                    // Replicate post
                    $newProduct = $product->replicate();
                    // $newProduct->name = $newProduct->name . ' ' . $i;
                    // $newProduct->slug = Str::slug($newProduct->name);
                    $newProduct->created_at = Carbon::now(); // changing the created_at date
                    $newProduct->save(); // saving it to the database

                    $slug = Str::slug($newProduct->name . '-' . $newProduct->id);

                    // update sort = id
                    Product::where("id", $newProduct->id)->update(['slug' => $slug, 'sort' => $newProduct->id]);

                    // Replicate Post Category
                    $newProduct = Product::find($newProduct->id);
                    $newProduct->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'book':
                // Replicate Post + Category
                $i = 1;
                $newBook = '';
                foreach ($arr as $id) {
                    $book = Book::find($id);

                    // Get categories of current post 
                    $category_id = $book->categories->pluck('id')->toArray();

                    // Replicate post
                    $newBook = $book->replicate();
                    // $newPost->name = $newPost->name . ' ' . $i;
                    // $newPost->slug = Str::slug($newPost->name);
                    $newBook->created_at = Carbon::now(); // changing the created_at date
                    $newBook->save(); // saving it to the database

                    $slug = Str::slug($newBook->name . '-' . $newBook->id);

                    // update sort = id
                    Book::where("id", $newBook->id)->update(['slug' => $slug, 'sort' => $newBook->id]);

                    // Replicate Post Category
                    $newBook = Book::find($newBook->id);
                    $newBook->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'dictionary':
                // Replicate Dictionary + Category
                $i = 1;
                $newDictionary = '';
                foreach ($arr as $id) {
                    $dictionary = Dictionary::find($id);

                    // Get categories of current post 
                    $category_id = $dictionary->categories->pluck('id')->toArray();

                    // Replicate dictionary
                    $newDictionary = $dictionary->replicate();
                    // $newPost->name = $newPost->name . ' ' . $i;
                    // $newPost->slug = Str::slug($newPost->name);
                    $newDictionary->created_at = Carbon::now(); // changing the created_at date
                    $newDictionary->save(); // saving it to the database

                    $slug = Str::slug($newDictionary->name . '-' . $newDictionary->id);

                    // update sort = id
                    Post::where("id", $newDictionary->id)->update(['slug' => $slug, 'sort' => $newDictionary->id]);

                    // Replicate Dictionary Category
                    $newPost = Dictionary::find($newDictionary->id);
                    $newPost->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
                // case 'product':
                //     // Replicate Product + Category
                //     $newProduct = '';
                //     $i = 0;
                //     foreach ($arr as $id) {
                //         $product = Product::find($id);

                //         // Get categories of current product
                //         $category_id = $product->categories->pluck('id')->toArray();

                //         // Replicate product
                //         $newProduct = $product->replicate();
                //         // $newProduct->image_name = ''; //** delete
                //         $newProduct->created_at = Carbon::now(); // changing the created_at date
                //         $newProduct->save(); // saving it to the database

                //         $slug = Str::slug($newProduct->name . '-' . $newProduct->id);

                //         // update sort = id
                //         Product::where("id", $newProduct->id)->update(['slug' => $slug, 'sort' => $newProduct->id]);

                //         // Replicate product category
                //         $newProduct = Product::find($newProduct->id);
                //         $newProduct->categories()->sync($category_id);
                //         $i++;
                //     }
                //     return 1;
                //     break;
            case 'education':
                // Replicate Education + Category
                $newEducation = '';
                $i = 0;
                foreach ($arr as $id) {
                    $education = Education::find($id);

                    // Get categories of current education
                    $category_id = $education->categories->pluck('id')->toArray();

                    // Replicate education
                    $newEducation = $education->replicate();
                    // $newEducation->image_name = ''; //** delete
                    $newEducation->created_at = Carbon::now(); // changing the created_at date
                    $newEducation->save(); // saving it to the database

                    $slug = Str::slug($newEducation->name . '-' . $newEducation->id);

                    // update sort = id
                    Education::where("id", $newEducation->id)->update(['slug' => $slug, 'sort' => $newEducation->id]);

                    // Replicate education category
                    $newEducation = Education::find($newEducation->id);
                    $newEducation->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'video':
                // Replicate Post + Category
                $i = 1;
                $newVideo = '';
                foreach ($arr as $id) {
                    $video = Video::find($id);

                    // Get categories of current post 
                    $category_id = $video->categories->pluck('id')->toArray();

                    // Replicate video
                    $newVideo = $video->replicate();
                    $newVideo->created_at = Carbon::now(); // changing the created_at date
                    $newVideo->save(); // saving it to the database

                    // update sort = id
                    Video::where("id", $newVideo->id)->update(['sort' => $newVideo->id]);

                    // Replicate Video Category
                    $newVideo = Video::find($newVideo->id);
                    $newVideo->categories()->sync($category_id);
                    $i++;
                }
                return 1;
                break;
            case 'faq':
                // Replicate Post + Category
                $i = 1;
                $newBook = '';
                foreach ($arr as $id) {
                    $faq = Faq::find($id);

                    // Replicate FAQ
                    $newBook = $faq->replicate();
                    $newBook->created_at = Carbon::now(); // changing the created_at date
                    $newBook->save(); // saving it to the database

                    // update sort = id
                    Faq::where("id", $newBook->id)->update(['sort' => $newBook->id]);
                    $i++;
                }
                return 1;
                break;
            case 'slider':
                // Replicate Slider + list image
                $i = 1;
                $newSlider = '';
                foreach ($arr as $id) {
                    $slider = Slider::find($id);

                    // Get slider list image
                    $list_image = Slider::where('status', 0)
                        ->where('slider_id', $slider->id)
                        ->orderBy('sort', 'asc')
                        ->get();

                    // Replicate Slider
                    $newSlider = $slider->replicate();
                    $newSlider->created_at = Carbon::now(); // changing the created_at date
                    $newSlider->save(); // saving it to the database

                    // update sort = id
                    Slider::where("id", $newSlider->id)->update(['sort' => $newSlider->id]);

                    // Replicate Slider list image
                    if ($list_image->count() > 0) {
                        foreach ($list_image as $item) {
                            $list_image = Slider::find($item->id);
                            $newImage = $list_image->replicate();
                            $newImage->slider_id = $newSlider->id; // changing the slider_id
                            $newImage->created_at = Carbon::now(); // changing the created_at date
                            $newImage->save(); // saving it to the database
                        }
                    }
                    $i++;
                }
                return 1;
                break;
            default:
                # code...
                break;
        }
    }


    // Quick change value of data list
    public function ajax_quickchange(Request $rq)
    {
        $id = $rq->id;
        $column = $rq->column;
        $value = $rq->value;

        // Call model
        (new $rq->model)::where('id', $id)->update([$column => $value]);
    }

    public function processThemeFast(Request $request)
    {
        $id = (int)$request->id;
        $origin_price = $request->origin_price;
        $promotion_price = $request->promotion_price;
        // $order_short = $request->order_short;
        $start_event = $request->start_event;
        $end_event = $request->end_event;
        if ($id > 0) :
            $data = array(
                'price_origin' => $origin_price,
                'price_promotion' => $promotion_price,
                // 'order_short' => $order_short,
                'start_event' => $start_event,
                'end_event' => $end_event,
                'updated' => date('Y-m-d H:i:s')
            );
            $respons = Theme::where("id", "=", $id)->update($data);
            echo 'OK';
        else :
            echo 'Lỗi';
        endif;
        exit();
    }

    public function update_new_item_status(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != "") :
            $status = $request['check'];
            $postID = (int)$request['sid'];
            if ($postID > 0) :
                $respons1 = Theme::where("id", "=", $postID)->update(array('item_new' => $status));
                echo "OK";
            else :
                echo "Lỗi";
            endif;
        endif;
    }

    public function update_process_flash_sale(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != "") :
            $status = $request['check'];
            $postID = (int)$request['sid'];
            if ($postID > 0) :
                $respons1 = Theme::where("id", "=", $postID)->update(array('flash_sale' => $status));
                echo "OK";
            else :
                echo "Lỗi";
            endif;
        endif;
    }

    public function update_process_sale_top_week(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != "") :
            $status = $request['check'];
            $postID = (int)$request['sid'];
            if ($postID > 0) :
                $respons1 = Theme::where("id", "=", $postID)->update(array('sale_top_week' => $status));
                echo "OK";
            else :
                echo "Lỗi";
            endif;
        endif;
    }

    public function update_process_propose(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != "") :
            $status = $request['check'];
            $postID = (int)$request['sid'];
            if ($postID > 0) :
                $respons1 = Theme::where("id", "=", $postID)->update(array('propose' => $status));
                echo "OK";
            else :
                echo "Lỗi";
            endif;
        endif;
    }

    public function updateStoreStatus(Request $request)
    {
        if (isset($request['check']) && $request['sid'] != "") :
            $status = $request['check'];
            $postID = (int)$request['sid'];
            if ($postID > 0) :
                $respons1 = Theme::where("id", "=", $postID)->update(array('store_status' => $status));
                echo "OK";
            else :
                echo "Lỗi";
            endif;
        endif;
    }

    public function checkPassword(Request $request)
    {
        $current_password = $request->current_password;
        if (!Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            echo 'Mật khẩu hiện tại không chính xác';
        } else {
            //echo 'Mật khẩu chính xác';
        }
    }

    public function getPlace(Request $request)
    {
        $data = [
            'label' => 'Chọn Quận / Huyện',
            'options' => '',
            'name' => '',
            'class' => 'place_select',
            'type' => '',
            'child' => '',
            'item' => '',
            'hasDefaultOption' => true,
        ];

        if ($request->type == 'province') {
            $options = District::where('province_id', $request->id)->get();

            $data['label'] = 'Chọn Quận / Huyện';
            $data['options'] = $options;
            $data['name'] = 'district_id';
            $data['type'] = 'district';
            $data['child'] = 'ward';
        } elseif ($request->type == 'district') {
            $options = Ward::where('district_id', $request->id)->get();
            $data['label'] = 'Chọn Phường / Xã';
            $data['options'] = $options;
            $data['name'] = 'ward_id';
            $data['type'] = 'ward';
            $data['child'] = 'street';
        }
        return view('admin.partials.select-label', $data);
    }
}
