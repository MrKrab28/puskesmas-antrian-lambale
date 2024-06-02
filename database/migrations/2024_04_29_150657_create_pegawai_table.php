<?php

use App\Models\Pegawai;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan');
            $table->enum('jk', ['L', 'P']);
            $table->string('email');
            $table->string('no_hp');
            $table->string('foto_profile')->default('default.png');
            $table->string('password');
            $table->timestamps();
        });

        $pegawai = new Pegawai();
        $pegawai->nama = 'imam';
        $pegawai->jabatan = 'dokter';
        $pegawai->jk = 'L';
        $pegawai->email = 'imam@mail';
        $pegawai->no_hp = '089123324';
        $pegawai->password = bcrypt('123');
        $pegawai->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
