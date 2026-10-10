<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('arsip_dokumen', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('id')
                ->constrained('arsip_dokumen')->nullOnDelete();
            $table->unsignedInteger('versi')->default(1)->after('file_size');
            $table->boolean('is_latest')->default(true)->after('versi');

            $table->index(['parent_id', 'is_latest']);
        });
    }

    public function down()
    {
        Schema::table('arsip_dokumen', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropColumn(['parent_id', 'versi', 'is_latest']);
        });
    }
};
