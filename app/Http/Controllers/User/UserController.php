<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function showRegister(){
        return view('user.auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'nik' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'password' => 'required',
            'jk' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->nik = $request->nik;
        $user->alamat = $request->alamat;
        $user->jk = $request->jk;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        $user->password =  bcrypt($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Berhasil Membuat Akun Silahkan Login');
    }
}
