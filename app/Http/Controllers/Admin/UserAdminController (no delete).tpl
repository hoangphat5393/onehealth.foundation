<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting, App\Models\Admin, App\Models\Addtocard;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\OrderExport;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\WebService\WebService;

use App\Models\AdminRole;

class UserAdminController extends Controller
{
    public $data, $all_roles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $routes = app()->routes->getRoutes();
        foreach ($routes as $route) {
            if (Str::startsWith($route->uri(), SC_ADMIN_PREFIX)) {
                $prefix = SC_ADMIN_PREFIX ? $route->getPrefix() : ltrim($route->getPrefix(), '/');
                $routeAdmin[$prefix] = [
                    'uri'    => 'ANY::' . $prefix . '/*',
                    'name'   => $prefix . '/*',
                    'method' => 'ANY',
                ];
                foreach ($route->methods as $key => $method) {
                    if ($method != 'HEAD' && !collect($this->without())->first(function ($exp) use ($route) {
                        return Str::startsWith($route->uri, $exp);
                    })) {
                        $routeAdmin[] = [
                            'uri'    => $method . '::' . $route->uri,
                            'name'   => $route->uri,
                            'method' => $method,
                        ];
                    }
                }
            }
        }

        $this->data['routeAdmin'] = $routeAdmin;
        $this->all_roles = AdminRole::pluck('name', 'id')->all();
    }

    public function index()
    {
        $appends = [
            'search_name' => request('search_name'),
        ];
        if (Auth::guard('admin')->user()->admin_level == 99999) {
            $db = Admin::select('*');

            if (request('search_name') != '') {
                $db->where('name', 'like', '%' . request('search_name') . '%');
            }
            $count_item = $db->count();
            $data = $db->orderBy('id')->paginate(20)->appends($appends);
        }
        return view('admin.user-admin.index')->with(['data' => $data, 'total_item' => $count_item]);
    }

    public function create()
    {
        $this->data['all_roles'] = $this->all_roles;
        return view('admin.user-admin.single', $this->data);
    }

    public function edit($id)
    {
        $user = Admin::find($id);

        $this->data = [
            'data_admin'        => $user,
            'all_roles'         => $this->all_roles,
            'user_roles'        => $user->roles->pluck('id')->toArray(),
        ];
        if ($user) {
            return view('admin.user-admin.single', $this->data);
        } else {
            return view('404');
        }
    }

    public function post(Request $request)
    {
        $data = request()->except(['_token',  'gallery', 'created_at', 'submit', 'tab_lang']);

        //id post
        $sid = $request->id ?? 0;

        $data = $request->all();



        $change_pass = $data['check_pass'] ?? 0;
        if ($change_pass || $sid == 0) {
            $this->validate($request, [
                'email' => 'required|unique:"' . Admin::class . '",email,' . $sid . '',
                'password'      => 'required|confirmed',
                'name'          => 'required',
            ], [
                'email.required' => 'Hãy nhập vào địa chỉ Email',
                'email.email' => 'Địa chỉ Email không đúng định dạng',
                'email.unique' => 'Địa chỉ Email đã tồn tại',
                'password.required' => 'Hãy nhập mật khẩu',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng',
                'name.required' => 'Tên không được trống',
            ]);
        } else {
            $this->validate($request, [
                'email' => 'required|string|max:50|unique:"' . Admin::class . '",email,' . $sid . '',
                'name'          => 'required',
            ], [
                'email.required' => 'Hãy nhập vào địa chỉ Email',
                'email.email' => 'Địa chỉ Email không đúng định dạng',
                'email.unique' => 'Địa chỉ Email đã tồn tại',
                'name.required' => 'Tên không được trống',
            ]);
        }

        $dataUpdate = [
            'email'     => $request->email,
            'name'      => $request->name,

            'admin_level' => $request->admin_level,
            'email_info'     => $request->email,
            'status'    => $request->status,
            'admin_level'    => 1
        ];
        if ($request->password)
            $dataUpdate['password']  = bcrypt($request->password);

        if ($sid == 0) {
            $user = Admin::create($dataUpdate);

            $roles = $data['roles'] ?? [];
            $permission = $data['permission'] ?? [];

            //Process role special
            if (in_array(1, $roles)) {
                // If group admin
                $roles = [1];
                $permission = [];
            } else if (in_array(2, $roles)) {
                // If group onlyview
                $roles = [2];
                $permission = [];
            }
            //End process role special

            //Insert roles
            if ($roles) {
                $user->roles()->attach($roles);
            }
            //Insert permission
            if ($permission) {
                $user->permissions()->attach($permission);
            }
        } else {
            $user = Admin::find($sid);
            $user->update($dataUpdate);
            // dd($user);
            if (!in_array($user->id, SC_GUARD_ADMIN)) {
                $roles = $data['roles'] ?? [];
                $permission = $data['permission'] ?? [];
                $user->roles()->detach();
                // $user->permissions()->detach();
                //Insert roles
                if ($roles) {
                    $user->roles()->attach($roles);
                }
                //Insert permission
                if ($permission) {
                    $user->permissions()->attach($permission);
                }
            }
        }

        $save = $data['submit'] ?? 'apply';
        if ($save == 'apply') {
            $msg = "User admin has been Updated";
            $url = route('admin.userAdminDetail', array($user->id));
            Helpers::msg_move_page($msg, $url);
        } else {
            // return redirect(route('admin_permission.index'));
            // return redirect(route('admin_role.index'));
            return redirect(route('admin.userList'));
        }
    }

    public function deleteUserAdmin($id)
    {
        $user_current = auth()->user();
        if (auth()->check() && $user_current->id != $id) {
            $loadDelete = Admin::find($id)->delete();
            $msg = "Admin account has been Delete";
            $url = route('admin.userList');
            Helpers::msg_move_page($msg, $url);
        }
        $msg = "Không thực hiện được thao tác này";
        $url = route('admin.userList');
        Helpers::msg_move_page($msg, $url);
    }


    public function without()
    {
        $prefix = SC_ADMIN_PREFIX ? SC_ADMIN_PREFIX . '/' : '';
        return [
            $prefix . 'login',
            $prefix . 'logout',
            $prefix . 'forgot',
            $prefix . 'deny',
            $prefix . 'locale',
            $prefix . 'uploads',
        ];
    }
}
