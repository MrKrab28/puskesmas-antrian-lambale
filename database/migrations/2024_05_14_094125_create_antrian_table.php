<?php

use App\Models\Antrian;
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
        Schema::create('antrian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user');
            $table->string('no_antrian');
            $table->enum('jenis_antrian' , ['gigi', 'umum', 'kia']);
            $table->enum('status' , ['menunggu', 'dipanggil', 'selesai'])->default('menunggu');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        $antrian = new Antrian();
        $antrian->id_user = 1;
        $antrian->no_antrian = 1;
        $antrian->jenis_antrian = 'gigi';
        $antrian->status = 'menunggu';
        $antrian->save();


        $antrian = new Antrian();
        $antrian->id_user = 1;
        $antrian->no_antrian = 1;
        $antrian->jenis_antrian = 'umum';
        $antrian->status = 'dipanggil';
        $antrian->save();


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
    
};
