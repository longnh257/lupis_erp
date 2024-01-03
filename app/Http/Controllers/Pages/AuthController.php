<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Đăng nhập thành công
            User::find(Auth::id())->logActivity('login', 'Đăng nhập', Auth::id(), Auth::id());
            return redirect()->intended('/');
        }

        // Đăng nhập thất bại
        return back()->withErrors(['errors' => 'Email hoặc mật khẩu không đúng.'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
