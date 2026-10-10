<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rapat', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rapat');
            $table->text('agenda');
            $table->datetime('tanggal_waktu');
            $table->string('lokasi')->nullable();
            $table->text('peserta_emails'); // JSON array
            $table->text('notulensi')->nullable();
            $table->string('file_notulensi')->nullable();
            $table->enum('status', ['dijadwalkan', 'berlangsung', 'selesai', 'dibatalkan'])->default('dijadwalkan');
            $table->string('divisi')->nullable();
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['tanggal_waktu', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('rapat');
    }
};