<?php

namespace App\Http\Controllers\User;

use App\Events\AntrianStore;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $jenis_antrian = $request->jenis_antrian;
        if ($jenis_antrian) {
            $antrianByJenis = Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->whereDate('created_at', Carbon::today())->get();



            // 'daftarAnggota' => User::all(),
            // 'antrian' => Antrian::where('jenis_antrian', $jenis_antrian)->orderBy('no_antrian')->get()

            return view('admin.jenis-antrian', [
                'daftarUser' => User::all(),
                'antrian' => $antrianByJenis,

            ]);
        }
        $data_antrian = [
            'kia' => Antrian::where('jenis_antrian', 'kia')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
            'umum' => Antrian::where('jenis_antrian', 'umum')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',

        ];
        // $data_antrian = Antrian::orderBy('no_antrian')->get()->groupBy('jenis_antrian');

        $antrian = Antrian::all();

        return view('user.antrian', compact([
            'data_antrian', 'antrian'
        ]));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_antrian' => 'required',
        ]);
        $hitung_antrian =  Antrian::where('jenis_antrian', $request->jenis_antrian)->whereDate('created_at', Carbon::today())->get()->count();

        if ($hitung_antrian >= 30) return redirect()->back()->with('error', 'Antrian penuh');

        $antrian_sebelumnya = Antrian::where('jenis_antrian', $request->jenis_antrian)->whereDate('created_at', Carbon::today())->latest()->first();

        $no_antrian = $hitung_antrian + 1;
        if ($antrian_sebelumnya) {

            if (Carbon::parse($antrian_sebelumnya->batas_waktu)->addMinutes(10) <= Carbon::now()) {

                $batas_waktu = Carbon::now()->addMinutes(10);
            }
            // elseif ($antrian_menunggu_terakhir) {
            //     $batas_waktu = Carbon::parse($antrian_menunggu_terakhir->batas_waktu)->addMinutes(10);

            // }
            else {

                $batas_waktu = Carbon::parse($antrian_sebelumnya->batas_waktu)->addMinutes(10);
            }
        } else {
            $batas_waktu = Carbon::now()->addMinutes(10);
        }

        $antrian = new Antrian();
        $antrian->id_user = auth()->user()->id;
        $antrian->no_antrian = $no_antrian;
        $antrian->jenis_antrian = $request->jenis_antrian;
        $antrian->batas_waktu = $batas_waktu;
        $antrian->save();

        broadcast(new AntrianStore($antrian));

        return redirect()->back()->with('success', 'Berhasil Mengambil Nomor Antrian');
    }

    public function showAntrian($jenis){




        $currentAntrian = Antrian::where('status', 'dipanggil')
        ->where('jenis_antrian', $jenis)
        ->latest('updated_at')
        ->first();

        return view('user.antrian')->with('currentAntrian', $currentAntrian)
        ->with('jenis', $jenis);;
        }
}
