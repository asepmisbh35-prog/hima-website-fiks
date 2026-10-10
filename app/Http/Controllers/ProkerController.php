<?php

namespace App\Http\Controllers;

use App\Models\Proker;
use App\Models\ArsipDokumen;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProkerController extends Controller
{
    /**
     * Hitung status otomatis berdasarkan progress.
     *
     * 0%        → perencanaan
     * 1–99%     → berjalan
     * 100%      → terealisasikan (hanya jika LPJ & foto sudah ada)
     */
    private function hitungStatus(int $progress, bool $lpjAda, bool $fotoAda): string
    {
        if ($progress === 0) {
            return 'perencanaan';
        }

        if ($progress === 100 && $lpjAda && $fotoAda) {
            return 'terealisasikan';
        }

        return 'berjalan';
    }

    /**
     * Simpan file ke tabel arsip_dokumen secara otomatis.
     * Dipanggil setiap kali ada upload proposal, LPJ, atau foto dokumentasi.
     */
    private function simpanKeArsip(
        string $filePath,
        \Illuminate\Http\UploadedFile $file,
        string $judul,
        string $kategori,
        string $deskripsi,
        ?string $fileType = null,
        ?int $fileSize = null
    ): void {
        ArsipDokumen::create([
            'judul'           => $judul,
            'kategori'        => $kategori,
            'deskripsi'       => $deskripsi,
            'tanggal_dokumen' => now()->toDateString(),
            'file_path'       => $filePath,
            'file_type'       => $fileType ?? $file->getClientOriginalExtension(),
            'file_size'       => $fileSize ?? $file->getSize(),
            'is_public'       => false,
            'diupload_oleh'   => auth()->id(),
        ]);
    }

    // ------------------------------------------------------------------ //
    //  INDEX
    // ------------------------------------------------------------------ //
    public function index(Request $request)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $query = Proker::with('pembuat')->latest();

        if ($request->filled('divisi')) {
            $query->where('divisi', $request->divisi);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('search')) {
            $query->where('nama_proker', 'like', '%' . $request->search . '%');
        }

        $prokers = $query->paginate(20);

        $stats = [
            'total'          => Proker::count(),
            'perencanaan'    => Proker::where('status', 'perencanaan')->count(),
            'berjalan'       => Proker::where('status', 'berjalan')->count(),
            'selesai'        => Proker::where('status', 'selesai')->count(),
            'terealisasikan' => Proker::where('status', 'terealisasikan')->count(),
        ];

        $divisis = Proker::distinct()->pluck('divisi')->filter();

        return view('proker.index', compact('prokers', 'stats', 'divisis'));
    }

    // ------------------------------------------------------------------ //
    //  CREATE
    // ------------------------------------------------------------------ //
    public function create()
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        return view('proker.create');
    }

    // ------------------------------------------------------------------ //
    //  STORE
    // ------------------------------------------------------------------ //
    public function store(Request $request)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_proker'     => 'required|string|max:255',
            'deskripsi'       => 'required|string',
            'ketua_pelaksana' => 'required|string|max:255',
            'divisi'          => 'required|string|max:255',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'anggaran'        => 'required|numeric|min:0',
            'file_proposal'   => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ]);

        // Upload proposal & simpan ke arsip
        $pathProposal = null;
        if ($request->hasFile('file_proposal')) {
            $file         = $request->file('file_proposal');
            $pathProposal = $file->store('proker/proposal', 'public');

            // ✅ Otomatis tersimpan di Arsip Dokumen
            $this->simpanKeArsip(
                $pathProposal,
                $file,
                'Proposal — ' . $validated['nama_proker'],
                'Proposal',
                'Proposal kegiatan ' . $validated['nama_proker'] . ' (' . $validated['divisi'] . ')'
            );
        }

        Proker::create([
            'nama_proker'     => $validated['nama_proker'],
            'deskripsi'       => $validated['deskripsi'],
            'ketua_pelaksana' => $validated['ketua_pelaksana'],
            'divisi'          => $validated['divisi'],
            'tanggal_mulai'   => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'anggaran'        => $validated['anggaran'],
            'file_proposal'   => $pathProposal,
            'dibuat_oleh'     => auth()->id(),
            'status'          => 'perencanaan',
            'progress_persen' => 0,
        ]);

        return redirect()->route('proker.index')
            ->with('success', 'Program Kerja berhasil ditambahkan!' .
                ($pathProposal ? ' Proposal otomatis tersimpan di Arsip Dokumen.' : ''));
    }

    // ------------------------------------------------------------------ //
    //  SHOW
    // ------------------------------------------------------------------ //
    public function show(Proker $proker)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $proker->load(['pembuat', 'monitoring' => function ($q) {
            $q->with('inputter')->latest();
        }]);

        return view('proker.show', compact('proker'));
    }

    // ------------------------------------------------------------------ //
    //  EDIT
    // ------------------------------------------------------------------ //
    public function edit(Proker $proker)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403, 'Hanya pengurus yang dapat mengedit program kerja.');
        }

        return view('proker.edit', compact('proker'));
    }

    // ------------------------------------------------------------------ //
    //  UPDATE
    // ------------------------------------------------------------------ //
    public function update(Request $request, Proker $proker)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403, 'Hanya pengurus yang dapat mengupdate program kerja.');
        }

        $validated = $request->validate([
            'nama_proker'      => 'required|string|max:255',
            'deskripsi'        => 'required|string',
            'ketua_pelaksana'  => 'required|string|max:255',
            'divisi'           => 'required|string|max:255',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
            'anggaran'         => 'required|numeric|min:0',
            'progress_persen'  => 'required|integer|min:0|max:100',
            'catatan_progress' => 'nullable|string',
        ]);

        $progress = (int) $validated['progress_persen'];
        $lpjAda   = (bool) $proker->file_lpj;
        $fotoAda  = (bool) $proker->foto_dokumentasi;

        // Cegah set 100% tanpa LPJ & foto
        if ($progress === 100 && (!$lpjAda || !$fotoAda)) {
            return back()
                ->withInput()
                ->withErrors(['progress_persen' => 'Progress 100% membutuhkan LPJ dan foto dokumentasi yang sudah diupload.']);
        }

        $validated['status'] = $this->hitungStatus($progress, $lpjAda, $fotoAda);

        $proker->update($validated);

        return redirect()->route('proker.show', $proker)
            ->with('success', 'Program Kerja berhasil diperbarui!');
    }

    // ------------------------------------------------------------------ //
    //  UPLOAD LAPORAN (LPJ + Foto Dokumentasi)
    //  Route: PATCH /proker/{proker}/upload-laporan
    //  Name : proker.upload-laporan
    // ------------------------------------------------------------------ //
    public function uploadLaporan(Request $request, Proker $proker)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $rules = [
            'file_lpj' => $proker->file_lpj
                ? 'nullable|file|mimes:pdf,doc,docx|max:10240'
                : 'required|file|mimes:pdf,doc,docx|max:10240',

            'foto_dokumentasi' => $proker->foto_dokumentasi
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];

        $request->validate($rules);

        $updateData  = [];
        $arsipDibuat = [];

        // ---- Upload LPJ ----
        if ($request->hasFile('file_lpj')) {
            // Hapus file lama dari storage & hapus record arsip lama
            if ($proker->file_lpj) {
                Storage::disk('public')->delete($proker->file_lpj);
                ArsipDokumen::where('file_path', $proker->file_lpj)->delete();
            }

            $file    = $request->file('file_lpj');
            $newPath = $file->store('proker/lpj', 'public');

            $updateData['file_lpj'] = $newPath;

            // ✅ Otomatis tersimpan di Arsip Dokumen
            $this->simpanKeArsip(
                $newPath,
                $file,
                'LPJ — ' . $proker->nama_proker,
                'Laporan',
                'Laporan Pertanggungjawaban kegiatan ' . $proker->nama_proker
                    . ' (' . $proker->divisi . ')'
                    . ' — Ketua: ' . $proker->ketua_pelaksana
            );

            $arsipDibuat[] = 'LPJ';
        }

        // ---- Upload Foto Dokumentasi ----
        if ($request->hasFile('foto_dokumentasi')) {
            // Hapus file lama dari storage & hapus record arsip lama
            if ($proker->foto_dokumentasi) {
                Storage::disk('public')->delete($proker->foto_dokumentasi);
                ArsipDokumen::where('file_path', $proker->foto_dokumentasi)->delete();
            }

            $foto    = $request->file('foto_dokumentasi');
            $newPath = ImageOptimizer::store($foto, 'proker/dokumentasi', 'public', 1600, 1600, 80);

            $updateData['foto_dokumentasi'] = $newPath;

            // ✅ Foto dokumentasi juga tersimpan di Arsip Dokumen
            $this->simpanKeArsip(
                $newPath,
                $foto,
                'Dokumentasi — ' . $proker->nama_proker,
                'Laporan',
                'Foto dokumentasi kegiatan ' . $proker->nama_proker
                    . ' (' . $proker->divisi . ')'
                    . ' — Ketua: ' . $proker->ketua_pelaksana,
                pathinfo($newPath, PATHINFO_EXTENSION),
                Storage::disk('public')->size($newPath)
            );

            $arsipDibuat[] = 'Foto Dokumentasi';
        }

        if (!empty($updateData)) {
            $proker->update($updateData);
            $proker->refresh();

            // Jika progress sudah 100% dan kedua file lengkap → terealisasikan
            if (
                $proker->progress_persen === 100
                && $proker->file_lpj
                && $proker->foto_dokumentasi
            ) {
                $proker->update(['status' => 'selesai']);
            }
        }

        $arsipInfo = !empty($arsipDibuat)
            ? ' (' . implode(' & ', $arsipDibuat) . ' otomatis tersimpan di Arsip Dokumen)'
            : '';

        return redirect()->route('proker.show', $proker)
            ->with('success', 'Laporan akhir berhasil diupload!' . $arsipInfo);
    }

    // ------------------------------------------------------------------ //
    //  DESTROY
    // ------------------------------------------------------------------ //
    public function destroy(Proker $proker)
    {
        if (!auth()->user()->isInti()) {
            abort(403, 'Hanya Pengurus Inti yang dapat menghapus program kerja.');
        }

        // Hapus semua file dari storage
        foreach (['file_proposal', 'file_lpj', 'foto_dokumentasi'] as $col) {
            if ($proker->$col) {
                Storage::disk('public')->delete($proker->$col);
                // Hapus juga record arsip yang terkait
                ArsipDokumen::where('file_path', $proker->$col)->delete();
            }
        }

        $proker->delete();

        return redirect()->route('proker.index')
            ->with('success', 'Program Kerja berhasil dihapus!');
    }
}
