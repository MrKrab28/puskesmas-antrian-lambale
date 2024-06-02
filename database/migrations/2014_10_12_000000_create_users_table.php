<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->enum('jk', ['P', 'L']);
            $table->string('no_hp');
            $table->string('nik');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user ->nama =  'Asri';
        $user ->email =  'asri@mail';
        $user ->jk =  'P';
        $user ->alamat =  'Langkumbe';
        $user ->no_hp =  '091283341';
        $user ->nik =  '737137121112';
        $user ->password = bcrypt('123');
        $user ->save();

        $user = new User();
        $user ->nama =  'imam';
        $user ->email =  'imam@mail';
        $user ->jk =  'P';
        $user ->alamat =  'Makassar';
        $user ->no_hp =  '091283341';
        $user ->nik =  '737137121423123';
        $user ->password = bcrypt('123');
        $user ->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
