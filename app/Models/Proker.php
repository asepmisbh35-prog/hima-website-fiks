<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;

    protected $table = 'proker';

    protected $fillable = [
        'nama_proker',
        'deskripsi',
        'ketua_pelaksana',      // ← tambahkan ini
        'divisi',
        'tanggal_mulai',
        'tanggal_selesai',
        'anggaran',
        'anggaran_terpakai',
        'file_proposal',        // ← tambahkan ini
        'file_lpj',             // ← tambahkan ini
        'foto_dokumentasi',     // ← tambahkan ini
        'dibuat_oleh',
        'status',
        'progress_persen',
        'catatan_progress',
    ];
    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'anggaran' => 'decimal:2',
        'anggaran_terpakai' => 'decimal:2',
        'is_public' => 'boolean',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function monitoring()
    {
        return $this->hasMany(MonitoringProker::class, 'proker_id');
    }

    // Accessor untuk sisa_anggaran
    public function getAnggaranTerpakaiAttribute()
    {
         return $this->monitoring()->sum('anggaran_terpakai') ?? 0;
    }

    public function getSisaAnggaranAttribute()
    {
        return $this->anggaran - $this->anggaran_terpakai;
    }

    // Format Rupiah Helper
    public function formatRupiah($nominal)
    {
        return 'Rp ' . number_format($nominal, 0, ',', '.');
    }


}