<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar Akun - HIMADIKTI</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50">
    <div class="min-h-full flex flex-col lg:flex-row">
        
        <!-- LEFT COLUMN - Form Register (Mobile First) -->
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:px-20 xl:px-24 order-2 lg:order-1">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <!-- Logo & Header -->
                <div>
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                        Buat Akun Baru
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500 transition">
                            Login di sini
                        </a>
                    </p>
                </div>

                <!-- Form -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input 
                                    id="name" 
                                    name="name" 
                                    type="text" 
                                    value="{{ old('name') }}"
                                    required 
                                    autofocus
                                    autocomplete="name"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Nama Lengkap"
                                >
                            </div>
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- NIM -->
                        <div>
                            <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">
                                NIM <span class="text-gray-500 text-xs">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input 
                                    id="nim" 
                                    name="nim" 
                                    type="text" 
                                    value="{{ old('nim') }}"
                                    autocomplete="nim"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Contoh: 20210001234"
                                >
                            </div>
                            @error('nim')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="username"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="nama@email.com"
                                >
                            </div>
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    required
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Minimal 8 karakter"
                                >
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1.5 text-xs text-gray-500">
                                Minimal 8 karakter, kombinasi huruf dan angka
                            </p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <input 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    type="password" 
                                    required
                                    autocomplete="new-password"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Ketik ulang password"
                                >
                            </div>
                            @error('password_confirmation')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input 
                                    id="terms" 
                                    name="terms" 
                                    type="checkbox"
                                    required
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition"
                                >
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="terms" class="text-gray-700">
                                    Saya setuju dengan <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Syarat & Ketentuan</a> dan <a href="#" class="font-medium text-primary-600 hover:text-primary-500">Kebijakan Privasi</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            Daftar Sekarang
                        </button>
                    </form>

                    <!-- Divider -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-gray-50 text-gray-500">Atau</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a 
                                href="{{ route('login') }}"
                                class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition"
                            >
                                Sudah Punya Akun? Login
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <p class="mt-8 text-center text-xs text-gray-500">
                    © {{ date('Y') }} HIMA PTI. All rights reserved.
                </p>
            </div>
        </div>

        <!-- RIGHT COLUMN - Hero Section (Hidden on Mobile) -->
        <div class="hidden lg:block relative flex-1 order-1 lg:order-2">
            <div class="absolute inset-0 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900"></div>
            
            <!-- Pattern Overlay -->
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

            <!-- Content -->
            <div class="relative h-full flex flex-col items-center justify-center px-12 text-white">
                
                <!-- Animated Icon -->
                <div class="mb-8 animate-bounce">
                    <div class="w-20 h-20 bg-white/10 backdrop-blur-lg rounded-2xl flex items-center justify-center border border-white/20 shadow-2xl">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h1 class="text-4xl font-bold text-center mb-4">
                    Bergabung dengan HIMADIKTI
                </h1>
                <p class="text-xl text-center text-white/90 mb-12 max-w-md">
                    Jadilah bagian dari keluarga besar Himpunan Mahasiswa PTI
                </p>

                <!-- Benefits -->
                <div class="space-y-4 max-w-md w-full">
                    <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 transform hover:scale-105 transition-transform">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Sampaikan Aspirasi</h3>
                            <p class="text-sm text-white/80">Suaramu penting untuk kemajuan HIMA</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 transform hover:scale-105 transition-transform">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Ikuti Kegiatan</h3>
                            <p class="text-sm text-white/80">Update info kegiatan dan event terbaru</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 transform hover:scale-105 transition-transform">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Daftar Pengurus</h3>
                            <p class="text-sm text-white/80">Kesempatan menjadi pengurus HIMA</p>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="mt-12 grid grid-cols-3 gap-6 max-w-md w-full">
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">500+</div>
                        <div class="text-sm text-white/80">Mahasiswa</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">50+</div>
                        <div class="text-sm text-white/80">Kegiatan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold mb-1">100%</div>
                        <div class="text-sm text-white/80">Dedikasi</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>