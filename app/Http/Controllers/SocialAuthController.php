<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use Redirect;
use Session;
use URL;
use App\User;
use App\Libraries\Helpers;

class SocialAuthController extends Controller
{
    /**
     * Chuyển hướng người dùng sang OAuth Provider.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        if (!Session::has('pre_url')) {
            Session::put('pre_url', URL::previous());
        } else {
            if (URL::previous() != URL::to('login')) {
                Session::put('pre_url', URL::previous());
            }
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Lấy thông tin từ Provider, kiểm tra nếu người dùng đã tồn tại trong CSDL
     * thì đăng nhập, ngược lại nếu chưa thì tạo người dùng mới trong SCDL.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser);

        return redirect()->route('index');
    }

    /**
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        $username = str_replace(' ', '', Helpers::remove_accents($user->name));
        $username = strtolower($username . rand(0, 10000));
        $check_email = User::where('email', $user->email)->first();
        if ($check_email) {
            $msg = "Email Google đã được sử dụng để đăng ký tài khoản";
            $result = "";
            $result .= "<script language='javascript'>alert('" . $msg . "');</script>";
            $result .= "<script language='javascript'>history.go(-1);</script>";
            echo $result;
            exit();
        } else {
            $result = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => bcrypt($user->token),
                'username' => $username,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
            return $result;
        }
    }
}
