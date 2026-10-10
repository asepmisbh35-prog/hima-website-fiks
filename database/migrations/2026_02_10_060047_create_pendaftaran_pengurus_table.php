<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran_pengurus', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pendaftaran')->unique();
            $table->foreignId('periode_id')->constrained('periode_pendaftaran')->onDelete('cascade'); // FIXED
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nim', 20);
            $table->string('jurusan');
            $table->string('cv_path');
            $table->text('motivasi');
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->foreignId('diverifikasi_oleh')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('tanggal_verifikasi')->nullable();
            $table->timestamps();
            
            $table->index(['periode_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran_pengurus');
    }
};