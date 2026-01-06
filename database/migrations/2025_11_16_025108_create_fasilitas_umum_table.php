<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('fasilitas_umum', function (Blueprint $table) {
            $table->id('fasilitas_id');

            $table->string('nama');
            $table->enum('jenis', ['Aula', 'Lapangan', 'Gedung', 'Ruang']);

            $table->string('alamat')->nullable();

            $table->enum('rt', ['1','2','3','4','5'])->nullable();
            $table->enum('rw', ['1','2','3','4','5'])->nullable();

            $table->integer('kapasitas')->nullable();

            $table->text('deskripsi')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas_umum');
    }
};
