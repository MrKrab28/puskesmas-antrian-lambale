<?php

namespace App\Livewire;

use App\Models\Antrian;
use Carbon\Carbon;
use Livewire\Component;

class DataAntrianLayanan extends Component
{
    public $jenisAntrian;

    public function render()
    {
        $data_antrian = [
            'kia' => Antrian::where('jenis_antrian', 'kia')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
            'umum' => Antrian::where('jenis_antrian', 'umum')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',
            'gigi' => Antrian::where('jenis_antrian', 'gigi')->where('status', 'dipanggil')->whereDate('created_at', Carbon::today())->first()->no_antrian ?? '0',

        ];
        return view('livewire.data-antrian-layanan', [
            'data_antrian' => $data_antrian
        ]);
    }
}
