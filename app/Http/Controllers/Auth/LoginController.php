<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:giangvien')->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login', ['route' => route('admin.login-view'), 'title'=>'Đăng nhập với tư cách quản trị viên']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (\Auth::guard('admin')->attempt($request->only('email','password'), $request->get('remember'))){
            return redirect()->intended('/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
    //giảng viên
    public function showTeacherLoginForm()
    {
        return view('auth.login', ['route' => route('giangvien.login-view'), 'title'=>'Đăng nhập với tư cách giảng viên']);
    }

    public function teacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (\Auth::guard('giangvien')->attempt($request->only('email','password'), $request->get('remember'))){
            return redirect()->intended('/giangvien/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }
}