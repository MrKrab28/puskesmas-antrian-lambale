<?php

namespace App\Models;

use App\Models\Jadwal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    protected $table = 'dokter';
    use HasFactory;

    public function jadwalDokter()
    {
        return $this->hasMany(Jadwal::class, 'id_dokter');
    }
}
