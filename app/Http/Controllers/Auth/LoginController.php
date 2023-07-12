<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->safe()->except('_token');

        if (Auth::attempt($credentials)) { // returning boolean | true : false
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->with(
            'message',
            'Email atau Password yang kamu masukkan salah!',
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('auth.index');
    }
}
