<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Program Kerja
            </h2>
            @if(auth()->user()->isPengurus())
                <a href="{{ route('proker.edit', $proker) }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm">
                    Edit Proker
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ==================== KOLOM KIRI ==================== --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Info Utama --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1 pr-4">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $proker->nama_proker }}</h3>
                                    <p class="text-sm text-gray-500 mt-1">Dibuat oleh {{ $proker->pembuat->name }}</p>
                                </div>
                                @php
                                    $statusColors = [
                                        'perencanaan'   => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                                        'berjalan'      => 'bg-blue-100 text-blue-800 border border-blue-300',
                                        'selesai'       => 'bg-green-100 text-green-800 border border-green-300',
                                        'terealisasikan'=> 'bg-emerald-100 text-emerald-800 border border-emerald-300',
                                        'dibatalkan'    => 'bg-red-100 text-red-800 border border-red-300',
                                    ];
                                    $statusLabels = [
                                        'perencanaan'    => '📋 Perencanaan',
                                        'berjalan'       => '🚀 Sedang Berjalan',
                                        'selesai'        => '✅ Selesai',
                                        'terealisasikan' => '🏆 Terealisasikan',
                                        'dibatalkan'     => '❌ Dibatalkan',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$proker->status] ?? 'bg-gray-100 text-gray-800' }} whitespace-nowrap">
                                    {{ $statusLabels[$proker->status] ?? ucfirst($proker->status) }}
                                </span>
                            </div>

                            <p class="text-gray-700">{{ $proker->deskripsi }}</p>

                            <div class="mt-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Ketua Pelaksana</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $proker->ketua_pelaksana ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Divisi</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $proker->divisi }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 mb-1">Periode</p>
                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $proker->tanggal_mulai->format('d M') }} – {{ $proker->tanggal_selesai->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Link Proposal --}}
                            @if($proker->file_proposal)
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <a
                                        href="{{ asset('storage/' . $proker->file_proposal) }}"
                                        target="_blank"
                                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 text-sm font-medium transition"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Lihat Proposal Kegiatan
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Progress --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Progress Kegiatan</h4>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Penyelesaian</span>
                                <span class="text-2xl font-bold text-primary-600">{{ $proker->progress_persen }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div
                                    class="h-4 rounded-full transition-all {{ $proker->progress_persen == 100 ? 'bg-emerald-500' : ($proker->progress_persen >= 90 ? 'bg-yellow-500' : 'bg-primary-600') }}"
                                    style="width: {{ $proker->progress_persen }}%"
                                ></div>
                            </div>

                            {{-- Milestone hints --}}
                            <div class="flex justify-between mt-1 text-xs text-gray-400">
                                <span>0%</span>
                                <span class="{{ $proker->progress_persen >= 20 ? 'text-primary-600 font-semibold' : '' }}">20% Berjalan</span>
                                <span class="{{ $proker->progress_persen >= 90 ? 'text-yellow-600 font-semibold' : '' }}">90% LPJ</span>
                                <span class="{{ $proker->progress_persen == 100 ? 'text-emerald-600 font-semibold' : '' }}">100%</span>
                            </div>

                            @if($proker->catatan_progress)
                                <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                                    <p class="text-xs text-gray-500 mb-1 font-medium">Catatan Progress:</p>
                                    <p class="text-sm text-gray-700">{{ $proker->catatan_progress }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Anggaran --}}
                    <div class="bg-white overflow-hidden shadow-lg sm:rounded-xl">
                        <div class="p-6">
                            <h4 class="text-lg font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Anggaran
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                                    <p class="text-xs font-medium text-blue-700 mb-1">Total Budget</p>
                                    <p class="text-xl font-bold text-blue-900">{{ $proker->formatRupiah($proker->anggaran) }}</p>
                                </div>
                                <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-4 border border-orange-200">
                                    <p class="text-xs font-medium text-orange-700 mb-1">Terpakai</p>
                                    <p class="text-xl font-bold text-orange-900">{{ $proker->formatRupiah($proker->anggaran_terpakai) }}</p>
                                    <p class="text-xs text-orange-600 mt-1">
                                        {{ $proker->anggaran > 0 ? number_format(($proker->anggaran_terpakai / $proker->anggaran) * 100, 1) : 0 }}%
                                    </p>
                                </div>
                                <div class="bg-gradient-to-br from-{{ $proker->sisa_anggaran >= 0 ? 'green' : 'red' }}-50 to-{{ $proker->sisa_anggaran >= 0 ? 'green' : 'red' }}-100 rounded-xl p-4 border border-{{ $proker->sisa_anggaran >= 0 ? 'green' : 'red' }}-200">
                                    <p class="text-xs font-medium text-{{ $proker->sisa_anggaran >= 0 ? 'green' : 'red' }}-700 mb-1">Sisa Budget</p>
                                    <p class="text-xl font-bold text-{{ $proker->sisa_anggaran >= 0 ? 'green' : 'red' }}-900">{{ $proker->formatRupiah($proker->sisa_anggaran) }}</p>
                                    @if($proker->sisa_anggaran < 0)
                                        <p class="text-xs text-red-700 mt-1 font-semibold">⚠️ Over Budget!</p>
                                    @else
                                        <p class="text-xs text-green-600 mt-1">✓ Dalam Budget</p>
                                    @endif
                                </div>
                            </div>

                            @php $budgetPercent = $proker->anggaran > 0 ? min(($proker->anggaran_terpakai / $proker->anggaran) * 100, 100) : 0; @endphp
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Penggunaan Budget</span>
                                    <span class="font-semibold {{ $proker->anggaran_terpakai > $proker->anggaran ? 'text-red-600' : '' }}">
                                        {{ number_format($budgetPercent, 1) }}%
                                    </span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="h-3 rounded-full transition-all {{ $proker->anggaran_terpakai > $proker->anggaran ? 'bg-red-600' : ($budgetPercent > 80 ? 'bg-yellow-500' : 'bg-green-600') }}"
                                         style="width: {{ $budgetPercent }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ==================== [BARU] SEKSI LPJ & DOKUMENTASI ==================== --}}
                    {{-- Hanya tampil jika progress >= 90% --}}
                    @if($proker->progress_persen >= 90)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border-2 {{ $proker->progress_persen == 100 ? 'border-emerald-300' : 'border-yellow-300' }}">
                            <div class="px-6 py-4 {{ $proker->progress_persen == 100 ? 'bg-emerald-50' : 'bg-yellow-50' }} border-b {{ $proker->progress_persen == 100 ? 'border-emerald-200' : 'border-yellow-200' }}">
                                <h4 class="font-bold {{ $proker->progress_persen == 100 ? 'text-emerald-900' : 'text-yellow-900' }} flex items-center gap-2">
                                    @if($proker->progress_persen == 100)
                                        🏆 Kegiatan Selesai — Kelengkapan Laporan
                                    @else
                                        📋 Hampir Selesai — Siapkan Laporan Akhir
                                    @endif
                                </h4>
                                <p class="text-xs {{ $proker->progress_persen == 100 ? 'text-emerald-700' : 'text-yellow-700' }} mt-1">
                                    @if($proker->progress_persen == 100)
                                        Progress sudah 100%. Pastikan LPJ dan dokumentasi sudah terupload.
                                    @else
                                        Progress sudah {{ $proker->progress_persen }}%. Upload LPJ dan dokumentasi sekarang agar siap saat kegiatan selesai.
                                    @endif
                                </p>
                            </div>

                            <div class="p-6 space-y-6">

                                {{-- Status checklist LPJ & Dokumentasi --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="flex items-center gap-3 p-3 rounded-lg {{ $proker->file_lpj ? 'bg-emerald-50 border border-emerald-200' : 'bg-gray-50 border border-gray-200' }}">
                                        @if($proker->file_lpj)
                                            <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                        <div>
                                            <p class="text-xs font-semibold {{ $proker->file_lpj ? 'text-emerald-800' : 'text-gray-700' }}">LPJ Kegiatan</p>
                                            <p class="text-xs {{ $proker->file_lpj ? 'text-emerald-600' : 'text-gray-400' }}">
                                                {{ $proker->file_lpj ? '✓ Terupload' : 'Belum diupload' }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 rounded-lg {{ $proker->foto_dokumentasi ? 'bg-emerald-50 border border-emerald-200' : 'bg-gray-50 border border-gray-200' }}">
                                        @if($proker->foto_dokumentasi)
                                            <svg class="w-6 h-6 text-emerald-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        @endif
                                        <div>
                                            <p class="text-xs font-semibold {{ $proker->foto_dokumentasi ? 'text-emerald-800' : 'text-gray-700' }}">Foto Dokumentasi</p>
                                            <p class="text-xs {{ $proker->foto_dokumentasi ? 'text-emerald-600' : 'text-gray-400' }}">
                                                {{ $proker->foto_dokumentasi ? '✓ Terupload' : 'Belum diupload' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Lihat file yang sudah ada --}}
                                @if($proker->file_lpj || $proker->foto_dokumentasi)
                                    <div class="flex flex-wrap gap-3">
                                        @if($proker->file_lpj)
                                            <a href="{{ asset('storage/' . $proker->file_lpj) }}" target="_blank"
                                               class="inline-flex items-center gap-2 px-3 py-2 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-lg hover:bg-emerald-100 text-xs font-medium transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                Download LPJ
                                            </a>
                                        @endif
                                        @if($proker->foto_dokumentasi)
                                            <a href="{{ asset('storage/' . $proker->foto_dokumentasi) }}" target="_blank"
                                               class="inline-flex items-center gap-2 px-3 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg hover:bg-blue-100 text-xs font-medium transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                Lihat Dokumentasi
                                            </a>
                                        @endif
                                    </div>
                                @endif

                                {{-- Form Upload LPJ & Dokumentasi --}}
                                @if(auth()->user()->isPengurus())
                                    <form
                                        action="{{ route('proker.upload-laporan', $proker) }}"
                                        method="POST"
                                        enctype="multipart/form-data"
                                        class="space-y-5 pt-4 border-t border-gray-200"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ ($proker->file_lpj && $proker->foto_dokumentasi) ? '🔄 Perbarui' : '📤 Upload' }} Laporan Akhir
                                        </p>

                                        {{-- Upload LPJ --}}
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                LPJ Kegiatan
                                                @if(!$proker->file_lpj)
                                                    <span class="text-red-500">*</span>
                                                @else
                                                    <span class="text-gray-400 font-normal">(opsional — ganti file lama)</span>
                                                @endif
                                            </label>
                                            <div
                                                id="drop-zone-lpj"
                                                class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition cursor-pointer group"
                                                onclick="document.getElementById('file_lpj').click()"
                                            >
                                                <div id="lpj-placeholder">
                                                    <svg class="mx-auto w-8 h-8 text-gray-400 group-hover:text-primary-500 transition mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    <p class="text-sm text-gray-600">Klik untuk upload LPJ</p>
                                                    <p class="text-xs text-gray-400 mt-1">PDF, DOC, DOCX · Maks 10 MB</p>
                                                </div>
                                                <div id="lpj-preview" class="hidden">
                                                    <svg class="mx-auto w-8 h-8 text-emerald-500 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <p id="lpj-filename" class="text-sm font-semibold text-emerald-700"></p>
                                                    <p id="lpj-filesize" class="text-xs text-gray-400 mt-1"></p>
                                                    <button type="button" onclick="clearFile(event, 'file_lpj', 'lpj')" class="mt-1 text-xs text-red-500 hover:underline">Hapus</button>
                                                </div>
                                            </div>
                                            <input type="file" name="file_lpj" id="file_lpj" class="hidden"
                                                accept=".pdf,.doc,.docx"
                                                onchange="handleFileChange(this, 'lpj')">
                                            @error('file_lpj')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Upload Foto Dokumentasi --}}
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                Foto Dokumentasi Kegiatan
                                                @if(!$proker->foto_dokumentasi)
                                                    <span class="text-red-500">*</span>
                                                @else
                                                    <span class="text-gray-400 font-normal">(opsional — ganti foto lama)</span>
                                                @endif
                                            </label>
                                            <div
                                                id="drop-zone-foto"
                                                class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-400 hover:bg-primary-50 transition cursor-pointer group"
                                                onclick="document.getElementById('foto_dokumentasi').click()"
                                            >
                                                <div id="foto-placeholder">
                                                    <svg class="mx-auto w-8 h-8 text-gray-400 group-hover:text-primary-500 transition mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    <p class="text-sm text-gray-600">Klik untuk upload foto dokumentasi</p>
                                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP · Maks 5 MB</p>
                                                </div>
                                                <div id="foto-preview" class="hidden">
                                                    <img id="foto-img-preview" src="" alt="preview" class="mx-auto max-h-32 rounded-lg mb-2 object-cover">
                                                    <p id="foto-filename" class="text-sm font-semibold text-emerald-700"></p>
                                                    <button type="button" onclick="clearFile(event, 'foto_dokumentasi', 'foto')" class="mt-1 text-xs text-red-500 hover:underline">Hapus</button>
                                                </div>
                                            </div>
                                            <input type="file" name="foto_dokumentasi" id="foto_dokumentasi" class="hidden"
                                                accept="image/jpeg,image/png,image/webp,.jpg,.jpeg,.png,.webp"
                                                onchange="handleImageChange(this)">
                                            @error('foto_dokumentasi')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        {{-- Syarat 100% warning --}}
                                        @if($proker->progress_persen < 100 || !$proker->file_lpj || !$proker->foto_dokumentasi)
                                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 flex items-start gap-2">
                                                <svg class="w-4 h-4 text-amber-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-xs text-amber-800">
                                                    <strong>Syarat progress 100%:</strong> LPJ dan foto dokumentasi harus sudah diupload sebelum progress dapat diset ke 100%.
                                                </p>
                                            </div>
                                        @endif

                                        <button
                                            type="submit"
                                            class="w-full px-4 py-3 bg-primary-600 text-white font-semibold rounded-xl hover:bg-primary-800 transition shadow flex items-center justify-center gap-2"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                            </svg>
                                            Upload Laporan Akhir
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Riwayat Monitoring --}}
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Riwayat Monitoring</h4>

                            @forelse($proker->monitoring as $monitor)
                                <div class="mb-4 p-4 border border-gray-200 rounded-lg hover:border-primary-200 transition">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-medium text-gray-700">
                                            {{ $monitor->tanggal_update->format('d F Y') }}
                                        </span>
                                        <span class="px-2 py-1 bg-primary-100 text-primary-800 text-xs font-semibold rounded-full">
                                            {{ $monitor->progress_persen }}%
                                        </span>
                                    </div>
                                    <p class="text-xs text-gray-500 mb-2">Diinput oleh: {{ $monitor->inputter->name ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-700 mb-2">{{ $monitor->deskripsi_tahapan }}</p>
                                    @if($monitor->hambatan)
                                        <div class="mt-2 p-2 bg-yellow-50 rounded">
                                            <p class="text-xs text-yellow-800"><strong>Hambatan:</strong> {{ $monitor->hambatan }}</p>
                                        </div>
                                    @endif
                                    <div class="mt-2 flex gap-4 text-xs text-gray-500">
                                        @if($monitor->anggaran_terpakai)
                                            <span>💰 {{ $proker->formatRupiah($monitor->anggaran_terpakai) }}</span>
                                        @endif
                                        @if($monitor->partisipasi_anggota)
                                            <span>👥 {{ $monitor->partisipasi_anggota }} anggota</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">Belum ada riwayat monitoring</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- ==================== KOLOM KANAN: FORM MONITORING ==================== --}}
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-6">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-1">Tambah Update Monitoring</h4>
                            <p class="text-xs text-gray-500 mb-4">Status kegiatan berubah otomatis sesuai progress</p>

                            {{-- Status otomatis info --}}
                            <div class="mb-4 grid grid-cols-3 gap-1 text-center text-xs">
                                <div class="rounded-lg p-2 {{ $proker->status == 'perencanaan' ? 'bg-yellow-100 text-yellow-800 font-semibold ring-2 ring-yellow-400' : 'bg-gray-100 text-gray-500' }}">
                                    📋<br>0%<br>Perencanaan
                                </div>
                                <div class="rounded-lg p-2 {{ $proker->status == 'berjalan' ? 'bg-blue-100 text-blue-800 font-semibold ring-2 ring-blue-400' : 'bg-gray-100 text-gray-500' }}">
                                    🚀<br>&gt;20%<br>Berjalan
                                </div>
                                <div class="rounded-lg p-2 {{ $proker->status == 'terealisasikan' ? 'bg-emerald-100 text-emerald-800 font-semibold ring-2 ring-emerald-400' : 'bg-gray-100 text-gray-500' }}">
                                    🏆<br>100%<br>Terealisasi
                                </div>
                            </div>

                            @if($proker->progress_persen >= 90 && (!$proker->file_lpj || !$proker->foto_dokumentasi))
                                <div class="mb-4 bg-amber-50 border border-amber-300 rounded-lg p-3">
                                    <p class="text-xs text-amber-800 font-medium">
                                        ⚠️ Upload LPJ & foto dokumentasi (di bawah) sebelum menyentuh 100%.
                                    </p>
                                </div>
                            @endif

                            <form action="{{ route('monitoring.store', $proker) }}" method="POST" class="space-y-4">
                                @csrf

                                <div>
                                    <label for="progress_persen" class="block text-sm font-medium text-gray-700 mb-1">
                                        Progress (%) <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="number"
                                        name="progress_persen"
                                        id="progress_persen"
                                        class="w-full rounded-lg border-gray-300"
                                        min="0"
                                        max="100"
                                        value="{{ $proker->progress_persen }}"
                                        required
                                        oninput="updateStatusHint(this.value)"
                                    >
                                    <p id="status-hint" class="mt-1 text-xs text-gray-500"></p>
                                </div>

                                <div>
                                    <label for="deskripsi_tahapan" class="block text-sm font-medium text-gray-700 mb-1">
                                        Deskripsi Tahapan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        name="deskripsi_tahapan"
                                        id="deskripsi_tahapan"
                                        rows="3"
                                        class="w-full rounded-lg border-gray-300"
                                        placeholder="Apa yang sudah dikerjakan..."
                                        required
                                    ></textarea>
                                </div>

                                <div>
                                    <label for="hambatan" class="block text-sm font-medium text-gray-700 mb-1">
                                        Hambatan
                                    </label>
                                    <textarea
                                        name="hambatan"
                                        id="hambatan"
                                        rows="2"
                                        class="w-full rounded-lg border-gray-300"
                                        placeholder="Kendala yang dihadapi (opsional)..."
                                    ></textarea>
                                </div>

                                <div>
                                    <label for="anggaran_terpakai" class="block text-sm font-medium text-gray-700 mb-1">
                                        Anggaran Terpakai (Rp)
                                    </label>
                                    <input
                                        type="number"
                                        name="anggaran_terpakai"
                                        id="anggaran_terpakai"
                                        class="w-full rounded-lg border-gray-300"
                                        min="0"
                                        step="1000"
                                        placeholder="0"
                                    >
                                </div>

                                <div>
                                    <label for="partisipasi_anggota" class="block text-sm font-medium text-gray-700 mb-1">
                                        Partisipasi Anggota
                                    </label>
                                    <input
                                        type="number"
                                        name="partisipasi_anggota"
                                        id="partisipasi_anggota"
                                        class="w-full rounded-lg border-gray-300"
                                        min="0"
                                        placeholder="Jumlah anggota terlibat"
                                    >
                                </div>

                                <button
                                    type="submit"
                                    class="w-full px-4 py-2 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition"
                                >
                                    Simpan Update
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('proker.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali ke Daftar Proker
                </a>
            </div>
        </div>
    </div>

    <script>
        // ---- Status Hint pada input progress ----
        function updateStatusHint(val) {
            const hint = document.getElementById('status-hint');
            val = parseInt(val) || 0;
            if (val === 0) {
                hint.textContent = '→ Status: Perencanaan';
                hint.className = 'mt-1 text-xs text-yellow-600 font-medium';
            } else if (val > 0 && val < 100) {
                hint.textContent = val >= 90
                    ? '→ Status: Berjalan · Siapkan LPJ & dokumentasi!'
                    : '→ Status: Berjalan';
                hint.className = 'mt-1 text-xs text-blue-600 font-medium';
            } else if (val === 100) {
                hint.textContent = '→ Status: Terealisasikan (wajib ada LPJ & dokumentasi)';
                hint.className = 'mt-1 text-xs text-emerald-600 font-medium';
            }
        }
        updateStatusHint({{ $proker->progress_persen }});

        // ---- File Handlers ----
        function handleFileChange(input, key) {
            const file = input.files[0];
            if (!file) return;
            const maxSize = 10 * 1024 * 1024;
            if (file.size > maxSize) { alert('File melebihi 10 MB.'); input.value = ''; return; }
            document.getElementById(key + '-placeholder').classList.add('hidden');
            document.getElementById(key + '-preview').classList.remove('hidden');
            document.getElementById(key + '-filename').textContent = file.name;
            if (document.getElementById(key + '-filesize'))
                document.getElementById(key + '-filesize').textContent = formatFileSize(file.size);
        }

        function handleImageChange(input) {
            const file = input.files[0];
            if (!file) return;
            const maxSize = 5 * 1024 * 1024;
            if (file.size > maxSize) { alert('Foto melebihi 5 MB.'); input.value = ''; return; }
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('foto-placeholder').classList.add('hidden');
                document.getElementById('foto-preview').classList.remove('hidden');
                document.getElementById('foto-img-preview').src = e.target.result;
                document.getElementById('foto-filename').textContent = file.name;
            };
            reader.readAsDataURL(file);
        }

        function clearFile(event, inputId, key) {
            event.stopPropagation();
            document.getElementById(inputId).value = '';
            document.getElementById(key + '-placeholder').classList.remove('hidden');
            document.getElementById(key + '-preview').classList.add('hidden');
            if (key === 'foto') document.getElementById('foto-img-preview').src = '';
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
        }

        // Drag-drop untuk LPJ
        ['lpj', 'foto'].forEach(key => {
            const zone = document.getElementById('drop-zone-' + key);
            if (!zone) return;
            zone.addEventListener('dragover', e => { e.preventDefault(); zone.classList.add('border-primary-500', 'bg-primary-50'); });
            zone.addEventListener('dragleave', () => zone.classList.remove('border-primary-500', 'bg-primary-50'));
            zone.addEventListener('drop', e => {
                e.preventDefault();
                zone.classList.remove('border-primary-500', 'bg-primary-50');
                const inputId = key === 'lpj' ? 'file_lpj' : 'foto_dokumentasi';
                const input = document.getElementById(inputId);
                const dt = new DataTransfer();
                dt.items.add(e.dataTransfer.files[0]);
                input.files = dt.files;
                key === 'foto' ? handleImageChange(input) : handleFileChange(input, key);
            });
        });
    </script>
</x-app-layout>