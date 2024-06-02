<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){


        $user = User::all();
        return view('admin.user', compact('user'));
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

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Pasien');

    }

    public function edit(User $user){
        return view('admin.user-edit', compact('user'));
    }

    public function update(Request $request, User $user){
        $user = User::find($user->id);
        $user->nama = $request->nama;
        $user->nik = $request->nik;
        $user->alamat = $request->alamat;
        $user->jk = $request->jk;
        $user->email = $request->email;
        $user->no_hp = $request->no_hp;
        if($request->password){

            $user->password = bcrypt($request->password);
        }

        $user->update();

        return redirect()->back()->with('success', 'Berhasil Mengubah Data Pasien');
    }

    public function delete(User $user ){
        $user->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data Pasien');

    }
}
