<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendaftaranPengurus extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran_pengurus';

    protected $fillable = [
        'kode_pendaftaran',
        'periode_id',
        'user_id',
        'nama',
        'nim',
        'jurusan',
        'cv_path',
        'motivasi',
        'status',
        'catatan',
        'diverifikasi_oleh',
        'tanggal_verifikasi',
    ];

    protected $casts = [
        'tanggal_verifikasi' => 'datetime',
    ];

    public function periode()
    {
        return $this->belongsTo(PeriodePendaftaran::class, 'periode_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}