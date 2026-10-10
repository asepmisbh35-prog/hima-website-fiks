<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight text-left">
                Arsip Dokumen
            </h2>
            @if(auth()->check() && auth()->user()->isPengurus())
                <a href="{{ route('arsip-dokumen.create') }}" class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 text-[10px] md:text-sm shadow-sm transition">
                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Upload Dokumen
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-r-lg shadow-sm text-sm md:text-base">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6 p-4 md:p-5">
                <form method="GET" action="{{ route('arsip-dokumen.index') }}" class="flex flex-col md:flex-row gap-3 md:gap-4">
                    <div class="w-full md:flex-1">
                        <input type="text"
                            name="search"
                            placeholder="Cari judul..."
                            value="{{ request('search') }}"
                            class="w-full text-sm md:text-base rounded-lg border-gray-300 py-2.5 px-3 focus:ring-primary-500 focus:border-primary-500"
                        >
                    </div>
                    <div class="w-full md:w-1/4">
                        <select name="kategori" class="w-full text-sm md:text-base rounded-lg border-gray-300 py-2.5 px-3 focus:ring-primary-500 focus:border-primary-500 bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="flex-1 md:flex-none md:w-24 px-4 py-2.5 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 text-sm transition">
                            Filter
                        </button>
                        <a href="{{ route('arsip-dokumen.index') }}" class="flex-1 md:flex-none md:w-24 flex items-center justify-center px-4 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 text-sm transition border border-gray-200">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            @if(auth()->check() && auth()->user()->isPengurus())
                <div id="bulk-toolbar" class="hidden mb-4 bg-gray-900 text-white rounded-xl px-4 py-3 flex flex-wrap items-center gap-3 shadow-lg sticky top-2 z-10">
                    <span class="text-xs md:text-sm font-medium"><span id="bulk-count">0</span> dokumen dipilih</span>

                    <select id="bulk-kategori-select" class="text-xs md:text-sm rounded-lg border-0 py-1.5 px-2 text-gray-800">
                        <option value="">Ubah kategori jadi...</option>
                        @foreach(\App\Models\ArsipDokumen::KATEGORI_LIST as $kat)
                            <option value="{{ $kat }}">{{ $kat }}</option>
                        @endforeach
                    </select>
                    <button type="button" onclick="submitBulkKategori()" class="text-xs md:text-sm bg-indigo-600 hover:bg-indigo-500 px-3 py-1.5 rounded-lg font-medium transition">
                        Terapkan
                    </button>

                    @if(auth()->user()->isInti())
                        <button type="button" onclick="submitBulkDestroy()" class="text-xs md:text-sm bg-red-600 hover:bg-red-500 px-3 py-1.5 rounded-lg font-medium transition ml-auto">
                            Hapus Terpilih
                        </button>
                    @endif

                    <button type="button" onclick="clearBulkSelection()" class="text-xs md:text-sm text-gray-300 hover:text-white underline">
                        Batal Pilih
                    </button>
                </div>

                <form id="bulk-kategori-form" action="{{ route('arsip-dokumen.bulkUpdateKategori') }}" method="POST" class="hidden">
                    @csrf
                    @method('PATCH')
                    <div id="bulk-kategori-ids"></div>
                    <input type="hidden" name="kategori" id="bulk-kategori-value">
                </form>
                <form id="bulk-destroy-form" action="{{ route('arsip-dokumen.bulkDestroy') }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                    <div id="bulk-destroy-ids"></div>
                </form>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
                @forelse($dokumen as $item)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 border border-gray-100 p-3 md:p-5 flex flex-col h-full relative">

                        @if(auth()->check() && auth()->user()->isPengurus())
                            <div class="absolute top-2 left-2 md:top-3 md:left-3 z-10 bg-white/90 backdrop-blur rounded-md p-0.5 shadow-sm">
                                <input type="checkbox"
                                    class="bulk-checkbox h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 block"
                                    value="{{ $item->id }}"
                                    onchange="updateBulkToolbar()"
                                >
                            </div>
                        @endif

                        <div class="flex items-center justify-center h-16 md:h-20 bg-gray-50 rounded-lg mb-3 border border-gray-100">
                            @php
                                $iconColors = [
                                    'pdf' => 'text-red-500',
                                    'doc' => 'text-blue-500',
                                    'docx' => 'text-blue-500',
                                    'ppt' => 'text-orange-500',
                                    'pptx' => 'text-orange-500',
                                    'xls' => 'text-green-500',
                                    'xlsx' => 'text-green-500',
                                    'jpg' => 'text-purple-500',
                                    'jpeg' => 'text-purple-500',
                                    'png' => 'text-purple-500',
                                ];
                                $color = $iconColors[$item->file_type] ?? 'text-gray-500';
                            @endphp
                            <svg class="w-8 h-8 md:w-10 md:h-10 {{ $color }}" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                        </div>

                        <h3 class="font-bold text-gray-900 mb-1.5 truncate text-xs md:text-base" title="{{ $item->judul }}">{{ $item->judul }}</h3>

                        <div class="space-y-1 text-[10px] md:text-sm text-gray-600 mb-3 flex-grow">
                            <p class="mb-1.5 flex items-center gap-1 flex-wrap">
                                <span class="px-1.5 py-0.5 bg-blue-100 text-blue-800 rounded text-[9px] md:text-xs font-bold border border-blue-200">
                                    {{ strtoupper($item->file_type) }}
                                </span>
                                @if($item->versi > 1)
                                    <a href="{{ route('arsip-dokumen.history', $item) }}" class="px-1.5 py-0.5 bg-indigo-100 text-indigo-800 rounded text-[9px] md:text-xs font-bold border border-indigo-200 hover:bg-indigo-200">
                                        v{{ $item->versi }}
                                    </a>
                                @endif
                            </p>
                            <p class="truncate">Kat: {{ $item->kategori }}</p>
                            <p>{{ $item->tanggal_dokumen->format('d/m/Y') }}</p>
                            <p>{{ number_format($item->file_size / 1024, 1) }} KB</p>
                            <p>DL: {{ $item->download_count }}x</p>
                        </div>

                        <div class="mt-auto space-y-1.5">
                            @if($item->isPreviewable() || (auth()->check() && (auth()->user()->isPengurus() || auth()->user()->isInti())))
                                <div class="flex gap-1.5">
                                    @if($item->isPreviewable())
                                        <a href="{{ route('arsip-dokumen.preview', $item) }}"
                                            class="flex-1 flex justify-center items-center px-2 py-1.5 bg-gray-100 text-gray-700 font-medium rounded-md hover:bg-gray-200 text-[10px] md:text-sm transition"
                                        >
                                            Lihat
                                        </a>
                                    @endif
                                    @if(auth()->check() && auth()->user()->isPengurus())
                                        <a href="{{ route('arsip-dokumen.edit', $item) }}"
                                            class="flex-1 flex items-center justify-center gap-1 px-2 py-1.5 bg-amber-50 text-amber-700 hover:bg-amber-600 hover:text-white font-medium rounded-md text-[10px] md:text-sm transition border border-amber-200 hover:border-transparent"
                                        >
                                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            Edit
                                        </a>
                                    @endif
                                    @if(auth()->check() && auth()->user()->isInti())
                                        <form action="{{ route('arsip-dokumen.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin hapus dokumen ini beserta seluruh riwayat versinya?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full flex items-center justify-center gap-1 px-2 py-1.5 bg-red-50 text-red-700 hover:bg-red-600 hover:text-white font-medium rounded-md text-[10px] md:text-sm transition border border-red-200 hover:border-transparent">
                                                <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endif
                            <a href="{{ route('arsip-dokumen.download', $item) }}"
                                class="w-full flex justify-center items-center px-2 py-1.5 md:py-2 bg-primary-600 text-white font-medium rounded-md hover:bg-primary-700 text-[10px] md:text-sm transition shadow-sm"
                                target="_blank"
                            >
                                <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span class="hidden sm:inline">Download</span>
                                <span class="inline sm:hidden">Unduh</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 md:col-span-3 lg:col-span-4 text-center py-10 md:py-16 bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-gray-50 rounded-full mb-3">
                            <svg class="h-6 w-6 md:h-8 md:w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-sm md:text-lg font-semibold text-gray-900 mb-1">Belum ada dokumen</h3>
                        <p class="text-xs md:text-sm text-gray-500">Silakan gunakan fitur pencarian atau tambahkan dokumen baru.</p>
                    </div>
                @endforelse
            </div>

            @if($dokumen->hasPages())
                <div class="mt-6 md:mt-8">
                    {{ $dokumen->links() }}
                </div>
            @endif
        </div>
    </div>

    @if(auth()->check() && auth()->user()->isPengurus())
    <script>
        function getSelectedIds() {
            return Array.from(document.querySelectorAll('.bulk-checkbox:checked')).map(cb => cb.value);
        }

        function updateBulkToolbar() {
            const ids = getSelectedIds();
            const toolbar = document.getElementById('bulk-toolbar');
            document.getElementById('bulk-count').textContent = ids.length;
            toolbar.classList.toggle('hidden', ids.length === 0);
        }

        function clearBulkSelection() {
            document.querySelectorAll('.bulk-checkbox:checked').forEach(cb => cb.checked = false);
            updateBulkToolbar();
        }

        function fillHiddenIds(containerId, ids) {
            const container = document.getElementById(containerId);
            container.innerHTML = '';
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                container.appendChild(input);
            });
        }

        function submitBulkKategori() {
            const kategori = document.getElementById('bulk-kategori-select').value;
            const ids = getSelectedIds();
            if (!kategori) { alert('Pilih kategori tujuan dulu.'); return; }
            if (ids.length === 0) { return; }

            document.getElementById('bulk-kategori-value').value = kategori;
            fillHiddenIds('bulk-kategori-ids', ids);
            document.getElementById('bulk-kategori-form').submit();
        }

        function submitBulkDestroy() {
            const ids = getSelectedIds();
            if (ids.length === 0) { return; }
            if (!confirm(`Yakin hapus ${ids.length} dokumen terpilih beserta seluruh riwayat versinya?`)) { return; }

            fillHiddenIds('bulk-destroy-ids', ids);
            document.getElementById('bulk-destroy-form').submit();
        }
    </script>
    @endif
</x-app-layout>