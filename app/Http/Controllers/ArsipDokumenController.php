<?php

namespace App\Http\Controllers;

use App\Models\ArsipDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArsipDokumenController extends Controller
{
    public function index(Request $request)
    {
        $query = ArsipDokumen::with('uploader')->where('is_latest', true)->latest();

        if (!auth()->check() || !auth()->user()->isPengurus()) {
            $query->where('is_public', true);
        }
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%'.$request->search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
            });
        }

        $dokumen = $query->paginate(20)->withQueryString();
        $kategoris = ArsipDokumen::distinct()->pluck('kategori');

        return view('arsip-dokumen.index', compact('dokumen', 'kategoris'));
    }

    public function create()
    {
        if (!auth()->user()->isPengurus()) abort(403);
        return view('arsip-dokumen.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isPengurus()) abort(403);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:'.implode(',', ArsipDokumen::KATEGORI_LIST),
            'deskripsi' => 'nullable|string',
            'tanggal_dokumen' => 'required|date',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:10240',
            'is_public' => 'boolean',
        ]);

        $file = $request->file('file');
        $filePath = $file->store('dokumen', 'public');

        ArsipDokumen::create([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'tanggal_dokumen' => $validated['tanggal_dokumen'],
            'file_path' => $filePath,
            'file_type' => $file->getClientOriginalExtension(),
            'file_size' => $file->getSize(),
            'is_public' => $request->boolean('is_public'),
            'diupload_oleh' => auth()->id(),
            'parent_id' => null,
            'versi' => 1,
            'is_latest' => true,
        ]);

        return redirect()->route('arsip-dokumen.index')->with('success', 'Dokumen berhasil diupload!');
    }

    public function edit(ArsipDokumen $arsipDokumen)
    {
        if (!auth()->user()->isPengurus()) abort(403);
        return view('arsip-dokumen.edit', compact('arsipDokumen'));
    }

    public function update(Request $request, ArsipDokumen $arsipDokumen)
    {
        if (!auth()->user()->isPengurus()) abort(403);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|in:'.implode(',', ArsipDokumen::KATEGORI_LIST),
            'deskripsi' => 'nullable|string',
            'tanggal_dokumen' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,jpg,jpeg,png|max:10240',
            'is_public' => 'boolean',
        ]);

        if ($request->hasFile('file')) {
            $rootId = $arsipDokumen->root_id;
            $versiTerakhir = ArsipDokumen::where('id', $rootId)->orWhere('parent_id', $rootId)->max('versi');

            $file = $request->file('file');
            $filePath = $file->store('dokumen', 'public');

            ArsipDokumen::create([
                'judul' => $validated['judul'],
                'kategori' => $validated['kategori'],
                'deskripsi' => $validated['deskripsi'] ?? null,
                'tanggal_dokumen' => $validated['tanggal_dokumen'],
                'file_path' => $filePath,
                'file_type' => $file->getClientOriginalExtension(),
                'file_size' => $file->getSize(),
                'is_public' => $request->boolean('is_public'),
                'diupload_oleh' => auth()->id(),
                'parent_id' => $rootId,
                'versi' => $versiTerakhir + 1,
                'is_latest' => true,
            ]);

            $arsipDokumen->update(['is_latest' => false]);

            return redirect()->route('arsip-dokumen.index')
                ->with('success', 'Versi baru dokumen berhasil diupload! Versi lama tetap tersimpan di riwayat.');
        }

        $arsipDokumen->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'tanggal_dokumen' => $validated['tanggal_dokumen'],
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()->route('arsip-dokumen.index')->with('success', 'Dokumen berhasil diperbarui!');
    }

    public function history(ArsipDokumen $arsipDokumen)
    {
        $rootId = $arsipDokumen->root_id;
        $versions = ArsipDokumen::where('id', $rootId)->orWhere('parent_id', $rootId)
            ->orderByDesc('versi')->get();

        if ($versions->isEmpty() || (!$versions->first()->is_public && (!auth()->check() || !auth()->user()->isPengurus()))) {
            abort(403);
        }

        return view('arsip-dokumen.history', compact('versions', 'arsipDokumen'));
    }

    public function preview(ArsipDokumen $arsipDokumen)
    {
        if (!$arsipDokumen->is_public && (!auth()->check() || !auth()->user()->isPengurus())) {
            abort(403, 'Dokumen ini tidak dapat diakses');
        }
        if (!$arsipDokumen->isPreviewable()) {
            return redirect()->route('arsip-dokumen.download', $arsipDokumen);
        }
        return view('arsip-dokumen.preview', compact('arsipDokumen'));
    }

    public function download(ArsipDokumen $arsipDokumen)
    {
        if (!$arsipDokumen->is_public && (!auth()->check() || !auth()->user()->isPengurus())) {
            abort(403, 'Dokumen ini tidak dapat diakses');
        }
        $arsipDokumen->increment('download_count');
        return Storage::disk('public')->download($arsipDokumen->file_path, $arsipDokumen->judul.'.'.$arsipDokumen->file_type);
    }

    public function destroy(ArsipDokumen $arsipDokumen)
    {
        if (!auth()->user()->isInti()) abort(403);

        $rootId = $arsipDokumen->root_id;
        $semuaVersi = ArsipDokumen::where('id', $rootId)->orWhere('parent_id', $rootId)->get();
        foreach ($semuaVersi as $versi) {
            Storage::disk('public')->delete($versi->file_path);
            $versi->delete();
        }

        return redirect()->route('arsip-dokumen.index')->with('success', 'Dokumen berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        if (!auth()->user()->isInti()) abort(403);

        $request->validate(['ids' => 'required|array', 'ids.*' => 'exists:arsip_dokumen,id']);

        $jumlah = 0;
        foreach (ArsipDokumen::whereIn('id', $request->ids)->get() as $dok) {
            $rootId = $dok->root_id;
            foreach (ArsipDokumen::where('id', $rootId)->orWhere('parent_id', $rootId)->get() as $versi) {
                Storage::disk('public')->delete($versi->file_path);
                $versi->delete();
            }
            $jumlah++;
        }

        return redirect()->route('arsip-dokumen.index')->with('success', "{$jumlah} dokumen berhasil dihapus!");
    }

    public function bulkUpdateKategori(Request $request)
    {
        if (!auth()->user()->isPengurus()) abort(403);

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:arsip_dokumen,id',
            'kategori' => 'required|string|in:'.implode(',', ArsipDokumen::KATEGORI_LIST),
        ]);

        $jumlah = ArsipDokumen::whereIn('id', $request->ids)->where('is_latest', true)
            ->update(['kategori' => $request->kategori]);

        return redirect()->route('arsip-dokumen.index')
            ->with('success', "Kategori {$jumlah} dokumen berhasil diubah menjadi \"{$request->kategori}\"!");
    }
}
