<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $jenis_antrian = $request->jenis_antrian;
        if ($jenis_antrian) {
            $antrianByJenis = Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->get();



            // 'daftarAnggota' => User::all(),
            // 'antrian' => Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->get()

            return view('admin.jenis-antrian', [
                'daftarUser' => User::doesntHave('antrian')->get(),
                'antrian' => $antrianByJenis,

            ]);
        }
        $data_antrian = [
            'umum' => Antrian::where('jenis_antrian', 'umum')->orderBy('no_antrian')->get(),
            'kia' => Antrian::where('jenis_antrian', 'kia')->orderBy('no_antrian')->get(),
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->orderBy('no_antrian')->get(),
        ];

        $antrian = Antrian::all();

        return view('admin.antrian', compact( [
            'data_antrian','antrian'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
        ]);
        $cekAntrian = Antrian::where('jenis_antrian', $request->jenis_antrian)->whereDate('created_at', Carbon::today())->get()->count();
        $no_antrian = $cekAntrian + 1;

        $antrian = new Antrian();
        $antrian->id_user = $request->id_user;
        $antrian->no_antrian = $no_antrian;
        $antrian->jenis_antrian = $request->jenis_antrian;
        $antrian->save();

        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Dibuat');
    }

    public function status(Antrian $antrian, Request $request)
    {
        // $statusBaru = $request->input('status');


        //     $antrian->status = $statusBaru;
        //     $antrian->update();

        //     return redirect()->back();

        $dipanggil = Antrian::where('jenis_antrian', $antrian->jenis_antrian)->where('status', 'dipanggil')->first();
        if($dipanggil){

        $dipanggil->status = 'selesai';
        $dipanggil->update();
        }

        $menunggu = Antrian::where('jenis_antrian', $antrian->jenis_antrian)->where('status', 'menunggu')->first();
        if ($menunggu) {
            $menunggu->status = 'dipanggil';
            $menunggu->update();
        }

        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Diupdate');
    }
}
