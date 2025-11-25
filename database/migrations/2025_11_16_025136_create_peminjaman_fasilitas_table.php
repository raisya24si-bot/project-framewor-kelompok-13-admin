<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('peminjaman_fasilitas', function (Blueprint $table) {
            $table->id('pinjam_id');

            // FIX FK
            $table->unsignedBigInteger('fasilitas_id');
            $table->foreign('fasilitas_id')
                  ->references('fasilitas_id')
                  ->on('fasilitas_umum')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('warga_id');
            $table->foreign('warga_id')
                  ->references('warga_id')
                  ->on('warga')
                  ->onDelete('cascade');

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->text('tujuan');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'selesai'])->default('pending');
            $table->decimal('total_biaya', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman_fasilitas');
    }
};
