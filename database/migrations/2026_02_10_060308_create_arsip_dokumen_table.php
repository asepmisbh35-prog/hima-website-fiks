<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('arsip_dokumen', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_dokumen');
            $table->string('file_path'); // Max 10MB
            $table->string('file_type');
            $table->integer('file_size'); // in bytes
            $table->boolean('is_public')->default(false);
            $table->integer('download_count')->default(0);
            $table->foreignId('diupload_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['kategori', 'is_public']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_dokumen');
    }
};