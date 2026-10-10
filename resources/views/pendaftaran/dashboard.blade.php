<x-app-layout>
    <x-slot name="header">
        <div id="header-desktop" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Kelola Pendaftaran Pengurus Muda
            </h2>
            @if(auth()->user()->isInti())
                <a href="{{ route('pendaftaran.periode.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-sm font-medium shadow-sm transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Kelola Periode
                </a>
            @endif
        </div>

        <div id="header-mobile" style="display: none;" class="justify-between items-center w-full">
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Pendaftaran
            </h2>
            @if(auth()->user()->isInti())
                <a href="{{ route('pendaftaran.periode.index') }}" class="inline-flex items-center px-3 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 text-xs font-bold shadow-sm transition">
                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Periode
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-6 mb-6 md:mb-8">
                @php
                    $statItems = [
                        ['label' => 'Total', 'val' => $stats['total'], 'col' => 'blue', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['label' => 'Menunggu', 'val' => $stats['menunggu'], 'col' => 'yellow', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Diterima', 'val' => $stats['diterima'], 'col' => 'green', 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Ditolak', 'val' => $stats['ditolak'], 'col' => 'red', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z']
                    ];
                @endphp
                @foreach($statItems as $s)
                    <div class="bg-white rounded-xl shadow-sm border border-{{ $s['col'] }}-100 p-3 md:p-6 hover:shadow-md transition flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-{{ $s['col'] }}-500 block md:hidden"></div>
                        <div class="flex items-center justify-between pl-1 md:pl-0">
                            <div>
                                <p class="text-[10px] md:text-sm text-gray-500 font-medium mb-0.5">{{ $s['label'] }}</p>
                                <p class="text-lg md:text-3xl font-bold text-gray-900">{{ $s['val'] }}</p>
                            </div>
                            <div class="bg-{{ $s['col'] }}-50 text-{{ $s['col'] }}-600 rounded-lg p-1.5 md:p-3">
                                <svg class="w-4 h-4 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $s['icon'] }}"/></svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <p class="text-green-800 font-medium text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <div id="desktop-view-container" style="display: none;">
                <div class="bg-white rounded-lg shadow-md mb-6 p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filter Pendaftar
                    </h3>
                    <form method="GET" action="{{ route('pendaftaran.dashboard') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2">Periode</label>
                            <select name="periode_id" class="w-full rounded-lg border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua Periode</option>
                                @foreach($periodes as $p)
                                    <option value="{{ $p->id }}" {{ request('periode_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_periode }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" class="w-full rounded-lg border-gray-300 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition font-medium shadow-sm">Filter</button>
                            <a href="{{ route('pendaftaran.dashboard') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                    <div class="p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kode</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Pendaftar</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Periode</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($pendaftaran as $item)
                                        <tr class="hover:bg-gray-50 transition">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-mono font-semibold rounded-md">{{ $item->kode_pendaftaran }}</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center">
                                                    <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold mr-3">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900">{{ $item->nama }}</div>
                                                        <div class="text-xs text-gray-500">{{ $item->nim }} • {{ $item->jurusan }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4"><span class="text-sm text-gray-700">{{ $item->periode->nama_periode }}</span></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusConfig = [
                                                        'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'icon' => '⏳'],
                                                        'diterima' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'icon' => '✓'],
                                                        'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'icon' => '✗'],
                                                    ];
                                                    $config = $statusConfig[$item->status];
                                                @endphp
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $config['bg'] }} {{ $config['text'] }}">
                                                    <span class="mr-1">{{ $config['icon'] }}</span>{{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">{{ $item->created_at->format('d M Y') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    <button onclick="openModal({{ $item->id }})" class="inline-flex items-center px-3 py-1.5 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700 transition shadow-sm">Detail</button>
                                                    <a href="{{ route('pendaftaran.downloadCV', $item) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 transition shadow-sm" target="_blank">CV</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="6" class="px-6 py-20 text-center text-gray-500 italic">Belum ada pendaftar</td></tr>
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
                        <svg class="w-4 h-4 mr-1.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                        Filter Pendaftar
                    </h3>
                    <form method="GET" action="{{ route('pendaftaran.dashboard') }}" class="space-y-3">
                        <div>
                            <select name="periode_id" class="w-full text-sm bg-gray-50 border-gray-200 rounded-lg py-2.5 px-3 focus:ring-2 focus:ring-primary-500 transition">
                                <option value="">Semua Periode</option>
                                @foreach($periodes as $p)
                                    <option value="{{ $p->id }}" {{ request('periode_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_periode }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <select name="status" class="w-full text-sm bg-gray-50 border-gray-200 rounded-lg py-2.5 px-3 focus:ring-2 focus:ring-primary-500 transition">
                                <option value="">Semua Status</option>
                                <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="flex gap-2 pt-1">
                            <button type="submit" class="flex-1 py-2.5 bg-primary-600 text-white font-bold rounded-lg text-sm transition active:scale-95">Terapkan Filter</button>
                            <a href="{{ route('pendaftaran.dashboard') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-lg text-sm border border-gray-200 flex items-center justify-center active:bg-gray-200 transition">Reset</a>
                        </div>
                    </form>
                </div>

                <div class="space-y-4">
                    @forelse($pendaftaran as $item)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 relative overflow-hidden">
                            @php
                                $config = $statusConfig[$item->status];
                                $lineCols = ['menunggu' => 'bg-yellow-400', 'diterima' => 'bg-green-500', 'ditolak' => 'bg-red-500'];
                            @endphp
                            <div class="absolute top-0 left-0 w-1 h-full {{ $lineCols[$item->status] }}"></div>

                            <div class="flex justify-between items-start mb-3 pl-1">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $config['bg'] }} {{ $config['text'] }} border">
                                    {{ $config['icon'] }} {{ ucfirst($item->status) }}
                                </span>
                                <span class="text-[10px] text-gray-500 font-mono font-bold bg-gray-100 px-2 py-0.5 rounded">{{ $item->kode_pendaftaran }}</span>
                            </div>

                            <div class="flex items-center mb-3 pl-1">
                                <div class="w-10 h-10 bg-primary-100 text-primary-700 rounded-full flex items-center justify-center font-bold text-sm mr-3 shrink-0">{{ strtoupper(substr($item->nama, 0, 1)) }}</div>
                                <div class="overflow-hidden">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $item->nama }}</p>
                                    <p class="text-[10px] text-gray-500 truncate">{{ $item->nim }} • {{ $item->jurusan }}</p>
                                </div>
                            </div>

                            <div class="flex flex-col gap-2 pt-3 border-t border-gray-100 pl-1">
                                <button onclick="openModal({{ $item->id }})" class="w-full py-2.5 bg-primary-600 text-white font-bold rounded-lg text-xs transition active:scale-95 shadow-sm">Lihat Detail</button>
                                <a href="{{ route('pendaftaran.downloadCV', $item) }}" target="_blank" class="w-full py-2.5 bg-blue-600 text-white font-bold rounded-lg text-xs text-center transition active:scale-95">Download CV</a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-10 rounded-xl text-center border border-gray-100 italic text-gray-500 text-sm">Belum ada pendaftar</div>
                    @endforelse
                </div>
            </div>

            @if($pendaftaran->hasPages())
                <div class="mt-6 border-t border-gray-100 pt-6">
                    {{ $pendaftaran->links() }}
                </div>
            @endif

        </div>
    </div>

    @foreach($pendaftaran as $item)
        <div id="modal-{{ $item->id }}" class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-50 flex items-center justify-center p-4 overflow-y-auto" onclick="if(event.target === this) closeModal({{ $item->id }})">
            <div class="relative w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden max-h-[90vh] flex flex-col" onclick="event.stopPropagation()">
                <div class="p-5 border-b flex justify-between items-start bg-gray-50 shrink-0">
                    <div>
                        <h3 class="text-lg md:text-xl font-bold text-gray-900">Detail Pendaftaran</h3>
                        <p class="text-xs text-gray-500 mt-1 font-mono">ID: {{ $item->kode_pendaftaran }}</p>
                    </div>
                    <button onclick="closeModal({{ $item->id }})" class="text-gray-400 hover:text-gray-600 bg-gray-200 rounded-full p-1.5 transition">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-5 md:p-8 overflow-y-auto">
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-50 p-4 rounded-xl border border-blue-100">
                            <div><label class="text-[10px] font-bold text-blue-600 uppercase block">Nama</label><p class="text-sm font-bold text-gray-900">{{ $item->nama }}</p></div>
                            <div><label class="text-[10px] font-bold text-blue-600 uppercase block">NIM</label><p class="text-sm font-bold text-gray-900">{{ $item->nim }}</p></div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Motivasi</label>
                            <p class="text-sm text-gray-700 whitespace-pre-wrap italic">"{{ $item->motivasi }}"</p>
                        </div>
                        <form action="{{ route('pendaftaran.updateStatus', $item) }}" method="POST" data-turbo="false" class="space-y-4 pt-4 border-t">
                            @csrf @method('PATCH')
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Update Status Lulus</label>
                                <select name="status" class="w-full rounded-lg border-gray-300 py-3 text-sm bg-white" required>
                                    <option value="menunggu" {{ $item->status == 'menunggu' ? 'selected' : '' }}>⏳ Menunggu</option>
                                    <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>✓ Diterima</option>
                                    <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>✗ Ditolak</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-700 mb-2">Catatan</label>
                                <textarea name="catatan" rows="3" class="w-full rounded-lg border-gray-300 text-sm resize-none" placeholder="Isi pesan/alasan kelulusan...">{{ $item->catatan }}</textarea>
                            </div>
                            <div class="flex flex-col-reverse sm:flex-row gap-2 pt-4">
                                <button type="button" onclick="closeModal({{ $item->id }})" class="w-full sm:w-auto px-6 py-2.5 bg-gray-100 text-gray-700 font-bold rounded-lg text-sm">Batal</button>
                                <button type="submit" class="w-full sm:w-auto flex-1 px-6 py-2.5 bg-primary-600 text-white font-bold rounded-lg text-sm shadow-md">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script>
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
        window.addEventListener('resize', adjustLayoutResponsive); window.addEventListener('DOMContentLoaded', adjustLayoutResponsive);
        adjustLayoutResponsive();

        function openModal(id) { document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden')); const modal = document.getElementById('modal-' + id); if (modal) { modal.classList.remove('hidden'); document.body.style.overflow = 'hidden'; } }
        function closeModal(id) { const modal = document.getElementById('modal-' + id); if (modal) { modal.classList.add('hidden'); document.body.style.overflow = 'auto'; } }
        document.addEventListener('keydown', (e) => { if (e.key === 'Escape') { document.querySelectorAll('[id^="modal-"]').forEach(m => m.classList.add('hidden')); document.body.style.overflow = 'auto'; } });
    </script>
    @endpush
</x-app-layout>