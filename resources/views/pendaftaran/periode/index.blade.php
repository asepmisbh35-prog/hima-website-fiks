<x-app-layout>
    <x-slot name="header">
        <div id="header-desktop" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Periode Pendaftaran
            </h2>
            <a href="{{ route('pendaftaran.periode.create') }}"
                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition shadow-lg font-medium">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Periode Baru
            </a>
        </div>

        <div id="header-mobile" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Kelola Periode
            </h2>
            <a href="{{ route('pendaftaran.periode.create') }}"
                class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg hover:from-primary-700 hover:to-primary-800 transition shadow-sm font-bold text-xs">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Periode Baru
            </a>
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg p-3 md:p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-green-500 mr-2 md:mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-800 font-medium text-xs md:text-base">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-3 md:p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500 mr-2 md:mr-3 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-red-800 font-medium text-xs md:text-base">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-xl p-4 md:p-6 mb-6 md:mb-8 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-2 md:ml-3">
                        <h4 class="font-bold text-blue-900 mb-1.5 md:mb-2 text-xs md:text-base">Informasi Penting</h4>
                        <ul class="text-[10px] md:text-sm text-blue-800 space-y-1 md:space-y-1.5">
                            <li class="flex items-start">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5 mt-0.5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                <span>Hanya <strong>satu periode</strong> yang dapat aktif dalam satu waktu</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5 mt-0.5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                <span>Mengaktifkan periode baru akan menonaktifkan periode lain secara otomatis</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-1.5 mt-0.5 text-blue-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                <span>Mahasiswa hanya bisa mendaftar saat periode aktif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="desktop-view-container" style="display: none;">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Periode</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Buka</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal Tutup</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($periodes as $periode)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-5">
                                                <div>
                                                    <div class="text-sm font-semibold text-gray-900 mb-1">{{ $periode->nama_periode }}</div>
                                                    @if ($periode->deskripsi)
                                                        <div class="text-xs text-gray-500 line-clamp-2">{{ $periode->deskripsi }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    <span class="text-sm font-medium text-gray-900">{{ $periode->tanggal_buka->format('d M Y') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                    <span class="text-sm font-medium text-gray-900">{{ $periode->tanggal_tutup->format('d M Y') }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                @if ($periode->is_active)
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span> Aktif
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200">
                                                        <span class="w-2 h-2 bg-gray-400 rounded-full mr-2"></span> Nonaktif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    {{-- Toggle Switch --}}
                                                    <form action="{{ route('pendaftaran.periode.toggleStatus', $periode) }}" method="POST" data-turbo="false" class="inline-block">
                                                        @csrf @method('PATCH')
                                                        <label class="relative inline-flex items-center cursor-pointer group">
                                                            <input type="checkbox" class="sr-only peer" {{ $periode->is_active ? 'checked' : '' }} onchange="if(confirm('{{ $periode->is_active ? 'Nonaktifkan periode ini?' : 'Aktifkan periode ini? Periode lain akan dinonaktifkan otomatis.' }}')){this.form.submit()}else{this.checked=!this.checked}">
                                                            <div class="w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-primary-600 shadow-inner"></div>
                                                            <span class="ml-2 text-xs font-medium text-gray-500 group-hover:text-gray-700 transition">{{ $periode->is_active ? 'ON' : 'OFF' }}</span>
                                                        </label>
                                                    </form>

                                                    {{-- Tombol Edit --}}
                                                    <a href="{{ route('pendaftaran.periode.edit', $periode) }}" class="inline-flex items-center px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-xs font-medium shadow-sm">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg> Edit
                                                    </a>

                                                    {{-- Tombol PDF --}}
                                                    <a href="{{ route('pendaftaran.periode.reportPdf', $periode) }}" target="_blank" title="Download laporan PDF periode ini" class="inline-flex items-center px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-xs font-medium shadow-sm">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg> PDF
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-20 text-center">
                                                <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                                </div>
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Periode</h3>
                                                <p class="text-gray-500 mb-6">Buat periode pendaftaran pertama untuk memulai</p>
                                                <a href="{{ route('pendaftaran.periode.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition shadow-lg">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg> Buat Periode Pertama
                                                </a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mobile-view-container" style="display: none;" class="space-y-4">
                @forelse($periodes as $periode)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 relative overflow-hidden flex flex-col h-full">
                        
                        <div class="absolute top-0 left-0 right-0 h-1 {{ $periode->is_active ? 'bg-green-500' : 'bg-gray-400' }}"></div>

                        <div class="flex justify-between items-start mt-1 mb-2">
                            @if ($periode->is_active)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-800 border border-green-200">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mr-1.5"></span> Nonaktif
                                </span>
                            @endif
                        </div>
                        
                        <h3 class="text-sm font-bold text-gray-900 mb-1 line-clamp-2 leading-snug">{{ $periode->nama_periode }}</h3>
                        
                        @if ($periode->deskripsi)
                            <p class="text-[10px] text-gray-500 line-clamp-2 mb-3">{{ $periode->deskripsi }}</p>
                        @endif

                        <div class="bg-gray-50 rounded-lg p-2.5 mb-3 border border-gray-100 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-semibold text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Buka
                                </span>
                                <span class="text-[10px] font-bold text-gray-800">{{ $periode->tanggal_buka->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-semibold text-gray-500 flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg> Tutup
                                </span>
                                <span class="text-[10px] font-bold text-gray-800">{{ $periode->tanggal_tutup->format('d M Y') }}</span>
                            </div>
                        </div>

                        <div class="mt-auto pt-2 border-t border-gray-100">
                            <form action="{{ route('pendaftaran.periode.toggleStatus', $periode) }}" method="POST" data-turbo="false" class="mb-2 w-full">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full flex justify-center items-center py-2 {{ $periode->is_active ? 'bg-gray-100 text-gray-700 border-gray-200' : 'bg-green-50 text-green-700 border-green-200' }} font-bold rounded-lg text-[10px] border shadow-sm transition active:scale-95" onclick="return confirm('{{ $periode->is_active ? 'Nonaktifkan periode ini?' : 'Aktifkan periode ini? Periode lain akan dinonaktifkan otomatis.' }}')">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                    {{ $periode->is_active ? 'Nonaktifkan Periode' : 'Aktifkan Periode' }}
                                </button>
                            </form>

                            <div class="flex gap-2">
                                <a href="{{ route('pendaftaran.periode.edit', $periode) }}" class="flex-1 flex justify-center items-center py-2 bg-blue-50 text-blue-700 font-bold rounded-lg text-[10px] border border-blue-200 transition active:scale-95 shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg> Edit
                                </a>
                                <a href="{{ route('pendaftaran.periode.reportPdf', $periode) }}" target="_blank" class="flex-1 flex justify-center items-center py-2 bg-red-50 text-red-600 font-bold rounded-lg text-[10px] border border-red-200 transition active:scale-95 shadow-sm">
                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg> PDF
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-50 rounded-full mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 mb-1">Belum Ada Periode</h3>
                        <p class="text-xs text-gray-500 mb-4">Buat periode pertama Anda.</p>
                        <a href="{{ route('pendaftaran.periode.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white font-bold rounded-lg text-xs transition shadow-sm">
                            Buat Periode
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($periodes->hasPages())
                <div class="mt-6 md:mt-8 border-t border-gray-200 pt-6">
                    {{ $periodes->links() }}
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
            const hD = document.getElementById('header-desktop'); const hM = document.getElementById('header-mobile');
            const vD = document.getElementById('desktop-view-container'); const vM = document.getElementById('mobile-view-container');
            
            if (window.innerWidth >= 768) {
                if (hD) hD.style.setProperty('display', 'flex', 'important'); if (vD) vD.style.setProperty('display', 'block', 'important');
                if (hM) hM.style.setProperty('display', 'none', 'important'); if (vM) vM.style.setProperty('display', 'none', 'important');
            } else {
                if (hM) hM.style.setProperty('display', 'flex', 'important'); if (vM) vM.style.setProperty('display', 'block', 'important');
                if (hD) hD.style.setProperty('display', 'none', 'important'); if (vD) vD.style.setProperty('display', 'none', 'important');
            }
        }
        window.addEventListener('resize', adjustLayoutResponsive);
        window.addEventListener('DOMContentLoaded', adjustLayoutResponsive);
        adjustLayoutResponsive();
    </script>
    @endpush
</x-app-layout>