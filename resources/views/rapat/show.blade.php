<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Rapat</h2>
            <a href="{{ route('rapat.edit', $rapat) }}"
                class="px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-800 text-sm font-medium transition">
                Edit Rapat
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ── Header Card ──────────────────────────────────────────────── --}}
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                {{-- Status bar warna --}}
                @php
                    $barColor = ['dijadwalkan'=>'bg-yellow-400','berlangsung'=>'bg-blue-500','selesai'=>'bg-green-500','dibatalkan'=>'bg-red-400'];
                    $statusColors = ['dijadwalkan'=>'bg-yellow-100 text-yellow-800','berlangsung'=>'bg-blue-100 text-blue-800','selesai'=>'bg-green-100 text-green-800','dibatalkan'=>'bg-red-100 text-red-800'];
                @endphp
                <div class="h-1.5 {{ $barColor[$rapat->status] ?? 'bg-gray-400' }}"></div>

                <div class="p-5 md:p-7">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div class="flex-1">
                            <h3 class="text-xl md:text-2xl font-bold text-gray-900 leading-tight">{{ $rapat->judul_rapat }}</h3>
                            <p class="text-sm text-gray-500 mt-1.5">
                                Dijadwalkan oleh <span class="font-medium text-gray-700">{{ $rapat->pembuat->name }}</span>
                                · <span class="text-gray-400">{{ $rapat->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <span class="self-start px-3 py-1.5 text-sm font-semibold rounded-full {{ $statusColors[$rapat->status] }}">
                            {{ ucfirst($rapat->status) }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                        <div class="flex items-start gap-3 p-3.5 bg-gray-50 rounded-xl">
                            <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Tanggal & Waktu</p>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">
                                    {{ $rapat->tanggal_waktu->translatedFormat('l, d F Y') }}
                                </p>
                                <p class="text-sm text-gray-600">Pukul {{ $rapat->tanggal_waktu->format('H:i') }} WIB</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 p-3.5 bg-gray-50 rounded-xl">
                            <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Lokasi</p>
                                <p class="text-sm font-semibold text-gray-900 mt-0.5">{{ $rapat->lokasi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Agenda ───────────────────────────────────────────────────── --}}
            <div class="bg-white shadow-sm rounded-xl p-5 md:p-7">
                <h4 class="text-base font-semibold text-gray-900 mb-3 flex items-center gap-2">
                    <span class="w-7 h-7 bg-orange-100 rounded-lg flex items-center justify-center text-sm">📋</span>
                    Agenda Rapat
                </h4>
                <pre class="whitespace-pre-wrap text-sm text-gray-700 font-sans leading-relaxed bg-gray-50 rounded-xl p-4">{{ $rapat->agenda }}</pre>
            </div>

            {{-- ── Peserta ──────────────────────────────────────────────────── --}}
            <div class="bg-white shadow-sm rounded-xl p-5 md:p-7">
                <h4 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <span class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center text-sm">👥</span>
                    Peserta Rapat
                    <span class="ml-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">
                        {{ $pesertaUsers->count() }} orang
                    </span>
                </h4>

                @if($pesertaUsers->isEmpty())
                    <p class="text-sm text-gray-500 italic">Belum ada peserta ditambahkan</p>
                @else
                    {{-- Desktop grid --}}
                    <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach($pesertaUsers as $u)
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50 hover:bg-blue-50 hover:border-blue-100 transition">
                                @if($u->photo)
                                    <img src="{{ asset('storage/' . $u->photo) }}" alt="{{ $u->name }}"
                                        class="w-10 h-10 rounded-full object-cover ring-2 ring-white"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                    <div class="hidden w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                @else
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $u->name }}</p>
                                    @php $rc = $u->role === 'pengurus_inti' ? ['👑','text-purple-600'] : ['⭐','text-green-600']; @endphp
                                    <p class="text-xs {{ $rc[1] }} font-medium">{{ $rc[0] }} {{ ucfirst(str_replace('_',' ',$u->role)) }}</p>
                                </div>
                                @if($u->id === $rapat->dibuat_oleh)
                                    <span class="text-[10px] bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded font-semibold">Host</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    {{-- Mobile list --}}
                    <div class="md:hidden space-y-2">
                        @foreach($pesertaUsers as $u)
                            <div class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 bg-gray-50">
                                @if($u->photo)
                                    <img src="{{ asset('storage/' . $u->photo) }}" alt="{{ $u->name }}"
                                        class="w-9 h-9 rounded-full object-cover"
                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                    <div class="hidden w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                @else
                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                                        {{ strtoupper(substr($u->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $u->name }}</p>
                                    @php $rc = $u->role === 'pengurus_inti' ? ['👑','text-purple-600'] : ['⭐','text-green-600']; @endphp
                                    <p class="text-xs {{ $rc[1] }}">{{ $rc[0] }} {{ ucfirst(str_replace('_',' ',$u->role)) }}</p>
                                </div>
                                @if($u->id === $rapat->dibuat_oleh)
                                    <span class="text-[10px] bg-blue-100 text-blue-700 px-1.5 py-0.5 rounded font-semibold">Host</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- Reminder status --}}
                <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-2">
                    @if($rapat->reminder_sent)
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs text-green-600 font-medium">Email reminder H-1 sudah terkirim</span>
                    @elseif($rapat->status === 'dijadwalkan')
                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-xs text-yellow-600 font-medium">
                            Email reminder akan dikirim otomatis H-1 sebelum rapat
                            ({{ $rapat->tanggal_waktu->subDay()->format('d M Y') }})
                        </span>
                    @endif
                </div>
            </div>

            {{-- ── Notulensi ────────────────────────────────────────────────── --}}
            <div class="bg-white shadow-sm rounded-xl p-5 md:p-7">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                        <span class="w-7 h-7 bg-indigo-100 rounded-lg flex items-center justify-center text-sm">📝</span>
                        Notulensi
                    </h4>
                    @if($rapat->file_notulensi)
                        <a href="{{ route('rapat.downloadNotulensi', $rapat) }}" target="_blank"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-lg text-xs font-semibold hover:bg-blue-100 transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            Download File
                        </a>
                    @endif
                </div>

                @if($rapat->notulensi || $rapat->file_notulensi)
                    @if($rapat->notulensi)
                        <pre class="whitespace-pre-wrap text-sm text-gray-700 font-sans leading-relaxed bg-gray-50 rounded-xl p-4 mb-4">{{ $rapat->notulensi }}</pre>
                    @endif
                    @if($rapat->file_notulensi)
                        <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-xl">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="text-sm text-green-800 font-medium">{{ basename($rapat->file_notulensi) }}</span>
                            </div>
                            <a href="{{ route('rapat.downloadNotulensi', $rapat) }}" target="_blank"
                                class="text-xs text-blue-600 hover:text-blue-800 font-medium">Download</a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-10 text-gray-400">
                        <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-sm">Notulensi belum tersedia</p>
                        <a href="{{ route('rapat.edit', $rapat) }}" class="mt-2 inline-block text-sm text-blue-600 hover:text-blue-800 font-medium">+ Tambah Notulensi</a>
                    </div>
                @endif
            </div>

            {{-- ── Quick Actions ────────────────────────────────────────────── --}}
            <div class="flex flex-wrap gap-3 pb-4">
                <a href="{{ route('rapat.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 text-sm font-medium transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </a>
                <a href="{{ route('rapat.edit', $rapat) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-800 text-sm font-medium transition">
                    Edit Rapat
                </a>
                @if(auth()->user()->isInti())
                    <form action="{{ route('rapat.destroy', $rapat) }}" method="POST"
                        onsubmit="return confirm('Yakin hapus rapat ini? Tindakan ini tidak dapat dibatalkan!')">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 text-sm font-medium transition">
                            Hapus Rapat
                        </button>
                    </form>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>