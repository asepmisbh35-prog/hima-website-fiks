<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringProker extends Model
{
    use HasFactory;

    protected $table = 'monitoring_proker';

    protected $fillable = [
        'proker_id',
        'progress_persen',
        'deskripsi_tahapan',
        'hambatan',
        'tanggal_update',
        'anggaran_terpakai',
        'partisipasi_anggota',
        'diinput_oleh',
    ];

    protected $casts = [
        'tanggal_update' => 'date',
        'anggaran_terpakai' => 'decimal:2',
    ];

    public function proker()
    {
        return $this->belongsTo(Proker::class);
    }

    public function inputter()
    {
        return $this->belongsTo(User::class, 'diinput_oleh');
    }
}