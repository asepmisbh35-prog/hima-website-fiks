<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->enum('jenis_surat', ['masuk', 'keluar', 'resmi', 'notulensi', 'lainnya']);
            $table->string('perihal');
            $table->date('tanggal_surat');
            $table->string('pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->string('kategori')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('file_path'); // Max 5MB
            $table->boolean('is_public')->default(false);
            $table->foreignId('diupload_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['jenis_surat', 'tanggal_surat', 'kategori']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_surat');
    }
};