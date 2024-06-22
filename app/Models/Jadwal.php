<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal_dokter';

    use HasFactory;

    public function dokter(){
       return $this->belongsTo(Dokter::class, 'id_dokter');
    }
}
