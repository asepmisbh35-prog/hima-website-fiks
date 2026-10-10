<?php

namespace App\Http\Controllers;

use App\Models\MonitoringProker;
use App\Models\Proker;
use Illuminate\Http\Request;

class MonitoringProkerController extends Controller
{
    public function store(Request $request, Proker $proker)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        // ✅ BENAR — validasi dulu, lalu ambil data validated terpisah
        $validated = $request->validate([
            'progress_persen'    => 'required|integer|min:0|max:100',
            'deskripsi_tahapan'  => 'required|string',
            'hambatan'           => 'nullable|string',
            'anggaran_terpakai'  => 'nullable|numeric|min:0',
            'partisipasi_anggota' => 'nullable|integer|min:0',
        ]);

        // Pastikan tidak null sebelum insert
        $validated['anggaran_terpakai']  = $validated['anggaran_terpakai'] ?? 0;
        $validated['partisipasi_anggota'] = $validated['partisipasi_anggota'] ?? 0;

       

        $validated['proker_id']      = $proker->id;
        $validated['tanggal_update'] = now();
        $validated['diinput_oleh']   = auth()->id();

        MonitoringProker::create($validated);

        // Update progress proker
        $updateData = [
            'progress_persen' => $validated['progress_persen'],
        ];

        if (!empty($validated['anggaran_terpakai'])) {
            $updateData['anggaran_terpakai'] = $proker->anggaran_terpakai + $validated['anggaran_terpakai'];
        }

        $proker->update($updateData);

        // Auto update status
        // Ganti bagian auto update status yang lama dengan ini:

        $progress = (int) $validated['progress_persen'];

        // Refresh proker untuk mendapatkan data terbaru
        $proker->refresh();

        if ($progress === 0) {
            $proker->update(['status' => 'perencanaan']);
        } elseif ($progress === 100 && $proker->file_lpj && $proker->foto_dokumentasi) {
            // 100% hanya jadi 'terealisasikan' jika LPJ & foto sudah ada
            $proker->update(['status' => 'selesai']);
        } elseif ($progress === 100 && (!$proker->file_lpj || !$proker->foto_dokumentasi)) {
            // 100% tapi belum lengkap → tetap 'berjalan' & kembalikan error
            $proker->update(['status' => 'berjalan']);
            return redirect()->route('proker.show', $proker)
                ->with('error', 'Progress 100% belum bisa diselesaikan! Harap upload LPJ dan foto dokumentasi terlebih dahulu.');
        } else {
            $proker->update(['status' => 'berjalan']);
        }

        return redirect()->route('proker.show', $proker)
            ->with('success', 'Update monitoring berhasil ditambahkan!');
    }
}