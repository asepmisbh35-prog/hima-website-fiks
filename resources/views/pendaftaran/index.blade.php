<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-base md:text-xl text-gray-800 leading-tight">
            Pendaftaran Pengurus Muda
        </h2>
    </x-slot>

    <div class="py-4 md:py-12">
        <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="mb-4 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-3 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-800 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 p-3 rounded-lg shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-red-800 text-sm font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($periode)
                <!-- SECTION AKTIF -->
                <div id="section-aktif">
                    <!-- Hero Section -->
                    <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 rounded-xl md:rounded-2xl shadow-xl overflow-hidden mb-5 md:mb-8">
                        <div class="relative px-5 py-7 md:px-12 md:py-16">
                            <!-- Background Pattern -->
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                                            <path d="M0 32V.5H32" fill="none" stroke="white" stroke-width="1"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#grid)"/>
                                </svg>
                            </div>

                            <div class="relative grid grid-cols-1 lg:grid-cols-2 gap-5 md:gap-8 items-center">
                                <!-- Left Content -->
                                <div class="text-white">
                                    <!-- Badge -->
                                    <div class="inline-flex items-center px-3 py-1.5 bg-white/20 backdrop-blur-lg rounded-full text-xs md:text-sm font-semibold mb-4 border border-white/30">
                                        <span class="w-1.5 h-1.5 md:w-2 md:h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                        Pendaftaran Dibuka
                                    </div>

                                    <!-- Judul — lebih kecil di mobile -->
                                    <h1 class="text-2xl md:text-4xl lg:text-5xl font-bold mb-3 leading-tight">
                                        {{ $periode->nama_periode }}
                                    </h1>

                                    @if($periode->deskripsi)
                                        <p class="text-sm md:text-xl text-white/90 mb-4 md:mb-6">
                                            {{ $periode->deskripsi }}
                                        </p>
                                    @else
                                        <p class="text-sm md:text-xl text-white/90 mb-4 md:mb-6">
                                            Bergabunglah dengan keluarga besar HIMADIKTI dan kembangkan potensi dirimu!
                                        </p>
                                    @endif

                                    <!-- Tombol -->
                                    <div class="mb-2 md:mb-8">
                                        @auth
                                            <a href="{{ route('pendaftaran.create') }}" class="inline-flex items-center px-5 py-2.5 md:px-8 md:py-4 bg-white text-primary-700 font-bold text-sm md:text-base rounded-lg md:rounded-xl hover:bg-gray-100 transition transform hover:scale-105 active:scale-95 shadow-xl">
                                                <svg class="w-4 h-4 md:w-6 md:h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Daftar Sekarang
                                                <svg class="w-4 h-4 md:w-5 md:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                </svg>
                                            </a>
                                        @else
                                            <div class="inline-flex items-center px-4 py-2.5 bg-yellow-100/20 backdrop-blur-lg border border-yellow-300/30 rounded-lg">
                                                <svg class="w-4 h-4 text-yellow-300 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-white text-sm">
                                                    Silakan <a href="{{ route('login') }}" class="font-bold underline hover:text-yellow-200">login</a> untuk mendaftar
                                                </span>
                                            </div>
                                        @endauth
                                    </div>
                                </div>

                                <!-- Right Content - Tanggal & Countdown -->
                                <div class="grid grid-cols-2 gap-3 md:gap-4">
                                    <!-- Tanggal Buka -->
                                    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl md:rounded-2xl p-3 md:p-6 hover:bg-white/20 transition">
                                        <div class="text-white/60 text-xs md:text-sm font-medium mb-1">Tanggal Buka</div>
                                        <div class="text-white text-2xl md:text-3xl font-bold mb-0.5">{{ $periode->tanggal_buka->format('d') }}</div>
                                        <div class="text-white/80 text-sm md:text-lg">{{ $periode->tanggal_buka->format('M Y') }}</div>
                                    </div>
                                    <!-- Tanggal Tutup -->
                                    <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-xl md:rounded-2xl p-3 md:p-6 hover:bg-white/20 transition">
                                        <div class="text-white/60 text-xs md:text-sm font-medium mb-1">Tanggal Tutup</div>
                                        <div class="text-white text-2xl md:text-3xl font-bold mb-0.5">{{ $periode->tanggal_tutup->format('d') }}</div>
                                        <div class="text-white/80 text-sm md:text-lg">{{ $periode->tanggal_tutup->format('M Y') }}</div>
                                    </div>

                                    <!-- Countdown -->
                                    <div class="col-span-2 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-lg border border-white/20 rounded-xl md:rounded-2xl p-3 md:p-6 text-center">
                                        <div class="text-white/60 text-xs md:text-sm font-medium mb-2 md:mb-3">Sisa Waktu Pendaftaran</div>
                                        <div class="flex justify-center gap-2 md:gap-4">
                                            <div class="bg-black/20 rounded-lg md:rounded-xl p-2 w-[52px] md:w-[70px] border border-white/10">
                                                <div id="cd-hari" class="text-xl md:text-2xl font-bold text-white">00</div>
                                                <div class="text-[9px] md:text-[10px] text-white/60 uppercase mt-0.5">Hari</div>
                                            </div>
                                            <div class="bg-black/20 rounded-lg md:rounded-xl p-2 w-[52px] md:w-[70px] border border-white/10">
                                                <div id="cd-jam" class="text-xl md:text-2xl font-bold text-white">00</div>
                                                <div class="text-[9px] md:text-[10px] text-white/60 uppercase mt-0.5">Jam</div>
                                            </div>
                                            <div class="bg-black/20 rounded-lg md:rounded-xl p-2 w-[52px] md:w-[70px] border border-white/10">
                                                <div id="cd-menit" class="text-xl md:text-2xl font-bold text-white">00</div>
                                                <div class="text-[9px] md:text-[10px] text-white/60 uppercase mt-0.5">Menit</div>
                                            </div>
                                            <div class="bg-black/20 rounded-lg md:rounded-xl p-2 w-[52px] md:w-[70px] border border-white/10">
                                                <div id="cd-detik" class="text-xl md:text-2xl font-bold text-orange-400">00</div>
                                                <div class="text-[9px] md:text-[10px] text-orange-400/80 uppercase mt-0.5">Detik</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECTION TUTUP (hidden, muncul saat countdown habis) -->
                <div id="section-tutup" class="hidden">
                    <div class="bg-gradient-to-br from-primary-300 via-primary-500 to-primary-700 rounded-xl md:rounded-2xl shadow-xl overflow-hidden mb-5 md:mb-8">
                        <div class="p-8 md:p-16 text-center">
                            <div class="inline-flex items-center justify-center w-14 h-14 md:w-20 md:h-20 bg-gray-100 rounded-full mb-4 md:mb-6">
                                <svg class="w-7 h-7 md:w-10 md:h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl md:text-2xl font-bold text-primary-50 mb-2 md:mb-3">Pendaftaran Telah Berakhir</h3>
                            <p class="text-white/80 text-sm md:text-lg max-w-md mx-auto">
                                Mohon maaf, waktu pendaftaran untuk periode ini telah ditutup. Silakan cek kembali nanti atau hubungi pengurus HIMA.
                            </p>
                        </div>
                    </div>
                </div>

            @else
                <!-- SECTION TIDAK ADA PERIODE AKTIF -->
                <div class="bg-white rounded-xl md:rounded-2xl shadow-lg overflow-hidden mb-5 md:mb-8">
                    <div class="p-8 md:p-16 text-center">
                        <div class="inline-flex items-center justify-center w-14 h-14 md:w-20 md:h-20 bg-gray-100 rounded-full mb-4 md:mb-6">
                            <svg class="w-7 h-7 md:w-10 md:h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-2xl font-bold text-gray-900 mb-2 md:mb-3">Pendaftaran Sedang Ditutup</h3>
                        <p class="text-gray-600 text-sm md:text-lg max-w-md mx-auto">
                            Saat ini tidak ada periode pendaftaran yang aktif. Silakan cek kembali nanti atau hubungi pengurus HIMA.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Requirements Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mt-4 md:mt-8">
                <!-- Syarat & Ketentuan -->
                <div class="lg:col-span-2 bg-white rounded-xl md:rounded-2xl shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-4 md:px-6 py-3 md:py-4">
                        <h3 class="text-base md:text-xl font-bold text-white flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Syarat & Ketentuan
                        </h3>
                    </div>
                    <div class="p-4 md:p-6">
                        <div class="space-y-3 md:space-y-4">
                            @foreach([
                                ['title' => 'Mahasiswa Aktif PTI', 'desc' => 'Terdaftar sebagai mahasiswa aktif Program Studi Pendidikan Teknologi Informasi'],
                                ['title' => 'Sudah Melaksanakan POLKM', 'desc' => 'Telah Mengikuti POLKM dan memiliki Sertifikat POLKM'],
                                ['title' => 'Upload CV', 'desc' => 'Menyiapkan CV dalam format PDF dengan ukuran maksimal 2MB'],
                                ['title' => 'Motivasi', 'desc' => 'Menulis motivasi bergabung (maksimal 500 karakter)'],
                            ] as $syarat)
                            <div class="flex items-start group">
                                <div class="flex-shrink-0 w-8 h-8 md:w-10 md:h-10 bg-green-100 rounded-lg md:rounded-xl flex items-center justify-center mr-3 md:mr-4 group-hover:bg-green-200 transition">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-900 text-sm md:text-base mb-0.5">{{ $syarat['title'] }}</h4>
                                    <p class="text-gray-500 text-xs md:text-sm">{{ $syarat['desc'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Info Cards -->
                <div class="space-y-4 md:space-y-6">
                    <!-- Contact -->
                    <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl md:rounded-2xl shadow-md p-4 md:p-6 text-white">
                        <div class="flex items-center mb-3 md:mb-4">
                            <div class="w-9 h-9 md:w-12 md:h-12 bg-white/20 rounded-lg md:rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-sm md:text-lg">Butuh Bantuan?</h4>
                                <p class="text-white/80 text-xs md:text-sm">Hubungi kami</p>
                            </div>
                        </div>
                        <div class="space-y-1.5 md:space-y-2 text-xs md:text-sm">
                            <p class="flex items-center">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                hima.pti@univ.ac.id
                            </p>
                            <p class="flex items-center">
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                +62 812-3456-7890
                            </p>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-white rounded-xl md:rounded-2xl shadow-md p-4 md:p-6">
                        <h4 class="font-bold text-gray-900 text-sm md:text-base mb-3 flex items-center">
                            <svg class="w-4 h-4 md:w-5 md:h-5 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            Tips Pendaftaran
                        </h4>
                        <ul class="space-y-1.5 md:space-y-2 text-xs md:text-sm text-gray-600">
                            <li class="flex items-start">
                                <span class="text-primary-600 mr-2 font-bold">•</span>
                                Siapkan CV yang menarik
                            </li>
                            <li class="flex items-start">
                                <span class="text-primary-600 mr-2 font-bold">•</span>
                                Tulis motivasi dengan jujur
                            </li>
                            <li class="flex items-start">
                                <span class="text-primary-600 mr-2 font-bold">•</span>
                                Cek kembali data sebelum submit
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Countdown Script -->
    @if($periode)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tanggalTutupStr = "{{ $periode->tanggal_tutup->format('Y-m-d') }} 23:59:59";
            var countDownDate = new Date(tanggalTutupStr.replace(/-/g, '/')).getTime();

            var timer = setInterval(function() {
                var now = new Date().getTime();
                var distance = countDownDate - now;

                if (distance < 0) {
                    clearInterval(timer);
                    var sectionAktif = document.getElementById("section-aktif");
                    if (sectionAktif) sectionAktif.classList.add("hidden");
                    var sectionTutup = document.getElementById("section-tutup");
                    if (sectionTutup) sectionTutup.classList.remove("hidden");
                    return;
                }

                var hari  = Math.floor(distance / (1000 * 60 * 60 * 24));
                var jam   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var menit = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var detik = Math.floor((distance % (1000 * 60)) / 1000);

                if(document.getElementById("cd-hari"))  document.getElementById("cd-hari").innerText  = hari.toString().padStart(2, '0');
                if(document.getElementById("cd-jam"))   document.getElementById("cd-jam").innerText   = jam.toString().padStart(2, '0');
                if(document.getElementById("cd-menit")) document.getElementById("cd-menit").innerText = menit.toString().padStart(2, '0');
                if(document.getElementById("cd-detik")) document.getElementById("cd-detik").innerText = detik.toString().padStart(2, '0');
            }, 1000);
        });
    </script>
    @endif
</x-app-layout>