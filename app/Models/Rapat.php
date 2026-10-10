<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapat extends Model
{
    use HasFactory;

    protected $table = 'rapat';

    protected $fillable = [
        'judul_rapat',
        'agenda',
        'tanggal_waktu',
        'lokasi',
        'peserta_ids',
        'notulensi',
        'file_notulensi',
        'status',
        'dibuat_oleh',
        'reminder_sent',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
        'peserta_ids'   => 'array',
        'reminder_sent' => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────────────────────

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    /**
     * Relasi ke User berdasarkan peserta_ids (JSON).
     * Karena peserta_ids disimpan sebagai JSON array of IDs,
     * kita load secara manual lewat helper.
     */
    public function getPesertaUsers()
    {
        $ids = $this->getPesertaIdsArray();
        if (empty($ids)) {
            return collect();
        }
        return User::whereIn('id', $ids)->orderBy('name')->get();
    }

    // ─── Helper Methods ──────────────────────────────────────────────────────────

    public function getPesertaIdsArray(): array
    {
        if (is_null($this->peserta_ids)) {
            return [];
        }
        return is_array($this->peserta_ids) ? $this->peserta_ids : [];
    }

    public function getPesertaCount(): int
    {
        return count($this->getPesertaIdsArray());
    }

    /**
     * Apakah user tertentu ada di daftar peserta?
     */
    public function hasPeserta(int $userId): bool
    {
        return in_array($userId, $this->getPesertaIdsArray());
    }

    /**
     * Cek apakah rapat ini H-1 dan reminder belum dikirim.
     */
    public function shouldSendReminder(): bool
    {
        if ($this->reminder_sent || $this->status === 'dibatalkan') {
            return false;
        }

        $hariIni     = now()->startOfDay();
        $besok       = now()->addDay()->startOfDay();
        $tanggalRapat = $this->tanggal_waktu->startOfDay();

        return $tanggalRapat->equalTo($besok);
    }
}
