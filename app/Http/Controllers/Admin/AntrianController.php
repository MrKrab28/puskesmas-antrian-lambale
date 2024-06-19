<?php

namespace App\Http\Controllers\Admin;
use App\Events\AntrianUpdated;
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
            $antrianByJenis = Antrian::where('jenis_antrian', $jenis_antrian)->whereDate('created_at', Carbon::today())->get();

            

            return view('admin.jenis-antrian', [
                'daftarUser' => User::doesntHave('antrian')->get(),
                'antrian' => $antrianByJenis,

            ]);
        }
        $data_antrian = [
            'umum' => Antrian::where('jenis_antrian', 'umum')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
            'kia' => Antrian::where('jenis_antrian', 'kia')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->whereDate('created_at', Carbon::today())->orderBy('no_antrian')->get(),
        ];

        $antrian = Antrian::all();

        return view('admin.antrian', compact([
            'data_antrian', 'antrian'
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
            }
            else {

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

        broadcast(new AntrianUpdated($antrian));
        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Dibuat');
    }

    public function status(Antrian $antrian, Request $request)
    {
        $jenisAntrian = $antrian->jenis_antrian;
        $panggilan_terakhir = Antrian::where('jenis_antrian', $jenisAntrian)
            ->where('status', 'dipanggil')
            ->first();


        $dipanggil = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'dipanggil')->first();
        // dd(Carbon::parse($dipanggil->batas_waktu));
        if ($dipanggil) {
            if (Carbon::parse($dipanggil->batas_waktu) <= Carbon::now()) {
                $dipanggil->status = 'selesai';
                $dipanggil->update();


                $menunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')->first();
                if ($menunggu) {
                    $menunggu->status = 'dipanggil';
                    $menunggu->update();

                    // Menyiarkan event AntrianUpdated dengan nomor antrian yang dipanggil
                broadcast(new AntrianUpdated($menunggu));
                }
            } else {
                return redirect()->back()->with('error', 'mohon di tungu ya ');
            }
        } else {
            $menunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')->first();
            if ($menunggu) {
                $menunggu->status = 'dipanggil';
                $menunggu->update();

                // Menyiarkan event AntrianUpdated dengan nomor antrian yang dipanggil
                broadcast(new AntrianUpdated($menunggu));
            }
        }

        return redirect()->back()->with('success', 'Nomor Antrian Berhasil Diupdate');


        // $sisaWaktu = 600 - ($now - $panggilan_terakhir);
        // $sisaWaktu = 600 - (time() - $now);
        // $sisaWaktu = max(0, $sisaWaktu);
        // // $request->session()->put('remainingSeconds', $sisaWaktu);
        // $minutes = floor($sisaWaktu / 60);
        // $seconds = $sisaWaktu % 60;
        // $timeString = sprintf("%02d:%02d", $minutes, $seconds);


        // $menunggu = Antrian::where('jenis_antrian', $jenisAntrian)->where('status', 'menunggu')->first();
        // if ($menunggu) {
        //     $menunggu->remaining_seconds = $sisaWaktu;
        //     $menunggu->update();
        // }
        // $timeString = Carbon::parse($panggilan_terakhir->batas_waktu)->diffForHumans();

        // return redirect()->back()->with([
        //     'error' => 'Anda harus menunggu ' . $timeString . ' menit sebelum memanggil antrian selanjutnya.',
        //     'timeString' => $timeString,
        // ]);
    }
}
