<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    public function index() {
        $jadwal = Jadwal::whereDate('tanggal', Carbon::today())->get();
        $daftar_dokter = Dokter::all();
        return view('admin.jadwal', compact(['jadwal', 'daftar_dokter']));
    }

    public function store(Request $request) {
        $request->validate([
            'id_dokter' => 'required',
            'jenis_antrian' => 'required',
            'tanggal' => 'required',
        ]);

        $jadwal = new Jadwal();
        $jadwal->id_dokter = $request->id_dokter;
        $jadwal->jenis_antrian = $request->jenis_antrian;
        $jadwal->tanggal = Carbon::today()->toDateString();
        $jadwal->save();

        return redirect()->back()->with('success', 'Berhasil Menambahkan Jadwal');
    }

    public function edit(Jadwal $jadwal){
        return view('admin.jadwal-edit', compact('jadwal'));
    }

    public function update(Jadwal $jadwal, Request $request){
        $jadwal = Jadwal::find($request->id);
        $jadwal->id_dokter = $request->id_dokter;
        $jadwal->jenis_antrian = $request->jenis_antrian;
        $jadwal->tanggal = $request->tanggal;
        $jadwal->update();
        return redirect()->back()->with('success', 'Berhasil Mengubah Jadwal');
    }

    public function delete(Jadwal $jadwal){
        $jadwal->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Jadwal');
    }
}
