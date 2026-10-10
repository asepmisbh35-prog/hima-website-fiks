<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Sampaikan Aspirasi Anda
        </h2>
    </x-slot>

    <div class="py-6 md:py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-gradient-to-r from-orange-500 to-orange-700 rounded-lg shadow-lg p-6 md:p-8 mb-6 text-white">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2 md:mb-3">💬 Sampaikan Aspirasimu</h2>
                        <p class="text-white/90 text-sm md:text-lg">
                            Suara kamu penting! Kirimkan aspirasi, keluhan, atau saran untuk kemajuan HIMADIKTI
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-2xl flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <p class="ml-3 text-sm md:text-base text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-lg rounded-xl mb-8">
                <div class="p-5 md:p-8">
                    <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-6" data-turbo="false">
                        @csrf

                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Informasi Pengirim
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                <div>
                                    <label for="pengirim_nama" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text" name="pengirim_nama" id="pengirim_nama" value="{{ old('pengirim_nama', auth()->user()->name ?? '') }}" class="block w-full py-2.5 md:py-3 px-3 md:px-4 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" placeholder="Nama Lengkap" required>
                                </div>

                                <div>
                                    <label for="pengirim_email" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">Email <span class="text-red-500">*</span></label>
                                    <input type="email" name="pengirim_email" id="pengirim_email" value="{{ old('pengirim_email', auth()->user()->email ?? '') }}" class="block w-full py-2.5 md:py-3 px-3 md:px-4 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" placeholder="email@example.com" required>
                                </div>
                            </div>

                            <div class="mt-4 md:mt-6">
                                <label for="pengirim_nim" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">NIM <span class="text-gray-400 text-xs">(Opsional)</span></label>
                                <input type="text" name="pengirim_nim" id="pengirim_nim" value="{{ old('pengirim_nim', auth()->user()->nim ?? '') }}" class="block w-full py-2.5 md:py-3 px-3 md:px-4 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition" placeholder="Contoh: 2021001">
                            </div>
                        </div>

                        <div>
                            <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                                Detail Aspirasi
                            </h3>

                            <div class="mb-4 md:mb-6">
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">Kategori <span class="text-red-500">*</span></label>
                                <select name="kategori" id="kategori" class="block w-full py-2.5 md:py-3 px-3 md:px-4 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition bg-white" required>
                                    <option value="">Pilih Kategori Aspirasi</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori }}" {{ old('kategori') == $kategori ? 'selected' : '' }}>{{ $kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="isi_aspirasi" class="block text-sm font-medium text-gray-700 mb-1 md:mb-2">Isi Aspirasi <span class="text-red-500">*</span></label>
                                <textarea name="isi_aspirasi" id="isi_aspirasi" rows="5" md:rows="6" maxlength="1000" class="block w-full px-3 md:px-4 py-2.5 md:py-3 text-sm md:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition resize-none" placeholder="Tulis aspirasi, keluhan, atau saran Anda di sini... (Maksimal 1000 karakter)" required>{{ old('isi_aspirasi') }}</textarea>
                                <div class="mt-2 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                    <p class="text-xs text-gray-500">Sampaikan secara jelas dan sopan</p>
                                    <p class="text-xs md:text-sm text-gray-600 font-medium"><span id="char-count" class="text-orange-600">0</span> / 1000 karakter</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between pt-6 border-t border-gray-200 gap-4">
                            <p class="text-sm text-gray-500 w-full md:w-auto"><span class="text-red-500">*</span> Wajib diisi</p>
                            <button type="submit" class="w-full md:w-auto justify-center inline-flex items-center px-8 py-3 bg-orange-600 text-white font-semibold rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition transform hover:scale-105 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Aspirasi
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @auth
                <div class="mt-10 md:mt-12 mb-6 flex items-center justify-center">
                    <div class="border-t border-gray-300 flex-grow"></div>
                    <h3 class="px-3 md:px-6 text-lg md:text-2xl font-bold text-gray-800 flex items-center text-center whitespace-nowrap">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Riwayat Aspirasi
                    </h3>
                    <div class="border-t border-gray-300 flex-grow"></div>
                </div>

                <div class="space-y-4 md:space-y-6">
                    @forelse($riwayatAspirasi as $item)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition duration-300">
                            <div class="p-5 md:p-6">
                                <div class="flex flex-col md:flex-row md:items-center justify-between mb-4 gap-3 md:gap-4">
                                    <div>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 mb-2 border border-gray-200">
                                            Kategori: {{ $item->kategori }}
                                        </span>
                                        <div class="text-xs md:text-sm text-gray-500">
                                            Dikirim pada {{ $item->created_at->format('d M Y, H:i') }}
                                        </div>
                                    </div>
                                    
                                    <div>
                                        @php
                                            $statusConfig = [
                                                'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'border' => 'border-yellow-200', 'icon' => '⏳'],
                                                'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'border' => 'border-blue-200', 'icon' => '🔄'],
                                                'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'border' => 'border-green-200', 'icon' => '✅'],
                                                'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'border' => 'border-red-200', 'icon' => '❌'],
                                            ];
                                            $config = $statusConfig[$item->status];
                                        @endphp
                                        <span class="inline-flex items-center px-3 md:px-4 py-1.5 md:py-2 rounded-lg text-xs md:text-sm font-bold {{ $config['bg'] }} {{ $config['text'] }} border {{ $config['border'] }}">
                                            <span class="mr-1 md:mr-2">{{ $config['icon'] }}</span>
                                            Status: {{ ucfirst($item->status) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-3 md:p-4 rounded-lg border border-gray-100 mb-4 text-sm md:text-base text-gray-700">
                                    "{{ $item->isi_aspirasi }}"
                                </div>

                                @if($item->tanggapan)
                                    <div class="bg-orange-50 border-l-4 border-orange-500 p-3 md:p-4 rounded-r-lg">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="text-xs md:text-sm font-bold text-orange-800">Tanggapan Pengurus:</h4>
                                            <span class="text-[10px] md:text-xs text-orange-600">{{ $item->tanggal_tanggapan ? \Carbon\Carbon::parse($item->tanggal_tanggapan)->format('d M Y') : '' }}</span>
                                        </div>
                                        <p class="text-orange-900 text-xs md:text-sm whitespace-pre-wrap">{{ $item->tanggapan }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 md:py-10 bg-white rounded-xl shadow-sm border border-gray-100">
                            <svg class="mx-auto h-10 w-10 md:h-12 md:w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum Ada Riwayat</h3>
                            <p class="mt-1 text-xs md:text-sm text-gray-500">Kamu belum pernah mengirimkan aspirasi.</p>
                        </div>
                    @endforelse

                    @if($riwayatAspirasi->hasPages())
                        <div class="mt-4 md:mt-6 overflow-x-auto">
                            {{ $riwayatAspirasi->links() }}
                        </div>
                    @endif
                </div>
            @endauth
            </div>
    </div>

    @push('scripts')
    <script>
        const textarea = document.getElementById('isi_aspirasi');
        const charCount = document.getElementById('char-count');
        
        textarea.addEventListener('input', function() {
            const count = this.value.length;
            charCount.textContent = count;
            
            if (count > 900) {
                charCount.classList.remove('text-orange-600');
                charCount.classList.add('text-red-600');
            } else if (count > 700) {
                charCount.classList.remove('text-orange-600', 'text-red-600');
                charCount.classList.add('text-yellow-600');
            } else {
                charCount.classList.remove('text-yellow-600', 'text-red-600');
                charCount.classList.add('text-orange-600');
            }
        });
        charCount.textContent = textarea.value.length;
    </script>
    @endpush
</x-app-layout>