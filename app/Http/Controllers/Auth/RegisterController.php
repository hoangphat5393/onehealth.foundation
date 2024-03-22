<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Auth\Events\Registered;
// use App\Verify\Service;
use Auth, Response;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Verification service
     *
     * @var Service
     */
    // protected $verify;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //    public function __construct(Service $verify)
    //     {
    //         parent::__construct();
    //         $this->middleware('guest');
    //         $this->verify = $verify;
    //     }

    public $data = [
        'error' => false,
        'success' => false,
        'message' => ''
    ];

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation_rules = array(
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|min:10|unique:users',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        );
        $messages = array(
            'email.required' => 'Please enter your email',
            'email.email' => 'Email address is not in the correct format',
            'email.max' => 'Email address up to 255 characters',
            'email.unique' => 'Email address already exists',
            'password.required' => 'Please enter password',
            'password_confirm.same' => 'Password and re-enter password do not match!',
        );
        return Validator::make($data, $validation_rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $fullname = $data['fullname'] ?? '';
        if ($fullname == '')
            $fullname = explode('@', $data['email'])[0];
        return User::create([
            'phone' => $data['phone'],
            'full_phone' => $data['full_phone'] ?? '',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'fullname' => $fullname
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd($request);
        $validator = $this->validator($request->all()); //->validate();

        // if ($validator->fails()) {
        //     $error = $validator->errors()->first();

        //     $this->data['status'] = 'error';
        //     $this->data['message'] = $error;

        //     return response()->json($this->data);
        // }

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            $this->data['status'] = 'error';
            $this->data['message'] = $error;
        } else {

            $this->create($request->all());

            $this->data['status'] = 'success';
            $this->data['message'] = 'Đăng ký thành công';
        }
        return response()->json($this->data);

        // $user = $this->create($request->all());
        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }
        // return $request->wantsJson() ? new Response('', 201) : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    //   Verify phone
    // protected function registered(Request $request, User $user)
    // {
    //     $verification = $this->verify->startVerification($user->full_phone, $request->post('channel', 'sms'));
    //     // dd($verification);
    //     if (!$verification->isValid()) {
    //         $user->delete();

    //         /*$errors = new MessageBag();
    //         foreach($verification->getErrors() as $error) {
    //             $errors->add('verification', $error);
    //         }*/
    //         $error = $verification->getErrors()[0] ?? 'Error!';
    //         return response()->json([
    //             'error' => 1,
    //             'msg'   => $error
    //         ]);
    //         return view('auth.register')->withErrors($errors);
    //     }

    //     $messages = new MessageBag();
    //     $messages->add('verification', "Code sent to {$request->user()->phone}");
    //     $view = view($this->templatePath . '.auth.verify', $messages)->render();
    //     return response()->json([
    //         'error' => 0,
    //         'view'    => $view,
    //         'url_redirect'    => route('auth.verify'),
    //         'msg'   => "Code sent to {$request->user()->phone}"
    //     ]);
    //     // return redirect('/verify')->with('messages', $messages);
    // }
}
