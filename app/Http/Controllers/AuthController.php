<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function show()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('success', 'already logged in.');
        }

        return view('login.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->intended('/dashboard')->with('success', 'Login is Successfully');
        }

        return back()->withErrors(['username' => '', 'password' => ''])->with('error', 'Username or Password Incorrect');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login')->with('error', 'Logged out');
    }
}
