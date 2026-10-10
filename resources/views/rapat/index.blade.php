<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Rapat & Notulensi
            </h2>
            <a href="{{ route('rapat.create') }}"
                class="inline-flex items-center gap-1.5 px-3 py-2 md:px-4 md:py-2.5 bg-primary-600 text-white rounded-xl hover:bg-primary-700 transition text-xs md:text-sm font-semibold shadow-sm whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Jadwalkan Rapat
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            {{-- ── Stats ────────────────────────────────────────────────────── --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                @php
                    $statItems = [
                        ['label'=>'Total Rapat',   'value'=>$stats['total'],       'color'=>'text-gray-900',   'bg'=>'bg-red-100',   'icon'=>'text-red-600',   'svg'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'],
                        ['label'=>'Dijadwalkan',   'value'=>$stats['dijadwalkan'], 'color'=>'text-yellow-600', 'bg'=>'bg-yellow-100', 'icon'=>'text-yellow-600', 'svg'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label'=>'Berlangsung',   'value'=>$stats['berlangsung'], 'color'=>'text-blue-600',   'bg'=>'bg-blue-100',   'icon'=>'text-blue-600',   'svg'=>'M13 10V3L4 14h7v7l9-11h-7z'],
                        ['label'=>'Selesai',       'value'=>$stats['selesai'],     'color'=>'text-green-600',  'bg'=>'bg-green-100',  'icon'=>'text-green-600',  'svg'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp
                @foreach($statItems as $s)
                    <div class="bg-white rounded-xl shadow-sm p-4 md:p-5 flex items-center gap-3">
                        <div class="{{ $s['bg'] }} rounded-xl p-2.5">
                            <svg class="w-5 h-5 {{ $s['icon'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['svg'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 leading-none mb-1">{{ $s['label'] }}</p>
                            <p class="text-xl md:text-2xl font-bold {{ $s['color'] }} leading-none">{{ $s['value'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- ── Flash Messages ───────────────────────────────────────────── --}}
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">{{ session('error') }}</div>
            @endif

            {{-- ── Filter ───────────────────────────────────────────────────── --}}
            <div class="bg-white rounded-xl shadow-sm p-4">
                <form method="GET" action="{{ route('rapat.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Cari judul, agenda, lokasi..."
                            value="{{ request('search') }}"
                            class="w-full pl-10 rounded-xl border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                    </div>
                    <div>
                        <select name="status" class="w-full rounded-xl border-gray-300 text-sm focus:border-primary-500 focus:ring-primary-500">
                            <option value="">Semua Status</option>
                            @foreach(['dijadwalkan'=>'Dijadwalkan','berlangsung'=>'Berlangsung','selesai'=>'Selesai','dibatalkan'=>'Dibatalkan'] as $v => $l)
                                <option value="{{ $v }}" {{ request('status') == $v ? 'selected' : '' }}>{{ $l }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-xl hover:bg-primary-700 text-sm font-medium transition">Filter</button>
                        <a href="{{ route('rapat.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 text-sm text-center flex items-center justify-center transition">Reset</a>
                    </div>
                </form>
            </div>

            {{-- ── Table / Cards ─────────────────────────────────────────────── --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl">
                <div class="p-4 md:p-6">

                    {{-- Desktop Table --}}
                    <div id="dt-table" class="overflow-x-auto" style="display:none">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    @foreach(['Judul Rapat','Tanggal & Waktu','Lokasi','Peserta','Status','Notulensi','Aksi'] as $th)
                                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ $th }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($rapat as $item)
                                    @php
                                        $sc = ['dijadwalkan'=>'bg-yellow-100 text-yellow-800','berlangsung'=>'bg-blue-100 text-blue-800','selesai'=>'bg-green-100 text-green-800','dibatalkan'=>'bg-red-100 text-red-800'];
                                        $pesertaCount = $item->getPesertaCount();
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-5 py-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $item->judul_rapat }}</div>
                                            <div class="text-xs text-gray-500 mt-0.5">{{ Str::limit($item->agenda, 55) }}</div>
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap text-sm text-gray-700">
                                            <div>{{ $item->tanggal_waktu->format('d M Y') }}</div>
                                            <div class="text-xs text-gray-500">{{ $item->tanggal_waktu->format('H:i') }} WIB</div>
                                        </td>
                                        <td class="px-5 py-4 text-sm text-gray-700">{{ $item->lokasi }}</td>
                                        <td class="px-5 py-4 whitespace-nowrap">
                                            @if($pesertaCount > 0)
                                                <span class="inline-flex items-center gap-1 text-sm text-gray-700">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                                    </svg>
                                                    {{ $pesertaCount }} orang
                                                </span>
                                            @else
                                                <span class="text-xs text-gray-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full {{ $sc[$item->status] }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap text-sm">
                                            @if($item->file_notulensi)
                                                <a href="{{ route('rapat.downloadNotulensi', $item) }}" target="_blank"
                                                    class="inline-flex items-center gap-1 text-primary-600 hover:text-primary-800 font-medium">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                                    Download
                                                </a>
                                            @else
                                                <span class="text-gray-400 text-xs">Belum ada</span>
                                            @endif
                                        </td>
                                        <td class="px-5 py-4 whitespace-nowrap text-sm">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('rapat.show', $item) }}" class="text-primary-600 hover:text-primary-900 font-medium">Detail</a>
                                                <span class="text-gray-300">·</span>
                                                <a href="{{ route('rapat.edit', $item) }}" class="text-gray-600 hover:text-gray-900 font-medium">Edit</a>
                                                @if(auth()->user()->isInti())
                                                    <span class="text-gray-300">·</span>
                                                    <form action="{{ route('rapat.destroy', $item) }}" method="POST" class="inline"
                                                        onsubmit="return confirm('Yakin hapus rapat ini?')">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Hapus</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-5 py-16 text-center text-gray-500">
                                            <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="text-sm">Belum ada rapat dijadwalkan</p>
                                            <a href="{{ route('rapat.create') }}" class="mt-3 inline-block text-sm text-primary-600 hover:text-primary-800 font-medium">+ Jadwalkan Rapat Pertama</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Mobile Cards --}}
                    <div id="mb-cards" class="space-y-3" style="display:none">
                        @forelse($rapat as $item)
                            @php
                                $sc = ['dijadwalkan'=>'bg-yellow-100 text-yellow-800 border-yellow-200','berlangsung'=>'bg-blue-100 text-blue-800 border-blue-200','selesai'=>'bg-green-100 text-green-800 border-green-200','dibatalkan'=>'bg-red-100 text-red-800 border-red-200'];
                                $bar = ['dijadwalkan'=>'bg-yellow-400','berlangsung'=>'bg-blue-500','selesai'=>'bg-green-500','dibatalkan'=>'bg-red-400'];
                                $pesertaCount = $item->getPesertaCount();
                            @endphp
                            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-sm">
                                <div class="h-1 {{ $bar[$item->status] ?? 'bg-gray-300' }}"></div>
                                <div class="p-4">
                                    <div class="flex items-start justify-between gap-3 mb-3">
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-sm font-bold text-gray-900 leading-snug">{{ $item->judul_rapat }}</h3>
                                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $item->agenda }}</p>
                                        </div>
                                        <span class="flex-shrink-0 px-2.5 py-1 text-[10px] font-bold rounded-full border {{ $sc[$item->status] }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2 bg-gray-50 rounded-xl p-3 mb-3">
                                        <div class="flex items-start gap-2">
                                            <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <div>
                                                <p class="text-[10px] text-gray-400 font-semibold uppercase">Tanggal</p>
                                                <p class="text-xs font-semibold text-gray-700">{{ $item->tanggal_waktu->format('d M Y') }}</p>
                                                <p class="text-xs text-gray-500">{{ $item->tanggal_waktu->format('H:i') }} WIB</p>
                                            </div>
                                        </div>
                                        <div class="flex items-start gap-2">
                                            <svg class="w-3.5 h-3.5 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                            <div>
                                                <p class="text-[10px] text-gray-400 font-semibold uppercase">Lokasi</p>
                                                <p class="text-xs font-semibold text-gray-700 line-clamp-2">{{ $item->lokasi }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Peserta avatars (preview) --}}
                                    @php $pesertaPreview = $item->getPesertaUsers()->take(5); @endphp
                                    @if($pesertaPreview->isNotEmpty())
                                        <div class="flex items-center gap-2 mb-3">
                                            <div class="flex -space-x-2">
                                                @foreach($pesertaPreview as $p)
                                                    @if($p->photo)
                                                        <img src="{{ asset('storage/' . $p->photo) }}" alt="{{ $p->name }}"
                                                            class="w-7 h-7 rounded-full object-cover ring-2 ring-white"
                                                            onerror="this.onerror=null;this.src=''">
                                                    @else
                                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-primary-500 to-indigo-600 ring-2 ring-white flex items-center justify-center text-white font-bold text-[10px]">
                                                            {{ strtoupper(substr($p->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                @endforeach
                                                @if($pesertaCount > 5)
                                                    <div class="w-7 h-7 rounded-full bg-gray-200 ring-2 ring-white flex items-center justify-center text-gray-600 font-bold text-[10px]">
                                                        +{{ $pesertaCount - 5 }}
                                                    </div>
                                                @endif
                                            </div>
                                            <span class="text-xs text-gray-500">{{ $pesertaCount }} peserta</span>
                                        </div>
                                    @endif

                                    {{-- Actions --}}
                                    <div class="grid grid-cols-2 gap-2">
                                        <a href="{{ route('rapat.show', $item) }}"
                                            class="flex items-center justify-center py-2.5 bg-blue-50 text-blue-700 border border-blue-200 text-xs font-semibold rounded-xl hover:bg-blue-100 transition active:scale-95">
                                            Detail
                                        </a>
                                        <a href="{{ route('rapat.edit', $item) }}"
                                            class="flex items-center justify-center py-2.5 bg-gray-50 text-gray-700 border border-gray-200 text-xs font-semibold rounded-xl hover:bg-gray-100 transition active:scale-95">
                                            Edit
                                        </a>
                                        @if($item->file_notulensi)
                                            <a href="{{ route('rapat.downloadNotulensi', $item) }}" target="_blank"
                                                class="col-span-2 flex items-center justify-center gap-1.5 py-2.5 bg-green-50 text-green-700 border border-green-200 text-xs font-semibold rounded-xl hover:bg-green-100 transition active:scale-95">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                </svg>
                                                Download Notulensi
                                            </a>
                                        @endif
                                        @if(auth()->user()->isInti())
                                            <form action="{{ route('rapat.destroy', $item) }}" method="POST"
                                                class="{{ $item->file_notulensi ? '' : 'col-span-2' }}"
                                                onsubmit="return confirm('Yakin hapus rapat ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="w-full flex items-center justify-center py-2.5 bg-red-50 text-red-600 border border-red-200 text-xs font-semibold rounded-xl hover:bg-red-100 transition active:scale-95">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-gray-400">
                                <svg class="mx-auto h-10 w-10 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-sm">Belum ada rapat dijadwalkan</p>
                                <a href="{{ route('rapat.create') }}" class="mt-3 inline-block text-sm text-primary-600 font-medium">+ Jadwalkan Rapat Pertama</a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4 border-t border-gray-100 pt-4">{{ $rapat->links() }}</div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function adaptLayout() {
            const isDesktop = window.innerWidth >= 768;
            document.getElementById('dt-table').style.display = isDesktop ? 'block' : 'none';
            document.getElementById('mb-cards').style.display  = isDesktop ? 'none'  : 'block';
        }
        window.addEventListener('DOMContentLoaded', adaptLayout);
        window.addEventListener('resize', adaptLayout);
    </script>
</x-app-layout>