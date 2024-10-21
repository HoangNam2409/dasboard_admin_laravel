<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct() {}

    public function index()
    {
        if (Auth::id()) {
            return redirect()->route('dashboard.index');
        }
        return view('auth.login');
    }

    public function login(AuthRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); //Ngăn chặn session fixation attacks
            flash()->success('Đăng nhập thành công');
            return redirect()->route('dashboard.index');
        };

        flash()->error('Email hoặc Mật khẩu không chính xác');
        return redirect()->route('auth.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
