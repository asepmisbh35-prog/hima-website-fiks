<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('proker', function (Blueprint $table) {
            // Cek kolom mana yang belum ada, tambahkan sesuai kebutuhan

            if (!Schema::hasColumn('proker', 'ketua_pelaksana')) {
                $table->string('ketua_pelaksana')->nullable()->after('deskripsi');
            }

            if (!Schema::hasColumn('proker', 'file_proposal')) {
                $table->string('file_proposal')->nullable()->after('anggaran');
            }

            if (!Schema::hasColumn('proker', 'file_lpj')) {
                $table->string('file_lpj')->nullable()->after('file_proposal');
            }

            if (!Schema::hasColumn('proker', 'foto_dokumentasi')) {
                $table->string('foto_dokumentasi')->nullable()->after('file_lpj');
            }
        });
    }

    public function down(): void
    {
        Schema::table('proker', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('proker', 'ketua_pelaksana')) {
                $columns[] = 'ketua_pelaksana';
            }
            if (Schema::hasColumn('proker', 'file_proposal')) {
                $columns[] = 'file_proposal';
            }
            if (Schema::hasColumn('proker', 'file_lpj')) {
                $columns[] = 'file_lpj';
            }
            if (Schema::hasColumn('proker', 'foto_dokumentasi')) {
                $columns[] = 'foto_dokumentasi';
            }

            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
