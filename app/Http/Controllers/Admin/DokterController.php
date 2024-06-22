<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::all();
        return view('admin.dokter', compact('dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'spesialis' => 'required',
        ]);

        $dokter = new Dokter();
        $dokter->nama = $request->nama;
        $dokter->email = $request->email;
        $dokter->no_hp = $request->no_hp;
        $dokter->spesialis = $request->spesialis;
        $dokter->save();

        return redirect()->back()->with('success', 'Berhasil Menambahkan Data Dokter');
    }

    public function edit(Dokter $dokter)
    {
        return view('admin.dokter-edit', compact('dokter'));
    }

    public function update(Dokter $dokter, Request $request)
    {
        $dokter = Dokter::find($dokter->id);
        $dokter->nama = $request->nama;
        $dokter->email = $request->email;
        $dokter->no_hp = $request->no_hp;
        $dokter->spesialis = $request->spesialis;
        $dokter->update();

        return redirect()->back()->with('success', 'Berhasil Mengubah Data Dokter');
    }

    public function delete(Dokter $dokter)
    {
        $dokter->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data Dokter');
    }
}
