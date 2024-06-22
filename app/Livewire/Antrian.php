<?php

namespace App\Livewire;

use App\Models\Antrian as ModelsAntrian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Antrian extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $jenisAntrian;

    public function render()
    {
        return view('livewire.antrian', [
            'daftarAntrian' => ModelsAntrian::where('jenis_antrian', $this->jenisAntrian)->whereDate('created_at', Carbon::today())->paginate(10)
        ]);
    }
}
