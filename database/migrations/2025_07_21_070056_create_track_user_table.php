<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini akan menyimpan data pendaftaran (enrollment)
        Schema::create('track_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('track_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Pastikan setiap pengguna hanya bisa mengambil satu track sekali
            $table->unique(['user_id', 'track_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('track_user');
    }
};