<?php

namespace App\Http\Controllers;

use App\Models\LandingPhoto;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPhotoController extends Controller
{
    protected array $sections = [
        'about'         => 'About / Carousel Tentang Kami',
        'team_inti'     => 'Pengurus Inti',
        'team_divisi'   => 'Ketua Divisi',
        'divisi'        => 'Kartu Divisi (Hero + Deskripsi)',
        'prestasi'      => 'Prestasi',
        'divisi_staff'  => 'Anggota Divisi (per halaman detail)',
        'divisi_proker' => 'Program Kerja Divisi (per halaman detail)',
    ];

    protected array $divisiSlugs = [
        'divisi-advokasi'        => 'Divisi Advokasi',
        'divisi-dana-usaha'      => 'Divisi Dana Usaha & Kesekertariatan',
        'divisi-it'              => 'Divisi Teknologi & Informasi',
        'divisi-jasmani-rohani'  => 'Divisi Jasmani & Rohani',
        'divisi-pendidikan'      => 'Divisi Pendidikan & PSDM',
        'divisi-sosial-budaya'   => 'Divisi Sosial Budaya',
    ];

    public function index(Request $request)
    {
        $section = $request->get('section', 'about');

        $photos = LandingPhoto::where('section', $section)
            ->orderBy('urutan')
            ->get();

        return view('admin.landing-photos.index', [
            'photos'        => $photos,
            'sections'      => $this->sections,
            'activeSection' => $section,
            'divisiSlugs'   => $this->divisiSlugs,
        ]);
    }

    public function create(Request $request)
    {
        return view('admin.landing-photos.create', [
            'sections'      => $this->sections,
            'activeSection' => $request->get('section', 'about'),
            'divisiSlugs'   => $this->divisiSlugs,
        ]);
    }

    public function store(Request $request)
    {
        $noPhotoSections = ['divisi_proker'];
        $needsPhoto = !in_array($request->section, $noPhotoSections);

        $data = $request->validate([
            'section'     => 'required|in:about,team_inti,team_divisi,divisi,prestasi,divisi_staff,divisi_proker',
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'urutan'      => 'nullable|integer|min:0',
            'photo'       => ($needsPhoto ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = $request->hasFile('photo')
            ? ImageOptimizer::store($request->file('photo'), 'landing', 'public', 1600, 1600, 80)
            : null;

        LandingPhoto::create([
            'section'     => $data['section'],
            'title'       => $data['title'] ?? null,
            'subtitle'    => $data['subtitle'] ?? null,
            'description' => $data['description'] ?? null,
            'link'        => $data['link'] ?? null,
            'urutan'      => $data['urutan'] ?? 0,
            'photo_path'  => $path,
            'is_active'   => true,
        ]);

        return redirect()
            ->route('admin.landing-photos.index', ['section' => $data['section']])
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(LandingPhoto $landingPhoto)
    {
        return view('admin.landing-photos.edit', [
            'photo'       => $landingPhoto,
            'sections'    => $this->sections,
            'divisiSlugs' => $this->divisiSlugs,
        ]);
    }

    public function update(Request $request, LandingPhoto $landingPhoto)
    {
        $data = $request->validate([
            'title'       => 'nullable|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link'        => 'nullable|string|max:255',
            'urutan'      => 'nullable|integer|min:0',
            'is_active'   => 'nullable|boolean',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('photo')) {
            if ($landingPhoto->photo_path && Storage::disk('public')->exists($landingPhoto->photo_path)) {
                Storage::disk('public')->delete($landingPhoto->photo_path);
            }
            $data['photo_path'] = ImageOptimizer::store($request->file('photo'), 'landing', 'public', 1600, 1600, 80);
        }

        $data['is_active'] = $request->boolean('is_active');

        $landingPhoto->update($data);

        return redirect()
            ->route('admin.landing-photos.index', ['section' => $landingPhoto->section])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(LandingPhoto $landingPhoto)
    {
        if ($landingPhoto->photo_path && Storage::disk('public')->exists($landingPhoto->photo_path)) {
            Storage::disk('public')->delete($landingPhoto->photo_path);
        }

        $section = $landingPhoto->section;
        $landingPhoto->delete();

        return redirect()
            ->route('admin.landing-photos.index', ['section' => $section])
            ->with('success', 'Data berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $data = $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:landing_photos,id',
        ]);

        foreach ($data['ids'] as $index => $id) {
            LandingPhoto::where('id', $id)->update(['urutan' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
