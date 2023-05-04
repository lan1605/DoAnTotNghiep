<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    public function showLinkRequestForm()
    {
        // return view('admin.passwords.email');
        return view('auth.passwords.email', ['route' => route('admin.password.email')]);
    }
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    public function broker()
    {
        return Password::broker('admins');
    }
}