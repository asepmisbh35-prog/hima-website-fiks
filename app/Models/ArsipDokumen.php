<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipDokumen extends Model
{
    use HasFactory;

    protected $table = 'arsip_dokumen';

    protected $fillable = [
        'judul', 'kategori', 'deskripsi', 'tanggal_dokumen', 'file_path',
        'file_type', 'file_size', 'is_public', 'download_count', 'diupload_oleh',
        'parent_id', 'versi', 'is_latest',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
        'is_public' => 'boolean',
        'is_latest' => 'boolean',
    ];

    public const KATEGORI_LIST = [
        'AD/ART', 'SK', 'Surat', 'Proposal', 'Laporan',
        'SOP', 'Panduan', 'Template', 'Presentasi', 'Lainnya',
    ];

    public const PREVIEWABLE_TYPES = ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp'];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'diupload_oleh');
    }

    public function parent()
    {
        return $this->belongsTo(ArsipDokumen::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(ArsipDokumen::class, 'parent_id');
    }

    public function getRootIdAttribute(): int
    {
        return $this->parent_id ?? $this->id;
    }

    public function isPreviewable(): bool
    {
        return in_array(strtolower($this->file_type), self::PREVIEWABLE_TYPES);
    }
}
