<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodePendaftaran extends Model
{
    use HasFactory;

    protected $table = 'periode_pendaftaran';
    

    protected $fillable = [
        'nama_periode',
        'tanggal_buka',
        'tanggal_tutup',
        'is_active',
        'deskripsi',
        'dibuat_oleh',
    ];

    protected $casts = [
        'tanggal_buka' => 'date',
        'tanggal_tutup' => 'date',
        'is_active' => 'boolean',
    ];

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function pendaftaran()
    {
        return $this->hasMany(PendaftaranPengurus::class, 'periode_id');

        
    }
}