<?php

namespace App\Http\Controllers;

use App\Models\PeriodePendaftaran;
use App\Models\PendaftaranPengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\PendaftaranStatusMail;
use Illuminate\Support\Facades\Mail;

class PendaftaranController extends Controller
{
    // Halaman publik - cek periode aktif (TANPA CEK TANGGAL KETAT)
    public function index()
    {
        // Ambil periode yang is_active = true
        $periode = PeriodePendaftaran::where('is_active', true)->first();

        return view('pendaftaran.index', compact('periode'));
    }

    // Form pendaftaran (harus login)
   // Form pendaftaran (harus login)
    public function create()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu');
        }

        // Ambil periode aktif
        $periode = PeriodePendaftaran::where('is_active', true)->first();

        if (!$periode) {
            return redirect()->route('pendaftaran.index')
                ->with('error', 'Pendaftaran sedang ditutup');
        }

        // ===== TAMBAHAN: CEK TANGGAL BUKA & TUTUP KETAT =====
        $sekarang = now();
        $tanggalBuka = \Carbon\Carbon::parse($periode->tanggal_buka)->startOfDay();
        $tanggalTutup = \Carbon\Carbon::parse($periode->tanggal_tutup)->endOfDay();

        if ($sekarang->lt($tanggalBuka)) {
            return redirect()->route('pendaftaran.index')->with('error', 'Mohon bersabar, periode pendaftaran belum dibuka.');
        }

        if ($sekarang->gt($tanggalTutup)) {
            return redirect()->route('pendaftaran.index')->with('error', 'Mohon maaf, waktu pendaftaran telah berakhir.');
        }
        // ====================================================

        // Cek apakah user sudah mendaftar di periode ini
        $sudahDaftar = PendaftaranPengurus::where('user_id', auth()->id())
            ->where('periode_id', $periode->id)
            ->exists();

        if ($sudahDaftar) {
            return redirect()->route('pendaftaran.index')
                ->with('error', 'Anda sudah mendaftar di periode ini');
        }

        return view('pendaftaran.create', compact('periode'));
    }

    // Proses pendaftaran
  // Proses pendaftaran
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $periode = PeriodePendaftaran::where('is_active', true)->first();

        if (!$periode) {
            return back()->with('error', 'Pendaftaran sedang ditutup');
        }

        // ===== TAMBAHAN: CEK TANGGAL BUKA & TUTUP KETAT =====
        $sekarang = now();
        $tanggalBuka = \Carbon\Carbon::parse($periode->tanggal_buka)->startOfDay();
        $tanggalTutup = \Carbon\Carbon::parse($periode->tanggal_tutup)->endOfDay();

        if ($sekarang->lt($tanggalBuka) || $sekarang->gt($tanggalTutup)) {
            return redirect()->route('pendaftaran.index')->with('error', 'Akses ditolak: Pendaftaran sedang tidak dalam masa aktif.');
        }
        // ====================================================

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'jurusan' => 'required|string|max:255',
            'cv' => 'required|file|mimes:pdf|max:2048',
            'motivasi' => 'required|string|max:500',
        ]);

        // Upload CV
        $cvPath = $request->file('cv')->store('cv', 'public');

        // Generate kode pendaftaran unik
        $kodePendaftaran = 'REG-' . strtoupper(Str::random(8));

        // Simpan pendaftaran
        PendaftaranPengurus::create([
            'kode_pendaftaran' => $kodePendaftaran,
            'periode_id' => $periode->id,
            'user_id' => auth()->id(),
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'jurusan' => $validated['jurusan'],
            'cv_path' => $cvPath,
            'motivasi' => $validated['motivasi'],
            'status' => 'menunggu',
        ]);

        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftaran berhasil! Kode pendaftaran Anda: ' . $kodePendaftaran);
    }
    // Dashboard untuk Pengurus
    public function dashboard(Request $request)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $query = PendaftaranPengurus::with(['periode', 'user'])->latest();

        if ($request->filled('periode_id')) {
            $query->where('periode_id', $request->periode_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pendaftaran = $query->paginate(20);
        $periodes = PeriodePendaftaran::latest()->get();

        $stats = [
            'total' => PendaftaranPengurus::count(),
            'menunggu' => PendaftaranPengurus::where('status', 'menunggu')->count(),
            'diterima' => PendaftaranPengurus::where('status', 'diterima')->count(),
            'ditolak' => PendaftaranPengurus::where('status', 'ditolak')->count(),
        ];

        return view('pendaftaran.dashboard', compact('pendaftaran', 'periodes', 'stats'));
    }

    // Update status pendaftaran
    public function updateStatus(Request $request, PendaftaranPengurus $pendaftaran)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:menunggu,diterima,ditolak',
            'catatan' => 'nullable|string',
        ]);

        $oldStatus = $pendaftaran->status;

        $pendaftaran->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
            'diverifikasi_oleh' => auth()->id(),
            'tanggal_verifikasi' => now(),
        ]);

        // Kirim email hanya jika status berubah
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($pendaftaran->user->email)
                    ->send(new PendaftaranStatusMail($pendaftaran));
            } catch (\Exception $e) {
                \Log::error('Failed to send email: ' . $e->getMessage());
            }
        }

        return redirect()
            ->route('pendaftaran.dashboard')
            ->with('success', 'Status diperbarui' . ($oldStatus !== $request->status ? ' & email notifikasi terkirim!' : '!'));
    }

    // Download CV
    public function downloadCV(PendaftaranPengurus $pendaftaran)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $path = Storage::disk('public')->path($pendaftaran->cv_path);
        return response()->download($path);
    }

    // ========== KELOLA PERIODE PENDAFTARAN ==========

    // Index Periode
    public function periodeIndex()
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $periodes = PeriodePendaftaran::with('pembuat')->latest()->paginate(10);

        return view('pendaftaran.periode.index', compact('periodes'));
    }

    // Form Create Periode
    public function periodeCreate()
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        return view('pendaftaran.periode.create');
    }

    // Store Periode Baru
    public function periodeStore(Request $request)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'deskripsi' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Jika checklist "Aktifkan periode ini sekarang" dicentang
        if ($request->has('is_active') && $request->is_active) {
            // Nonaktifkan semua periode lain dulu
            PeriodePendaftaran::query()->update(['is_active' => false]);
        }

        // Buat periode baru
        PeriodePendaftaran::create([
            'nama_periode' => $validated['nama_periode'],
            'tanggal_buka' => $validated['tanggal_buka'],
            'tanggal_tutup' => $validated['tanggal_tutup'],
            'deskripsi' => $validated['deskripsi'],
            'is_active' => $request->has('is_active') ? true : false,
            'dibuat_oleh' => auth()->id(),
        ]);

        return redirect()->route('pendaftaran.periode.index')
            ->with('success', 'Periode pendaftaran berhasil dibuat!');
    }

    // Form Edit Periode
    public function periodeEdit(PeriodePendaftaran $periode)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        return view('pendaftaran.periode.edit', compact('periode'));
    }

    // Update Periode
    public function periodeUpdate(Request $request, PeriodePendaftaran $periode)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_periode' => 'required|string|max:255',
            'tanggal_buka' => 'required|date',
            'tanggal_tutup' => 'required|date|after:tanggal_buka',
            'deskripsi' => 'nullable|string',
        ]);

        $periode->update($validated);

        return redirect()->route('pendaftaran.periode.index')
            ->with('success', 'Periode berhasil diperbarui!');
    }

    // Toggle Status Periode (Aktif/Nonaktif)
    public function periodeToggle(PeriodePendaftaran $periode)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        // Jika akan diaktifkan, nonaktifkan semua periode lain dulu
        if (!$periode->is_active) {
            PeriodePendaftaran::query()->update(['is_active' => false]);
        }

        // Toggle status periode ini
        $periode->update(['is_active' => !$periode->is_active]);

        $status = $periode->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()->route('pendaftaran.periode.index')
            ->with('success', "Periode berhasil {$status}!");
    }

    // ============================================================
