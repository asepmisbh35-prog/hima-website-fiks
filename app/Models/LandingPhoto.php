<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LandingPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'section', 'title', 'subtitle', 'description',
        'link', 'photo_path', 'urutan', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getPhotoUrlAttribute(): ?string
    {
        if (!$this->photo_path) {
            return null;
        }

        return Storage::disk('public')->exists($this->photo_path)
            ? Storage::url($this->photo_path)
            : asset('images/himadikti.png');
    }

    public function scopeSection($query, string $section)
    {
        return $query->where('section', $section)
            ->where('is_active', true)
            ->orderBy('urutan');
    }

    public function scopeForDivisi($query, string $slug)
    {
        return $query->where('link', $slug)
            ->where('is_active', true)
            ->orderBy('urutan');
    }
}
