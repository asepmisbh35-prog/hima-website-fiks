<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rapat', function (Blueprint $table) {
            // Hapus kolom lama peserta_emails, ganti dengan peserta_ids (array of user IDs)
            $table->dropColumn('peserta_emails');
            $table->text('peserta_ids')->nullable()->after('lokasi'); // JSON array of user IDs
            $table->boolean('reminder_sent')->default(false)->after('status'); // flag notif H-1
        });
    }

    public function down()
    {
        Schema::table('rapat', function (Blueprint $table) {
            $table->dropColumn(['peserta_ids', 'reminder_sent']);
            $table->text('peserta_emails')->nullable();
        });
    }
};
