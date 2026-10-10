<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Rapat
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

                    <form action="{{ route('rapat.update', $rapat) }}" method="POST" enctype="multipart/form-data" data-turbo="false" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        {{-- ── Judul ────────────────────────────────────────────── --}}
                        <div>
                            <label for="judul_rapat" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Judul Rapat <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul_rapat" id="judul_rapat"
                                value="{{ old('judul_rapat', $rapat->judul_rapat) }}"
                                class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                required>
                        </div>

                        {{-- ── Agenda ───────────────────────────────────────────── --}}
                        <div>
                            <label for="agenda" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Agenda Rapat <span class="text-red-500">*</span>
                            </label>
                            <textarea name="agenda" id="agenda" rows="5"
                                class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                required>{{ old('agenda', $rapat->agenda) }}</textarea>
                        </div>

                        {{-- ── Tanggal & Lokasi ─────────────────────────────────── --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_waktu" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Tanggal & Waktu <span class="text-red-500">*</span>
                                </label>
                                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu"
                                    value="{{ old('tanggal_waktu', $rapat->tanggal_waktu->format('Y-m-d\TH:i')) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    required>
                            </div>
                            <div>
                                <label for="lokasi" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                    Lokasi <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="lokasi" id="lokasi"
                                    value="{{ old('lokasi', $rapat->lokasi) }}"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    list="lokasi-list" required>
                                <datalist id="lokasi-list">
                                    <option value="Ruang Rapat Gedung A">
                                    <option value="Ruang Seminar">
                                    <option value="Ruang Multimedia">
                                    <option value="Sekretariat HIMA">
                                    <option value="Google Meet">
                                    <option value="Zoom Meeting">
                                </datalist>
                            </div>
                        </div>

                        {{-- ── Status ───────────────────────────────────────────── --}}
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Status Rapat <span class="text-red-500">*</span>
                            </label>
                            <select name="status" id="status"
                                class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                required>
                                @foreach(['dijadwalkan' => 'Dijadwalkan', 'berlangsung' => 'Berlangsung', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $val => $label)
                                    <option value="{{ $val }}" {{ old('status', $rapat->status) == $val ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- ── Peserta Selector ─────────────────────────────────── --}}
                        @php $currentPesertaIds = old('peserta_ids', $rapat->getPesertaIdsArray()); @endphp
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Peserta Rapat
                                <span class="text-xs font-normal text-gray-400 ml-1">(pengurus harian & inti)</span>
                            </label>

                            <div class="relative mb-3">
                                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                <input type="text" id="searchPeserta"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm"
                                    placeholder="Cari nama pengurus...">
                            </div>

                            <div id="selectedChips" class="flex flex-wrap gap-2 mb-3 min-h-[36px]"></div>

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
                                                {{ in_array($user->id, (array)$currentPesertaIds) ? 'checked' : '' }}
                                                onchange="updateChips()">
                                            <div class="flex-shrink-0">
                                                @if($user->photo)
                                                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                                                        class="w-9 h-9 rounded-full object-cover ring-2 ring-gray-100"
                                                        onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
                                                    <div class="hidden w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 items-center justify-center text-white font-bold text-sm">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @else
                                                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center text-white font-bold text-sm">
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
                        </div>

                        {{-- ── Notulensi ─────────────────────────────────────────── --}}
                        <div class="border-t border-gray-100 pt-6">
                            <h3 class="text-sm font-semibold text-gray-700 mb-4">Notulensi</h3>

                            <div class="space-y-4">
                                <textarea name="notulensi" id="notulensi" rows="7"
                                    class="w-full rounded-xl border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm"
                                    placeholder="Tuliskan hasil rapat, keputusan, dan action items...">{{ old('notulensi', $rapat->notulensi) }}</textarea>

                                {{-- File saat ini --}}
                                @if($rapat->file_notulensi)
                                    <div class="flex items-center justify-between p-3 bg-green-50 border border-green-200 rounded-xl">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm text-green-800 font-medium">{{ basename($rapat->file_notulensi) }}</span>
                                        </div>
                                        <a href="{{ route('rapat.downloadNotulensi', $rapat) }}" target="_blank"
                                            class="text-xs text-primary-600 hover:text-primary-800 font-medium">Download</a>
                                    </div>
                                @endif

                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-2">
                                        {{ $rapat->file_notulensi ? 'Ganti File Notulensi (Opsional)' : 'Upload File Notulensi' }} — PDF/DOC/DOCX, maks 5MB
                                    </label>
                                    <label for="file_notulensi" class="flex items-center gap-3 px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 hover:bg-blue-50 cursor-pointer transition-colors">
                                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                        </svg>
                                        <span id="fileLabel" class="text-sm text-gray-500">Klik untuk pilih file atau drag & drop</span>
                                        <input id="file_notulensi" name="file_notulensi" type="file" class="sr-only"
                                            accept=".pdf,.doc,.docx" onchange="updateFileLabel(this)">
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- ── Reminder info ────────────────────────────────────── --}}
                        @if($rapat->reminder_sent)
                            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 flex items-center gap-2">
                                <svg class="w-4 h-4 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <p class="text-xs text-yellow-800">Reminder H-1 sudah dikirim. Jika mengubah tanggal, reminder akan dikirim ulang secara otomatis.</p>
                            </div>
                        @endif

                        {{-- ── Tombol ───────────────────────────────────────────── --}}
                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                            <a href="{{ route('rapat.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 font-medium">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button type="submit"
                                class="px-6 py-2.5 bg-primary-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition shadow-md">
                                Update Rapat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const pengurusData = {!! $pengurus->map(fn($u) => [
            'id'    => $u->id,
            'name'  => $u->name,
            'role'  => $u->role,
        ])->toJson() !!};

        function getCheckedIds() {
            return [...document.querySelectorAll('.peserta-checkbox:checked')].map(c => parseInt(c.value));
        }

        function updateChips() {
            const ids   = getCheckedIds();
            const chips = document.getElementById('selectedChips');
            const count = document.getElementById('selectedCount');
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

        document.getElementById('searchPeserta').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.peserta-item').forEach(el => {
                el.style.display = el.dataset.name.includes(q) ? '' : 'none';
            });
        });

        function updateFileLabel(input) {
            const label = document.getElementById('fileLabel');
            if (input.files && input.files[0]) {
                label.textContent = '✓ ' + input.files[0].name;
                label.classList.add('text-blue-600', 'font-medium');
            }
        }

        updateChips();
    </script>
    @endpush
</x-app-layout>