// METHOD: Report PDF per Periode
// ============================================================

    /**
     * Generate laporan PDF untuk satu periode tertentu
     */
    public function reportPeriode(PeriodePendaftaran $periode)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        // Ambil semua data pendaftaran pada periode ini beserta relasi
        $pendaftaran = PendaftaranPengurus::with(['user', 'verifikator'])
            ->where('periode_id', $periode->id)
            ->orderBy('status')
            ->orderBy('created_at')
            ->get();

        // Hitung statistik untuk periode ini
        $stats = [
            'total'    => $pendaftaran->count(),
            'menunggu' => $pendaftaran->where('status', 'menunggu')->count(),
            'diterima' => $pendaftaran->where('status', 'diterima')->count(),
            'ditolak'  => $pendaftaran->where('status', 'ditolak')->count(),
        ];

        // Load view khusus PDF dan generate
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pendaftaran.report-pdf', [
            'periode'     => $periode,
            'pendaftaran' => $pendaftaran,
            'stats'       => $stats,
            'generated_at' => now()->format('d M Y, H:i'),
            'generated_by' => auth()->user()->name,
        ])->setPaper('a4', 'landscape');

        // Nama file PDF
        $filename = 'Laporan-Pendaftaran-' . \Illuminate\Support\Str::slug($periode->nama_periode) . '-' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}