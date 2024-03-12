<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\View\View;
use Auth, DB, File, Image, Config;


class SubscriptionController extends Controller
{
    public $data = [];

    public function index()
    {
        $appends = [
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $db = Subscription::select('*');

            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            $data_post = $db->orderByDesc('id')->paginate(20)->appends($appends);
        } else {
            $data_post = Subscription::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->orderByDesc('id')
                ->paginate(20)
                ->appends($appends);
            $count_item = Subscription::where('admin_id', '=', Auth::guard('admin')->user()->id)
                ->count();
        }
        return view('admin.subscription.index')->with(['data' => $data_post, 'total_item' => $count_item]);
    }
}
