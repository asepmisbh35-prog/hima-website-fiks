<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('pengirim_nama');
            $table->string('pengirim_email');
            $table->string('pengirim_nim', 20)->nullable();
            $table->enum('kategori', ['Akademik', 'Fasilitas', 'HIMA', 'BEM', 'DPM', 'BEMF', 'Lainnya']);
            $table->text('isi_aspirasi'); // Max 1000 karakter (validasi di controller)
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'ditolak'])->default('menunggu');
            $table->text('tanggapan')->nullable();
            $table->foreignId('ditanggapi_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_tanggapan')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'kategori']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('aspirasi');
    }
};