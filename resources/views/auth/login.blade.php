<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - HIMADIKTI</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Fullscreen Fix */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        /* Logo Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-30px);
            }
        }

        @keyframes pulse-glow {
            0%, 100% {
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 40px rgba(255, 255, 255, 0.6);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-glow {
            animation: pulse-glow 2s ease-in-out infinite;
        }

        /* Smooth scroll for mobile */
        .scroll-container {
            overflow-y: auto;
            -webkit-overflow-scrolling: touch;
        }
    </style>
</head>
<body class="h-full bg-gray-50">
    <div class="h-full flex flex-col lg:flex-row">
        
        <!-- LEFT COLUMN - Form Login -->
        <div class="flex-1 flex flex-col justify-center py-8 px-4 sm:px-6 lg:px-20 xl:px-24 order-2 lg:order-1 scroll-container">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                
                <!-- Logo & Header -->
                <div>
                    <h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
                        Selamat Datang Kembali
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="font-medium text-primary-600 hover:text-primary-500 transition">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mt-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form -->
                <div class="mt-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

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
                                    autofocus
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
                                    autocomplete="current-password"
                                    class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent transition placeholder-gray-400"
                                    placeholder="••••••••"
                                >
                            </div>
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input 
                                    id="remember_me" 
                                    name="remember" 
                                    type="checkbox"
                                    class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded transition"
                                >
                                <label for="remember_me" class="ml-2 block text-sm text-gray-700">
                                    Ingat saya
                                </label>
                            </div>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary-600 hover:text-primary-500 transition">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            Masuk
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
                                href="{{ route('register') }}"
                                class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition"
                            >
                                Buat Akun Baru
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <p class="mt-8 text-center text-xs text-gray-500">
                    © {{ date('Y') }} HIMADIKTI. All rights reserved.
                </p>
            </div>
        </div>

        <!-- RIGHT COLUMN - Hero Section -->
        <div class="hidden lg:block relative flex-1 order-1 lg:order-2 h-full">
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
            <div class="relative h-full flex flex-col items-center justify-center px-122 text-white">
                
                <!-- Animated Logo -->
               <div class="mb-2 animate-float flex justify-center">
    <img 
        src="{{ asset('images/himadikti.png') }}" 
        alt="Logo HIMADIKTI"
        class="w-12 h-13 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24 "
    >
</div>

                <!-- Title -->
                <h1 class="text-4xl lg:text-5xl font-bold text-center mb-2">
                    HIMADIKTI
                </h1>
                <p class="text-xl text-center text-white/90 mb-12 max-w-md">
                    Himpunan Mahasiswa Pendidikan Teknologi Informasi
                </p>

                <!-- Features -->
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
                            <h3 class="font-semibold text-lg mb-1">Aspirasi Mahasiswa</h3>
                            <p class="text-sm text-white/80">Sampaikan aspirasi dan saran untuk kemajuan bersama</p>
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
                            <h3 class="font-semibold text-lg mb-1">Kelola Kegiatan</h3>
                            <p class="text-sm text-white/80">Pantau jadwal dan kegiatan HIMA dengan mudah</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 transform hover:scale-105 transition-transform">
                        <div class="flex-shrink-0">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg mb-1">Arsip Digital</h3>
                            <p class="text-sm text-white/80">Akses dokumen dan surat penting kapan saja</p>
                        </div>
                    </div>
                </div>

                <!-- Bottom Quote -->
                <div class="mt-12 text-center">
                    <p class="text-white/80 italic text-base max-w-md">
                        "Bersama membangun organisasi yang solid dan berprestasi"
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>