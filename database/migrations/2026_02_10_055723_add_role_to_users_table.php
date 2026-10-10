<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'nim')) {
            $table->string('nim', 20)->nullable()->after('email');
        }

        if (!Schema::hasColumn('users', 'role')) {
            $table->enum('role', ['mahasiswa_umum', 'pengurus_harian', 'pengurus_inti'])
                  ->default('mahasiswa_umum')->after('nim');
        }

        if (!Schema::hasColumn('users', 'phone')) {
            $table->string('phone', 20)->nullable()->after('role');
        }
    });
}

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nim', 'role', 'phone']);
        });
    }
};