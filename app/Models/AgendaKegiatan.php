<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'agenda_kegiatan';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'divisi',
        'panitia_emails',
        'is_public',
        'dibuat_oleh',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'panitia_emails' => 'array',
        'is_public' => 'boolean',
    ];

    // Relationship
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    // Helper method untuk form edit (convert array ke string)
    public function getPanitiaEmailsString()
    {
        if (empty($this->panitia_emails)) {
            return '';
        }
        
        // Kalau sudah array (karena $casts), langsung implode
        if (is_array($this->panitia_emails)) {
            return implode(', ', $this->panitia_emails);
        }
        
        // Kalau masih JSON string, decode dulu
        $emails = json_decode($this->panitia_emails, true);
        return is_array($emails) ? implode(', ', $emails) : '';
    }

    // Helper method untuk view (return array)
    public function getPanitiaEmailsArray()
    {
        if (empty($this->panitia_emails)) {
            return [];
        }
        
        // Kalau sudah array (karena $casts)
        if (is_array($this->panitia_emails)) {
            return $this->panitia_emails;
        }
        
        // Kalau masih JSON string
        $emails = json_decode($this->panitia_emails, true);
        return is_array($emails) ? $emails : [];
    }
}