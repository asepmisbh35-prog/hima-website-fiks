<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi';

    protected $fillable = [
        'user_id',
        'pengirim_nama',
        'pengirim_email',
        'pengirim_nim',
        'kategori',
        'isi_aspirasi',
        'status',
        'tanggapan',
        'ditanggapi_oleh',
        'tanggal_tanggapan',
    ];

    protected $casts = [
        'tanggal_tanggapan' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penanggap()
    {
        return $this->belongsTo(User::class, 'ditanggapi_oleh');
    }
}