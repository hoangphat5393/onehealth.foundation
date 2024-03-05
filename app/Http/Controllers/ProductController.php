<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Models\Category;
use App\Http\Filters\ProductFilter;
use Illuminate\Support\Facades\Cookie;
use Session, Cart, DB;
use App\Models\Page;

// use Carbon\Carbon;

class ProductController extends Controller
{
    use \App\Traits\LocalizeController;
    public $data = [];

    public function __construct()
    {
        parent::__construct();

        // MAIN MENU
        // $categories = Menu::getByName('Menu-main');

        // dd($categories);
        // $this->data['categories'] = $categories;
        // $this->data['categories'] = Category::where('status', 1)->where('parent', 0)->orderby('priority', 'DESC')->limit(4)->get();
    }

    public function index()
    {
        $categories = Category::where('status', 1)
            ->where('type', 'product')
            ->where('parent', 0)
            ->orderby('sort', 'asc');
        $this->data['categories'] = $categories->get();
        $this->data['page'] = Page::where('slug', 'product')->first();
        $this->data['product'] = Product::where('status', 1)->paginate(12);

        return view('theme.product.index', $this->data);
    }

    public function allProducts()
    {
        $this->localized();
        $this->data['categories'] = Category::where('status', 0)->where('parent', 0)->get();
        $this->data['page'] = \App\Models\Page::where('slug', 'products')->first();
        $data_search = [
            'sort_order'    => 'id__desc',
        ];
        $this->data['products'] = (new Product)->getList($data_search);
        $this->data['categories_list'] = Category::where('status', 1)
            ->where('type', 'product')
            ->where('parent', 0)
            ->orderby('sort')
            ->limit(10)
            ->get();

        return view($this->templatePath . '.product.index', $this->data);
    }

    public function categoryDetail($slug)
    {
        $this->localized();
        $category = Category::where('slug', $slug)->first();

        $this->data['categories'] = Category::where(['parent' => 0, 'type' => 'product'])
            ->orderBy('sort', 'asc')
            ->get();

        $this->data['category'] = $category;
        $this->data['slug'] = $slug;

        if ($category) {

            $category_id = $category->id;
            $this->data['category_id'] = $category_id;

            $this->data['product'] = $category->products()
                ->where('status', 1)
                ->orderByDesc('sort')
                ->orderby('name', 'asc')
                ->paginate(12);

            $this->data['seo'] = [
                'seo_title' => $category->seo_title != '' ? $category->seo_title : $category->name,
                'seo_image' => $category->image,
                'seo_description'   => $category->seo_description ?? '',
                'seo_keyword'   => $category->seo_keyword ?? '',
            ];


            return view('theme.product.category', $this->data)->compileShortcodes();
        } else
            return $this->productDetail($slug);
    }

    public function productDetail($slug)
    {
        $this->localized();

        $product = Product::where('slug', $slug)->first();

        if ($product) {

            $category = $product->categories->last();
            $this->data['category'] = $category;

            $this->data['product'] = $product;



            $this->data['brc'] = [];
            if ($category) {
                $brc = $this->getCategoryParent($category);
                if (count($brc)) {
                    $this->data['brc'] = array_reverse($brc);
                }
                array_push($this->data['brc'], ['url' => '', 'name' => $this->data['product']->name]);
            }

            $product->recommend_list = $product->recommend_list ? json_decode($product->recommend_list) : [];
            $this->data['recommended_product'] = Product::select('id', 'slug', 'sku', 'name', 'description', 'image', 'price', 'date_start', 'date_end')
                ->where('status', 1)
                ->whereIn('id', $product->recommend_list)
                ->orderBy('sort', 'desc')
                ->orderByDesc('id')
                ->limit(8)
                ->get();

            $this->data['seo'] = [
                'seo_title' => $product->seo_title != '' ? $product->seo_title : $product->name,
                'seo_image' => $product->image,
                'seo_description'   => $product->seo_description ?? '',
                'seo_keyword'   => $product->seo_keyword ?? '',
            ];
            return view($this->templatePath . '.product.single', $this->data)->compileShortcodes();
        } else {
            return view('errors.404');
        }
    }

    public function getCategoryParent($category, $brc = [])
    {
        $item = ['url' => route('product.detail', [$category->slug]), 'name' => $category->name];
        array_push($brc, $item);

        if ($category->parent) {
            $category = Category::find($category->parent);
            $brc = $this->getCategoryParent($category, $brc);
        }
        return $brc;
    }

    public function getBuyNow()
    {
        $data = request()->all();

        $id = $data['product'];
        $product = \App\Product::select('id', 'name', 'unit', 'price', 'stock')->find($id);

        $list_promotion = \App\Models\ShopProductPromotion::where('shop_product_id', $product->id)
            ->orderby('qty_to_promotion')
            ->orderby('id')
            ->get();

        if (!$product) {
            return response()->json(
                [
                    'error' => 1,
                    'msg' => 'Item is not exist',
                ]
            );
        }

        $promotion = 0;
        $promotion_unit = '$';
        if (!empty($list_promotion)) {
            foreach ($list_promotion as $v) {
                if ($data['qty'] >= $v['qty_to_promotion']) {
                    $promotion = $v['promotion'];
                    $promotion_unit = $v['promotion_unit'];
                }
            }
        }

        // $variables = \App\Variable::where('status', 0)->where('parent', 0)->orderBy('stt', 'asc')->get();
        // $attr = $data['option'] ?? '';

        $price = $product->price;

        $form_attr = ['promotion' => $promotion, 'promotion_unit' => $promotion_unit, 'unit' => $product->unit];

        // Check product allow for sale
        $option = array(
            'id'      => $id,
            'title'   => $product->name,
            'qty'     => $data['qty'],
            'price'   => $price,
            'options' => $form_attr ?? []
        );

        // Cart::add(
        //     array(
        //         'id'      => $product->id,
        //         'name'    => $product->name,
        //         'qty'     => $data['qty'],
        //         'price'   => $price,
        //         'options' => $form_attr ?? []
        //     )
        // );

        session()->forget('option');
        session()->push('option', json_encode($option, JSON_UNESCAPED_SLASHES));

        return response()->json(
            [
                'error' => 0,
                'msg' => 'Success',
            ]
        );
    }

