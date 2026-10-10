<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manajemen Program Kerja
            </h2>
            <a href="{{ route('proker.create') }}" class="inline-flex items-center justify-center px-3 py-2 md:px-4 md:py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition text-xs md:text-sm whitespace-nowrap shadow-sm">
                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Program Kerja
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Total Proker</p>
                            <p class="text-lg md:text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Perencanaan</p>
                            <p class="text-lg md:text-2xl font-bold text-yellow-600">{{ $stats['perencanaan'] }}</p>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Sedang Berjalan</p>
                            <p class="text-lg md:text-2xl font-bold text-blue-600">{{ $stats['berjalan'] }}</p>
                        </div>
                        <div class="bg-blue-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-4 md:p-6">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <p class="text-xs md:text-sm text-gray-500">Selesai</p>
                            <p class="text-lg md:text-2xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
                        </div>
                        <div class="bg-green-100 rounded-full p-2 md:p-3">
                            <svg class="w-5 h-5 md:w-6 md:h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm md:text-base">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <form method="GET" action="{{ route('proker.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari nama proker..." 
                            value="{{ request('search') }}"
                            class="w-full rounded-lg border-gray-300 text-sm md:text-base"
                        >
                    </div>
                    <div>
                        <select name="divisi" class="w-full rounded-lg border-gray-300 text-sm md:text-base">
                            <option value="">Semua Divisi</option>
                            @foreach($divisis as $divisi)
                                <option value="{{ $divisi }}" {{ request('divisi') == $divisi ? 'selected' : '' }}>
                                    {{ $divisi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <select name="status" class="w-full rounded-lg border-gray-300 text-sm md:text-base">
                            <option value="">Semua Status</option>
                            <option value="perencanaan" {{ request('status') == 'perencanaan' ? 'selected' : '' }}>Perencanaan</option>
                            <option value="berjalan" {{ request('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm md:text-base transition">
                            Filter
                        </button>
                        <a href="{{ route('proker.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 flex items-center justify-center text-sm md:text-base transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div id="desktop-proker-view" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($prokers as $item)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden">
                            <div class="p-6 border-b">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="font-semibold text-gray-900 text-lg line-clamp-2 flex-1">{{ $item->nama_proker }}</h3>
                                    @php
                                        $statusColors = [
                                            'perencanaan' => 'bg-yellow-100 text-yellow-800',
                                            'berjalan' => 'bg-blue-100 text-blue-800',
                                            'selesai' => 'bg-green-100 text-green-800',
                                            'dibatalkan' => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$item->status] }} whitespace-nowrap ml-2">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $item->deskripsi }}</p>
                            </div>

                            <div class="px-6 py-4 bg-gray-50 space-y-2 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <span>{{ $item->divisi }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>{{ $item->tanggal_mulai->format('d M') }} - {{ $item->tanggal_selesai->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="px-6 py-4">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-sm font-medium text-gray-700">Progress</span>
                                    <span class="text-sm font-bold text-primary-600">{{ $item->progress_persen }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div 
                                        class="h-2.5 rounded-full transition-all {{ $item->progress_persen == 100 ? 'bg-green-600' : 'bg-primary-600' }}" 
                                        style="width: {{ $item->progress_persen }}%"
                                    ></div>
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-gradient-to-br from-gray-50 to-gray-100 border-t">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Total Budget:</span>
                                        <span class="font-semibold text-gray-700">{{ $item->formatRupiah($item->anggaran) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-gray-500">Terpakai:</span>
                                        <span class="font-semibold text-orange-600">{{ $item->formatRupiah($item->anggaran_terpakai) }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm pt-2 border-t border-gray-200">
                                        <span class="font-medium text-gray-700">Sisa:</span>
                                        <span class="font-bold {{ $item->sisa_anggaran >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $item->formatRupiah($item->sisa_anggaran) }}
                                        </span>
                                    </div>
                                    @if($item->sisa_anggaran < 0)
                                        <div class="pt-2">
                                            <span class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                                ⚠️ Over Budget
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="px-6 py-4 bg-white border-t flex gap-2">
                                <a href="{{ route('proker.show', $item) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white text-center rounded-lg hover:bg-primary-700 text-sm font-medium transition">
                                    <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Detail
                                </a>
                                @if(auth()->user()->isPengurus())
                                    <a href="{{ route('proker.edit', $item) }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition">
                                        <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                @endif
                                @if(auth()->user()->isInti())
                                    <form action="{{ route('proker.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus proker ini? Data monitoring juga akan terhapus!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium transition">
                                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-16 bg-white rounded-xl shadow-md">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                <svg class="w-8 h-8 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Program Kerja</h3>
                            <p class="text-gray-500 mb-6">Mulai dengan membuat program kerja pertama</p>
                            <a href="{{ route('proker.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-lg">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Tambah Program Kerja
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            <div id="mobile-proker-view" class="space-y-4" style="display: none;">
                @forelse($prokers as $item)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        
                        <div class="p-4 border-b border-gray-50">
                            <div class="flex justify-between items-start gap-3 mb-1.5">
                                <h3 class="font-bold text-gray-900 text-base leading-tight">{{ $item->nama_proker }}</h3>
                                
                                @php
                                    $statusColorsMobile = [
                                        'perencanaan' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'berjalan'    => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'selesai'     => 'bg-green-100 text-green-800 border-green-200',
                                        'dibatalkan'  => 'bg-red-100 text-red-800 border-red-200',
                                    ];
                                @endphp
                                <span class="flex-shrink-0 px-2.5 py-1 text-[10px] font-extrabold rounded-lg border {{ $statusColorsMobile[$item->status] }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $item->deskripsi }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 grid grid-cols-1 gap-2 border-b border-gray-100">
                            <div class="flex items-center text-gray-600 text-xs font-medium">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                {{ $item->divisi }}
                            </div>
                            <div class="flex items-center text-gray-600 text-xs font-medium">
                                <svg class="w-4 h-4 mr-2 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $item->tanggal_mulai->format('d M') }} - {{ $item->tanggal_selesai->format('d M Y') }}
                            </div>
                        </div>

                        <div class="px-4 pt-4 pb-3">
                            <div class="flex justify-between items-end mb-1.5">
                                <span class="text-xs font-semibold text-gray-600">Progress Proker</span>
                                <span class="text-sm font-black {{ $item->progress_persen == 100 ? 'text-green-600' : 'text-primary-600' }}">{{ $item->progress_persen }}%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden shadow-inner">
                                <div class="h-full rounded-full transition-all duration-500 ease-out {{ $item->progress_persen == 100 ? 'bg-green-500' : 'bg-primary-500' }}" style="width: {{ $item->progress_persen }}%"></div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-white space-y-1.5 border-t border-dashed border-gray-200">
                            <div class="flex justify-between text-[11px] font-medium text-gray-500">
                                <span>Anggaran:</span>
                                <span>{{ $item->formatRupiah($item->anggaran) }}</span>
                            </div>
                            <div class="flex justify-between text-[11px] font-medium text-gray-500">
                                <span>Terpakai:</span>
                                <span class="text-orange-600">{{ $item->formatRupiah($item->anggaran_terpakai) }}</span>
                            </div>
                            <div class="flex justify-between text-xs font-bold pt-1">
                                <span class="text-gray-700">Sisa Dana:</span>
                                <span class="{{ $item->sisa_anggaran >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $item->formatRupiah($item->sisa_anggaran) }}
                                </span>
                            </div>
                            @if($item->sisa_anggaran < 0)
                                <div class="mt-1">
                                    <span class="inline-block px-2 py-0.5 bg-red-50 border border-red-200 text-red-700 text-[10px] font-bold rounded">
                                        ⚠️ Over Budget
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-3 bg-gray-50 border-t border-gray-100 grid grid-cols-2 gap-2">
                            <a href="{{ route('proker.show', $item) }}" class="col-span-1 w-full flex items-center justify-center py-2.5 bg-primary-50 text-primary-700 border border-primary-200 text-xs font-bold rounded-xl hover:bg-primary-100 active:scale-95 transition">
                                <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Detail
                            </a>
                            
                            @if(auth()->user()->isPengurus())
                                <a href="{{ route('proker.edit', $item) }}" class="col-span-1 w-full flex items-center justify-center py-2.5 bg-white text-gray-700 border border-gray-300 text-xs font-bold rounded-xl hover:bg-gray-50 active:scale-95 transition shadow-sm">
                                    <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                            @else
                                <div class="col-span-1"></div>
                            @endif

                            @if(auth()->user()->isInti())
                                <form action="{{ route('proker.destroy', $item) }}" method="POST" class="col-span-2 mt-1" onsubmit="return confirm('Yakin hapus proker ini? Data monitoring juga akan terhapus!')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full flex items-center justify-center py-2.5 bg-red-50 text-red-600 border border-red-200 text-xs font-bold rounded-xl hover:bg-red-100 active:scale-95 transition">
                                        <svg class="w-4 h-4 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus Proker
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <div class="inline-flex items-center justify-center w-14 h-14 bg-gray-50 rounded-full mb-3">
                            <svg class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <h3 class="text-base font-bold text-gray-900 mb-1">Belum Ada Proker</h3>
                        <p class="text-xs text-gray-500 mb-4">Buat program kerja pertama Anda</p>
                        <a href="{{ route('proker.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white font-semibold text-xs rounded-xl shadow-sm">
                            Tambah Proker Baru
                        </a>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $prokers->links() }}
            </div>
            
            <div class="h-8 md:hidden"></div>
        </div>
    </div>

    <script>
        function handleProkerLayout() {
            const desktopGrid = document.getElementById('desktop-proker-view');
            const mobileCards = document.getElementById('mobile-proker-view');
            
            if (window.innerWidth >= 768) {
                desktopGrid.style.display = 'block'; 
                mobileCards.style.display = 'none';
            } else {
                desktopGrid.style.display = 'none';
                mobileCards.style.display = 'block'; 
            }
        }

        window.addEventListener('DOMContentLoaded', handleProkerLayout);
        window.addEventListener('resize', handleProkerLayout);
    </script>
</x-app-layout>