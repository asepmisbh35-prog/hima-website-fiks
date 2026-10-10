<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('proker', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proker');
            $table->text('deskripsi')->nullable();
            $table->string('divisi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('anggaran', 15, 2)->default(0);
            $table->decimal('anggaran_terpakai', 15, 2)->default(0);
            $table->integer('progress_persen')->default(0); // 0-100
            $table->text('catatan_progress')->nullable();
            $table->enum('status', ['perencanaan', 'berjalan', 'selesai', 'dibatalkan'])->default('perencanaan');
            $table->boolean('is_public')->default(false);
            $table->foreignId('dibuat_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['divisi', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('proker');
    }
};