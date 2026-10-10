<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg md:text-xl text-gray-800 leading-tight">
            Edit Periode Pendaftaran
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl md:rounded-2xl shadow-xl p-5 md:p-8 mb-6 md:mb-8 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 bg-white/20 backdrop-blur-lg rounded-full text-[10px] md:text-sm font-bold mb-3 md:mb-4 border border-white/30">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1.5 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Periode
                        </div>
                        <h2 class="text-xl md:text-3xl font-bold mb-1 md:mb-2 line-clamp-2 leading-tight">{{ $periode->nama_periode }}</h2>
                        <p class="text-white/90 text-xs md:text-sm">Perbarui informasi periode pendaftaran</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-16 h-16 md:w-20 md:h-20 bg-white/20 backdrop-blur-lg rounded-xl md:rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl rounded-xl md:rounded-2xl">
                <div class="p-5 md:p-10">
                    
                    @if($errors->any())
                        <div class="mb-6 md:mb-8 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4 md:p-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500 mr-2 md:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-bold text-red-900 mb-1.5 md:mb-2 text-xs md:text-sm">Terdapat kesalahan:</p>
                                    <ul class="list-disc list-inside text-[10px] md:text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.periode.update', $periode) }}" method="POST" class="space-y-6 md:space-y-8" data-turbo="false">
                        @csrf
                        @method('PATCH')

                        <div>
                            <h3 class="text-sm md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-purple-200">
                                <svg class="w-4 h-4 md:w-6 md:h-6 mr-1.5 md:mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Periode
                            </h3>

                            <div class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="nama_periode" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                        Nama Periode <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                            </svg>
                                        </div>
                                        <input 
                                            type="text" 
                                            name="nama_periode" 
                                            id="nama_periode"
                                            value="{{ old('nama_periode', $periode->nama_periode) }}"
                                            class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-xs md:text-base"
                                            placeholder="Contoh: Pendaftaran Pengurus 2026"
                                            required
                                        >
                                    </div>
                                    @error('nama_periode')
                                        <p class="mt-1 text-[10px] md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label for="tanggal_buka" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                            Tanggal Buka <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <input 
                                                type="date" 
                                                name="tanggal_buka" 
                                                id="tanggal_buka"
                                                value="{{ old('tanggal_buka', $periode->tanggal_buka->format('Y-m-d')) }}"
                                                class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-xs md:text-base"
                                                required
                                            >
                                        </div>
                                        @error('tanggal_buka')
                                            <p class="mt-1 text-[10px] md:text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="tanggal_tutup" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                            Tanggal Tutup <span class="text-red-500">*</span>
                                        </label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                            <input 
                                                type="date" 
                                                name="tanggal_tutup" 
                                                id="tanggal_tutup"
                                                value="{{ old('tanggal_tutup', $periode->tanggal_tutup->format('Y-m-d')) }}"
                                                class="block w-full pl-9 md:pl-10 pr-3 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition text-xs md:text-base"
                                                required
                                            >
                                        </div>
                                        @error('tanggal_tutup')
                                            <p class="mt-1 text-[10px] md:text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="deskripsi" class="block text-xs md:text-sm font-bold text-gray-700 mb-1.5 md:mb-2">
                                        Deskripsi <span class="text-gray-400 font-normal text-[10px] md:text-xs">(Opsional)</span>
                                    </label>
                                    <textarea 
                                        name="deskripsi" 
                                        id="deskripsi"
                                        rows="4"
                                        class="block w-full px-3 md:px-4 py-2.5 md:py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition resize-none text-xs md:text-base"
                                        placeholder="Deskripsi singkat tentang periode pendaftaran ini..."
                                    >{{ old('deskripsi', $periode->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <p class="mt-1 text-[10px] md:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 border-l-4 border-blue-500 rounded-xl p-4 md:p-6 mt-2">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600 mr-2.5 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-bold text-blue-900 mb-1 text-xs md:text-base">Catatan Penting</p>
                                    <p class="text-[10px] md:text-sm text-blue-800 leading-relaxed">
                                        Status aktif/nonaktif periode diatur melalui <strong>toggle switch</strong> (atau tombol aktifkan) di halaman Kelola Periode. 
                                        Edit form ini hanya untuk mengubah nama, tanggal, dan deskripsi.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-between pt-5 md:pt-8 border-t-2 border-gray-200 gap-3 md:gap-0 mt-4">
                            <a href="{{ route('pendaftaran.periode.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center py-2.5 md:py-2 text-gray-600 bg-gray-100 md:bg-transparent rounded-xl md:rounded-none hover:text-gray-900 hover:bg-gray-200 md:hover:bg-transparent font-bold text-xs md:text-sm transition">
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button 
                                type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-6 md:px-8 py-3 md:py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold rounded-xl hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105 active:scale-95 shadow-xl text-xs md:text-base"
                            >
                                <svg class="w-4 h-4 md:w-5 md:h-5 mr-1.5 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Periode
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>