    public function buyNow($id)
    {
        $product = Product::find($id);
        $option = session()->get('option');

        if ($option) {
            $option = json_decode($option[0], true);
            if ($option['id'] != $product->id)
                return redirect()->route('game.detail', $product->slug);
        } else
            return redirect()->route('game.detail', $product->slug);

        if ($product) {
            $this->data['product'] = $product;

            $this->data['seo'] = [
                'seo_title' => 'Mua ngay - ' . $product->name,
            ];
            if (session()->has('cart-info')) {
                $data = session()->get('cart-info');
                $this->data["cart_info"] = $data;
            }

            // dd($this->data);
            return view($this->templatePath . '.cart.quick-buy', $this->data);
        }
    }

    public function quickView()
    {
        $id = request()->id;
        if ($id) {
            $this->localized();

            $product = Product::find($id);

            if ($product) {
                $session_products = session()->get('products.recently_viewed');

                if (!is_array($session_products) ||  array_search($product->id, $session_products) === false)
                    session()->push('products.recently_viewed', $product->id);

                $this->data['product'] = $product;
                // $this->data['related'] = Product::with('getInfo')->whereHas('getInfo', function($query) use($product){
                //     return $query->where('province_id', $product->getInfo->province_id)->where('theme_id', '<>', $product->id);
                // })->limit(10)->get();

                // dd($this->data['product']);
                return response()->json([
                    'error' => 0,
                    'msg'   => 'Success',
                    'view'   => view($this->templatePath . '.product.product-quick-view', ['data' => $this->data])->compileShortcodes()->render(),
                ]);
                // return view($this->templatePath .'.product.product-single', ['data'=>$this->data])->compileShortcodes();
            }
        }
    }

    public function ajax_categoryDetail($slug)
    {
        $this->localized();
        $category = Category::where('categorySlug', $slug)->first();
        // dd($this->data['category']);
        $lc = $this->data['lc'];
        // dd($category->products);
        $view = view('theme.partials.product-banner-home', compact('category', 'lc'))->render();
        return response()->json($view);
    }

    public function wishlist(Request $request)
    {
        $this->localized();

        $id = $request->id;
        $type = 'save';
        if (auth()->check()) {
            $data_db = array(
                'product_id' => $id,
                'user_id' => auth()->user()->id,
            );

            $db = \App\Models\Wishlist::where('product_id', $id)->where('user_id', auth()->user()->id)->first();
            if ($db != '') {
                $db->delete();
                $type = 'remove';
            } else
                \App\Models\Wishlist::create($data_db)->save();

            $count_wishlist = \App\Models\Wishlist::where('user_id', auth()->user()->id)->count();
            $this->data['count_wishlist'] = $count_wishlist;
            $this->data['status'] = 'success';
        } else {
            $wishlist = json_decode(\Cookie::get('wishlist'));
            $key = false;


            if ($wishlist != '')
                $key = array_search($id, $wishlist);
            if ($key !== false) {
                unset($wishlist[$key]);
                $type = 'remove';
            } else {
                $wishlist[] = $id;
            }
            $this->data['count_wishlist'] = count($wishlist);
            $this->data['status'] = 'success';
            $cookie = Cookie::queue('wishlist', json_encode($wishlist), 1000000000);
        }
        $this->data['type'] = $type;
        // $this->data['view'] = view('theme.product.includes.wishlist-icon', ['type'=>$type, 'id'=>$id])->render();

        return response()->json($this->data);
    }

    public function ajax_get_categories($slug)
    {
        $this->localized();
        if ($slug == 'du-an') {
            $this->data['type'] = 'project';
            $projects = \App\Models\Project::where('status', 0)->limit(20)->get();
            $this->data['view'] = view('theme.product.includes.category-dropdown', compact('projects'))->render();
        } else {
            $this->data['type'] = 'category';
            $category_parent = Category::where('categorySlug', $slug)->first();
            $categories = Category::where('categoryParent', $category_parent->categoryID)->get();
            $this->data['view'] = view('theme.product.includes.category-dropdown', compact('categories'))->render();
        }

        return response()->json($this->data);
    }


    /*==================attr select=====================*/

    public function changeAttr()
    {
        $data = request()->all();
        // dd($data);
        // $attr_id = $data['attr_id'] ? explode('_', $data['attr_id'])[1] : '';
        // dd($attr_id);
        $product = Product::find($data['product']);
        if ($product) {
            return response()->json(
                [
                    'error' => 0,
                    'show_price' => $product->showPriceDetail($data['option'])->render(),
                    'view'  => view($this->templatePath . '.product.includes.product-variations', ['product' => $product, 'attr_id' => $data['attr_id'], 'attr_list_selected' => $data['option']])->render(),
                    'msg'   => 'Success'
                ]
            );
        }
    }

    /*==================end attr select=====================*/
}
