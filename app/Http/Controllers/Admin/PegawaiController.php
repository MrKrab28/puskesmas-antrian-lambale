<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index(){
        $pegawai = Pegawai::all();
        return view('admin.pegawai', compact('pegawai'));
    }
}
