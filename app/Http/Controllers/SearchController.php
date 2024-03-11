<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use App\News;
use App\Product;
use Carbon\Carbon;

class SearchController extends Controller
{
    use \App\Traits\LocalizeController;
    public $data = [];

    public function index(Request $rq)
    {
        $this->localized();
        $this->data['keyword'] = $rq->input('keyword', '');

        if ($this->data['keyword']) {
            $this->data['result'] = true;

            $keyword = '%' . addslashes($this->data['keyword']) . '%';

            $this->data['news'] = News::where('name', 'like', $keyword)->paginate(1);
            return view('theme.search', $this->data);
        } else {
            return view('theme.search', $this->data);
        }
    }

    public static function searchMuiltiple($keyword = '')
    {
        // Show mysql query
        // DB::enableQueryLog(); // Enable query log
        $lc = app()->getLocale();
        if ($keyword) {
            $ex = explode(' ', $keyword);

            $db = self::select('*');
            foreach ($ex as $v) {
                $v = '%' . addslashes($v) . '%';
                if ('vi' == $lc) {
                    $db->orwhere('name', 'like', $v);
                } else {
                    $db->orwhere('name_' . $lc, 'like', $v);
                }
            }
            foreach ($ex as $v) {
                $db->orwhere('sku', 'like', $v);
            }
        }
        if ('vi' == $lc) {
            $db->orderby('name', 'asc');
        } else {
            $db->orderby('name_' . $lc, 'asc');
        }
        $result = $db->paginate(20)->appends('keyword', $keyword); // pagination &keyword
        return $result;
    }
}
