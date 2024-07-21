<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Antrian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        // $data_antrian = [
        //     'jumlah_antrian' => Antrian::whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
        //     'antrian_menunggu' => Antrian::where('status', 'menunggu')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
        //     'antrian_diapnggil' => Antrian::where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
        //     'antrian_Selesai' => Antrian::where('status', 'gigi')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',

        // ];

        $antrian = Antrian::whereDate('created_at', Carbon::today())->get();

        // return view('admin.dashboard', compact([
        //     'data_antrian', 'antrian'
        // ]));

        return view('admin.dashboard', compact('antrian'));
    }
}
