<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE landing_photos MODIFY section ENUM('about','team_inti','team_divisi','divisi','prestasi','divisi_staff','divisi_proker') NOT NULL");

        Schema::table('landing_photos', function ($table) {
            $table->string('photo_path')->nullable()->change();
        });
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE landing_photos MODIFY section ENUM('about','team_inti','team_divisi','divisi','prestasi') NOT NULL");

        Schema::table('landing_photos', function ($table) {
            $table->string('photo_path')->nullable(false)->change();
        });
    }
};
