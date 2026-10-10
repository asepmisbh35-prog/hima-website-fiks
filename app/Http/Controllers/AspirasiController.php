<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AspirasiTanggapanMail;

class AspirasiController extends Controller
{
    public function create()
    {
        $kategoris = ['Akademik', 'Fasilitas', 'HIMA', 'BEM', 'DPM', 'BEMF', 'Lainnya'];
        
        // Siapkan variabel kosong untuk riwayat
        $riwayatAspirasi = collect(); 
        
        // Jika user sudah login (Mahasiswa Umum), ambil riwayat aspirasinya
        if (auth()->check()) {
            $riwayatAspirasi = Aspirasi::where('user_id', auth()->id())
                ->latest()
                ->paginate(5); // Menampilkan 5 riwayat per halaman agar tidak terlalu panjang
        }

        return view('aspirasi.create', compact('kategoris', 'riwayatAspirasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pengirim_nama' => 'required|string|max:255',
            'pengirim_email' => 'required|email|max:255',
            'pengirim_nim' => 'nullable|string|max:20',
            'kategori' => 'required|in:Akademik,Fasilitas,HIMA,BEM,DPM,BEMF,Lainnya',
            'isi_aspirasi' => 'required|string|max:1000',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Aspirasi::create($validated);

        return redirect()->route('aspirasi.create')
            ->with('success', 'Aspirasi berhasil dikirim!');
    }

    public function dashboard()
    {
        // Check authorization
        if (!auth()->user()->isPengurus()) {
            abort(403, 'Akses ditolak');
        }
        
        $aspirasi = Aspirasi::latest()->paginate(20);
        $stats = [
            'total' => Aspirasi::count(),
            'menunggu' => Aspirasi::where('status', 'menunggu')->count(),
            'diproses' => Aspirasi::where('status', 'diproses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];

        return view('aspirasi.dashboard', compact('aspirasi', 'stats'));
    }

    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        // Check authorization
        if (!auth()->user()->isPengurus()) {
            abort(403, 'Akses ditolak');
        }

        $validated = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,ditolak',
            'tanggapan' => 'nullable|string',
        ]);

        // Simpan status lama untuk dicek apakah berubah
        $oldStatus = $aspirasi->status;
        $oldTanggapan = $aspirasi->tanggapan;

        // Update database
        $aspirasi->update([
            'status' => $validated['status'],
            'tanggapan' => $validated['tanggapan'],
            'ditanggapi_oleh' => auth()->id(),
            'tanggal_tanggapan' => now(),
        ]);

        // Kirim email HANYA JIKA status berubah ATAU ada tanggapan baru yang ditambahkan
        if ($oldStatus !== $validated['status'] || $oldTanggapan !== $validated['tanggapan']) {
            try {
                // Pastikan email pengirim ada
                if (!empty($aspirasi->pengirim_email)) {
                    Mail::to($aspirasi->pengirim_email)
                        ->send(new AspirasiTanggapanMail($aspirasi));
                }
            } catch (\Exception $e) {
                // Log error jika email gagal terkirim (misal karena jaringan)
                \Log::error('Gagal kirim email aspirasi: ' . $e->getMessage());
                return back()->with('success', 'Status berhasil diperbarui, tapi email notifikasi gagal terkirim.');
            }
        }

        return back()->with('success', 'Status aspirasi berhasil diperbarui & notifikasi terkirim!');
    }

    public function destroy(Aspirasi $aspirasi)
    {
        // Check authorization
        if (!auth()->user()->isInti()) {
            abort(403, 'Akses ditolak');
        }
        
        $aspirasi->delete();

        return back()->with('success', 'Aspirasi berhasil dihapus!');
    }
    
}