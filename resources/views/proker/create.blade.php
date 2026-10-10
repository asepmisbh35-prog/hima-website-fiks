<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Program Kerja Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                   
@if($errors->hasBag('default') && $errors->getBag('default')->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <p class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
        <ul class="list-disc list-inside text-sm text-red-700">
            @foreach($errors->getBag('default')->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                    {{-- 
                        PENTING: Form ini menggunakan enctype multipart/form-data 
                        karena ada upload file (proposal kegiatan).
                    --}}
                    <form action="{{ route('proker.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        {{-- ==================== SECTION 1: INFO DASAR ==================== --}}
                        <div>
                            <h3 class="text-base font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold rounded-full">1</span>
                                Informasi Dasar
                            </h3>

                            <div class="space-y-5">
                                {{-- Nama Proker --}}
                                <div>
                                    <label for="nama_proker" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Program Kerja <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="nama_proker"
                                        id="nama_proker"
                                        value="{{ old('nama_proker') }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="Contoh: Seminar Teknologi AI 2026"
                                        required
                                    >
                                    @error('nama_proker')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Deskripsi --}}
                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                        name="deskripsi"
                                        id="deskripsi"
                                        rows="4"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="Jelaskan detail program kerja, tujuan, dan target yang ingin dicapai..."
                                        required
                                    >{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- [BARU] Ketua Pelaksana --}}
                                <div>
                                    <label for="ketua_pelaksana" class="block text-sm font-medium text-gray-700 mb-2">
                                        Ketua Pelaksana <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="ketua_pelaksana"
                                        id="ketua_pelaksana"
                                        value="{{ old('ketua_pelaksana') }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="Nama lengkap ketua pelaksana kegiatan"
                                        required
                                    >
                                    @error('ketua_pelaksana')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Divisi --}}
                                <div>
                                    <label for="divisi" class="block text-sm font-medium text-gray-700 mb-2">
                                        Divisi Penanggung Jawab <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="divisi"
                                        id="divisi"
                                        value="{{ old('divisi') }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="Contoh: Divisi Humas"
                                        list="divisi-list"
                                        required
                                    >
                                    <datalist id="divisi-list">
                                        <option value="Divisi PSDA">
                                        <option value="Divisi Pendidikan">
                                        <option value="Divisi Jasroh">
                                        <option value="Divisi Kewirausahaan">
                                        <option value="Divisi Minat Bakat">
                                        <option value="Pengurus Inti">
                                    </datalist>
                                    @error('divisi')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ==================== SECTION 2: WAKTU ==================== --}}
                        <div>
                            <h3 class="text-base font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold rounded-full">2</span>
                                Waktu Pelaksanaan
                            </h3>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Mulai <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        name="tanggal_mulai"
                                        id="tanggal_mulai"
                                        value="{{ old('tanggal_mulai') }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        required
                                    >
                                    @error('tanggal_mulai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Selesai <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                        type="date"
                                        name="tanggal_selesai"
                                        id="tanggal_selesai"
                                        value="{{ old('tanggal_selesai') }}"
                                        class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        required
                                    >
                                    @error('tanggal_selesai')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- ==================== SECTION 3: ANGGARAN ==================== --}}
                        <div>
                            <h3 class="text-base font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold rounded-full">3</span>
                                Anggaran
                            </h3>

                            <div>
                                <label for="anggaran" class="block text-sm font-medium text-gray-700 mb-2">
                                    Total Anggaran (Rp) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-medium">
                                        Rp
                                    </span>
                                    <input
                                        type="number"
                                        name="anggaran"
                                        id="anggaran"
                                        value="{{ old('anggaran') }}"
                                        class="w-full pl-12 rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500"
                                        placeholder="0"
                                        min="0"
                                        step="1000"
                                        required
                                    >
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Masukkan total anggaran yang dibutuhkan untuk program kerja ini</p>
                                @error('anggaran')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ==================== SECTION 4: UPLOAD PROPOSAL ==================== --}}
                        <div>
                            <h3 class="text-base font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200 flex items-center gap-2">
                                <span class="inline-flex items-center justify-center w-6 h-6 bg-primary-600 text-white text-xs font-bold rounded-full">4</span>
                                Proposal Kegiatan
                            </h3>

                            <div>
                                <label for="file_proposal" class="block text-sm font-medium text-gray-700 mb-2">
                                    Upload Proposal
                                    <span class="text-gray-400 font-normal">(Opsional)</span>
                                </label>

                                {{-- Drop Zone --}}
                                <div
                                    id="drop-zone-proposal"
                                    class="relative border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-primary-400 hover:bg-primary-50 transition-all cursor-pointer group"
                                    onclick="document.getElementById('file_proposal').click()"
                                >
                                    <div id="proposal-placeholder">
                                        <svg class="mx-auto w-10 h-10 text-gray-400 group-hover:text-primary-500 transition mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        <p class="text-sm font-medium text-gray-700">Klik atau drag & drop file proposal di sini</p>
                                        <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX · Maksimal 10 MB</p>
                                    </div>
                                    <div id="proposal-preview" class="hidden">
                                        <svg class="mx-auto w-10 h-10 text-primary-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        <p id="proposal-filename" class="text-sm font-semibold text-primary-700"></p>
                                        <p id="proposal-filesize" class="text-xs text-gray-500 mt-1"></p>
                                        <button
                                            type="button"
                                            onclick="clearFile(event, 'file_proposal', 'proposal')"
                                            class="mt-2 text-xs text-red-500 hover:text-red-700 underline"
                                        >Hapus file</button>
                                    </div>
                                </div>

                                <input
                                    type="file"
                                    name="file_proposal"
                                    id="file_proposal"
                                    class="hidden"
                                    accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    onchange="handleFileChange(this, 'proposal')"
                                >
                                @error('file_proposal')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- ==================== INFO BOX ==================== --}}
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">📌 Informasi</h4>
                            <ul class="text-sm text-blue-800 space-y-1 list-disc list-inside">
                                <li>Status awal program kerja otomatis <strong>"Perencanaan"</strong> (0%)</li>
                                <li>Status berubah otomatis sesuai progress yang diinput</li>
                                <li>Progress ≥ 90% → form upload LPJ & dokumentasi akan muncul</li>
                                <li>Progress 100% mensyaratkan LPJ & foto dokumentasi telah diupload</li>
                            </ul>
                        </div>

                        {{-- ==================== SUBMIT ==================== --}}
                        <div class="flex items-center justify-between pt-4 border-t">
                            <a href="{{ route('proker.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-medium">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button
                                type="submit"
                                class="px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg"
                            >
                                Simpan Program Kerja
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ---- File Upload Handler ----
        function handleFileChange(input, key) {
            const file = input.files[0];
            if (!file) return;

            const maxSize = 10 * 1024 * 1024; // 10 MB
            if (file.size > maxSize) {
                alert('Ukuran file melebihi batas maksimal 10 MB.');
                input.value = '';
                return;
            }

            document.getElementById(key + '-placeholder').classList.add('hidden');
            document.getElementById(key + '-preview').classList.remove('hidden');
            document.getElementById(key + '-filename').textContent = file.name;
            document.getElementById(key + '-filesize').textContent = formatFileSize(file.size);
        }

        function clearFile(event, inputId, key) {
            event.stopPropagation();
            document.getElementById(inputId).value = '';
            document.getElementById(key + '-placeholder').classList.remove('hidden');
            document.getElementById(key + '-preview').classList.add('hidden');
        }

        function formatFileSize(bytes) {
            if (bytes < 1024) return bytes + ' B';
            if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(1) + ' KB';
            return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
        }

        // ---- Drag & Drop ----
        const dropZone = document.getElementById('drop-zone-proposal');
        dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('border-primary-500', 'bg-primary-50'); });
        dropZone.addEventListener('dragleave', () => { dropZone.classList.remove('border-primary-500', 'bg-primary-50'); });
        dropZone.addEventListener('drop', e => {
            e.preventDefault();
            dropZone.classList.remove('border-primary-500', 'bg-primary-50');
            const input = document.getElementById('file_proposal');
            const dt = new DataTransfer();
            dt.items.add(e.dataTransfer.files[0]);
            input.files = dt.files;
            handleFileChange(input, 'proposal');
        });
    </script>
</x-app-layout>