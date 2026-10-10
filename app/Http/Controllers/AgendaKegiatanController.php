<?php

namespace App\Http\Controllers;

use App\Models\AgendaKegiatan;
use Illuminate\Http\Request;

class AgendaKegiatanController extends Controller
{
    // List semua agenda (public bisa lihat yang public)
    public function index(Request $request)
    {
        $query = AgendaKegiatan::with('pembuat')->latest('tanggal_mulai');

        // Filter untuk mahasiswa umum: hanya lihat yang public
        if (!auth()->check() || !auth()->user()->isPengurus()) {
            $query->where('is_public', true);
        }

        // Filter by bulan
        if ($request->filled('bulan')) {
            $bulan = $request->bulan;
            $query->whereMonth('tanggal_mulai', $bulan);
        }

        // Filter by divisi
        if ($request->filled('divisi')) {
            $query->where('divisi', $request->divisi);
        }

        $agenda = $query->get();

        // Get events untuk kalender (format JSON)
        $events = $agenda->map(function($item) {
            return [
                'id' => $item->id,
                'title' => $item->nama_kegiatan,
                'start' => $item->tanggal_mulai->format('Y-m-d'),
                'end' => $item->tanggal_selesai ? $item->tanggal_selesai->addDay()->format('Y-m-d') : null,
                'color' => $item->is_public ? '#3b82f6' : '#10b981',
                'url' => '#event-' . $item->id,
            ];
        });

        $divisis = AgendaKegiatan::distinct()->pluck('divisi')->filter();

        return view('agenda.index', compact('agenda', 'events', 'divisis'));
    }

    // Form tambah kegiatan (Pengurus only)
    public function create()
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        return view('agenda.create');
    }

    // Store kegiatan
    public function store(Request $request)
    {
        if (!auth()->user()->isPengurus()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable',
            'waktu_selesai' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
            'panitia_emails' => 'nullable|string',
            'divisi' => 'nullable|string|max:255',
            'is_public' => 'boolean',
        ]);

        // Convert panitia emails to JSON array
        if ($request->filled('panitia_emails')) {
            $emails = array_map('trim', explode(',', $request->panitia_emails));
            $validated['panitia_emails'] = json_encode($emails);
        }

        $validated['dibuat_oleh'] = auth()->id();
        $validated['is_public'] = $request->is_public ?? false;

        AgendaKegiatan::create($validated);

        // TODO: Kirim email notifikasi ke panitia

        return redirect()->route('agenda.index')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // Edit kegiatan
    public function edit(AgendaKegiatan $agenda)
    {
        // Cek permission
        if (!auth()->user()->isInti() && $agenda->dibuat_oleh != auth()->id()) {
            abort(403, 'Anda tidak dapat mengedit kegiatan ini');
        }

        return view('agenda.edit', compact('agenda'));
    }

    // Update kegiatan
    public function update(Request $request, AgendaKegiatan $agenda)
    {
        // Cek permission
        if (!auth()->user()->isInti() && $agenda->dibuat_oleh != auth()->id()) {
            abort(403, 'Anda tidak dapat mengedit kegiatan ini');
        }

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'waktu_mulai' => 'nullable',
            'waktu_selesai' => 'nullable',
            'lokasi' => 'nullable|string|max:255',
            'panitia_emails' => 'nullable|string',
            'divisi' => 'nullable|string|max:255',
            'is_public' => 'boolean',
        ]);

        // Convert panitia emails to JSON array
        if ($request->filled('panitia_emails')) {
            $emails = array_map('trim', explode(',', $request->panitia_emails));
            $validated['panitia_emails'] = json_encode($emails);
        }

        $validated['is_public'] = $request->is_public ?? false;

        $agenda->update($validated);

        return redirect()->route('agenda.index')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // Delete kegiatan (Pengurus Inti only)
    public function destroy(AgendaKegiatan $agenda)
    {
        if (!auth()->user()->isInti()) {
            abort(403);
        }

        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }
}