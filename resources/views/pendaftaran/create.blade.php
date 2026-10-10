<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Form Pendaftaran - HIMADIKTI</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Mobile-first responsive overrides */
        @media (max-width: 640px) {
            /* Navigation */
            .nav-logo-text { font-size: 1.1rem !important; }
            .nav-dashboard-text { display: none; }
            .nav-dashboard-icon { display: flex !important; }

            /* Header card */
            .header-card-padding { padding: 1.25rem 1rem !important; }
            .header-badge { font-size: 0.65rem !important; padding: 0.3rem 0.7rem !important; }
            .header-title { font-size: 1.35rem !important; line-height: 1.3 !important; margin-bottom: 0.4rem !important; }
            .header-period { font-size: 0.875rem !important; margin-bottom: 0.25rem !important; }
            .header-date { font-size: 0.7rem !important; }

            /* Form card */
            .form-card-padding { padding: 1.25rem 1rem !important; }

            /* Section titles */
            .section-title { font-size: 0.9rem !important; }

            /* Inputs */
            .input-field { padding: 0.625rem 0.75rem 0.625rem 2.25rem !important; font-size: 0.875rem !important; border-radius: 0.65rem !important; }
            .input-icon { left: 0.6rem !important; }
            .input-label { font-size: 0.78rem !important; margin-bottom: 0.3rem !important; }

            /* Upload area */
            .upload-area { padding: 1.5rem 1rem !important; }
            .upload-icon-wrap { width: 3rem !important; height: 3rem !important; border-radius: 0.875rem !important; }
            .upload-icon { width: 1.5rem !important; height: 1.5rem !important; }
            .upload-text-main { font-size: 0.8rem !important; }
            .upload-text-sub { font-size: 0.7rem !important; }

            /* Motivasi textarea */
            .motivasi-field { padding: 0.625rem 0.75rem !important; font-size: 0.875rem !important; border-radius: 0.65rem !important; }
            .char-counter { font-size: 0.75rem !important; }

            /* Info box */
            .info-box { padding: 1rem !important; border-radius: 0.75rem !important; }
            .info-title { font-size: 0.85rem !important; margin-bottom: 0.5rem !important; }
            .info-item { font-size: 0.75rem !important; }
            .info-item-icon { width: 0.875rem !important; height: 0.875rem !important; margin-right: 0.375rem !important; }

            /* Submit section */
            .submit-section { padding-top: 1.25rem !important; flex-direction: column-reverse !important; gap: 0.75rem !important; }
            .back-btn { font-size: 0.8rem !important; justify-content: center !important; }
            .submit-btn { width: 100% !important; justify-content: center !important; padding: 0.75rem 1.5rem !important; font-size: 0.875rem !important; border-radius: 0.75rem !important; }
            .submit-btn-icon { width: 1rem !important; height: 1rem !important; }

            /* Error alerts */
            .error-box { padding: 1rem !important; margin-bottom: 1.25rem !important; border-radius: 0.65rem !important; }
            .error-title { font-size: 0.8rem !important; }
            .error-item { font-size: 0.75rem !important; }

            /* Spacing */
            .section-gap { margin-bottom: 1.5rem !important; }
            .field-gap { gap: 1rem !important; }
            .page-padding { padding: 0.75rem 0.625rem 2rem !important; }
        }

        @media (max-width: 380px) {
            .header-title { font-size: 1.15rem !important; }
            .nav-logo-text { font-size: 1rem !important; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">

    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-lg border-b border-gray-200 shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">
            <div class="flex justify-between h-14 sm:h-16 items-center">
                <!-- Logo -->
                <a href="/" class="flex items-center space-x-2">
                    <img
                        src="{{ asset('images/himadikti.png') }}"
                        alt="HIMADIKTI Logo"
                        class="h-8 w-auto sm:h-10"
                    >
                    <span class="nav-logo-text text-xl font-bold bg-gradient-to-r from-primary-600 to-primary-700 bg-clip-text text-transparent">HIMADIKTI</span>
                </a>

                <!-- Dashboard link: icon-only on mobile, text on desktop -->
                <div class="flex items-center">
                    <!-- Desktop: text button -->
                    <a href="{{ route('dashboard') }}" class="nav-dashboard-text hidden sm:inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Dashboard
                    </a>
                    <!-- Mobile: icon-only button -->
                    <a href="{{ route('dashboard') }}" class="nav-dashboard-icon sm:hidden flex items-center justify-center w-9 h-9 rounded-lg text-gray-600 hover:text-primary-600 hover:bg-primary-50 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="page-padding py-6 sm:py-12 px-3 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">

            <!-- Header Card -->
            <div class="bg-gradient-to-br from-primary-600 via-primary-700 to-primary-900 rounded-2xl shadow-2xl overflow-hidden mb-5 sm:mb-8">
                <div class="header-card-padding relative px-6 py-8 sm:px-8 sm:py-12">
                    <!-- Pattern Background -->
                    <div class="absolute inset-0 opacity-10">
                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="form-pattern" width="32" height="32" patternUnits="userSpaceOnUse">
                                    <path d="M0 32V.5H32" fill="none" stroke="white" stroke-width="1"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#form-pattern)"/>
                        </svg>
                    </div>

                    <div class="relative">
                        <div class="header-badge inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-white/20 backdrop-blur-lg rounded-full text-xs sm:text-sm font-semibold mb-3 sm:mb-4 border border-white/30 text-white">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Form Pendaftaran
                        </div>
                        <h1 class="header-title text-2xl sm:text-4xl font-bold text-white mb-2 sm:mb-3">Pendaftaran Pengurus HIMADIKTI</h1>
                        <p class="header-period text-base sm:text-xl text-white/90 mb-1.5 sm:mb-2">{{ $periode->nama_periode }}</p>
                        <p class="header-date text-xs sm:text-sm text-white/70 flex items-center">
                            <svg class="w-3.5 h-3.5 inline mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $periode->tanggal_buka->format('d M Y') }} - {{ $periode->tanggal_tutup->format('d M Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="form-card-padding p-5 sm:p-8 md:p-10">

                    @if($errors->any())
                        <div class="error-box mb-6 sm:mb-8 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg p-4 sm:p-6">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-red-500 mr-2.5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="error-title font-semibold text-red-900 mb-1.5 sm:mb-2 text-sm sm:text-base">Terdapat kesalahan:</p>
                                    <ul class="list-disc list-inside text-xs sm:text-sm text-red-700 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li class="error-item">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 sm:space-y-8" data-turbo="false">
                        @csrf

                        <!-- Personal Info Section -->
                        <div class="section-gap">
                            <h3 class="section-title text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center pb-2.5 sm:pb-3 border-b-2 border-primary-200">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Informasi Pribadi
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 field-gap gap-4 sm:gap-6">
                                <!-- Nama -->
                                <div class="md:col-span-2">
                                    <label for="nama" class="input-label block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5 sm:mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon absolute inset-y-0 left-0 pl-2.5 sm:pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            name="nama"
                                            id="nama"
                                            value="{{ old('nama', auth()->user()->name) }}"
                                            class="input-field block w-full pl-9 sm:pl-10 pr-3 py-2.5 sm:py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                            placeholder="Nama Lengkap"
                                            required
                                        >
                                    </div>
                                    @error('nama')
                                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NIM -->
                                <div>
                                    <label for="nim" class="input-label block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5 sm:mb-2">
                                        NIM <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon absolute inset-y-0 left-0 pl-2.5 sm:pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            name="nim"
                                            id="nim"
                                            value="{{ old('nim', auth()->user()->nim) }}"
                                            class="input-field block w-full pl-9 sm:pl-10 pr-3 py-2.5 sm:py-3 text-sm border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                            placeholder="Contoh: 2021001"
                                            required
                                        >
                                    </div>
                                    @error('nim')
                                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Divisi Yang Diminati -->
                                <div>
                                    <label for="jurusan" class="input-label block text-xs sm:text-sm font-semibold text-gray-700 mb-1.5 sm:mb-2">
                                        Divisi Yang Diminati <span class="text-red-500">*</span>
                                        <span class="text-gray-400 font-normal text-xs block mt-0.5">Pilih minimal 2 divisi</span>
                                    </label>
                                    <div class="relative">
                                        <div class="input-icon absolute inset-y-0 left-0 pl-2.5 sm:pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <input
                                            type="text"
                                            name="jurusan"
                                            id="jurusan"
                                            value="{{ old('jurusan', ' Divisi Sosial Budaya') }}"
                                            class="input-field block w-full pl-9 sm:pl-10 pr-3 py-2.5 sm:py-3 text-sm border border-primary-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition"
                                            required
                                        >
                                    </div>
                                    @error('jurusan')
                                        <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Documents Section -->
                        <div class="section-gap">
                            <h3 class="section-title text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center pb-2.5 sm:pb-3 border-b-2 border-primary-200">
                                <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                </svg>
                                Dokumen Pendukung
                            </h3>

                            <!-- Upload CV -->
                            <div>
                                <label class="input-label block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                    Upload Dokumen (CV, KTM, Sertifikat dalam 1 file) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative border-2 border-dashed border-primary-300 rounded-xl hover:border-primary-400 transition-all bg-gradient-to-br from-gray-50 to-white">
                                    <input
                                        type="file"
                                        name="cv"
                                        id="cv"
                                        class="sr-only"
                                        accept=".pdf"
                                        required
                                        onchange="displayFileName(this)"
                                    >
                                    <label for="cv" class="cursor-pointer block upload-area px-4 py-7 sm:px-6 sm:py-10 text-center">
                                        <div class="space-y-2 sm:space-y-3">
                                            <div class="flex justify-center">
                                                <div class="upload-icon-wrap w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center">
                                                    <svg class="upload-icon w-7 h-7 sm:w-8 sm:h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="upload-text-main text-sm sm:text-base font-semibold text-gray-700">
                                                    <span class="text-primary-600">Tap untuk upload</span>
                                                </p>
                                                <p class="upload-text-sub text-xs sm:text-sm text-gray-500 mt-0.5">PDF (max. 2MB)</p>
                                            </div>
                                            <div id="file-preview" class="hidden">
                                                <div class="inline-flex items-center px-3 py-1.5 sm:px-4 sm:py-2 bg-green-100 rounded-lg">
                                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-green-600 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span id="file-name" class="text-xs sm:text-sm font-medium text-green-800 break-all"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                @error('cv')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Motivasi -->
                            <div class="mt-4 sm:mt-6">
                                <label for="motivasi" class="input-label block text-xs sm:text-sm font-semibold text-gray-700 mb-2 sm:mb-3">
                                    Motivasi <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    name="motivasi"
                                    id="motivasi"
                                    rows="7"
                                    maxlength="500"
                                    class="motivasi-field block w-full px-3 sm:px-4 py-2.5 sm:py-3 text-sm border border-primary-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition resize-none"
                                    placeholder="Ceritakan mengapa Anda ingin bergabung menjadi Pengurus HIMADIKTI, mengapa Anda ingin bergabung di divisi tersebut, dan apa kontribusi yang bisa Anda berikan..."
                                    required
                                >{{ old('motivasi') }}</textarea>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <p class="char-counter text-xs text-gray-500">Tuliskan dengan jelas dan sopan</p>
                                    <p class="char-counter text-xs sm:text-sm font-medium">
                                        <span id="motivasi-count" class="text-primary-600">0</span>
                                        <span class="text-gray-500">/ 500</span>
                                    </p>
                                </div>
                                @error('motivasi')
                                    <p class="mt-1 text-xs sm:text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="info-box bg-gradient-to-br from-primary-50 to-primary-100 border-l-4 border-primary-500 rounded-xl p-4 sm:p-6">
                            <h4 class="info-title font-bold text-primary-900 mb-2.5 sm:mb-3 flex items-center text-sm sm:text-base">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                Informasi Penting
                            </h4>
                            <ul class="space-y-1.5 sm:space-y-2">
                                @php
                                $infoItems = [
                                    'Pastikan semua data yang diisi sudah benar',
                                    'Dokumen harus dalam format PDF dengan ukuran maksimal 2MB',
                                    'Isi file PDF dengan format: CV, KTM, Sertifikat POLKM dalam 1 file',
                                    'Anda akan mendapatkan kode pendaftaran setelah submit',
                                    'Hasil verifikasi akan dikirim melalui email',
                                ];
                                @endphp
                                @foreach($infoItems as $item)
                                <li class="info-item flex items-start text-xs sm:text-sm text-primary-900">
                                    <svg class="info-item-icon w-3.5 h-3.5 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 mt-0.5 text-primary-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $item }}
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Submit Section -->
                        <div class="submit-section flex items-center justify-between pt-5 sm:pt-8 border-t-2 border-gray-200">
                            <a href="{{ route('pendaftaran.index') }}" class="back-btn inline-flex items-center text-xs sm:text-sm text-primary-600 hover:text-primary-900 font-medium transition">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Kembali
                            </a>
                            <button
                                type="submit"
                                class="submit-btn inline-flex items-center px-5 sm:px-8 py-3 sm:py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white text-sm sm:text-base font-bold rounded-xl hover:from-primary-700 hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition transform hover:scale-105 active:scale-95 shadow-xl"
                            >
                                <svg class="submit-btn-icon w-4 h-4 sm:w-5 sm:h-5 mr-1.5 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Kirim Pendaftaran
                                <svg class="submit-btn-icon w-4 h-4 sm:w-5 sm:h-5 ml-1.5 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Character counter untuk motivasi
        const motivasi = document.getElementById('motivasi');
        const motivasiCount = document.getElementById('motivasi-count');

        motivasi.addEventListener('input', function() {
            const count = this.value.length;
            motivasiCount.textContent = count;

            if (count > 450) {
                motivasiCount.className = 'text-red-600';
            } else if (count > 350) {
                motivasiCount.className = 'text-yellow-600';
            } else {
                motivasiCount.className = 'text-primary-600';
            }
        });

        motivasiCount.textContent = motivasi.value.length;

        // Display file name with preview
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
</body>
</html>