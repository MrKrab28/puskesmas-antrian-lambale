<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Events\AntrianUpdated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AntrianController extends Controller
{
    public function index(Request $request)
    {
        $jenis_antrian = $request->jenis_antrian;
        if ($jenis_antrian) {
            $antrianByJenis = Antrian::where('jenis_antrian', $jenis_antrian)->whereDate('created_at', Carbon::today())->get();

            return view('admin.jenis-antrian', [
                'daftarUser' => User::doesntHave('antrian')->get(),
                'daftarAntrian' => $antrianByJenis,

            ]);
        }
        $data_antrian = [
            'umum' => Antrian::where('jenis_antrian', 'umum')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
            'kia' => Antrian::where('jenis_antrian', 'kia')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
        ];
        $antrian_tutup = [
            'umum' => Cache::get('antrian_umum_tutup', false),
            'kia' => Cache::get('antrian_kia_tutup', false),
            'gigi' => Cache::get('antrian_gigi_tutup', false),
        ];

        return view('admin.antrian', compact([
            'data_antrian',  'antrian_tutup'
        ]));
    }



    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
        ]);


        $hitung_antrian =  Antrian::where('jenis_antrian', $request->jenis_antrian)->whereDate('created_at', Carbon::today())->get()->count();

        if ($hitung_antrian >= 30) return redirect()->back()->with('error', 'Antrian penuh');

        $antrian_sebelumnya = Antrian::where('jenis_antrian', $request->jenis_antrian)->whereDate('created_at', Carbon::today())->latest()->first();

        $no_antrian = $hitung_antrian + 1;
        if ($antrian_sebelumnya) {

            if (Carbon::parse($antrian_sebelumnya->batas_waktu)->addMinutes(10) <= Carbon::now()) {

                $batas_waktu = Carbon::now()->addMinutes(10);
            } else {

                $batas_waktu = Carbon::parse($antrian_sebelumnya->batas_waktu)->addMinutes(10);
            }
        } else {
            $batas_waktu = Carbon::now()->addMinutes(10);
        }
        $antrian = new Antrian();
        $antrian->id_user = $request->id_user;
        $antrian->no_antrian = $no_antrian;
        $antrian->jenis_antrian = $request->jenis_antrian;
        $antrian->batas_waktu = $batas_waktu;
        $antrian->save();

        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Dibuat');
    }

    public function skip(Antrian $antrian)
    {
        $jenisAntrian = $antrian->jenis_antrian;


        $dipanggil = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'dipanggil')
            ->whereDate('created_at', Carbon::today())->first();
        $dipanggil->status = 'selesai';
        $dipanggil->update();

        $daftarTunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')
            ->whereDate('created_at', Carbon::today())->get();

        if ($daftarTunggu) {
            $penungguSebelumnya = null;

            foreach ($daftarTunggu as $menunggu) {
                if ($penungguSebelumnya) {
                    $waktu = Carbon::parse($penungguSebelumnya->batas_waktu)->addMinutes(10);
                    $menunggu->batas_waktu = $waktu;
                    $menunggu->update();
                } else {
                    $waktu = Carbon::parse(now())->addMinutes(10);

                    $menunggu->status = 'dipanggil';
                    $menunggu->batas_waktu = $waktu;
                    $menunggu->update();
                }

                $penungguSebelumnya = $menunggu;
            }

            // Menyiarkan event AntrianUpdated dengan nomor antrian yang dipanggil
            broadcast(new AntrianUpdated());
        }
        return redirect()->back()->with('success', 'Skip Antrian berhasil');
    }

    public function status(Antrian $antrian, Request $request)
    {
        $jenisAntrian = $antrian->jenis_antrian;

        $dipanggil = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'dipanggil')
            ->whereDate('created_at', Carbon::today())->first();

        if ($dipanggil) {
            if (Carbon::parse($dipanggil->batas_waktu) <= Carbon::now()) {
                $dipanggil->status = 'selesai';
                $dipanggil->update();


                $menunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')
                    ->whereDate('created_at', Carbon::today())->first();
                if ($menunggu) {
                    $menunggu->status = 'dipanggil';
                    $menunggu->update();

                    // Menyiarkan event AntrianUpdated dengan nomor antrian yang dipanggil
                    broadcast(new AntrianUpdated());
                }
            } else {
                return redirect()->back()->with('error', 'mohon di tungu ya ');
            }
        } else {
            $menunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')
                ->whereDate('created_at', Carbon::today())->first();
            if ($menunggu) {
                $menunggu->status = 'dipanggil';
                $menunggu->update();

                // Menyiarkan event AntrianUpdated dengan nomor antrian yang dipanggil
                broadcast(new AntrianUpdated());
            }
        }

        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Diupdate');
    }

    public function tutupAntrian($jenisAntrian)
    {


        if (!in_array($jenisAntrian, ['umum', 'kia', 'gigi'])) {
            return response()->json(['success' => false, 'message' => 'Jenis antrian tidak valid.']);
        }

        Cache::put('antrian_' . $jenisAntrian . '_tutup', true, now()->addDays(1));

        broadcast(new AntrianUpdated());

        return redirect()->back()->with('success', 'Antrian ' . strtoupper($jenisAntrian) . ' berhasil ditutup');
    }


    public function bukaAntrian($jenisAntrian)
    {
        if (!in_array($jenisAntrian, ['umum', 'kia', 'gigi'])) {
            return response()->json(['success' => false, 'message' => 'Jenis antrian tidak valid.']);
        }

        Cache::forget('antrian_' . $jenisAntrian . '_tutup');

        broadcast(new AntrianUpdated());

        return redirect()->back()->with('success', 'Antrian ' . strtoupper($jenisAntrian) . ' berhasil dibuka kembali');
    }
}
