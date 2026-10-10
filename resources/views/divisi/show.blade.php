@php
    // Variabel socials tetap di sini karena footer ada di semua halaman
    $socials = [
        [
            'label' => 'Instagram',
            'href' => 'https://instagram.com/himadikti',
            'icon' =>
                'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z',
        ],
        [
            'label' => 'LinkedIn',
            'href' => 'https://linkedin.com',
            'icon' =>
                'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z',
        ],
        [
            'label' => 'YouTube',
            'href' => 'https://youtube.com',
            'icon' =>
                'M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['name'] }} — HIMADIKTI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-dm overflow-x-hidden bg-[#0a0a0a] text-[#f5f5f5]">

    <style>
        /* Efek Glassmorphism saat Scroll */
        #navbar.scrolled {
            background: rgba(10, 10, 10, 0.75);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Navigasi Link Hover Indicator */
        nav ul li a {
            position: relative;
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #ea580c;
            transition: width 0.3s ease;
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        .back-btn-pill.show {
            animation: slideLeft .5s ease .05s forwards;
        }

        .subtitle-fade.show,
        .reveal.visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        .flip-wrap.flipped .flip-inner {
            transform: rotateY(180deg) !important;
        }

        .dot-btn {
            border: none;
            cursor: pointer;
            border-radius: 9999px;
            transition: all .3s ease;
            padding: 0;
            background: rgba(255, 255, 255, .2);
            width: 8px;
            height: 8px;
        }

        .dot-btn.active {
            background: #ea580c;
            width: 24px;
            border-radius: 4px;
        }

        @keyframes slideLeft {
            from {
                opacity: 0;
                transform: translateX(-12px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: 0
            }
        }

        @keyframes scrollPulse {
            0% {
                transform: scaleY(0);
                transform-origin: top;
            }

            50% {
                transform: scaleY(1);
                transform-origin: top;
            }

            51% {
                transform: scaleY(1);
                transform-origin: bottom;
            }

            100% {
                transform: scaleY(0);
                transform-origin: bottom;
            }
        }
    </style>

    <nav id="navbar" class="fixed top-0 inset-x-0 z-[100] py-6 transition-all duration-500 bg-transparent">
        <div class="max-w-[1200px] mx-auto px-6 md:px-10 flex items-center justify-between">

            <a href="{{ route('home') }}" class="flex items-center gap-3 group no-underline">
                <div class="relative">
                    <img src="{{ asset('images/himadikti.png') }}" alt="HIMADIKTI"
                        class="h-10 w-auto transition-transform duration-300 group-hover:scale-110">
                    <div
                        class="absolute -inset-1 bg-orange-600/20 blur-lg rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                </div>
                <span
                    class="font-syne font-extrabold text-xl tracking-tight text-white group-hover:text-orange-500 transition-colors">
                    HIMADIKTI
                </span>
            </a>

            <ul class="hidden lg:flex items-center gap-10 list-none">
                <li><a href="{{ route('home') }}"
                        class="text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500 hover:tracking-wide">Beranda</a>
                </li>
                <li><a href="{{ route('home') }}#about"
                        class="text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500 hover:tracking-wide">Tentang</a>
                </li>
                <li><a href="{{ route('home') }}#divisi"
                        class="text-[0.85rem] font-semibold text-white/70 no-underline transition-all tracking-wide">Divisi</a>
                </li>
                <li><a href="{{ route('home') }}#features"
                        class="text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500 hover:tracking-wide">Fitur</a>
                </li>
                <li><a href="{{ route('home') }}#contact"
                        class="text-[0.85rem] font-semibold text-white/70 no-underline transition-all hover:text-orange-500 hover:tracking-wide">Kontak</a>
                </li>
            </ul>

            <div class="flex items-center gap-5">
                <a href="/login"
                    class="hidden sm:block text-[0.85rem] font-bold text-white/80 no-underline hover:text-white transition-colors">
                    Masuk
                </a>
                <a href="/register"
                    class="px-6 py-2.5 bg-orange-600 text-white font-syne text-[0.8rem] font-bold no-underline rounded-full transition-all duration-300 hover:bg-orange-500 hover:shadow-[0_8px_20px_rgba(234,88,12,0.4)] hover:-translate-y-0.5 active:scale-95">
                    Daftar
                </a>
            </div>
        </div>
    </nav>

    <section
        class="min-h-screen flex flex-col items-center justify-center text-center px-6 pt-[140px] pb-20 relative overflow-hidden">

        <div class="absolute inset-0 z-0">
            <img src="{{ $data['img'] }}" alt="{{ $data['name'] }}" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-[#0a0a0ab6] via-[#0a0a0a]/20 to-[#0a0a0a]"></div>
        </div>

        <div
            class="absolute inset-0 z-0 bg-[linear-gradient(rgba(234,88,12,.04)_1px,transparent_1px),linear-gradient(90deg,rgba(234,88,12,.04)_1px,transparent_1px)] bg-[size:60px_60px] [mask-image:radial-gradient(ellipse_at_center,black_30%,transparent_75%)]">
        </div>

        {{-- Back btn --}}
        <!-- <div class="relative z-10 w-full max-w-[1100px] mx-auto mb-8 text-left">
        <a href="{{ route('home') }}#divisi" class="back-btn-pill inline-flex items-center gap-[7px] py-2 px-[18px] bg-orange-600 text-white rounded-full text-[.82rem] font-semibold no-underline opacity-0 transition-all duration-300 hover:bg-orange-700 hover:shadow-[0_4px_14px_rgba(234,88,12,.4)] group" id="back-btn-top">
            <svg class="transition-transform duration-200 group-hover:-translate-x-[3px]" width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Beranda
        </a>
    </div> -->

        {{-- Badge --}}
        <div class="relative z-10 mb-[18px]">
            <span
                class="inline-block py-[5px] px-4 bg-orange-600 text-white rounded-full text-[.72rem] font-bold tracking-[2.5px] uppercase opacity-0 transition-opacity duration-400 shadow-sm"
                id="hero-badge"> HIMADIKTI</span>
        </div>

        {{-- Title --}}
        <h1 id="hero-title-wrap"
            class="relative z-10 font-extrabold text-[clamp(2rem,6vw,3.8rem)] text-white tracking-[-1.5px] leading-[1.1] min-h-[1.3em] inline-flex items-center justify-center gap-1">
            <span id="typewriter-text"></span>
            <span id="typewriter-cursor"
                class="inline-block w-[3px] h-[1.1em] bg-orange-600 align-middle ml-1 animate-[blink_.75s_step-end_infinite]"></span>
        </h1>

        {{-- Garis Bawah Hero --}}
        <span id="hero-underline"
            class="block h-[3px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-[14px] opacity-0 transition-all duration-[800ms] ease-out"></span>

        {{-- Subtitle --}}
        <p class="subtitle-fade relative z-10 max-w-[600px] mx-auto mt-6 text-base font-medium leading-[1.75] text-white/80 opacity-0 translate-y-[14px] transition-all duration-700 ease-out shadow-black drop-shadow-md"
            id="hero-subtitle">
            {{ $data['desc'] }}
        </p>

        {{-- Scroll hint --}}
        <div class="subtitle-fade relative z-10 mt-12 flex flex-col items-center gap-2 opacity-0 translate-y-[14px] transition-all duration-700 ease-out"
            id="scroll-hint">
            <span class="text-[.72rem] tracking-[2px] uppercase text-white/50">Scroll</span>
            <div
                class="w-[1px] h-[36px] bg-gradient-to-b from-orange-600 to-transparent animate-[scrollPulse_1.5s_ease_infinite]">
            </div>
        </div>
    </section>

    <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-orange-600/40 to-transparent m-0"></div>

    <section class="bg-white">
        <div class="max-w-[1100px] mx-auto py-20 px-6">
            <div class="text-center reveal opacity-0 translate-y-[28px] transition-all duration-600 ease-out">
                <p class="inline-block text-[.72rem] font-bold tracking-[2.5px] uppercase text-orange-600 mb-2.5">
                    Kegiatan Utama</p><br>

                {{-- Title Program Kerja - Teks diubah jadi gray-900 --}}
                <h2
                    class="dynamic-title font-syne text-[clamp(1.6rem,3vw,2.2rem)] font-extrabold text-gray-900 mb-1.5 inline-block">
                    Program <span class="text-orange-600">Kerja</span></h2>
                {{-- Garis Bawah Program Kerja --}}
                <span
                    class="dynamic-underline block h-[3px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-1 opacity-0 transition-all duration-[800ms] ease-out"></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-[18px] mt-12">
                <?php
            $rdelay = ['delay-[80ms]','delay-[160ms]','delay-[240ms]','delay-[320ms]','delay-[400ms]','delay-[480ms]','delay-[80ms]'];
            foreach ($data['prokers'] as $i => $pk):
            ?>
                <div
                    class="flip-wrap reveal <?php echo $rdelay[$i % count($rdelay)]; ?> group/flip [perspective:1000px] h-[186px] cursor-pointer opacity-0 translate-y-[28px] transition-all duration-600 ease-out">
                    <div
                        class="flip-inner relative w-full h-full [transform-style:preserve-3d] transition-transform duration-[650ms] ease-[cubic-bezier(.4,0,.2,1)] group-hover/flip:[transform:rotateY(180deg)]">

                        {{-- Sisi Depan (Sebelum Hover) - Diubah jadi gradien putih ke oren dan teks disesuaikan --}}
                        <div
                            class="absolute inset-0 rounded-[14px] flex flex-col items-center justify-center gap-2.5 p-5 [backface-visibility:hidden] bg-gradient-to-br from-primary-100 to-primary-600 border border-gray-400 shadow-sm">
                            <span class="text-[2rem] leading-none text-primary-600"><?php echo $pk['icon']; ?></span>
                            <p class="text-black font-bold text-[.83rem] text-center leading-[1.45]"><?php echo $pk['title']; ?>
                            </p>
                        </div>

                        {{-- Sisi Belakang (Saat Hover) - Tetap Oranye --}}
                        <div
                            class="absolute inset-0 rounded-[14px] flex flex-col items-center justify-center gap-2.5 p-5 [backface-visibility:hidden] bg-[linear-gradient(135deg,#9a3412_0%,#ea580c_60%,#f97316_100%)] border border-white/15 [transform:rotateY(180deg)]">
                            <span class="text-[1.5rem] leading-none"><?php echo $pk['icon']; ?></span>
                            <p class="text-white font-bold text-[.75rem] text-center mb-1 leading-[1.4]">
                                <?php echo $pk['title']; ?></p>
                            <p class="text-white/90 text-[.72rem] text-center leading-[1.55]"><?php echo $pk['detail']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-orange-600/40 to-transparent m-0"></div>

    <section class="bg-white/5">
        <div class="max-w-[1100px] mx-auto py-20 px-6">
            <div class="text-center reveal opacity-0 translate-y-[28px] transition-all duration-600 ease-out">
                <p class="inline-block text-[.72rem] font-bold tracking-[2.5px] uppercase text-orange-500 mb-2.5">Tim
                    Kami</p><br>

                {{-- Title Staf Divisi --}}
                <h2
                    class="dynamic-title font-syne text-[clamp(1.6rem,3vw,2.2rem)] font-extrabold text-white mb-1.5 inline-block">
                    Anggota <span class="text-orange-600">Divisi</span></h2>
                {{-- Garis Bawah Staf --}}
                <span
                    class="dynamic-underline block h-[3px] w-0 rounded-full bg-gradient-to-r from-orange-600 to-orange-500 mx-auto mt-1 opacity-0 transition-all duration-[800ms] ease-out"></span>
            </div>

            <div class="relative px-7 mt-12">
                <button
                    class="absolute top-1/2 -translate-y-1/2 left-[-22px] z-10 w-[42px] h-[42px] rounded-full border border-orange-600/30 bg-orange-600/10 text-orange-500 flex items-center justify-center cursor-pointer transition-all duration-200 hover:bg-orange-600 hover:border-orange-600 hover:text-white hover:shadow-[0_4px_14px_rgba(234,88,12,.35)]"
                    id="staff-prev" aria-label="Sebelumnya">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <div class="overflow-hidden rounded-2xl" id="staff-viewport">
                    <div class="flex gap-5 transition-transform duration-[550ms] ease-[cubic-bezier(.77,0,.18,1)] will-change-transform"
                        id="staff-track">
                        <?php foreach ($data['staffs'] as $staff): ?>
                        <div
                            class="staff-card flex-none w-[88%] sm:w-[calc(50%-10px)] md:w-[calc(33.333%-14px)] flex flex-col items-center text-center gap-3.5 py-7 px-4 bg-white/5 border border-white/10 rounded-[18px] transition-all duration-300 hover:bg-orange-600/10 hover:border-orange-600/30 hover:-translate-y-1 group/card">
                            <img src="<?php echo $staff['photo']; ?>" alt="<?php echo $staff['name']; ?>"
                                class="w-24 h-24 rounded-full object-cover border-[3px] border-orange-600 shadow-[0_0_0_5px_rgba(234,88,12,.15),0_0_20px_rgba(234,88,12,.1)] transition-all duration-300 group-hover/card:shadow-[0_0_0_6px_rgba(234,88,12,.3),0_0_28px_rgba(234,88,12,.2)] group-hover/card:scale-105"
                                onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($staff['name']); ?>&background=1e293b&color=ea580c&size=96&bold=true'">
                            <div>
                                <p class="font-syne text-[.9rem] font-bold text-white"><?php echo $staff['name']; ?></p>
                                {{-- Role/Jabatan - Diubah bg-orange-600 text-white --}}
                                <p
                                    class="text-[.75rem] font-semibold text-white bg-orange-600 py-[4px] px-3 rounded-full mt-1.5 inline-block shadow-sm">
                                    <?php echo $staff['role']; ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <button
                    class="absolute top-1/2 -translate-y-1/2 right-[-22px] z-10 w-[42px] h-[42px] rounded-full border border-orange-600/30 bg-orange-600/10 text-orange-500 flex items-center justify-center cursor-pointer transition-all duration-200 hover:bg-orange-600 hover:border-orange-600 hover:text-white hover:shadow-[0_4px_14px_rgba(234,88,12,.35)]"
                    id="staff-next" aria-label="Berikutnya">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="flex justify-center gap-2 mt-6" id="staff-dots"></div>
        </div>
    </section>

    <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-orange-600/40 to-transparent m-0"></div>

    <section
        class="bg-white text-center py-20 px-6 relative overflow-hidden reveal opacity-0 translate-y-[28px] transition-all duration-600 ease-out">
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-[radial-gradient(ellipse,rgba(234,88,12,.12)_0%,transparent_65%)] pointer-events-none">
        </div>
        <p class="inline-block text-[.72rem] font-bold tracking-[2.5px] uppercase text-orange-600 mb-3 relative z-10">
            Navigasi</p>

        {{-- Teks diubah jadi gray-900 --}}
        <h2 class="font-syne text-[clamp(1.6rem,3vw,2.4rem)] font-extrabold text-gray-900 mb-2 relative z-10">
            Kembali ke <span class="text-orange-600">Halaman Utama</span>
        </h2>
        <p class="text-[.9rem] text-gray-600 mb-8 max-w-[400px] mx-auto leading-[1.6] relative z-10">
            Jelajahi lebih banyak informasi tentang HIMADIKTI dan seluruh divisi kami.
        </p>

        {{-- Tombol CTA - Diubah bg-orange-600 text-white --}}
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2.5 py-3.5 px-8 bg-orange-600 text-white font-syne text-[.9rem] font-bold no-underline rounded-xl transition-all duration-300 shadow-[0_4px_20px_rgba(234,88,12,.3)] hover:-translate-y-1 hover:bg-orange-700 hover:shadow-[0_12px_32px_rgba(234,88,12,.45)] relative z-10">
            <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Kembali ke Beranda
        </a>
    </section>

    <footer class="bg-[#050505] border-t border-white/5">
        <div class="max-w-[1200px] mx-auto pt-16 pb-8 px-10">
            <div
                class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[1.8fr_1fr_1fr_1.2fr] gap-12 pb-12 border-b border-white/5">

                {{-- Brand --}}
                <div>
                    <div class="flex items-center gap-2.5 mb-3.5">
                        <img src="{{ asset('images/himadikti.png') }}" alt="HIMADIKTI" class="h-9 w-auto">
                        <span class="font-syne font-extrabold text-2xl text-orange-600">HIMADIKTI</span>
                    </div>
                    <p class="text-[.84rem] leading-[1.75] text-white/40 mb-5 max-w-[260px]">
                        Himpunan Mahasiswa Pendidikan Teknologi Informasi — wadah aspirasi, kreativitas, dan
                        pengembangan diri mahasiswa PTI.
                    </p>
                    <div class="flex gap-2.5">
                        <?php foreach ($socials as $s): ?>
                        <a href="<?php echo $s['href']; ?>" target="_blank" rel="noopener"
                            class="w-9 h-9 rounded-lg border border-white/10 bg-white/5 flex items-center justify-center transition-all duration-200 hover:bg-orange-600 hover:border-orange-600 hover:-translate-y-[2px] group/social"
                            aria-label="<?php echo $s['label']; ?>">
                            <svg viewBox="0 0 24 24"
                                class="w-3.5 h-3.5 fill-white/50 group-hover/social:fill-white transition-colors duration-200">
                                <path d="<?php echo $s['icon']; ?>" />
                            </svg>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                {{-- Navigasi --}}
                <div>
                    <p class="font-syne text-[.8rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4.5">
                        Navigasi</p>
                    <div class="flex flex-col gap-2.5">
                        <a href="{{ route('home') }}"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Beranda</a>
                        <a href="{{ route('home') }}#about"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Tentang
                            Kami</a>
                        <a href="{{ route('home') }}#features"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Fitur
                            Platform</a>
                        <a href="{{ route('home') }}#team"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Pengurus</a>
                        <a href="{{ route('home') }}#contact"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Kontak</a>
                    </div>
                </div>

                {{-- Divisi --}}
                <div>
                    <p class="font-syne text-[.8rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4.5">Divisi
                    </p>
                    <div class="flex flex-col gap-2.5">
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            Keilmuan</a>
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            IT</a>
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            PSDM</a>
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            Advokasi</a>
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            Dana Usaha</a>
                        <a href="#"
                            class="text-[.83rem] text-white/40 no-underline transition-colors duration-200 hover:text-orange-500">Divisi
                            Sosial Budaya</a>
                    </div>
                </div>

                {{-- Kontak --}}
                <div>
                    <p class="font-syne text-[.8rem] font-bold tracking-[1.5px] uppercase text-white/90 mb-4.5">Kontak
                    </p>
                    <div class="flex items-start gap-2.5 mb-3.5">
                        <div
                            class="w-8 h-8 shrink-0 bg-orange-600/10 border border-orange-600/20 rounded-lg flex items-center justify-center">
                            <svg viewBox="0 0 24 24" stroke-width="2"
                                class="w-3.5 h-3.5 stroke-orange-600 fill-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[.72rem] text-white/30 mb-0.5">Email</p>
                            <p class="text-[.82rem] text-white/70"><a href="mailto:himadiktiipi@gmail.com"
                                    class="text-white/70 no-underline hover:text-orange-500">himadiktiipi@gmail.com</a>
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5 mb-3.5">
                        <div
                            class="w-8 h-8 shrink-0 bg-orange-600/10 border border-orange-600/20 rounded-lg flex items-center justify-center">
                            <svg viewBox="0 0 24 24" stroke-width="2"
                                class="w-3.5 h-3.5 stroke-orange-600 fill-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[.72rem] text-white/30 mb-0.5">Telepon</p>
                            <p class="text-[.82rem] text-white/70">+62 831-3456-7890</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5 mb-3.5">
                        <div
                            class="w-8 h-8 shrink-0 bg-orange-600/10 border border-orange-600/20 rounded-lg flex items-center justify-center">
                            <svg viewBox="0 0 24 24" stroke-width="2"
                                class="w-3.5 h-3.5 stroke-orange-600 fill-none">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[.72rem] text-white/30 mb-0.5">Alamat</p>
                            <p class="text-[.82rem] text-white/70">Kampus IPI, Gedung Skema Lt. 2</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between flex-wrap gap-3 pt-7">
                <p class="text-[.78rem] text-white/25">© 2025 HIMADIKTI — Himpunan Mahasiswa Pendidikan Teknologi
                    Informasi. All rights reserved.</p>
                <p class="text-[.78rem] text-white/20 italic">Bersama membangun generasi digital yang berkarakter.</p>
            </div>
        </div>
    </footer>

    <script>
        /* ── Navbar Scroll Handler ── */
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }, {
            passive: true
        });


        document.addEventListener('DOMContentLoaded', function() {

            /* ── FUNGSI MASTER: MENGUKUR & MENARIK GARIS ── */
            function aktifkanGaris(teksElemen, garisElemen) {
                if (!teksElemen || !garisElemen) return;
                garisElemen.classList.remove('opacity-0');
                garisElemen.style.width = teksElemen.offsetWidth + 'px';
            }

            /* ── Ukur ulang garis kalau ukuran layar berubah ── */
            window.addEventListener('resize', function() {
                aktifkanGaris(document.getElementById('hero-title-wrap'), document.getElementById(
                    'hero-underline'));

                document.querySelectorAll('.reveal.visible').forEach(function(section) {
                    aktifkanGaris(section.querySelector('.dynamic-title'), section.querySelector(
                        '.dynamic-underline'));
                });
            });

            /* ── Navbar scroll ── */
            window.addEventListener('scroll', function() {
                document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 60);
            });

            /* ── Scroll reveal & Garis Bawah ── */
            var ro = new IntersectionObserver(function(entries) {
                entries.forEach(function(e) {
                    if (e.isIntersecting) {
                        e.target.classList.add('visible');

                        var targetH2 = e.target.querySelector('.dynamic-title');
                        var targetLine = e.target.querySelector('.dynamic-underline');

                        if (targetH2 && targetLine) {
                            setTimeout(function() {
                                aktifkanGaris(targetH2, targetLine);
                            }, 200);
                        }

                        ro.unobserve(e.target);
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -40px 0px'
            });
            document.querySelectorAll('.reveal').forEach(function(el) {
                ro.observe(el);
            });

            /* ── Typewriter & Hero Line ── */
            var FULL = '{!! $data['name'] !!}';
            var twEl = document.getElementById('typewriter-text');
            var cur = document.getElementById('typewriter-cursor');
            var badge = document.getElementById('hero-badge');
            var sub = document.getElementById('hero-subtitle');
            var hint = document.getElementById('scroll-hint');
            var backB = document.getElementById('back-btn-top');
            var idx = 0;

            setTimeout(function() {
                badge.classList.remove('opacity-0');
                backB.classList.add('show');
            }, 120);

            // ... kode sebelumnya tetap sama ...

            setTimeout(function() {
                var t = setInterval(function() {
                    // Cek apakah karakter selanjutnya adalah tag <br>
                    if (FULL.substring(idx, idx + 4) === '<br>') {
                        twEl.innerHTML += '<br>'; // Tambahkan baris baru secara instan
                        idx += 4; // Lewati 4 karakter tag <br>
                    } else {
                        twEl.innerHTML += FULL[idx++]; // Gunakan innerHTML, bukan textContent
                    }

                    if (idx >= FULL.length) {
                        clearInterval(t);
                        setTimeout(function() {
                            cur.style.display = 'none';
                        }, 1100);

                        // Panggil fungsi master untuk menyesuaikan garis bawah
                        aktifkanGaris(document.getElementById('hero-title-wrap'), document
                            .getElementById('hero-underline'));

                        setTimeout(function() {
                            sub.classList.add('show');
                            hint.classList.add('show');
                        }, 350);
                    }
                }, 58);
            }, 560);

            // ... kode setelahnya tetap sama ...

            /* ── Flip card tap (mobile) ── */
            document.querySelectorAll('.flip-wrap').forEach(function(c) {
                c.addEventListener('click', function() {
                    this.classList.toggle('flipped');
                });
            });

            /* ── Staff Slider ── */
            var track = document.getElementById('staff-track');
            var viewport = document.getElementById('staff-viewport');
            var prevBtn = document.getElementById('staff-prev');
            var nextBtn = document.getElementById('staff-next');
            var dotsWrap = document.getElementById('staff-dots');
            var cards = track.querySelectorAll('.staff-card');
            var cur2 = 0,
                timer = null;

            function vis() {
                var w = viewport.offsetWidth;
                return w < 500 ? 1 : w < 768 ? 2 : 3;
            }

            function tot() {
                return Math.max(1, Math.ceil(cards.length / vis()));
            }

            function buildDots() {
                dotsWrap.innerHTML = '';
                for (var i = 0; i < tot(); i++) {
                    (function(i) {
                        var d = document.createElement('button');
                        d.className = 'dot-btn' + (i === cur2 ? ' active' : '');
                        d.setAttribute('aria-label', 'Slide ' + (i + 1));
                        d.onclick = function() {
                            stopA();
                            goTo(i);
                            startA();
                        };
                        dotsWrap.appendChild(d);
                    })(i);
                }
            }

            function goTo(n) {
                var t = tot();
                cur2 = ((n % t) + t) % t;
                var cw = cards[0].offsetWidth + 20;
                track.style.transform = 'translateX(-' + (cur2 * cw) + 'px)';
                buildDots();
            }

            function startA() {
                timer = setInterval(function() {
                    goTo(cur2 + 1);
                }, 3200);
            }

            function stopA() {
                clearInterval(timer);
            }

            prevBtn.onclick = function() {
                stopA();
                goTo(cur2 - 1);
                startA();
            };
            nextBtn.onclick = function() {
                stopA();
                goTo(cur2 + 1);
                startA();
            };

            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    stopA();
                    goTo(cur2 - 1);
                    startA();
                }
                if (e.key === 'ArrowRight') {
                    stopA();
                    goTo(cur2 + 1);
                    startA();
                }
            });

            var tx = 0;
            track.addEventListener('touchstart', function(e) {
                tx = e.touches[0].clientX;
            }, {
                passive: true
            });
            track.addEventListener('touchend', function(e) {
                var d = tx - e.changedTouches[0].clientX;
                if (Math.abs(d) > 40) {
                    stopA();
                    d > 0 ? goTo(cur2 + 1) : goTo(cur2 - 1);
                    startA();
                }
            }, {
                passive: true
            });

            var rt;
            window.addEventListener('resize', function() {
                clearTimeout(rt);
                rt = setTimeout(function() {
                    goTo(0);
                }, 200);
            });

            buildDots();
            startA();
        });
    </script>

</body>

</html>
