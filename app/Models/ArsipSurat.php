<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'perihal',
        'tanggal_surat',
        'pengirim',
        'penerima',
        'kategori',
        'deskripsi',
        'file_path',
        'is_public',
        'diupload_oleh',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
        'is_public' => 'boolean',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'diupload_oleh');
    }
}