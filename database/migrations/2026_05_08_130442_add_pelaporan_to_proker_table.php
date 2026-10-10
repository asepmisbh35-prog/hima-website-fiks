<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kita hanya menambahkan kolom ke tabel 'proker' yang sudah ada
        Schema::table('proker', function (Blueprint $table) {
            $table->string('ketua_pelaksana')->nullable()->after('divisi');
            $table->string('proposal_kegiatan')->nullable()->after('catatan_progress');
            $table->string('file_lpj')->nullable();
            $table->string('foto_dokumentasi')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('proker', function (Blueprint $table) {
            $table->dropColumn(['ketua_pelaksana', 'proposal_kegiatan', 'file_lpj', 'foto_dokumentasi']);
        });
    }
};
