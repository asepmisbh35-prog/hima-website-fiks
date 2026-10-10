<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Jadwalkan Rapat Baru
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-5 md:p-8">

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                            <p class="font-semibold text-red-800 mb-2 text-sm">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('rapat.store') }}" method="POST" enctype="multipart/form-data" data-turbo="false" class="space-y-6">
                        @csrf

                        {{-- ── Judul ────────────────────────────────────────────── --}}
                        <div>
                            <label for="judul_rapat" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Judul Rapat <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul_rapat" id="judul_rapat"
                                value="{{ old('judul_rapat') }}"
                                class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                placeholder="Contoh: Rapat Koordinasi Bulanan"
                                required>
                            @error('judul_rapat')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ── Agenda ───────────────────────────────────────────── --}}
                        <div>
                            <label for="agenda" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Agenda Rapat <span class="text-red-500">*</span>
                            </label>
                            <textarea name="agenda" id="agenda" rows="5"
                                class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                placeholder="1. Pembukaan&#10;2. Evaluasi program bulan lalu&#10;3. Perencanaan kegiatan bulan depan&#10;4. Penutup"
                                required>{{ old('agenda') }}</textarea>
                            @error('agenda')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ── Tanggal & Lokasi ─────────────────────────────────── --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_waktu" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Tanggal & Waktu <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu"
                                    value="{{ old('tanggal_waktu') }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    required>
                                @error('tanggal_waktu')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Lokasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="lokasi" id="lokasi"
                                    value="{{ old('lokasi') }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    placeholder="Ruang rapat / Google Meet / Zoom"
                                    list="lokasi-list" required>
                                <datalist id="lokasi-list">
                                    <option value="Ruang Rapat Gedung A">
                                    <option value="Ruang Seminar">
                                    <option value="Ruang Multimedia">
                                    <option value="Sekretariat HIMA">
                                    <option value="Google Meet">
                                    <option value="Zoom Meeting">
                                </datalist>
                                @error('lokasi')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Peserta Selector ─────────────────────────────────── --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Peserta Rapat
                                <span class="text-xs font-normal text-gray-400 ml-1">(pengurus harian & inti)</span>
                            </label>

                            {{-- Search box --}}
                            <div class="relative mb-3">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" id="searchPeserta"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 text-sm"
                                    placeholder="Cari nama pengurus...">
                            </div>

                            {{-- Selected chips --}}
                            <div id="selectedChips" class="flex flex-wrap gap-2 mb-3 min-h-[36px]"></div>

                            {{-- User grid --}}
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <div class="bg-gray-50 px-4 py-2.5 border-b border-gray-200 flex items-center justify-between">
                                    <span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Daftar Pengurus</span>
                                    <div class="flex gap-2">
                                        <button type="button" onclick="selectAll()" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Pilih Semua</button>
                                        <span class="text-gray-300">|</span>
                                        <button type="button" onclick="clearAll()" class="text-xs text-red-500 hover:text-red-700 font-medium">Batal Semua</button>
                                    </div>
                                </div>

                                <div id="pesertaList" class="divide-y divide-gray-100 max-h-72 overflow-y-auto">
                                    @forelse($pengurus as $user)
                                        <label class="peserta-item flex items-center gap-3 px-4 py-3 hover:bg-blue-50 cursor-pointer transition-colors"
                                            data-name="{{ strtolower($user->name) }}"
                                            data-id="{{ $user->id }}">
                                            <input type="checkbox"
                                                name="peserta_ids[]"
                                                value="{{ $user->id }}"
                                                class="peserta-checkbox w-4 h-4 text-blue-600 rounded border-gray-300"
                                                {{ is_array(old('peserta_ids')) && in_array($user->id, old('peserta_ids')) ? 'checked' : '' }}
                                                onchange="updateChips()">
                                            <div class="flex-shrink-0">
                                                @if($user->photo)
                                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                                                        class="w-9 h-9 rounded-full object-cover ring-2 ring-gray-100"
                                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                                    <div class="hidden w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 items-center justify-center text-white font-bold text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @else
                                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                                @if($user->nim)
                                                    <p class="text-xs text-gray-500">NIM: {{ $user->nim }}</p>
                                                @endif
                                            </div>
                                            @php
                                                $roleLabel = $user->role === 'pengurus_inti' ? ['👑', 'bg-purple-100 text-purple-700'] : ['⭐', 'bg-green-100 text-green-700'];
                                            @endphp
                                            <span class="flex-shrink-0 inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold {{ $roleLabel[1] }}">
                                                {{ $roleLabel[0] }} {{ $user->role === 'pengurus_inti' ? 'Inti' : 'Harian' }}
                                            </span>
                                        </label>
                                    @empty
                                        <div class="px-4 py-8 text-center text-gray-500 text-sm">
                                            Belum ada pengurus terdaftar
                                        </div>
                                    @endforelse
                                </div>

                                <div class="bg-gray-50 px-4 py-2 border-t border-gray-200">
                                    <span class="text-xs text-gray-500">
                                        Terpilih: <strong id="selectedCount" class="text-primary-600">0</strong> dari {{ $pengurus->count() }} pengurus
                                    </span>
                                </div>
                            </div>
                            @error('peserta_ids')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ── Notulensi (opsional) ─────────────────────────────── --}}
                        <div class="border-t border-gray-100 pt-6">
                            <div class="flex items-center gap-2 mb-1.5">
                                <h3 class="text-sm font-semibold text-gray-700">Notulensi</h3>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">Opsional</span>
                            </div>
                            <p class="text-xs text-gray-500 mb-4">Dapat ditambahkan sekarang atau setelah rapat selesai</p>

                            <div class="space-y-4">
                                <textarea name="notulensi" id="notulensi" rows="5"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    placeholder="Tuliskan hasil rapat, keputusan, dan action items...">{{ old('notulensi') }}</textarea>

                                {{-- File upload --}}
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-2">Upload File (PDF/DOC/DOCX, maks 5MB)</label>
                                    <label for="file_notulensi" class="flex items-center gap-3 px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        <span id="fileLabel" class="text-sm text-gray-500">Klik untuk pilih file atau drag & drop</span>
                                        <input id="file_notulensi" name="file_notulensi" type="file" class="sr-only"
                                            accept=".pdf,.doc,.docx" onchange="updateFileLabel(this)">
                                    </label>
                                    @error('file_notulensi')
                                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ── Info Box ─────────────────────────────────────────── --}}
                        <div class="bg-blue-50 border border-primary-200-200 rounded-xl p-4">
                            <p class="text-xs font-semibold text-primary-800 mb-1.5">📌 Informasi Penting</p>
                            <ul class="text-xs text-primary-700 space-y-1 list-disc list-inside">
                                <li>Pastikan tanggal dan waktu sudah benar sebelum disimpan</li>
                                <li>Email reminder akan dikirim otomatis H-1 kepada peserta yang dipilih</li>
                                <li>Anda (pembuat rapat) otomatis masuk sebagai peserta</li>
                                <li>Status awal rapat adalah "Dijadwalkan"</li>
                            </ul>
                        </div>

                        {{-- ── Tombol ───────────────────────────────────────────── --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('rapat.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit"
                                class="px-6 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-md">
                                Jadwalkan Rapat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // ─── Peserta chips ─────────────────────────────────────────────────────
        const pengurusData = {!! $pengurus->map(fn($u) => [
            'id'    => $u->id,
            'name'  => $u->name,
            'role'  => $u->role,
            'photo' => $u->photo ? asset('storage/' . $u->photo) : null,
        ])->toJson() !!};

        function getCheckedIds() {
            return [...document.querySelectorAll('.peserta-checkbox:checked')].map(c => parseInt(c.value));
        }

        function updateChips() {
            const ids    = getCheckedIds();
            const chips  = document.getElementById('selectedChips');
            const count  = document.getElementById('selectedCount');
            count.textContent = ids.length;

            chips.innerHTML = ids.map(id => {
                const u = pengurusData.find(p => p.id === id);
                if (!u) return '';
                const color = u.role === 'pengurus_inti' ? 'bg-purple-100 text-purple-800 border-purple-200' : 'bg-green-100 text-green-800 border-green-200';
                return `<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium border ${color}">
                    ${u.name}
                    <button type="button" onclick="removeChip(${u.id})" class="hover:opacity-70">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </span>`;
            }).join('');
        }

        function removeChip(id) {
            const cb = document.querySelector(`.peserta-checkbox[value="${id}"]`);
            if (cb) { cb.checked = false; updateChips(); }
        }

        function selectAll() {
            document.querySelectorAll('.peserta-item:not([style*="display: none"]) .peserta-checkbox').forEach(c => c.checked = true);
            updateChips();
        }

        function clearAll() {
            document.querySelectorAll('.peserta-checkbox').forEach(c => c.checked = false);
            updateChips();
        }

        // ─── Search filter ─────────────────────────────────────────────────────
        document.getElementById('searchPeserta').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.peserta-item').forEach(el => {
                el.style.display = el.dataset.name.includes(q) ? '' : 'none';
            });
        });

        // ─── File label ────────────────────────────────────────────────────────
        function updateFileLabel(input) {
            const label = document.getElementById('fileLabel');
            if (input.files && input.files[0]) {
                label.textContent = '✓ ' + input.files[0].name;
                label.classList.add('text-blue-600', 'font-medium');
            }
        }

        // Init
        updateChips();
    </script>
    @endpush
</x-app-layout>