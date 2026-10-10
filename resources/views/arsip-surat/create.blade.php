<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
            Upload Surat Baru
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-xl md:rounded-2xl shadow-xl p-6 md:p-8 mb-6 md:mb-8 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-white/20 backdrop-blur-lg rounded-full text-xs md:text-sm font-semibold mb-3 md:mb-4 border border-white/30">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1.5 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Arsip Surat
                        </div>
                        <h2 class="text-xl md:text-3xl font-bold mb-1 md:mb-2">Upload Surat Baru</h2>
                        <p class="text-white/90 text-xs md:text-base">Arsipkan surat untuk dokumentasi dan kemudahan akses</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl md:rounded-2xl shadow-xl overflow-hidden">
                <div class="p-5 md:p-10">
                    
                    @if($errors->any())
                        <div class="mb-6 md:mb-8 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4 md:p-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500 mr-2 md:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-red-900 mb-1.5 md:mb-2 text-sm md:text-base">Terdapat kesalahan:</p>
                                    <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('arsip-surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 md:space-y-8" data-turbo="false">
                        @csrf

                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-blue-200">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Informasi Surat
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="nomor_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Nomor Surat <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="nomor_surat" 
                                            id="nomor_surat"
                                            value="{{ old('nomor_surat') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                            placeholder="001/HIMA-PTI/2024"
                                            required
                                        >
                                    </div>
                                    @error('nomor_surat')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="jenis_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Jenis Surat <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                        <select 
                                            name="jenis_surat" 
                                            id="jenis_surat"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition appearance-none bg-white"
                                            required
                                        >
                                            <option value="">Pilih Jenis Surat</option>
                                            @foreach($jenisSurat as $jenis)
                                                <option value="{{ $jenis }}" {{ old('jenis_surat') == $jenis ? 'selected' : '' }}>
                                                    {{ ucfirst($jenis) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('jenis_surat')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="perihal" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Perihal <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="perihal" 
                                            id="perihal"
                                            value="{{ old('perihal') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                            placeholder="Undangan Rapat Koordinasi"
                                            required
                                        >
                                    </div>
                                    @error('perihal')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_surat" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Tanggal Surat <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="date" 
                                            name="tanggal_surat" 
                                            id="tanggal_surat"
                                            value="{{ old('tanggal_surat') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                            required
                                        >
                                    </div>
                                    @error('tanggal_surat')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Kategori <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="kategori" 
                                            id="kategori"
                                            value="{{ old('kategori') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                            placeholder="Administrasi, Kegiatan, dll"
                                        >
                                    </div>
                                    @error('kategori')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="pengirim" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Pengirim <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="pengirim" 
                                            id="pengirim"
                                            value="{{ old('pengirim') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                            placeholder="Ketua HIMA"
                                        >
                                    </div>
                                    @error('pengirim')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="penerima" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Penerima <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="penerima" 
                                            id="penerima"
                                            value="{{ old('penerima') }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                            placeholder="Dekan Fakultas"
                                        >
                                    </div>
                                    @error('penerima')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Deskripsi <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <textarea 
                                        name="deskripsi" 
                                        id="deskripsi"
                                        rows="4"
                                        class="block w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                        placeholder="Deskripsi singkat tentang surat..."
                                    >{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-blue-200">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                Upload File
                            </h3>

                            <div class="relative border-2 border-dashed border-gray-300 rounded-xl hover:border-blue-400 transition-all bg-gradient-to-br from-gray-50 to-white">
                                <input 
                                    type="file" 
                                    name="file" 
                                    id="file"
                                    class="sr-only"
                                    accept=".pdf,.doc,.docx"
                                    required
                                    onchange="displayFileName(this)"
                                >
                                <label for="file" class="cursor-pointer block px-4 py-8 md:py-12 text-center">
                                    <div class="space-y-3">
                                        <div class="flex justify-center">
                                            <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center">
                                                <svg class="w-6 h-6 md:w-8 md:h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm md:text-base font-semibold text-gray-700">
                                                <span class="text-blue-600">Pilih file</span> <span class="hidden sm:inline">atau drag and drop</span>
                                            </p>
                                            <p class="text-xs md:text-sm text-gray-500 mt-1">PDF, DOC, DOCX (max. 5MB)</p>
                                        </div>
                                        <div id="file-preview" class="hidden">
                                            <div class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-green-100 rounded-lg">
                                                <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600 mr-1.5 md:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                <span id="file-name" class="text-xs md:text-sm font-medium text-green-800 break-all line-clamp-1"></span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('file')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 md:p-6 border border-purple-200">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input 
                                        type="checkbox" 
                                        name="is_public" 
                                        id="is_public"
                                        value="1"
                                        {{ old('is_public') ? 'checked' : '' }}
                                        class="w-4 h-4 md:w-5 md:h-5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded transition mt-0.5 md:mt-0"
                                    >
                                </div>
                                <div class="ml-3">
                                    <label for="is_public" class="font-semibold text-sm md:text-base text-gray-900 cursor-pointer">
                                        Jadikan surat ini publik
                                    </label>
                                    <p class="text-xs md:text-sm text-gray-600 mt-0.5 md:mt-1">
                                        Surat publik dapat diakses oleh mahasiswa umum di halaman Arsip.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-6 md:pt-8 border-t-2 border-gray-200 gap-3 md:gap-4">
                            <a href="{{ route('arsip-surat.index') }}" class="w-full sm:w-auto flex justify-center items-center px-6 py-2.5 md:py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition">
                                ← Kembali
                            </a>
                            <button 
                                type="submit"
                                class="w-full sm:w-auto flex justify-center items-center px-6 md:px-8 py-2.5 md:py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-xl hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg"
                            >
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Arsipkan Surat
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
            const filePreview = document.getElementById('file-preview');
            
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
                filePreview.classList.remove('hidden');
            } else {
                filePreview.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>