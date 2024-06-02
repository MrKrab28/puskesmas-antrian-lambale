<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('user')->attempt($credentials)){
            return view('user.welcome');
        }
         if (Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with('failed', 'Gagal Login, Password Atau Email Salah');

    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
