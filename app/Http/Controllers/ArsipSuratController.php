<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ArsipSuratController extends Controller
{
    // List semua surat
    public function index(Request $request)
    {
        $query = ArsipSurat::with('uploader')->latest();

        // Filter untuk mahasiswa umum: hanya lihat yang public
        if (!auth()->check() || !auth()->user()->isPengurus()) {
            $query->where('is_public', true);
        }

        // Filter by jenis surat
        if ($request->filled('jenis_surat')) {
            $query->where('jenis_surat', $request->jenis_surat);
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nomor_surat', 'like', '%' . $request->search . '%')
                    ->orWhere('perihal', 'like', '%' . $request->search . '%')
                    ->orWhere('pengirim', 'like', '%' . $request->search . '%')
                    ->orWhere('penerima', 'like', '%' . $request->search . '%');
            });
        }

        $arsip = $query->paginate(20);

        $jenisSurat = ['masuk', 'keluar', 'resmi', 'notulensi', 'lainnya'];

        return view('arsip-surat.index', compact('arsip', 'jenisSurat'));
    }

    // Form upload surat — PUBLIK (tidak perlu login)
    public function create()
    {
        $jenisSurat = ['masuk', 'keluar', 'resmi', 'notulensi', 'lainnya'];

        return view('arsip-surat.create', compact('jenisSurat'));
    }

    // Store surat — PUBLIK (tidak perlu login)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_surat'   => 'required|string|max:255|unique:arsip_surat,nomor_surat',
            'jenis_surat'   => 'required|in:masuk,keluar,resmi,notulensi,lainnya',
            'perihal'       => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim'      => 'nullable|string|max:255',
            'penerima'      => 'nullable|string|max:255',
            'kategori'      => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'file'          => 'required|file|mimes:pdf,doc,docx|max:5120',
            'is_public'     => 'boolean',
        ]);

        $filePath = $request->file('file')->store('surat', 'public');

        ArsipSurat::create([
            'nomor_surat'   => $validated['nomor_surat'],
            'jenis_surat'   => $validated['jenis_surat'],
            'perihal'       => $validated['perihal'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'pengirim'      => $validated['pengirim'] ?? null,
            'penerima'      => $validated['penerima'] ?? null,
            'kategori'      => $validated['kategori'] ?? null,
            'deskripsi'     => $validated['deskripsi'] ?? null,
            'file_path'     => $filePath,
            'is_public'     => $request->is_public ?? false,
            'diupload_oleh' => auth()->id() ?? null,
        ]);

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Surat berhasil diarsipkan!');
    }

    // Download surat
    public function download(ArsipSurat $arsipSurat)
    {
        if (!$arsipSurat->is_public && (!auth()->check() || !auth()->user()->isPengurus())) {
            abort(403, 'Surat ini tidak dapat diakses');
        }

        $filename = str_replace(['/', '\\', ':', '*', '?', '"', '<', '>', '|'], '-', $arsipSurat->nomor_surat) . '.pdf';

        return Storage::disk('public')->download($arsipSurat->file_path, $filename);
    }

    // Edit surat (Pengurus Inti only)
    public function edit(ArsipSurat $arsipSurat)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $jenisSurat = ['masuk', 'keluar', 'resmi', 'notulensi', 'lainnya'];

        return view('arsip-surat.edit', compact('arsipSurat', 'jenisSurat'));
    }

    // Update surat
    public function update(Request $request, ArsipSurat $arsipSurat)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $validated = $request->validate([
            'nomor_surat'   => 'required|string|max:255|unique:arsip_surat,nomor_surat,' . $arsipSurat->id,
            'jenis_surat'   => 'required|in:masuk,keluar,resmi,notulensi,lainnya',
            'perihal'       => 'required|string|max:255',
            'tanggal_surat' => 'required|date',
            'pengirim'      => 'nullable|string|max:255',
            'penerima'      => 'nullable|string|max:255',
            'kategori'      => 'nullable|string|max:255',
            'deskripsi'     => 'nullable|string',
            'file'          => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'is_public'     => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($arsipSurat->file_path);
            $validated['file_path'] = $request->file('file')->store('surat', 'public');
        }

        $arsipSurat->update($validated);

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Surat berhasil diperbarui!');
    }

    // Delete surat (Pengurus Inti only)
    public function destroy(ArsipSurat $arsipSurat)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        Storage::disk('public')->delete($arsipSurat->file_path);
        $arsipSurat->delete();

        return redirect()->route('arsip-surat.index')
            ->with('success', 'Surat berhasil dihapus!');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // REPORT — generate PDF laporan semua arsip surat (Pengurus Inti only)
    // ─────────────────────────────────────────────────────────────────────────
    public function report()
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $arsip = ArsipSurat::orderBy('tanggal_surat', 'desc')->get();

        $pdf = Pdf::loadView('arsip-surat.report', compact('arsip'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'defaultFont'          => 'sans-serif',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => false,
            ]);

        $filename = 'Laporan_Arsip_Surat_' . now()->format('d-m-Y') . '.pdf';

        return $pdf->download($filename);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // QR PRINT — halaman print QR code untuk form upload surat — PUBLIK
    // ─────────────────────────────────────────────────────────────────────────
    public function qrPrint()
    {
        $uploadUrl = route('arsip-surat.create');

        return view('arsip-surat.qr-print', compact('uploadUrl'));
    }
}
