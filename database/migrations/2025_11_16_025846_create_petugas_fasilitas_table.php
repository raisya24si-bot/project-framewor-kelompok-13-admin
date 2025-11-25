<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('petugas_fasilitas', function (Blueprint $table) {
            $table->id('petugas_id');

            // FK ke fasilitas
            $table->unsignedBigInteger('fasilitas_id');
            $table->foreign('fasilitas_id')
                  ->references('fasilitas_id')
                  ->on('fasilitas_umum')
                  ->onDelete('cascade');

            // FK ke warga (petugas_warga_id)
            $table->unsignedBigInteger('petugas_warga_id');
            $table->foreign('petugas_warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

            $table->string('peran')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas_fasilitas');
    }
};
