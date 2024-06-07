<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\User;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index(Request $request){
        $jenis_antrian = $request->jenis_antrian;
        if ($jenis_antrian) {
            $antrianByJenis = Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->get();



            // 'daftarAnggota' => User::all(),
            // 'antrian' => Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->get()

            return view('admin.jenis-antrian', [
                'daftarUser' => User::all(),
                'antrian' => $antrianByJenis,

            ]);
        }
        $data_antrian = [
            'umum' => Antrian::where('jenis_antrian', 'umum')->orderBy('no_antrian')->get(),
            'kia' => Antrian::where('jenis_antrian', 'kia')->orderBy('no_antrian')->get(),
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->orderBy('no_antrian')->get(),
        ];

        $antrian = Antrian::all();

        return view('user.antrian', compact( [
            'data_antrian','antrian'
        ]));
    }
}
