<?php

use App\Models\Admin;
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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nama');
            $table->string('password');
            $table->timestamps();
        });

        $admin = new Admin();
        $admin->email = 'admin@mail';
        $admin->nama = 'admin';
        $admin->password = bcrypt('123');
        $admin->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
