<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Page;
use App\Models\Category;
use App\Models\Post;
use App\Models\ShopProduct as ShopProduct;
use DB;

class NewsController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [];

    // All categories
    public function index($slug = '')
    {
        // $this->localized();

        // All category
        $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // All news 
        $news = News::where('status', 1)
            ->orderbyDesc('sort')
            ->paginate(10);

        // Lastest news
        $feature_news = News::where('status', 1)
            ->orderbyDesc('id')
            ->limit(1)
            ->get();

        // default data
        $this->data['categories'] = $categories;
        $this->data['news'] = $news;

        // extra data
        $this->data['feature_news'] = $feature_news;

        // dd($slug);
        // if has slug then get single category data
        if ($slug) {
            return $this->categoryDetail($slug);
        }

        // dd(123);
        return view('theme.news.index', $this->data);
        // return view('theme.news.index', $this->data)->compileShortcodes();
    }

    // Single category
    public function categoryDetail($slug)
    {
        $this->localized();
        $category = Category::where('slug', $slug)->first();

        // dd($category);
        if ($category) {
            $this->data['category'] = $category;
            $this->data['category_child'] = $category->children();

            $this->data['news'] = $news = $category->posts()
                ->where('status', 1)
                ->orderbyDesc('sort')->orderbyDesc('id')
                ->paginate(6);

            $this->data['seo'] = [
                'seo_title' => $category->seo_title != '' ? $category->seo_title : $category->name,
                'seo_image' => $category->image,
                'seo_description'   => $category->seo_description ?? '',
                'seo_keyword'   => $category->seo_keyword ?? '',
            ];
            // return view($this->templatePath . '.news.index', $this->data);

            // Nếu chỉ có 1 bài viết thì điều hướng tới bài vô bài viết đó luôn
            // if ($news->count() == 1) {
            //     return $this->newsDetail($news->first()->slug);
            // }
            return view('theme.news.category', $this->data);
        } else
            return view('errors.404');
        // return $this->newsDetail($slug);
    }

    // News detail
    public function newsDetail($slug)
    {
        $news = Post::where('slug', $slug)->first();

        // All category
        $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // default data
        $this->data['categories'] = $categories;
        $this->data['news'] = $news;

        // $tintuc = Category::where('slug', 'cong-thong-tin');
        // $this->data['news_featured'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->orderby('id', 'desc')
        //     ->limit(6)
        //     ->get();

        // Recently news
        // $this->data['recently_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->orderby('created_at', 'desc')
        //     ->get();

        // Latest news
        // $this->data['latest_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->orderby('id', 'desc')
        //     ->get();

        // Related News
        // $this->data['related_news'] = $tintuc->news()
        //     ->where('status', 1)
        //     ->where('id', '<>', $news->id)
        //     ->limit(4)
        //     ->get();

        $this->data['seo'] = [
            'seo_title' => $news->seo_title != '' ? $news->seo_title : $news->name,
            'seo_image' => $news->image,
            'seo_description'   => $news->seo_description ?? '',
            'seo_keyword'   => $news->seo_keyword ?? '',
        ];

        return view('theme.news.single', $this->data);
    }
}
