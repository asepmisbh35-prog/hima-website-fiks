<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
        'nim',
        'role',
        'phone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Helper methods untuk role
    public function isInti()
    {
        return $this->role === 'pengurus_inti';
    }

    public function isHarian()
    {
        return $this->role === 'pengurus_harian';
    }

    public function isPengurus()
    {
        return in_array($this->role, ['pengurus_harian', 'pengurus_inti']);
    }

    // Relationships
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class);
    }
}