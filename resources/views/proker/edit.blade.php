<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Program Kerja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-2xl shadow-xl p-5 md:p-8 mb-6 md:mb-8 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl md:text-3xl font-bold mb-1 md:mb-2 leading-tight">{{ $proker->nama_proker }}</h2>
                        <p class="text-white/90 text-sm md:text-base mb-4">{{ $proker->divisi }}</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 md:gap-4 mt-4 md:mt-6">
                            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-4">
                                <p class="text-white/70 text-xs md:text-sm mb-1">Total Anggaran</p>
                                <p class="text-xl md:text-2xl font-bold">{{ $proker->formatRupiah($proker->anggaran) }}</p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-4">
                                <p class="text-white/70 text-xs md:text-sm mb-1">Anggaran Terpakai</p>
                                <p class="text-xl md:text-2xl font-bold text-orange-300">{{ $proker->formatRupiah($proker->anggaran_terpakai) }}</p>
                                <p class="text-[10px] md:text-xs text-white/60 mt-1">
                                    {{ number_format(($proker->anggaran > 0 ? ($proker->anggaran_terpakai / $proker->anggaran * 100) : 0), 1) }}%
                                </p>
                            </div>
                            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl p-4">
                                <p class="text-white/70 text-xs md:text-sm mb-1">Sisa Anggaran</p>
                                <p class="text-xl md:text-2xl font-bold {{ $proker->sisa_anggaran >= 0 ? 'text-green-300' : 'text-red-300' }}">
                                    {{ $proker->formatRupiah($proker->sisa_anggaran) }}
                                </p>
                                @if($proker->sisa_anggaran < 0)
                                    <p class="text-[10px] md:text-xs text-red-300 mt-1">⚠️ Over budget!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($proker->sisa_anggaran < 0)
                <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4 md:p-6 mb-6 md:mb-8">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <h4 class="font-bold text-red-900 text-sm md:text-base mb-1">⚠️ Anggaran Melebihi Budget!</h4>
                            <p class="text-xs md:text-sm text-red-700">
                                Total anggaran terpakai ({{ $proker->formatRupiah($proker->anggaran_terpakai) }}) 
                                melebihi budget yang direncanakan ({{ $proker->formatRupiah($proker->anggaran) }}).
                                Harap lakukan evaluasi atau penyesuaian anggaran.
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl rounded-2xl">
                <div class="p-5 md:p-10">
                    
                    @if($errors->any())
                        <div class="mb-6 md:mb-8 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4 md:p-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 md:w-6 md:h-6 text-red-500 mr-2 md:mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-semibold text-red-900 text-sm md:text-base mb-2">Terdapat kesalahan:</p>
                                    <ul class="list-disc list-inside text-xs md:text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('proker.update', $proker) }}" method="POST" class="space-y-6 md:space-y-8" data-turbo="false">
                        @csrf
                        @method('PATCH')

                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-purple-200">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Informasi Dasar
                            </h3>

                            <div class="space-y-4 md:space-y-6">
                                <div>
                                    <label for="nama_proker" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Nama Program Kerja <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="nama_proker" 
                                        id="nama_proker"
                                        value="{{ old('nama_proker', $proker->nama_proker) }}"
                                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                        required
                                    >
                                </div>

                                <div>
                                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea 
                                        name="deskripsi" 
                                        id="deskripsi"
                                        rows="5"
                                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition resize-none"
                                        required
                                    >{{ old('deskripsi', $proker->deskripsi) }}</textarea>
                                </div>

                                <div>
                                    <label for="divisi" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Divisi Penanggung Jawab <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        name="divisi" 
                                        id="divisi"
                                        value="{{ old('divisi', $proker->divisi) }}"
                                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
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
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <div>
                                        <label for="tanggal_mulai" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                            Tanggal Mulai <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            name="tanggal_mulai" 
                                            id="tanggal_mulai"
                                            value="{{ old('tanggal_mulai', $proker->tanggal_mulai->format('Y-m-d')) }}"
                                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                            required
                                        >
                                    </div>

                                    <div>
                                        <label for="tanggal_selesai" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                            Tanggal Selesai <span class="text-red-500">*</span>
                                        </label>
                                        <input 
                                            type="date" 
                                            name="tanggal_selesai" 
                                            id="tanggal_selesai"
                                            value="{{ old('tanggal_selesai', $proker->tanggal_selesai->format('Y-m-d')) }}"
                                            class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-transparent transition"
                                            required
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-green-200">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Anggaran
                            </h3>

                            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 md:p-6 mb-4 md:mb-6 border border-green-200">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-4 text-center">
                                    <div>
                                        <p class="text-[11px] md:text-xs text-green-700 font-medium mb-0.5 md:mb-1">Total Budget</p>
                                        <p class="text-lg md:text-xl font-bold text-green-900">{{ $proker->formatRupiah($proker->anggaran) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] md:text-xs text-orange-700 font-medium mb-0.5 md:mb-1">Terpakai (dari Monitoring)</p>
                                        <p class="text-lg md:text-xl font-bold text-orange-900">{{ $proker->formatRupiah($proker->anggaran_terpakai) }}</p>
                                    </div>
                                    <div class="pt-2 md:pt-0 border-t border-green-200 md:border-t-0">
                                        <p class="text-[11px] md:text-xs font-medium mb-0.5 md:mb-1 {{ $proker->sisa_anggaran >= 0 ? 'text-green-700' : 'text-red-700' }}">
                                            Sisa Anggaran
                                        </p>
                                        <p class="text-lg md:text-xl font-bold {{ $proker->sisa_anggaran >= 0 ? 'text-green-900' : 'text-red-900' }}">
                                            {{ $proker->formatRupiah($proker->sisa_anggaran) }}
                                        </p>
                                    </div>
                                </div>
                                
                                @php
                                    $persenTerpakai = $proker->anggaran > 0 ? ($proker->anggaran_terpakai / $proker->anggaran * 100) : 0;
                                @endphp
                                <div class="mt-4">
                                    <div class="flex justify-between text-[11px] md:text-xs text-gray-600 mb-1">
                                        <span>Penggunaan Budget</span>
                                        <span class="font-semibold">{{ number_format($persenTerpakai, 1) }}%</span>
                                    </div>
                                    <div class="w-full bg-green-200 rounded-full h-2.5 md:h-3">
                                        <div class="h-2.5 md:h-3 rounded-full transition-all {{ $persenTerpakai > 100 ? 'bg-red-600' : ($persenTerpakai > 80 ? 'bg-yellow-500' : 'bg-green-600') }}" 
                                             style="width: {{ min($persenTerpakai, 100) }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="anggaran" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Total Anggaran (Rp) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-semibold text-sm md:text-base">Rp</span>
                                    <input 
                                        type="number" 
                                        name="anggaran" 
                                        id="anggaran"
                                        value="{{ old('anggaran', $proker->anggaran) }}"
                                        class="w-full pl-12 pr-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                        min="0"
                                        step="1000"
                                        required
                                    >
                                </div>
                                <p class="mt-1.5 text-[11px] md:text-xs text-gray-500">
                                    💡 Anggaran terpakai akan dihitung otomatis dari laporan monitoring
                                </p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-4 md:mb-6 flex items-center pb-2 md:pb-3 border-b-2 border-blue-200">
                                <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                                Progress & Status
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="progress_persen" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Progress (%) <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        name="progress_persen" 
                                        id="progress_persen"
                                        value="{{ old('progress_persen', $proker->progress_persen) }}"
                                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                        min="0"
                                        max="100"
                                        required
                                        oninput="updateProgressBar(this.value)"
                                    >
                                    <div class="mt-3 w-full bg-gray-200 rounded-full h-2.5 md:h-3">
                                        <div 
                                            id="progress-bar"
                                            class="h-2.5 md:h-3 rounded-full transition-all" 
                                            style="width: {{ $proker->progress_persen }}%; background-color: {{ $proker->progress_persen == 100 ? '#10b981' : '#3b82f6' }}"
                                        ></div>
                                    </div>
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select 
                                        name="status" 
                                        id="status"
                                        class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                        required
                                    >
                                        <option value="perencanaan" {{ old('status', $proker->status) == 'perencanaan' ? 'selected' : '' }}>📋 Perencanaan</option>
                                        <option value="berjalan" {{ old('status', $proker->status) == 'berjalan' ? 'selected' : '' }}>🚀 Sedang Berjalan</option>
                                        <option value="selesai" {{ old('status', $proker->status) == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                        <option value="dibatalkan" {{ old('status', $proker->status) == 'dibatalkan' ? 'selected' : '' }}>❌ Dibatalkan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-6">
                                <label for="catatan_progress" class="block text-sm font-semibold text-gray-700 mb-1.5 md:mb-2">
                                    Catatan Progress
                                </label>
                                <textarea 
                                    name="catatan_progress" 
                                    id="catatan_progress"
                                    rows="4"
                                    class="w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition resize-none"
                                    placeholder="Catatan tambahan tentang progress atau kendala yang dihadapi..."
                                >{{ old('catatan_progress', $proker->catatan_progress) }}</textarea>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse md:flex-row items-center justify-between pt-6 md:pt-8 border-t-2 border-gray-200 gap-3 md:gap-0">
                            <a href="{{ route('proker.show', $proker) }}" class="w-full md:w-auto inline-flex justify-center items-center px-4 py-3 md:py-2 text-gray-600 hover:text-gray-900 bg-gray-100 md:bg-transparent rounded-xl md:rounded-none font-semibold md:font-medium text-sm md:text-base transition">
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Batal
                            </a>
                            <button 
                                type="submit"
                                class="w-full md:w-auto inline-flex justify-center items-center px-6 py-3.5 md:py-4 bg-gradient-to-r from-purple-600 to-purple-700 text-white font-bold text-sm md:text-base rounded-xl hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition transform hover:scale-105 active:scale-95 shadow-xl md:shadow-lg"
                            >
                                <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Program Kerja
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="h-8 md:hidden"></div>
        </div>
    </div>

    <script>
        function updateProgressBar(value) {
            const bar = document.getElementById('progress-bar');
            bar.style.width = value + '%';
            
            if (value == 100) {
                bar.style.backgroundColor = '#10b981'; // green
            } else {
                bar.style.backgroundColor = '#3b82f6'; // blue
            }
        }
    </script>
</x-app-layout>