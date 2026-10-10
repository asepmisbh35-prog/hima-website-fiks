<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 md:space-y-6">
            
            <div class="bg-gradient-to-r from-secondary-50 to-secondary-100 rounded-2xl md:rounded-lg shadow-sm md:shadow-lg p-5 md:p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg md:text-2xl font-bold mb-1 md:mb-2 leading-tight">Selamat Datang, {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-white/90 text-sm md:text-base">
                            Role: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</span>
                        </p>
                        <p class="text-white/80 text-xs md:text-sm mt-1.5 md:mt-1">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
                    </div>
                    <div class="hidden md:block flex-shrink-0">
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-lg rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->isPengurus())
            
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 md:gap-6">
                
                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6 hover:shadow-lg transition">
                    <div class="flex items-start md:items-center justify-between">
                        <div class="min-w-0 pr-2">
                            <p class="text-[11px] md:text-sm text-gray-600 mb-0.5 md:mb-1 truncate">Total Aspirasi</p>
                            <p class="text-xl md:text-3xl font-bold text-gray-900 leading-none">{{ \App\Models\Aspirasi::count() }}</p>
                            <p class="text-[10px] md:text-xs text-yellow-600 mt-1.5 md:mt-2 truncate">
                                {{ \App\Models\Aspirasi::where('status', 'menunggu')->count() }} Menunggu
                            </p>
                        </div>
                        <div class="bg-yellow-100 rounded-lg md:rounded-full p-2 md:p-4 flex-shrink-0">
                            <svg class="w-5 h-5 md:w-8 md:h-8 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('aspirasi.dashboard') }}" class="mt-3 md:mt-4 block text-[11px] md:text-sm text-primary-600 hover:text-primary-700 font-bold md:font-medium">
                        Lihat Detail →
                    </a>
                </div>

                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6 hover:shadow-lg transition">
                    <div class="flex items-start md:items-center justify-between">
                        <div class="min-w-0 pr-2">
                            <p class="text-[11px] md:text-sm text-gray-600 mb-0.5 md:mb-1 truncate">Pendaftaran</p>
                            <p class="text-xl md:text-3xl font-bold text-gray-900 leading-none">{{ \App\Models\PendaftaranPengurus::count() }}</p>
                            <p class="text-[10px] md:text-xs text-blue-600 mt-1.5 md:mt-2 truncate">
                                {{ \App\Models\PendaftaranPengurus::where('status', 'menunggu')->count() }} Menunggu
                            </p>
                        </div>
                        <div class="bg-blue-100 rounded-lg md:rounded-full p-2 md:p-4 flex-shrink-0">
                            <svg class="w-5 h-5 md:w-8 md:h-8 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('pendaftaran.dashboard') }}" class="mt-3 md:mt-4 block text-[11px] md:text-sm text-primary-600 hover:text-primary-700 font-bold md:font-medium">
                        Lihat Detail →
                    </a>
                </div>

                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6 hover:shadow-lg transition">
                    <div class="flex items-start md:items-center justify-between">
                        <div class="min-w-0 pr-2">
                            <p class="text-[11px] md:text-sm text-gray-600 mb-0.5 md:mb-1 truncate">Agenda</p>
                            <p class="text-xl md:text-3xl font-bold text-gray-900 leading-none">{{ \App\Models\AgendaKegiatan::count() }}</p>
                            <p class="text-[10px] md:text-xs text-green-600 mt-1.5 md:mt-2 truncate">
                                {{ \App\Models\AgendaKegiatan::where('tanggal_mulai', '>=', now())->count() }} Mendatang
                            </p>
                        </div>
                        <div class="bg-green-100 rounded-lg md:rounded-full p-2 md:p-4 flex-shrink-0">
                            <svg class="w-5 h-5 md:w-8 h-8 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('agenda.index') }}" class="mt-3 md:mt-4 block text-[11px] md:text-sm text-primary-600 hover:text-primary-700 font-bold md:font-medium">
                        Lihat Detail →
                    </a>
                </div>

                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6 hover:shadow-lg transition">
                    <div class="flex items-start md:items-center justify-between">
                        <div class="min-w-0 pr-2">
                            <p class="text-[11px] md:text-sm text-gray-600 mb-0.5 md:mb-1 truncate">Program Kerja</p>
                            <p class="text-xl md:text-3xl font-bold text-gray-900 leading-none">{{ \App\Models\Proker::count() }}</p>
                            <p class="text-[10px] md:text-xs text-purple-600 mt-1.5 md:mt-2 truncate">
                                {{ \App\Models\Proker::where('status', 'berjalan')->count() }} Berjalan
                            </p>
                        </div>
                        <div class="bg-purple-100 rounded-lg md:rounded-full p-2 md:p-4 flex-shrink-0">
                            <svg class="w-5 h-5 md:w-8 md:h-8 text-purple-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                    <a href="{{ route('proker.index') }}" class="mt-3 md:mt-4 block text-[11px] md:text-sm text-primary-600 hover:text-primary-700 font-bold md:font-medium">
                        Lihat Detail →
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 md:gap-6">
                
                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base md:text-lg font-semibold text-gray-900">Aspirasi Terbaru</h3>
                        <a href="{{ route('aspirasi.dashboard') }}" class="text-xs md:text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse(\App\Models\Aspirasi::latest()->take(5)->get() as $aspirasi)
                            <div class="flex items-start space-x-3 p-2 md:p-3 hover:bg-gray-50 rounded-lg transition">
                                <div class="flex-shrink-0 mt-0.5">
                                    @php
                                        $statusColors = [
                                            'menunggu' => 'bg-yellow-100 text-yellow-800',
                                            'diproses' => 'bg-blue-100 text-blue-800',
                                            'selesai'  => 'bg-green-100 text-green-800',
                                            'ditolak'  => 'bg-red-100 text-red-800',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-[10px] md:text-xs font-semibold rounded-lg md:rounded-full {{ $statusColors[$aspirasi->status] }} flex-shrink-0 block text-center min-w-[70px]">
                                        {{ ucfirst($aspirasi->status) }}
                                    </span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold md:font-medium text-gray-900 truncate">{{ $aspirasi->pengirim_nama }}</p>
                                    <p class="text-[11px] md:text-xs text-gray-500 truncate mt-0.5 md:mt-0">{{ Str::limit($aspirasi->isi_aspirasi, 50) }}</p>
                                    <p class="text-[10px] md:text-xs text-gray-400 mt-1">{{ $aspirasi->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 py-6 bg-gray-50 rounded-lg border border-dashed">Belum ada aspirasi</p>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-base md:text-lg font-semibold text-gray-900">Agenda Mendatang</h3>
                        <a href="{{ route('agenda.index') }}" class="text-xs md:text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @forelse(\App\Models\AgendaKegiatan::where('tanggal_mulai', '>=', now())->orderBy('tanggal_mulai')->take(5)->get() as $agenda)
                            <div class="flex items-start space-x-3 p-2 md:p-3 hover:bg-gray-50 rounded-lg transition border border-gray-50 md:border-transparent">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 md:w-12 md:h-12 bg-primary-50 md:bg-primary-100 rounded-lg flex flex-col items-center justify-center border border-primary-100 md:border-transparent">
                                        <span class="text-[10px] md:text-xs text-primary-600 font-semibold leading-tight">{{ $agenda->tanggal_mulai->format('M') }}</span>
                                        <span class="text-sm md:text-lg text-primary-700 font-bold leading-tight">{{ $agenda->tanggal_mulai->format('d') }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold md:font-medium text-gray-900 truncate">{{ $agenda->nama_kegiatan }}</p>
                                    <p class="text-[11px] md:text-xs text-gray-500 mt-0.5 md:mt-0 truncate">{{ $agenda->divisi }}</p>
                                    <div class="flex items-center mt-1">
                                        <svg class="w-3 h-3 md:w-3.5 md:h-3.5 text-gray-400 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        <p class="text-[10px] md:text-xs text-gray-400 truncate">{{ $agenda->lokasi }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-sm text-gray-500 py-6 bg-gray-50 rounded-lg border border-dashed">Belum ada agenda</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-semibold text-gray-900">Progress Program Kerja</h3>
                    <a href="{{ route('proker.index') }}" class="text-xs md:text-sm text-primary-600 hover:text-primary-700 font-medium">Lihat Semua</a>
                </div>
                <div class="space-y-4">
                    @forelse(\App\Models\Proker::where('status', '!=', 'dibatalkan')->latest()->take(5)->get() as $proker)
                        <div class="border-b border-gray-100 md:border-gray-200 pb-4 last:border-0 last:pb-0">
                            <div class="flex items-end justify-between mb-2">
                                <div class="flex-1 pr-4">
                                    <h4 class="text-sm font-bold md:font-medium text-gray-900 leading-tight mb-0.5 md:mb-0">{{ $proker->nama_proker }}</h4>
                                    <p class="text-[11px] md:text-xs text-gray-500">{{ $proker->divisi }}</p>
                                </div>
                                <span class="text-sm font-bold md:font-semibold {{ $proker->progress_persen == 100 ? 'text-green-600' : 'text-primary-600' }} flex-shrink-0">
                                    {{ $proker->progress_persen }}%
                                </span>
                            </div>
                            <div class="w-full bg-gray-100 md:bg-gray-200 rounded-full h-2 shadow-inner md:shadow-none">
                                <div 
                                    class="h-2 rounded-full transition-all duration-500 ease-out {{ $proker->progress_persen == 100 ? 'bg-green-500 md:bg-green-600' : 'bg-primary-500 md:bg-primary-600' }}" 
                                    style="width: <?= $proker->progress_persen ?>%"
                                ></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-sm text-gray-500 py-6 bg-gray-50 rounded-lg border border-dashed">Belum ada program kerja</p>
                    @endforelse
                </div>
            </div>

            @endif

            @if(!auth()->user()->isPengurus())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                
                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('aspirasi.create') }}" class="flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-xl md:rounded-lg transition active:scale-95 border border-yellow-100 md:border-transparent">
                            <div class="w-10 h-10 bg-yellow-200 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-5 h-5 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold md:font-medium text-gray-900">Kirim Aspirasi</p>
                                <p class="text-[11px] md:text-xs text-gray-500 mt-0.5 md:mt-0">Sampaikan aspirasi Anda</p>
                            </div>
                        </a>

                        <a href="{{ route('agenda.index') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-xl md:rounded-lg transition active:scale-95 border border-green-100 md:border-transparent">
                            <div class="w-10 h-10 bg-green-200 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-5 h-5 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold md:font-medium text-gray-900">Lihat Agenda</p>
                                <p class="text-[11px] md:text-xs text-gray-500 mt-0.5 md:mt-0">Cek kegiatan HIMA</p>
                            </div>
                        </a>

                        <a href="{{ route('pendaftaran.index') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-xl md:rounded-lg transition active:scale-95 border border-blue-100 md:border-transparent">
                            <div class="w-10 h-10 bg-blue-200 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold md:font-medium text-gray-900">Daftar Pengurus</p>
                                <p class="text-[11px] md:text-xs text-gray-500 mt-0.5 md:mt-0">Bergabung dengan HIMA</p>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                    <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-3 md:mb-4">Tentang HIMADIKTI</h3>
                    <p class="text-[13px] md:text-sm text-gray-600 mb-4 leading-relaxed">
                        Himpunan Mahasiswa Pendidikan Teknologi Informasi adalah organisasi mahasiswa yang bergerak dalam bidang akademik, soft skill, dan pengembangan diri.
                    </p>
                    <div class="space-y-2.5 md:space-y-2">
                        <div class="flex items-center text-xs md:text-sm text-gray-600 font-medium md:font-normal">
                            <svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Pengembangan Akademik
                        </div>
                        <div class="flex items-center text-xs md:text-sm text-gray-600 font-medium md:font-normal">
                            <svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Soft Skill Training
                        </div>
                        <div class="flex items-center text-xs md:text-sm text-gray-600 font-medium md:font-normal">
                            <svg class="w-4 h-4 mr-2 text-primary-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Networking & Community
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6 mt-4 md:mt-0">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base md:text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-orange-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                        Riwayat Aspirasi
                    </h3>
                    <a href="{{ route('aspirasi.create') }}" class="text-[10px] md:text-xs font-semibold text-orange-600 hover:text-orange-700 bg-orange-50 px-2.5 py-1.5 md:px-3 md:py-1 rounded-lg md:rounded-full transition active:scale-95 shadow-sm md:shadow-none">
                        + Buat Baru
                    </a>
                </div>
                
                <div class="space-y-3 md:space-y-4">
                    @forelse($riwayatAspirasi ?? [] as $aspirasi)
                        <div class="border border-gray-100 rounded-xl p-3 md:p-4 hover:shadow-sm transition">
                            <div class="flex justify-between items-start gap-3 mb-2">
                                <span class="text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wider">{{ $aspirasi->kategori }}</span>
                                @php
                                    $statusConfig = [
                                        'menunggu' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800'],
                                        'diproses' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800'],
                                        'selesai' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
                                        'ditolak' => ['bg' => 'bg-red-100', 'text' => 'text-red-800'],
                                    ];
                                    $cfg = $statusConfig[$aspirasi->status];
                                @endphp
                                <span class="flex-shrink-0 px-2 py-1 rounded-lg md:rounded-md text-[10px] font-bold {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                    {{ ucfirst($aspirasi->status) }}
                                </span>
                            </div>
                            <p class="text-xs md:text-sm text-gray-800 line-clamp-2 mb-2">"{{ $aspirasi->isi_aspirasi }}"</p>
                            
                            @if($aspirasi->tanggapan)
                                <div class="bg-orange-50/50 border-l-2 border-orange-400 p-2 mt-2 rounded-r-md">
                                    <p class="text-[10px] md:text-[11px] font-semibold text-orange-800 mb-0.5 md:mb-1">Tanggapan Pengurus:</p>
                                    <p class="text-[11px] md:text-xs text-orange-900 line-clamp-2">{{ $aspirasi->tanggapan }}</p>
                                </div>
                            @endif
                            <div class="mt-2 text-[9px] md:text-[10px] font-medium text-gray-400 text-right">
                                {{ $aspirasi->created_at->format('d M Y') }}
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-6 md:py-8 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                            <p class="text-xs md:text-sm text-gray-500">Belum ada aspirasi yang dikirim.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @php
                $riwayatPendaftaran = \App\Models\PendaftaranPengurus::where('user_id', auth()->id())
                    ->with('periode')
                    ->latest()
                    ->get();
            @endphp

            @if($riwayatPendaftaran->count() > 0)
            <div class="mt-4 md:mt-6 bg-white rounded-xl md:rounded-lg shadow-sm md:shadow-md p-4 md:p-6">
                <h3 class="text-base md:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-primary-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    Riwayat Pendaftaran Saya
                </h3>
                <div class="space-y-4">
                    @foreach($riwayatPendaftaran as $daftar)
                        @php
                            $statusConfig = [
                                'menunggu' => ['bg' => 'bg-yellow-50', 'border' => 'border-yellow-400', 'badge' => 'bg-yellow-100 text-yellow-800', 'icon' => '⏳'],
                                'diterima' => ['bg' => 'bg-green-50',  'border' => 'border-green-400',  'badge' => 'bg-green-100 text-green-800',   'icon' => '✅'],
                                'ditolak'  => ['bg' => 'bg-red-50',    'border' => 'border-red-400',    'badge' => 'bg-red-100 text-red-800',       'icon' => '❌'],
                            ];
                            $cfg = $statusConfig[$daftar->status];
                        @endphp
                        <div class="rounded-xl md:rounded-lg border-l-4 {{ $cfg['border'] }} {{ $cfg['bg'] }} p-4 md:p-5">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 w-full">
                                    <div class="flex justify-between items-start gap-3 mb-3 md:mb-2">
                                        <div class="flex items-center gap-2 md:gap-3">
                                            <span class="text-lg md:text-xl flex-shrink-0">{{ $cfg['icon'] }}</span>
                                            <h4 class="font-bold md:font-semibold text-gray-900 text-sm md:text-base leading-tight">{{ $daftar->periode->nama_periode }}</h4>
                                        </div>
                                        <span class="flex-shrink-0 px-2.5 md:px-3 py-1 rounded-lg md:rounded-full text-[10px] md:text-xs font-bold {{ $cfg['badge'] }}">
                                            {{ ucfirst($daftar->status) }}
                                        </span>
                                    </div>
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 text-[11px] md:text-sm text-gray-600 mb-3 bg-white/50 md:bg-transparent p-2 md:p-0 rounded-lg md:rounded-none">
                                        <div>
                                            <span class="text-[10px] md:text-xs font-bold md:font-medium text-gray-400 block mb-0.5">Kode</span>
                                            <span class="font-mono font-bold md:font-semibold text-gray-800">{{ $daftar->kode_pendaftaran }}</span>
                                        </div>
                                        <div>
                                            <span class="text-[10px] md:text-xs font-bold md:font-medium text-gray-400 block mb-0.5">Tanggal Daftar</span>
                                            <span class="font-semibold md:font-normal">{{ $daftar->created_at->format('d M Y') }}</span>
                                        </div>
                                        <div class="col-span-2 md:col-span-1">
                                            <span class="text-[10px] md:text-xs font-bold md:font-medium text-gray-400 block mb-0.5">NIM</span>
                                            <span class="font-semibold md:font-normal">{{ $daftar->nim }}</span>
                                        </div>
                                    </div>

                                    @if($daftar->catatan)
                                        <div class="bg-white/80 rounded-lg p-3 border border-gray-200 mt-3 md:mt-0 mb-3 md:mb-0">
                                            <span class="text-[10px] md:text-xs font-bold md:font-semibold text-gray-500 block mb-1">📝 Catatan Pengurus:</span>
                                            <p class="text-xs md:text-sm text-gray-700 leading-relaxed">{{ $daftar->catatan }}</p>
                                        </div>
                                    @endif

                                    <div class="mt-4 md:mt-3">
                                        @if($daftar->status === 'diterima')
                                            <div class="w-full md:w-auto text-center inline-flex justify-center items-center px-4 py-2.5 md:py-1.5 bg-green-600 text-white text-xs md:text-sm font-bold md:font-semibold rounded-xl md:rounded-lg shadow-sm md:shadow-none">
                                                🎉 Selamat! Anda diterima
                                            </div>
                                        @elseif($daftar->status === 'ditolak')
                                            <a href="{{ route('pendaftaran.index') }}" class="w-full md:w-auto text-center inline-flex justify-center items-center px-4 py-2.5 md:py-1.5 bg-primary-600 text-white text-xs md:text-sm font-bold md:font-semibold rounded-xl md:rounded-lg hover:bg-primary-700 active:scale-95 transition shadow-sm md:shadow-none">
                                                🔄 Coba di Periode Berikutnya
                                            </a>
                                        @elseif($daftar->status === 'menunggu')
                                            <div class="w-full md:w-auto text-center inline-flex justify-center items-center px-4 py-2.5 md:py-1.5 bg-yellow-100 text-yellow-800 text-xs md:text-sm font-bold md:font-semibold rounded-xl md:rounded-lg">
                                                ⏳ Sedang direview pengurus
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="h-8 md:hidden"></div>
        </div>
    </div>
</x-app-layout>