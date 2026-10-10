<?php

namespace App\Http\Controllers;

use App\Models\Rapat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class RapatController extends Controller
{
    // ─── Ambil daftar pengurus untuk pilihan peserta ──────────────────────────

    private function getPengurusOptions()
    {
        return User::whereIn('role', ['pengurus_harian', 'pengurus_inti'])
            ->orderByRaw("FIELD(role, 'pengurus_inti', 'pengurus_harian')")
            ->orderBy('name')
            ->get(['id', 'name', 'role', 'nim', 'photo']);
    }

    // ─── Index ────────────────────────────────────────────────────────────────

    public function index(Request $request)
    {
        if (!auth()->check() || !auth()->user()->isPengurus()) {
            abort(403, 'Hanya pengurus yang dapat melihat rapat');
        }

        $query = Rapat::with('pembuat')->latest('tanggal_waktu');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul_rapat', 'like', '%' . $request->search . '%')
                    ->orWhere('agenda', 'like', '%' . $request->search . '%')
                    ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        $rapat = $query->paginate(20);

        $stats = [
            'total'       => Rapat::count(),
            'dijadwalkan' => Rapat::where('status', 'dijadwalkan')->count(),
            'berlangsung' => Rapat::where('status', 'berlangsung')->count(),
            'selesai'     => Rapat::where('status', 'selesai')->count(),
        ];

        return view('rapat.index', compact('rapat', 'stats'));
    }

    // ─── Create ───────────────────────────────────────────────────────────────

    public function create()
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $pengurus = $this->getPengurusOptions();
        return view('rapat.create', compact('pengurus'));
    }

    // ─── Store ────────────────────────────────────────────────────────────────

    public function store(Request $request)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_rapat'  => 'required|string|max:255',
            'agenda'       => 'required|string',
            'tanggal_waktu' => 'required|date|after:now',
            'lokasi'       => 'required|string|max:255',
            'peserta_ids'  => 'nullable|array',
            'peserta_ids.*' => 'integer|exists:users,id',
            'notulensi'    => 'nullable|string',
            'file_notulensi' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // Pastikan pembuat rapat selalu masuk daftar peserta
        $pesertaIds = $validated['peserta_ids'] ?? [];
        if (!in_array(auth()->id(), $pesertaIds)) {
            $pesertaIds[] = auth()->id();
        }
        $validated['peserta_ids'] = $pesertaIds;

        if ($request->hasFile('file_notulensi')) {
            $validated['file_notulensi'] = $request->file('file_notulensi')->store('notulensi', 'public');
        }

        $validated['dibuat_oleh'] = auth()->id();
        $validated['status']      = 'dijadwalkan';
        $validated['reminder_sent'] = false;

        Rapat::create($validated);

        return redirect()->route('rapat.index')
            ->with('success', 'Rapat berhasil dijadwalkan! Notifikasi H-1 akan dikirim otomatis kepada peserta.');
    }

    // ─── Show ─────────────────────────────────────────────────────────────────

    public function show(Rapat $rapat)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $pesertaUsers = $rapat->getPesertaUsers();
        return view('rapat.show', compact('rapat', 'pesertaUsers'));
    }

    // ─── Edit ─────────────────────────────────────────────────────────────────

    public function edit(Rapat $rapat)
    {
        if (!auth()->user()->isInti() && $rapat->dibuat_oleh != auth()->id()) {
            abort(403);
        }

        $pengurus = $this->getPengurusOptions();
        return view('rapat.edit', compact('rapat', 'pengurus'));
    }

    // ─── Update ───────────────────────────────────────────────────────────────

    public function update(Request $request, Rapat $rapat)
    {
        if (!auth()->user()->isInti() && $rapat->dibuat_oleh != auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'judul_rapat'  => 'required|string|max:255',
            'agenda'       => 'required|string',
            'tanggal_waktu' => 'required|date',
            'lokasi'       => 'required|string|max:255',
            'peserta_ids'  => 'nullable|array',
            'peserta_ids.*' => 'integer|exists:users,id',
            'notulensi'    => 'nullable|string',
            'file_notulensi' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'status'       => 'required|in:dijadwalkan,berlangsung,selesai,dibatalkan',
        ]);

        // Pastikan pembuat rapat selalu masuk daftar peserta
        $pesertaIds = $validated['peserta_ids'] ?? [];
        if (!in_array($rapat->dibuat_oleh, $pesertaIds)) {
            $pesertaIds[] = $rapat->dibuat_oleh;
        }
        $validated['peserta_ids'] = $pesertaIds;

        // Jika tanggal diubah, reset flag reminder agar bisa dikirim ulang
        if ($rapat->tanggal_waktu->ne($validated['tanggal_waktu'])) {
            $validated['reminder_sent'] = false;
        }

        if ($request->hasFile('file_notulensi')) {
            if ($rapat->file_notulensi) {
                Storage::disk('public')->delete($rapat->file_notulensi);
            }
            $validated['file_notulensi'] = $request->file('file_notulensi')->store('notulensi', 'public');
        }

        $rapat->update($validated);

        return redirect()->route('rapat.index')
            ->with('success', 'Rapat berhasil diperbarui!');
    }

    // ─── Update Status ────────────────────────────────────────────────────────

    public function updateStatus(Request $request, Rapat $rapat)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:dijadwalkan,berlangsung,selesai,dibatalkan',
        ]);

        $rapat->update($validated);

        return back()->with('success', 'Status rapat berhasil diperbarui!');
    }

    // ─── Download Notulensi ───────────────────────────────────────────────────

    public function downloadNotulensi(Rapat $rapat)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        if (!$rapat->file_notulensi) {
            return back()->with('error', 'File notulensi tidak tersedia');
        }

        return Storage::disk('public')->download(
            $rapat->file_notulensi,
            $rapat->judul_rapat . ' - Notulensi.pdf'
        );
    }

    // ─── Destroy ─────────────────────────────────────────────────────────────

    public function destroy(Rapat $rapat)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        if ($rapat->file_notulensi) {
            Storage::disk('public')->delete($rapat->file_notulensi);
        }

        $rapat->delete();

        return redirect()->route('rapat.index')
            ->with('success', 'Rapat berhasil dihapus!');
    }
    public function content(): Content
    {
        $logoPath = public_path('images/himadikti.png');
        $logoBase64 = file_exists($logoPath)
            ? 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath))
            : null;

        return new Content(
            view: 'emails.rapat-reminder',
            with: [
                'logoBase64' => $logoBase64,
            ]
        );
    }
}
