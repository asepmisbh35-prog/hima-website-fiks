<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upload Dokumen Baru
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg rounded-xl">
                <div class="p-5 md:p-8">
                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-r-lg p-4 shadow-sm">
                            <p class="font-semibold text-red-800 mb-2 text-sm md:text-base">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('arsip-dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 md:space-y-6" data-turbo="false">
                        @csrf

                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Judul Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                name="judul" 
                                id="judul"
                                value="{{ old('judul') }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition"
                                placeholder="Contoh: Anggaran Dasar dan Anggaran Rumah Tangga"
                                required
                            >
                            @error('judul')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <select name="kategori"
                                id="kategori"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition bg-white"
                                required
                            >
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(\App\Models\ArsipDokumen::KATEGORI_LIST as $kat)
                                    <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_dokumen" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Tanggal Dokumen <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                name="tanggal_dokumen" 
                                id="tanggal_dokumen"
                                value="{{ old('tanggal_dokumen', date('Y-m-d')) }}"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition"
                                required
                            >
                            @error('tanggal_dokumen')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <textarea name="deskripsi" 
                                id="deskripsi"
                                rows="3"
                                class="w-full text-sm md:text-base rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 py-2.5 px-3 md:py-3 md:px-4 transition resize-none"
                                placeholder="Deskripsi singkat tentang dokumen ini..."
                            >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">
                                Upload Dokumen <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1 flex justify-center px-4 md:px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-primary-400 transition bg-gray-50">
                                <div class="space-y-2 text-center">
                                    <svg class="mx-auto h-10 w-10 md:h-12 md:w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex flex-col sm:flex-row items-center justify-center text-xs md:text-sm text-gray-600 gap-1">
                                        <label for="file" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500 px-2 py-1 shadow-sm border border-gray-200">
                                            <span>Pilih file</span>
                                            <input id="file" 
                                                name="file" 
                                                type="file" 
                                                class="sr-only"
                                                accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx"
                                                required
                                                onchange="displayFileName(this)"
                                            >
                                        </label>
                                        <p class="hidden sm:block">atau drag and drop</p>
                                    </div>
                                    <p class="text-[10px] md:text-xs text-gray-500">PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX</p>
                                    <p class="text-[10px] md:text-xs text-gray-500">Maksimal 10MB</p>
                                    <p id="file-name" class="text-xs md:text-sm font-medium text-primary-600 mt-2 break-all px-2"></p>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4">
                            <div class="flex items-start">
                                <input type="checkbox" 
                                    name="is_public" 
                                    id="is_public"
                                    value="1"
                                    {{ old('is_public') ? 'checked' : '' }}
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-1 md:mt-0.5"
                                >
                                <div class="ml-3">
                                    <label for="is_public" class="font-semibold text-sm md:text-base text-gray-900 block mb-0.5">
                                        Jadikan dokumen ini publik
                                    </label>
                                    <p class="text-xs md:text-sm text-gray-600 leading-relaxed">
                                        Dokumen publik dapat diakses dan didownload oleh semua mahasiswa. Dokumen private hanya bisa diakses oleh pengurus.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-6 border-t border-gray-200 gap-3 md:gap-4">
                            <a href="{{ route('arsip-dokumen.index') }}" class="w-full sm:w-auto text-center px-6 py-2.5 md:py-3 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition">
                                ← Kembali
                            </a>
                            <button type="submit"
                                class="w-full sm:w-auto flex justify-center items-center px-6 py-2.5 md:py-3 bg-primary-600 text-white font-bold rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg"
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                </svg>
                                Upload Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function displayFileName(input) {
            const fileName = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                const file = input.files[0];
                const size = (file.size / 1024 / 1024).toFixed(2);
                fileName.textContent = `✓ ${file.name} (${size} MB)`;
            }
        }
    </script>
</x-app-layout>