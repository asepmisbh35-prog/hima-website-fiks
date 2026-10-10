<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
            Buat Periode Pendaftaran Baru
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-4 md:p-6">
                    
                    @if($errors->any())
                        <div class="mb-4 md:mb-6 bg-red-50 border border-red-200 rounded-lg p-3 md:p-4">
                            <p class="font-semibold text-red-800 mb-1.5 md:mb-2 text-xs md:text-sm">Terdapat kesalahan:</p>
                            <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.periode.store') }}" method="POST" class="space-y-4 md:space-y-6">
                        @csrf

                        <div>
                            <label for="nama_periode" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                Nama Periode <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="nama_periode" 
                                id="nama_periode"
                                value="{{ old('nama_periode') }}"
                                class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm md:text-base py-2.5 md:py-2"
                                placeholder="Contoh: Pendaftaran Pengurus Muda 2026/2027"
                                required
                            >
                            @error('nama_periode')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="deskripsi" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                Deskripsi
                            </label>
                            <textarea 
                                name="deskripsi" 
                                id="deskripsi"
                                rows="4"
                                class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm md:text-base py-2.5 md:py-2 resize-none"
                                placeholder="Deskripsi periode pendaftaran (opsional)..."
                            >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="tanggal_buka" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                    Tanggal Buka <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_buka" 
                                    id="tanggal_buka"
                                    value="{{ old('tanggal_buka') }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm md:text-base py-2.5 md:py-2"
                                    required
                                >
                                @error('tanggal_buka')
                                    <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="tanggal_tutup" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                    Tanggal Tutup <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="date" 
                                    name="tanggal_tutup" 
                                    id="tanggal_tutup"
                                    value="{{ old('tanggal_tutup') }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-primary-500 focus:ring-primary-500 text-sm md:text-base py-2.5 md:py-2"
                                    required
                                >
                                @error('tanggal_tutup')
                                    <p class="mt-1 text-xs md:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 md:p-4">
                            <div class="flex items-start">
                                <input 
                                    type="checkbox" 
                                    name="is_active" 
                                    id="is_active"
                                    value="1"
                                    {{ old('is_active') ? 'checked' : '' }}
                                    class="h-4 w-4 md:h-5 md:w-5 text-primary-600 focus:ring-primary-500 border-gray-300 rounded mt-0.5"
                                >
                                <div class="ml-2.5 md:ml-3">
                                    <label for="is_active" class="font-bold text-xs md:text-sm text-gray-900 cursor-pointer">
                                        Aktifkan periode ini sekarang
                                    </label>
                                    <p class="text-[10px] md:text-xs text-gray-600 mt-0.5">
                                        Jika dicentang, periode ini akan langsung aktif dan periode lain akan dinonaktifkan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 md:p-4">
                            <h4 class="font-bold text-xs md:text-sm text-yellow-900 mb-1.5 md:mb-2">⚠️ Perhatian</h4>
                            <ul class="text-[10px] md:text-xs text-yellow-800 space-y-1 list-disc list-inside">
                                <li>Pastikan tanggal sudah benar sebelum mengaktifkan</li>
                                <li>Hanya satu periode yang bisa aktif dalam satu waktu</li>
                                <li>Mahasiswa hanya bisa mendaftar pada periode yang aktif</li>
                            </ul>
                        </div>

                        <div class="flex flex-col-reverse md:flex-row items-center justify-between pt-4 md:pt-6 border-t border-gray-200 gap-3 md:gap-0 mt-2">
                            <a href="{{ route('pendaftaran.periode.index') }}" class="w-full md:w-auto inline-flex justify-center items-center py-2.5 md:py-2 text-gray-600 bg-gray-100 md:bg-transparent rounded-lg md:rounded-none hover:text-gray-900 hover:bg-gray-200 md:hover:bg-transparent font-bold text-xs md:text-sm transition">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button 
                                type="submit"
                                class="w-full md:w-auto px-6 py-2.5 md:py-3 bg-primary-600 text-white font-bold text-xs md:text-sm rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition shadow-lg flex justify-center items-center"
                            >
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Simpan Periode
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>