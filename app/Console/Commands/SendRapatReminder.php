<?php

namespace App\Console\Commands;

use App\Mail\RapatReminderMail;
use App\Models\Rapat;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRapatReminder extends Command
{
    protected $signature   = 'rapat:send-reminder';
    protected $description = 'Kirim email reminder H-1 kepada peserta rapat';

    public function handle(): int
    {
        $rapat = Rapat::where('status', 'dijadwalkan')
            ->where('reminder_sent', false)
            ->whereDate('tanggal_waktu', now()->addDay()->toDateString())
            ->get();

        if ($rapat->isEmpty()) {
            $this->info('Tidak ada rapat yang perlu diingatkan hari ini.');
            return self::SUCCESS;
        }

        $this->info("Ditemukan {$rapat->count()} rapat untuk diingatkan...");

        foreach ($rapat as $item) {
            $pesertaIds = $item->getPesertaIdsArray();

            if (empty($pesertaIds)) {
                $this->warn("Rapat [{$item->judul_rapat}] tidak memiliki peserta, dilewati.");
                $item->update(['reminder_sent' => true]);
                continue;
            }

            $pesertaUsers = User::whereIn('id', $pesertaIds)->get();
            $terkirim = 0;

            foreach ($pesertaUsers as $peserta) {
                try {
                    Mail::to($peserta->email)->queue(new RapatReminderMail($item, $peserta));
                    $terkirim++;
                } catch (\Exception $e) {
                    $this->error("Gagal kirim ke {$peserta->email}: {$e->getMessage()}");
                }
            }

            $item->update(['reminder_sent' => true]);

            $this->info("✓ Rapat [{$item->judul_rapat}]: reminder terkirim ke {$terkirim} peserta.");
        }

        $this->info('Selesai mengirim reminder rapat.');
        return self::SUCCESS;
    }
}
