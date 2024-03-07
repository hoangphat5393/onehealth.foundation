<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Page;
use App\Models\Category;
use App\Models\Campaign;
use DB;

class CampaignController extends Controller
{
    use \App\Traits\LocalizeController;

    public $data = [];

    // All categories
    public function index($slug = '')
    {
        // $this->localized();

        // All category
        $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // All campaign 
        $campaign = News::where('status', 1)
            ->orderbyDesc('sort')
            ->paginate(10);

        // Lastest campaign
        $feature_news = News::where('status', 1)
            ->orderbyDesc('id')
            ->limit(1)
            ->get();

        // default data
        $this->data['categories'] = $categories;
        $this->data['campaign'] = $campaign;

        // dd($slug);
        // if has slug then get single category data
        if ($slug) {
            return $this->categoryDetail($slug);
        }

        // dd(123);
        return view('theme.campaign.index', $this->data);
        // return view('theme.campaign.index', $this->data)->compileShortcodes();
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

            $this->data['campaign'] = $campaign = $category->posts()
                ->where('status', 1)
                ->orderbyDesc('sort')->orderbyDesc('id')
                ->paginate(6);

            $this->data['seo'] = [
                'seo_title' => $category->seo_title != '' ? $category->seo_title : $category->name,
                'seo_image' => $category->image,
                'seo_description'   => $category->seo_description ?? '',
                'seo_keyword'   => $category->seo_keyword ?? '',
            ];
            // return view($this->templatePath . '.campaign.index', $this->data);

            // Nếu chỉ có 1 bài viết thì điều hướng tới bài vô bài viết đó luôn
            // if ($campaign->count() == 1) {
            //     return $this->newsDetail($campaign->first()->slug);
            // }
            return view('theme.campaign.category', $this->data);
        } else
            return view('errors.404');
        // return $this->newsDetail($slug);
    }

    // News detail
    public function campaignDetail($slug)
    {
        $campaign = Campaign::where('slug', $slug)->first();

        // All category
        // $categories = Category::where(['status' => 1, 'type' => 'post', 'parent' => 0])->get();

        // default data
        // $this->data['categories'] = $categories;
        $this->data['campaign'] = $campaign;

        $this->data['seo'] = [
            'seo_title' => $campaign->seo_title != '' ? $campaign->seo_title : $campaign->name,
            'seo_image' => $campaign->image,
            'seo_description'   => $campaign->seo_description ?? '',
            'seo_keyword'   => $campaign->seo_keyword ?? '',
        ];

        return view('theme.campaign.single', $this->data);
    }
}
