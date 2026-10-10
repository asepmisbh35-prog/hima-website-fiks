<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitoring_proker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proker_id')->constrained('proker')->onDelete('cascade');
            $table->integer('progress_persen'); // 0-100
            $table->text('deskripsi_tahapan');
            $table->text('hambatan')->nullable();
            $table->date('tanggal_update');
            $table->decimal('anggaran_terpakai', 15, 2)->default(0);
            $table->integer('partisipasi_anggota')->nullable();
            $table->foreignId('diinput_oleh')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['proker_id', 'tanggal_update']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitoring_proker');
    }
};