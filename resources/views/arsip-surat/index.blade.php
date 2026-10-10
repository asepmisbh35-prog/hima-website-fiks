<x-app-layout>
    <x-slot name="header">
        
        <div id="header-desktop" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Arsip Surat
            </h2>

            <div class="flex items-center gap-3">
                @if(auth()->check() && auth()->user()->isInti())
                    <a href="{{ route('arsip-surat.report') }}" target="_blank"
                        class="inline-flex items-center px-5 py-3 bg-gradient-to-r from-primary-500 to-primary-700 text-primary-50 rounded-xl hover:from-primary-600 hover:to-primary-800 transition shadow-lg font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Report PDF
                    </a>
                @endif

                @if(auth()->check() && auth()->user()->isPengurus())
                    <a href="{{ route('arsip-surat.create') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Upload Surat
                    </a>
                @endif

                
            </div>
        </div>

        <div id="header-mobile" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Arsip Surat
            </h2>

            <div class="flex items-center gap-2">
                @if(auth()->check() && auth()->user()->isInti())
                    <a href="{{ route('arsip-surat.report') }}" target="_blank"
                        class="inline-flex items-center justify-center p-2 bg-orange-100 text-orange-700 rounded-lg shadow-sm border border-orange-200 active:scale-95 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </a>
                @endif

                @if(auth()->check() && auth()->user()->isPengurus())
                    <a href="{{ route('arsip-surat.create') }}"
                        class="inline-flex items-center px-3 py-2 bg-orange-600 text-white font-bold rounded-lg shadow-sm text-xs active:scale-95 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        Upload
                    </a>
                @endif
            </div>
        </div>

    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-800 font-medium text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div id="desktop-view-container" style="display: none;">
                <div class="bg-white rounded-xl shadow-lg mb-8 p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter Arsip Surat
                    </h3>
                    <form method="GET" action="{{ route('arsip-surat.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari nomor surat, perihal..." 
                                value="{{ request('search') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                            >
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <select name="jenis_surat" class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                <option value="">Semua Jenis</option>
                                @foreach($jenisSurat as $jenis)
                                    <option value="{{ $jenis }}" {{ request('jenis_surat') == $jenis ? 'selected' : '' }}>
                                        {{ ucfirst($jenis) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="kategori" 
                                placeholder="Kategori..." 
                                value="{{ request('kategori') }}"
                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                            >
                        </div>

                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition shadow-md">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                </svg>
                                Filter
                            </button>
                            <a href="{{ route('arsip-surat.index') }}" class="inline-flex items-center justify-center px-4 py-3 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </a>
                        </div>
                    </form>
                </div>

                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No. Surat</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jenis</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Perihal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pengirim/Penerima</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($arsip as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-xl flex items-center justify-center text-white mr-3 shadow-md">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                    </div>
                                                    <span class="text-sm font-mono font-semibold text-gray-900">{{ $item->nomor_surat }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                @php
                                                    $jenisConfig = [
                                                        'masuk' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => '📩'],
                                                        'keluar' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => '📤'],
                                                        'internal' => ['bg' => 'bg-purple-100', 'text' => 'text-purple-800', 'border' => 'border-purple-200', 'icon' => '🏢'],
                                                    ];
                                                    $config = $jenisConfig[$item->jenis_surat] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'border' => 'border-gray-200', 'icon' => '📄'];
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                                    <span class="mr-1">{{ $config['icon'] }}</span>
                                                    {{ ucfirst($item->jenis_surat) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="text-sm font-semibold text-gray-900">{{ $item->perihal }}</div>
                                                @if($item->kategori)
                                                    <div class="flex items-center mt-1 text-xs text-gray-500">
                                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                                        </svg>
                                                        {{ $item->kategori }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $item->tanggal_surat->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-sm text-gray-600">
                                                @if($item->pengirim)
                                                    <div class="flex items-center mb-1">
                                                        <svg class="w-3 h-3 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                                        </svg>
                                                        <span class="text-xs">{{ $item->pengirim }}</span>
                                                    </div>
                                                @endif
                                                @if($item->penerima)
                                                    <div class="flex items-center">
                                                        <svg class="w-3 h-3 text-gray-400 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                        </svg>
                                                        <span class="text-xs">{{ $item->penerima }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    <a 
                                                        href="{{ route('arsip-surat.download', $item) }}"
                                                        class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700 transition shadow-sm"
                                                        target="_blank"
                                                    >
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                        </svg>
                                                        Download
                                                    </a>
                                                    @if(auth()->check() && auth()->user()->isInti())
                                                        <a 
                                                            href="{{ route('arsip-surat.edit', $item) }}"
                                                            class="inline-flex items-center justify-center w-8 h-8 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition shadow-sm"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                            </svg>
                                                        </a>
                                                        <form action="{{ route('arsip-surat.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus surat {{ $item->nomor_surat }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-600 text-white rounded-lg hover:bg-red-700 transition shadow-sm">
                                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-20 text-center">
                                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Arsip Surat</h3>
                                                <p class="text-gray-500">Belum ada surat yang diarsipkan</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mobile-view-container" style="display: none;">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 p-4">
                    <h3 class="text-xs font-bold text-gray-700 mb-3 flex items-center uppercase tracking-wider">
                        <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        Filter Pencarian
                    </h3>
                    <form method="GET" action="{{ route('arsip-surat.index') }}" class="space-y-3">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Cari nomor surat atau perihal..." 
                                value="{{ request('search') }}"
                                class="w-full text-sm bg-gray-50 border border-gray-200 rounded-lg py-2.5 pl-9 pr-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                            >
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3">
                            <select name="jenis_surat" class="w-full text-sm bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-2 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition">
                                <option value="">Semua Jenis</option>
                                @foreach($jenisSurat as $jenis)
                                    <option value="{{ $jenis }}" {{ request('jenis_surat') == $jenis ? 'selected' : '' }}>
                                        {{ ucfirst($jenis) }}
                                    </option>
                                @endforeach
                            </select>
                            
                            <input 
                                type="text" 
                                name="kategori" 
                                placeholder="Kategori..." 
                                value="{{ request('kategori') }}"
                                class="w-full text-sm bg-gray-50 border border-gray-200 rounded-lg py-2.5 px-3 focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                            >
                        </div>

                        <div class="flex gap-2 pt-1">
                            <button type="submit" class="flex-1 py-2.5 bg-primary-600 text-white font-bold rounded-lg text-sm transition shadow-sm active:scale-95">
                                Terapkan Filter
                            </button>
                            <a href="{{ route('arsip-surat.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-lg text-sm border border-gray-200 flex items-center justify-center transition active:bg-gray-200">
                                Reset
                            </a>
                        </div>
                    </form>
                </div>

                <div class="space-y-4">
                    @forelse($arsip as $item)
                        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition duration-300 border border-gray-200 p-4 relative overflow-hidden">
                            
                            @php
                                $jenisConfig = [
                                    'masuk' => ['color' => 'bg-green-500', 'bg' => 'bg-green-100', 'text' => 'text-green-700'],
                                    'keluar' => ['color' => 'bg-blue-500', 'bg' => 'bg-blue-100', 'text' => 'text-blue-700'],
                                    'internal' => ['color' => 'bg-purple-500', 'bg' => 'bg-purple-100', 'text' => 'text-purple-700'],
                                ];
                                $config = $jenisConfig[$item->jenis_surat] ?? ['color' => 'bg-gray-500', 'bg' => 'bg-gray-100', 'text' => 'text-gray-700'];
                            @endphp
                            <div class="absolute top-0 left-0 right-0 h-1 {{ $config['color'] }}"></div>

                            <div class="flex flex-col gap-1.5 mb-2 mt-1">
                                <span class="inline-flex w-max items-center px-2 py-0.5 rounded text-[10px] font-bold {{ $config['bg'] }} {{ $config['text'] }}">
                                    {{ ucfirst($item->jenis_surat) }}
                                </span>
                                <span class="text-xs font-mono font-semibold text-gray-500 truncate" title="{{ $item->nomor_surat }}">
                                    {{ $item->nomor_surat }}
                                </span>
                            </div>

                            <h3 class="font-bold text-gray-800 mb-2 text-sm leading-snug line-clamp-2" title="{{ $item->perihal }}">
                                {{ $item->perihal }}
                            </h3>
                            
                            <div class="space-y-1 text-xs text-gray-600 mb-3 flex-grow">
                                @if($item->kategori)
                                    <p class="flex items-center truncate text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.707 9.293a1 1 0 010 1.414l-7 7a1 1 0 01-1.414 0l-7-7A.997.997 0 012 10V5a3 3 0 013-3h5c.256 0 .512.098.707.293l7 7zM5 6a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                                        {{ $item->kategori }}
                                    </p>
                                @endif
                                <p class="flex items-center">
                                    <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    {{ $item->tanggal_surat->format('d/m/Y') }}
                                </p>
                                
                                @if($item->pengirim)
                                    <p class="truncate text-gray-500" title="Dari: {{ $item->pengirim }}"><span class="font-semibold text-gray-600">Dari:</span> {{ $item->pengirim }}</p>
                                @endif
                                @if($item->penerima)
                                    <p class="truncate text-gray-500" title="Ke: {{ $item->penerima }}"><span class="font-semibold text-gray-600">Ke:</span> {{ $item->penerima }}</p>
                                @endif
                            </div>

                            <div class="flex flex-col gap-2 pt-3 border-t border-gray-100">
                                <a 
                                    href="{{ route('arsip-surat.download', $item) }}"
                                    class="w-full flex justify-center items-center py-2.5 bg-primary-600 text-white font-bold rounded-lg text-xs transition shadow-sm active:scale-95"
                                    target="_blank"
                                >
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    Unduh Surat
                                </a>
                                
                                @if(auth()->check() && auth()->user()->isInti())
                                    <div class="flex gap-2">
                                        <a 
                                            href="{{ route('arsip-surat.edit', $item) }}"
                                            class="flex-1 flex justify-center items-center py-2 bg-gray-100 text-gray-700 font-bold rounded-lg text-xs transition border border-gray-200"
                                        >
                                            Edit
                                        </a>
                                        <form action="{{ route('arsip-surat.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus surat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex justify-center items-center py-2 bg-red-50 text-red-600 font-bold rounded-lg text-xs transition border border-red-100">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-3">
                                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900 mb-1">Belum Ada Arsip Surat</h3>
                            <p class="text-xs text-gray-500">Belum ada surat yang diarsipkan saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if($arsip->hasPages())
                <div class="mt-6 border-t border-gray-200 pt-6">
                    {{ $arsip->links() }}
                </div>
            @endif

        </div>
    </div>

    @push('scripts')
    <script>
        // ==============================================================
        // JAVASCRIPT DETEKSI RESPONSIVE (MEMAKSA HIDE/SHOW SECARA ABSOLUT)
        // ==============================================================
        function adjustLayoutResponsive() {
            // Container Header
            const headerDesktop = document.getElementById('header-desktop');
            const headerMobile = document.getElementById('header-mobile');
            
            // Container Content
            const desktopView = document.getElementById('desktop-view-container');
            const mobileView = document.getElementById('mobile-view-container');
            
            // Breakpoint standar Laptop/Desktop (>= 768px)
            if (window.innerWidth >= 768) {
                // Tampilkan Tampilan Desktop (Tabel & Filter Asli)
                if (headerDesktop) headerDesktop.style.setProperty('display', 'flex', 'important');
                if (desktopView) desktopView.style.setProperty('display', 'block', 'important');
                
                // Sembunyikan total Tampilan HP
                if (headerMobile) headerMobile.style.setProperty('display', 'none', 'important');
                if (mobileView) mobileView.style.setProperty('display', 'none', 'important');
            } else {
                // Tampilkan Tampilan HP (Card & Tombol Rapi)
                if (headerMobile) headerMobile.style.setProperty('display', 'flex', 'important');
                if (mobileView) mobileView.style.setProperty('display', 'block', 'important');
                
                // Sembunyikan total Tampilan Desktop
                if (headerDesktop) headerDesktop.style.setProperty('display', 'none', 'important');
                if (desktopView) desktopView.style.setProperty('display', 'none', 'important');
            }
        }

        // Eksekusi fungsi saat layar diresize atau orientasi HP diputar
        window.addEventListener('resize', adjustLayoutResponsive);
        
        // Eksekusi fungsi saat elemen-elemen HTML selesai dimuat
        window.addEventListener('DOMContentLoaded', adjustLayoutResponsive);
        
        // Eksekusi langsung sebagai pengaman pertama
        adjustLayoutResponsive();

        
    </script>
    @endpush
</x-app-layout>