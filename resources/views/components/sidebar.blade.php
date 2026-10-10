<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans antialiased" x-data="{ sidebarOpen: false }">
    
    <div class="flex h-full bg-gray-100">
        
        <!-- Sidebar Overlay Mobile -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden"></div>

        <!-- Sidebar - FULL HEIGHT -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" 
               class="fixed lg:relative inset-y-0 left-0 z-50 w-64 flex flex-col bg-white border-r border-gray-200 transform transition-transform duration-300">
            
            <!-- Logo -->
           <div class="flex items-center justify-between h-16 px-6 border-b border-gray-200 flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                <!-- Logo Image -->
                <img 
                    src="{{ asset('images/himadikti.png') }}" 
                    alt="HIMADIKTI Logo" 
                    class="h-10 w-auto"
                >
                <!-- Text (Opsional, bisa dihapus kalau cuma mau logo) -->
                <span class="text-xl font-bold text-primary-600">HIMADIKTI</span>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

            <!-- User Info -->
            <div class="px-6 py-4 border-b border-gray-200 flex-shrink-0 bg-gradient-to-r from-gray-50 to-white">
            <div class="flex items-center gap-3">
                <!-- Profile Photo with Online Indicator -->
                <div class="relative flex-shrink-0">
                    @if(Auth::user()->photo)
                        <img 
                            src="{{ asset('storage/' . Auth::user()->photo) }}?v={{ time() }}" 
                            alt="{{ Auth::user()->name }}"
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-primary-200 shadow-lg transition-transform hover:scale-105"
                            onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        >
                        <!-- Fallback Avatar -->
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg" style="display: none;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @else
                        <!-- Default Avatar -->
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-lg">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    
                    <!-- Online Indicator -->
                    <span class="absolute bottom-0 right-0 block h-3 w-3 rounded-full bg-green-400 ring-2 ring-white shadow-sm"></span>
                </div>
                
                <!-- User Info -->
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">
                        {{ Auth::user()->name }}
                    </p>
                    <div class="flex items-center gap-2 mt-0.5">
                        <!-- Role Badge -->
                        @if(Auth::user()->role === 'pengurus_inti')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-purple-100 to-purple-200 text-purple-800 ring-1 ring-purple-300">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Pengurus Inti
                            </span>
                        @elseif(Auth::user()->role === 'pengurus_harian')
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 ring-1 ring-blue-300">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Pengurus Harian
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 ring-1 ring-gray-300">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                Mahasiswa
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

            <!-- Navigation - SCROLLABLE -->
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu Utama</p>
                </div>
                @unless(auth()->check() && auth()->user()->isPengurus())
                <!-- Aspirasi -->
                <a href="{{ route('aspirasi.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('aspirasi.create') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Kirim Aspirasi
                </a>
                <!-- Pendaftaran -->
                <a href="{{ route('pendaftaran.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('pendaftaran.index') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    Pendaftaran
                </a>
                @endunless
                
                <!-- Arsip Dekumen -->
                <a href="{{ route('arsip-dokumen.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('arsip-dokumen.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z"/></svg>
                    Arsip Dokumen
                </a>
                <!-- Agenda -->
                <a href="{{ route('agenda.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('agenda.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Agenda Kegiatan
                </a>    

                @auth
                    @if(auth()->user()->isPengurus())
                        <div class="pt-4 pb-2">
                            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kelola Data</p>
                        </div>

                        <a href="{{ route('aspirasi.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('aspirasi.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            Kelola Aspirasi
                        </a>

                        <!-- Arsip Surat -->
                        <a href="{{ route('arsip-surat.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('arsip-surat.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Arsip Surat
                        </a>

                        <a href="{{ route('pendaftaran.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('pendaftaran.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Kelola Pendaftaran
                        </a>

                         <!-- Kelola Periode Pendaftaran -->
                        @if(auth()->user()->isInti())
                        <a href="{{ route('pendaftaran.periode.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('pendaftaran.periode.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Kelola Periode
                        </a>
                        <!-- User Management -->
                        <a href="{{ route('users.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('users.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            Kelola User
                        </a>

                        <!-- Kelola Foto Landing Page -->
                        <a href="{{ route('admin.landing-photos.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('admin.landing-photos.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 16M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Kelola Foto Landing
                        </a>
                        @endif

                        <!-- Manajemen Rapat -->
                        <a href="{{ route('rapat.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('rapat.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Manajemen Rapat
                        </a>

                        <!-- Manajemen Proker -->
                        <a href="{{ route('proker.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition {{ request()->routeIs('proker.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            Manajemen Proker
                        </a>
                        
                        
                    @endif
                @endauth
            </nav>

            <!-- Bottom -->
            <div class="p-4 border-t border-gray-200 flex-shrink-0 bg-white">
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 mb-1 text-sm text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Profile
                    </a>
                    <form method="POST" action="{{ route('logout') }}" data-turbo="false">
                        @csrf
                        <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 rounded-lg hover:bg-red-50 transition">
                            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Logout
                        </button>
                    </form>
                @endauth
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Mobile Header -->
            <header class="lg:hidden bg-white border-b border-gray-200 flex-shrink-0">
                <div class="flex items-center justify-between h-16 px-4">
                    <button @click="sidebarOpen = true" class="text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <span class="text-lg font-bold text-primary-600">HIMADIKTI</span>
                    <div class="w-6"></div>
                </div>
            </header>

            <!-- Main Content Scrollable -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                {{ $slot }}
            </main>
        </div>

    </div>

    @stack('scripts')
</body>
</html>