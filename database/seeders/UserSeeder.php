<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PeriodePendaftaran;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $inti = User::create([
            'name' => 'Admin Inti',
            'email' => 'inti@hima.com',
            'nim' => '2021001',
            'role' => 'pengurus_inti',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Pengurus Harian',
            'email' => 'harian@hima.com',
            'nim' => '2021002',
            'role' => 'pengurus_harian',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Mahasiswa Umum',
            'email' => 'mahasiswa@hima.com',
            'nim' => '2021003',
            'role' => 'mahasiswa_umum',
            'password' => Hash::make('password123'),
        ]);

        PeriodePendaftaran::create([
            'nama_periode' => 'Rekrutmen Pengurus 2026',
            'tanggal_buka' => now(),
            'tanggal_tutup' => now()->addDays(30),
            'is_active' => true,
            'deskripsi' => 'Periode pendaftaran pengurus muda HIMADIKTI tahun 2026. Terbuka untuk semua mahasiswa aktif PTI.',
            'dibuat_oleh' => $inti->id,
        ]);
    }
}