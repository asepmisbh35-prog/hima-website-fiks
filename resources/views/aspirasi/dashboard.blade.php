<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm text-gray-600 mb-1">Total Aspirasi</p>
                            <p class="text-xl md:text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                            <p class="hidden md:block text-xs text-gray-500 mt-1">Semua kategori</p>
                        </div>
                        <div class="bg-gradient-to-r from-secondary-50 to-secondary-100 rounded-xl md:rounded-2xl p-3 md:p-4 shadow-lg">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm text-gray-600 mb-1">Menunggu</p>
                            <p class="text-xl md:text-3xl font-bold text-yellow-600">{{ $stats['menunggu'] }}</p>
                            <p class="hidden md:block text-xs text-gray-500 mt-1">Perlu tindakan</p>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-400 to-yellow-600 rounded-xl md:rounded-2xl p-3 md:p-4 shadow-lg">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm text-gray-600 mb-1">Diproses</p>
                            <p class="text-xl md:text-3xl font-bold text-blue-600">{{ $stats['diproses'] }}</p>
                            <p class="hidden md:block text-xs text-gray-500 mt-1">Sedang ditangani</p>
                        </div>
                        <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl md:rounded-2xl p-3 md:p-4 shadow-lg">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition p-4 md:p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs md:text-sm text-gray-600 mb-1">Selesai</p>
                            <p class="text-xl md:text-3xl font-bold text-green-600">{{ $stats['selesai'] }}</p>
                            <p class="hidden md:block text-xs text-gray-500 mt-1">Sudah ditangani</p>
                        </div>
                        <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-xl md:rounded-2xl p-3 md:p-4 shadow-lg">
                            <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <p class="text-green-800 font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div id="desktop-table-container" class="mb-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pengirim</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aspirasi</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($aspirasi as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-5">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center text-white font-bold mr-3 shadow-sm">
                                                        {{ strtoupper(substr($item->pengirim_nama, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">{{ $item->pengirim_nama }}</div>
                                                        <div class="text-xs text-gray-500">{{ $item->pengirim_email }}</div>
                                                        @if($item->pengirim_nim)
                                                            <div class="text-xs text-gray-400">NIM: {{ $item->pengirim_nim }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                    {{ $item->kategori }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5">
                                                <div class="text-sm text-gray-700 max-w-md">
                                                    <p class="line-clamp-2">{{ $item->isi_aspirasi }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                @php
                                                    $statusConfig = [
                                                        'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => '⏳'],
                                                        'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => '🔄'],
                                                        'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => '✅'],
                                                        'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'border' => 'border-red-200', 'icon' => '❌'],
                                                    ];
                                                    $config = $statusConfig[$item->status];
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                                    <span class="mr-1">{{ $config['icon'] }}</span>
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center text-sm text-gray-600">
                                                    <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                    </svg>
                                                    {{ $item->created_at->format('d M Y') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-center">
                                                <div class="flex justify-center items-center space-x-2">
                                                    <button 
                                                        onclick="openModal({{ $item->id }})"
                                                        class="inline-flex items-center px-3 py-1.5 bg-orange-600 text-white text-xs font-medium rounded-lg hover:bg-orange-700 transition shadow-sm"
                                                    >
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                        </svg>
                                                        Detail
                                                    </button>
                                                    @if(auth()->user()->isInti())
                                                        <form action="{{ route('aspirasi.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus aspirasi dari {{ $item->pengirim_nama }}?')">
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
                                                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Aspirasi</h3>
                                                <p class="text-gray-500">Belum ada mahasiswa yang mengirim aspirasi</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="mobile-cards-container" class="space-y-4 mb-8">
                @forelse($aspirasi as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 relative overflow-hidden">
                        @php
                            $statusConfig = [
                                'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => '⏳', 'line' => 'bg-yellow-400'],
                                'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'icon' => '🔄', 'line' => 'bg-blue-500'],
                                'selesai' =>  ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '✅', 'line' => 'bg-green-500'],
                                'ditolak' =>  ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => '❌', 'line' => 'bg-red-500'],
                            ];
                            $config = $statusConfig[$item->status];
                        @endphp
                        
                        <div class="absolute top-0 left-0 right-0 h-1 {{ $config['line'] }}"></div>
                        
                        <div class="flex justify-between items-start mb-3 mt-1">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $config['bg'] }} {{ $config['text'] }} border">
                                {{ $config['icon'] }} {{ ucfirst($item->status) }}
                            </span>
                            <span class="text-[10px] text-gray-500 font-medium">{{ $item->created_at->format('d/m/Y') }}</span>
                        </div>

                        <div class="flex items-center mb-3">
                            <div class="w-9 h-9 bg-orange-100 text-orange-700 rounded-full flex items-center justify-center font-bold text-xs mr-3 shrink-0">
                                {{ strtoupper(substr($item->pengirim_nama, 0, 1)) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-xs font-bold text-gray-900 truncate">{{ $item->pengirim_nama }}</p>
                                <p class="text-[10px] text-gray-500 truncate">{{ $item->pengirim_email }}</p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Aspirasi: ({{ $item->kategori }})</p>
                            <p class="text-xs text-gray-700 line-clamp-2 leading-relaxed">"{{ $item->isi_aspirasi }}"</p>
                        </div>

                        <div class="flex flex-col gap-2 pt-3 border-t border-gray-100">
                            <button onclick="openModal({{ $item->id }})" class="w-full flex justify-center items-center py-2.5 bg-orange-600 text-white font-bold rounded-lg text-xs transition active:scale-95 shadow-sm">
                                <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Lihat Detail & Respon
                            </button>
                            
                            @if(auth()->user()->isInti())
                                <form action="{{ route('aspirasi.destroy', $item) }}" method="POST" class="w-full" onsubmit="return confirm('Hapus aspirasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full flex justify-center items-center py-2.5 bg-red-50 text-red-600 font-bold rounded-lg text-xs transition border border-red-100 active:bg-red-600 active:text-white">
                                        <svg class="w-3.5 h-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        Hapus Aspirasi
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-10 rounded-xl text-center border border-gray-100 shadow-sm">
                        <p class="text-gray-500 text-sm italic">Belum ada aspirasi masuk.</p>
                    </div>
                @endforelse
            </div>

            @if($aspirasi->hasPages())
                <div class="mt-4 md:mt-6">
                    {{ $aspirasi->links() }}
                </div>
            @endif

            @foreach($aspirasi as $item)
                <div id="modal-{{ $item->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 overflow-y-auto" onclick="if(event.target === this) closeModal({{ $item->id }})">
                    <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col" onclick="event.stopPropagation()">
                        <div class="p-5 border-b flex justify-between items-center bg-gray-50 shrink-0">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg md:text-xl">Respon Aspirasi</h3>
                                <p class="text-xs text-gray-500 mt-1">Review dan kelola aspirasi mahasiswa</p>
                            </div>
                            <button onclick="closeModal({{ $item->id }})" class="text-gray-400 hover:text-gray-600 p-1.5 rounded-full hover:bg-gray-200 transition">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="p-5 md:p-8 overflow-y-auto">
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-4 rounded-xl border border-blue-100">
                                    <div>
                                        <label class="text-[10px] font-bold text-blue-600 uppercase mb-1 block">Nama Pengirim</label>
                                        <p class="text-sm md:text-base font-bold text-gray-900">{{ $item->pengirim_nama }}</p>
                                    </div>
                                    <div>
                                        <label class="text-[10px] font-bold text-blue-600 uppercase mb-1 block">Kategori</label>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 mt-1">
                                            {{ $item->kategori }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <label class="text-[10px] font-bold text-gray-400 uppercase mb-2 block tracking-widest">Isi Aspirasi Mahasiswa</label>
                                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">"{{ $item->isi_aspirasi }}"</div>
                                </div>

                                @if($item->tanggapan)
                                    <div>
                                        <label class="text-[10px] font-bold text-green-600 uppercase mb-2 block tracking-widest">Tanggapan Sebelumnya</label>
                                        <div class="bg-green-50 p-4 rounded-xl border border-green-100 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap">{{ $item->tanggapan }}</div>
                                    </div>
                                @endif

                                <form action="{{ route('aspirasi.updateStatus', $item) }}" method="POST" data-turbo="false" class="space-y-4 pt-4 border-t">
                                    @csrf @method('PATCH')
                                    <div class="grid grid-cols-1 gap-4">
                                        <div>
                                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">Update Status Pengerjaan</label>
                                            <select name="status" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500 py-3 text-sm bg-white" required>
                                                <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                                <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs md:text-sm font-bold text-gray-700 mb-2">Tanggapan / Solusi Pengurus</label>
                                            <textarea name="tanggapan" rows="4" class="w-full rounded-lg border-gray-300 focus:ring-2 focus:ring-orange-500 text-sm resize-none" placeholder="Tuliskan jawaban atau langkah yang akan diambil...">{{ $item->tanggapan }}</textarea>
                                        </div>
                                    </div>
                                    <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-4">
                                        <button type="button" onclick="closeModal({{ $item->id }})" class="w-full sm:w-auto px-6 py-2.5 bg-gray-200 text-gray-700 font-bold rounded-lg text-sm hover:bg-gray-300 transition">Batal</button>
                                        <button type="submit" class="w-full sm:w-auto px-6 py-2.5 bg-gradient-to-r from-orange-600 to-orange-700 text-white font-bold rounded-lg text-sm hover:from-orange-700 hover:to-orange-800 shadow-md transition">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    @push('scripts')
    <script>
        // ==============================================================
        // JAVASCRIPT DETEKSI RESPONSIVE (MEMAKSA HIDE/SHOW SECARA ABSOLUT)
        // ==============================================================
        function adjustLayoutResponsive() {
            const tableContainer = document.getElementById('desktop-table-container');
            const cardsContainer = document.getElementById('mobile-cards-container');
            
            // Breakpoint Tailwind 'md' adalah 768px
            if (window.innerWidth >= 768) {
                // Mode Laptop/Desktop: Tampilkan Tabel, Sembunyikan Card secara total
                if (tableContainer) tableContainer.style.setProperty('display', 'block', 'important');
                if (cardsContainer) cardsContainer.style.setProperty('display', 'none', 'important');
            } else {
                // Mode HP: Sembunyikan Tabel, Tampilkan Card
                if (tableContainer) tableContainer.style.setProperty('display', 'none', 'important');
                if (cardsContainer) cardsContainer.style.setProperty('display', 'block', 'important');
            }
        }

        // Jalankan fungsi saat resize layar dan saat DOM selesai dimuat
        window.addEventListener('resize', adjustLayoutResponsive);
        window.addEventListener('DOMContentLoaded', adjustLayoutResponsive);
        
        // Eksekusi langsung sebagai pengaman instan
        adjustLayoutResponsive();

        // ==============================================================
        // LOGIC MODAL DETAIL
        // ==============================================================
        function openModal(id) {
            document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
            const modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal(id) {
            const modal = document.getElementById('modal-' + id);
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        document.addEventListener('keydown', (e) => { 
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
                document.body.style.overflow = 'auto';
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden'));
        });
    </script>
    @endpush
</x-app-layout>