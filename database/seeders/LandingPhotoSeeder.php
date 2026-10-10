<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LandingPhoto;
use Illuminate\Support\Facades\File;

class LandingPhotoSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // ===== ABOUT (carousel "Tentang Kami") =====
            ['section' => 'about', 'title' => 'Berbagi', 'src' => 'images/about/berbagi.png', 'urutan' => 1],
            ['section' => 'about', 'title' => 'Inovasi', 'src' => 'images/about/inno.png', 'urutan' => 2],
            ['section' => 'about', 'title' => 'Juara', 'src' => 'images/about/juara.png', 'urutan' => 3],
            ['section' => 'about', 'title' => 'Milan', 'src' => 'images/about/milan.png', 'urutan' => 4],
            ['section' => 'about', 'title' => 'Open House', 'src' => 'images/about/open.png', 'urutan' => 5],
            ['section' => 'about', 'title' => 'Pelantikan', 'src' => 'images/about/pelantikan.png', 'urutan' => 6],
            ['section' => 'about', 'title' => 'Seminar', 'src' => 'images/about/seminar.png', 'urutan' => 7],

            // ===== PENGURUS INTI =====
            ['section' => 'team_inti', 'title' => 'Nazmi Kamilah', 'subtitle' => 'Ketua Umum HIMADIKTI', 'src' => 'images/bph/ketua.jpg', 'urutan' => 1],
            ['section' => 'team_inti', 'title' => 'M.Rizal Maddanie', 'subtitle' => 'Wakil Ketua Umum HIMADIKTI', 'src' => 'images/bph/wakil.jpg', 'urutan' => 2],
            ['section' => 'team_inti', 'title' => 'M.Nazmi Syarip H', 'subtitle' => 'Bendahara Umum HIMADIKTI', 'src' => 'images/bph/bendum.jpg', 'urutan' => 3],
            ['section' => 'team_inti', 'title' => 'Nazwa Rizki Awalia', 'subtitle' => 'Sekretaris Umum HIMADIKTI', 'src' => 'images/bph/sekum.jpg', 'urutan' => 4],
            ['section' => 'team_inti', 'title' => 'Siti Nur Wulandari', 'subtitle' => 'Wakil Sekretaris Umum HIMADIKTI', 'src' => 'images/bph/sekum1.jpg', 'urutan' => 5],

            // ===== KETUA DIVISI =====
            ['section' => 'team_divisi', 'title' => 'Yusuf Mustofa', 'subtitle' => 'Ketua Divisi Kesekertariatan', 'src' => 'images/kadiv/kesek.jpg', 'urutan' => 1],
            ['section' => 'team_divisi', 'title' => 'Restu', 'subtitle' => 'Ketua Divisi Sosial Budaya', 'src' => 'images/kadiv/sos.jpg', 'urutan' => 2],
            ['section' => 'team_divisi', 'title' => 'Naufal Dafa Khoiron', 'subtitle' => 'Ketua Divisi Jasmani & Rohani', 'src' => 'images/proker/jas.png', 'urutan' => 3],
            ['section' => 'team_divisi', 'title' => 'Moch. Andika Ramdani', 'subtitle' => 'Ketua Divisi IT', 'src' => 'images/kadiv/it.jpg', 'urutan' => 4],
            ['section' => 'team_divisi', 'title' => 'Deswita', 'subtitle' => 'Ketua Divisi Minat & Bakat', 'src' => 'images/kadiv/minkat.jpg', 'urutan' => 5],
            ['section' => 'team_divisi', 'title' => 'Ferdiansyah', 'subtitle' => 'Ketua Divisi Advokasi', 'src' => 'images/kadiv/advo.jpg', 'urutan' => 6],
            ['section' => 'team_divisi', 'title' => 'Dyvia Fadilla', 'subtitle' => 'Ketua Divisi PSDM', 'src' => 'images/kadiv/psdm.jpg', 'urutan' => 7],
            ['section' => 'team_divisi', 'title' => 'Hildan Fatwa', 'subtitle' => 'Ketua Divisi Dana Usaha', 'src' => 'images/kadiv/danus.jpg', 'urutan' => 8],
            ['section' => 'team_divisi', 'title' => 'Raras Rahma R', 'subtitle' => 'Ketua Divisi Pendidikan', 'src' => 'images/kadiv/pendik.jpg', 'urutan' => 9],

            // ===== DIVISI CARDS =====
            ['section' => 'divisi', 'title' => 'Divisi Advokasi', 'description' => 'Kajian strategis & advokasi kebijakan.', 'link' => 'divisi-advokasi', 'src' => 'images/proker/advo.jpg', 'urutan' => 1],
            ['section' => 'divisi', 'title' => 'Divisi Dana Usaha & Kesekertariatan', 'description' => 'Kreatif berwirausaha, mandiri dalam berkarya.', 'link' => 'divisi-dana-usaha', 'src' => 'images/proker/danus.jpg', 'urutan' => 2],
            ['section' => 'divisi', 'title' => 'Divisi Teknologi & Informasi', 'description' => 'Kreatif berwirausaha, mandiri dalam berkarya.', 'link' => 'divisi-it', 'src' => 'images/proker/it.png', 'urutan' => 3],
            ['section' => 'divisi', 'title' => 'Divisi Jasmani & Rohani', 'description' => 'Kreatif berwirausaha, mandiri dalam berkarya.', 'link' => 'divisi-jasmani-rohani', 'src' => 'images/proker/jasroh.png', 'urutan' => 4],
            ['section' => 'divisi', 'title' => 'Divisi Pendidikan & PSDM', 'description' => 'Mencetak kader unggul, berintegritas dan berdaya saing.', 'link' => 'divisi-pendidikan', 'src' => 'images/proker/pendik.jpg', 'urutan' => 5],
            ['section' => 'divisi', 'title' => 'Divisi Sosial Budaya', 'description' => 'Merajut kebersamaan, melestarikan keberagaman.', 'link' => 'divisi-sosial-budaya', 'src' => 'images/proker/danus.jpg', 'urutan' => 6],

            // ===== PRESTASI =====
            ['section' => 'prestasi', 'title' => 'Prestasi 1', 'src' => 'images/prestasi/pre (1).png', 'urutan' => 1],
            ['section' => 'prestasi', 'title' => 'Prestasi 2', 'src' => 'images/prestasi/pre (2).png', 'urutan' => 2],
            ['section' => 'prestasi', 'title' => 'Prestasi 3', 'src' => 'images/prestasi/pre (3).png', 'urutan' => 3],
            ['section' => 'prestasi', 'title' => 'Prestasi 4', 'src' => 'images/prestasi/pre (4).png', 'urutan' => 4],
            ['section' => 'prestasi', 'title' => 'Prestasi 5', 'src' => 'images/prestasi/pre (5).png', 'urutan' => 5],
            ['section' => 'prestasi', 'title' => 'Prestasi 6', 'src' => 'images/prestasi/pre (6).png', 'urutan' => 6],
            ['section' => 'prestasi', 'title' => 'Prestasi 7', 'src' => 'images/prestasi/pre (7).png', 'urutan' => 7],
        ];

        $copied = 0;
        $skipped = 0;

        foreach ($items as $item) {
            $sourcePath = public_path($item['src']);

            if (!File::exists($sourcePath)) {
                $this->command->warn("Lewati (file tidak ditemukan): {$item['src']}");
                $skipped++;
                continue;
            }

            $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
            $filename = 'landing/' . uniqid($item['section'] . '_') . '.' . $ext;
            $destPath = storage_path('app/public/' . $filename);

            File::ensureDirectoryExists(dirname($destPath));
            File::copy($sourcePath, $destPath);

            LandingPhoto::create([
                'section'     => $item['section'],
                'title'       => $item['title'] ?? null,
                'subtitle'    => $item['subtitle'] ?? null,
                'description' => $item['description'] ?? null,
                'link'        => $item['link'] ?? null,
                'photo_path'  => $filename,
                'urutan'      => $item['urutan'] ?? 0,
                'is_active'   => true,
            ]);

            $copied++;
        }

        $this->command->info("Selesai: {$copied} foto berhasil dipindah, {$skipped} dilewati.");
    }
}
