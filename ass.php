<?echo
// about.php
$pageTitle = "Tentang BEM FEB UI - Badan Eksekutif Mahasiswa Fakultas Ekonomi dan Bisnis UI";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#1E40AF',
                        'secondary': '#F59E0B',
                        'accent': '#10B981',
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .gradient-text { 
            background: linear-gradient(135deg, #1E40AF 0%, #3B82F6 50%, #F59E0B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    
    <!-- Header -->
    <header id="yy" class="bg-white shadow-lg sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center">
                        <i class="fas fa-university text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">BEM FEB UI</h1>
                        <p class="text-xs text-gray-500">Badan Eksekutif Mahasiswa</p>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-700 hover:text-primary font-medium transition-all duration-300">Beranda</a>
                    <a href="/about.php" class="text-primary font-semibold border-b-2 border-primary pb-1">Tentang</a>
                    <a href="#" class="text-gray-700 hover:text-primary font-medium transition-all duration-300">Struktur</a>
                    <a href="#" class="text-gray-700 hover:text-primary font-medium transition-all duration-300">Kegiatan</a>
                    <a href="#" class="text-gray-700 hover:text-primary font-medium transition-all duration-300">Kontak</a>
                </div>
                
                <button class="md:hidden p-2">
                    <i class="fas fa-bars text-xl text-gray-700"></i>
                </button>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-900 pt-32 pb-24">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-6 lg:px-8 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                    Tentang 
                    <span class="block gradient-text">BEM FEB UI</span>
                </h1>
                <p class="text-xl md:text-2xl font-light mb-12 opacity-90 max-w-2xl mx-auto leading-relaxed">
                    Badan Eksekutif Mahasiswa Fakultas Ekonomi dan Bisnis 
                    Universitas Indonesia
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center max-w-md mx-auto">
                    <a href="#visi-misi" class="bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-2xl font-semibold hover:bg-white/30 transition-all duration-300 border-2 border-white/30">
                        Visi & Misi
                    </a>
                    <a href="#sejarah" class="bg-white text-primary px-8 py-4 rounded-2xl font-semibold hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl">
                        Sejarah
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-24">
                <span class="inline-block px-4 py-2 bg-secondary text-white text-sm font-semibold rounded-full mb-6">VISI & MISI</span>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6">Arah Pergerakan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Visi dan misi BEM FEB UI mencerminkan komitmen penuh kami dalam mewujudkan aspirasi mahasiswa dan kemajuan Fakultas Ekonomi dan Bisnis Universitas Indonesia.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Visi -->
                <div class="group">
                    <div class="flex items-start space-x-6 mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-primary to-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-2xl group-hover:scale-110 transition-all duration-500">
                            <i class="fas fa-eye text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-gray-900 mb-4 group-hover:text-primary transition-colors">VISI</h3>
                            <div class="h-1 w-24 bg-gradient-to-r from-primary to-blue-600 rounded-full mb-6"></div>
                        </div>
                    </div>
                    <p class="text-xl text-gray-700 leading-relaxed max-w-lg">
                        Menjadi lembaga eksekutif mahasiswa Fakultas Ekonomi dan Bisnis Universitas Indonesia yang <strong>terdepan, inovatif, dan inspiratif</strong> dalam mewujudkan aspirasi mahasiswa serta kemajuan fakultas.
                    </p>
                </div>

                <!-- Misi -->
                <div class="group">
                    <div class="flex items-start space-x-6 mb-8">
                        <div class="w-16 h-16 bg-gradient-to-r from-accent to-emerald-500 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-2xl group-hover:scale-110 transition-all duration-500">
                            <i class="fas fa-bullseye text-2xl text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-3xl font-black text-gray-900 mb-4 group-hover:text-accent transition-colors">MISI</h3>
                            <div class="h-1 w-24 bg-gradient-to-r from-accent to-emerald-500 rounded-full mb-6"></div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <p class="text-xl text-gray-700 leading-relaxed flex items-start">
                            <span class="text-accent font-semibold mr-3 mt-1">1.</span>
                            Meningkatkan kualitas <strong>akademik dan non-akademik</strong> mahasiswa FEB UI
                        </p>
                        <p class="text-xl text-gray-700 leading-relaxed flex items-start">
                            <span class="text-accent font-semibold mr-3 mt-1">2.</span>
                            Menjembatani aspirasi mahasiswa dengan <strong>stakeholder</strong> fakultas
                        </p>
                        <p class="text-xl text-gray-700 leading-relaxed flex items-start">
                            <span class="text-accent font-semibold mr-3 mt-1">3.</span>
                            Mengembangkan <strong>potensi dan kompetensi</strong> kepemimpinan mahasiswa
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="py-32 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-24">
                <span class="inline-block px-4 py-2 bg-primary text-white text-sm font-semibold rounded-full mb-6">SEJARAH</span>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6">Jejak Perjalanan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">Sejak berdirinya, BEM FEB UI terus berkembang menjadi pilar utama gerakan mahasiswa Fakultas Ekonomi dan Bisnis Universitas Indonesia.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Gedung FEB UI" 
                             class="w-full h-96 object-cover rounded-3xl shadow-2xl hover:scale-105 transition-all duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent rounded-3xl"></div>
                        <div class="absolute bottom-6 left-6 text-white">
                            <p class="text-2xl font-bold mb-2">FEB UI Campus</p>
                            <p class="text-lg opacity-90">Pusat Aktivitas Mahasiswa</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-primary to-blue-600 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-calendar text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">1980</h4>
                                <p class="text-primary font-semibold">Didirikan</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            BEM FEB UI resmi berdiri sebagai representasi mahasiswa Fakultas Ekonomi Universitas Indonesia yang baru saja terbentuk.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="w-12 h-12 bg-gradient-to-r from-secondary to-orange-500 rounded-2xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-white text-lg"></i>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">2010</h4>
                                <p class="text-secondary font-semibold">Transformasi</p>
                            </div>
                        </div>
                        <p class="text-lg text-gray-700 leading-relaxed">
                            Resmi berganti nama menjadi BEM FEB UI seiring transformasi Fakultas Ekonomi menjadi Fakultas Ekonomi dan Bisnis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nilai Inti Section -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-24">
                <span class="inline-block px-4 py-2 bg-accent text-white text-sm font-semibold rounded-full mb-6">NILI KAMI</span>
                <h2 class="text-5xl md:text-6xl font-black text-gray-900 mb-6">Core Values</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-500 border border-blue-100 hover:shadow-2xl hover:-translate-y-4">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-primary to-blue-600 rounded-3xl flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-xl">
                        <i class="fas fa-handshake text-2xl text-white"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary">Integritas</h4>
                    <p class="text-gray-600 leading-relaxed">Bertindak jujur, adil, dan bertanggung jawab dalam setiap keputusan dan tindakan.</p>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-emerald-50 to-teal-50 hover:from-emerald-100 hover:to-teal-100 transition-all duration-500 border border-emerald-100 hover:shadow-2xl hover:-translate-y-4">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-accent to-emerald-500 rounded-3xl flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-xl">
                        <i class="fas fa-users text-2xl text-white"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-accent">Solidaritas</h4>
                    <p class="text-gray-600 leading-relaxed">Membangun kebersamaan dan saling mendukung antar seluruh warga FEB UI.</p>
                </div>

                <div class="group text-center p-10 rounded-3xl bg-gradient-to-br from-orange-50 to-yellow-50 hover:from-orange-100 hover:to-yellow-100 transition-all duration-500 border border-orange-100 hover:shadow-2xl hover:-translate-y-4 md:col-span-2 lg:col-span-1">
                    <div class="w-20 h-20 mx-auto mb-6 bg-gradient-to-r from-secondary to-orange-500 rounded-3xl flex items-center justify-center group-hover:scale-110 transition-all duration-300 shadow-xl">
                        <i class="fas fa-rocket text-2xl text-white"></i>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-secondary">Inovasi</h4>
                    <p class="text-gray-600 leading-relaxed">Selalu berpikir kreatif dan berani mengambil langkah progresif untuk kemajuan bersama.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 bg-gradient-to-r from-primary to-blue-600">
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center text-white">
            <h2 class="text-4xl md:text-5xl font-black mb-6">Siap Bergabung?</h2>
            <p class="text-xl md:text-2xl font-light mb-12 opacity-90 max-w-2xl mx-auto">Jadilah bagian dari pergerakan BEM FEB UI dan wujudkan aspirasi mahasiswa bersama kami.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#" class="bg-white text-primary px-10 py-5 rounded-3xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:-translate-y-1">
                    <i class="fas fa-whatsapp mr-3"></i>
                    WhatsApp
                </a>
                <a href="#" class="border-2 border-white px-10 py-5 rounded-3xl font-bold text-lg hover:bg-white hover:text-primary transition-all duration-300 backdrop-blur-sm">
                    <i class="fab fa-instagram mr-3"></i>
                    Instagram
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-800 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-university text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold">BEM FEB UI</h3>
                        </div>
                    </div>
                    <p class="text-gray-400 leading-relaxed">Badan Eksekutif Mahasiswa Fakultas Ekonomi dan                         Bisnis Universitas Indonesia
                    </p>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="/" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="/about.php" class="text-gray-400 hover:text-white transition-colors font-semibold">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Struktur Organisasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Kegiatan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Publikasi</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6">Kontak</h4>
                    <ul class="space-y-3">
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-secondary w-5"></i>
                            <span class="text-gray-400">bemfebui@ui.ac.id</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-secondary w-5"></i>
                            <span class="text-gray-400">+62 812-3456-7890</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-secondary w-5"></i>
                            <span class="text-gray-400">FEB UI, Depok</span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-bold mb-6">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-secondary rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-green-500 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-whatsapp text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-blue-500 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="w-12 h-12 bg-gray-800 hover:bg-sky-500 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-16 pt-12 text-center text-gray-400">
                <p>&copy; <?php echo date('Y'); ?> BEM FEB UI. All rights reserved. Made with ❤️ for FEB UI.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button id="scrollTop" class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-to-r from-primary to-blue-600 text-white rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 opacity-0 invisible flex items-center justify-center text-xl z-40 hover:scale-110" title="Kembali ke atas">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
        // Smooth scrolling untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll to top button
        const scrollTopBtn = document.getElementById('scrollTop');
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
                scrollTopBtn.classList.add('opacity-100', 'visible');
            } else {
                scrollTopBtn.classList.remove('opacity-100', 'visible');
                scrollTopBtn.classList.add('opacity-0', 'invisible');
            }
        });

        scrollTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.classList.add('shadow-xl', 'bg-white/95', 'backdrop-blur-md');
            } else {
                header.classList.remove('shadow-xl', 'bg-white/95', 'backdrop-blur-md');
            }
        });

        // Animate on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                    entry.target.classList.remove('opacity-0', 'translate-y-10');
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.group, .stat-item, .about-text').forEach(el => {
            el.classList.add('opacity-0', 'translate-y-10', 'transition-all', 'duration-700', 'ease-out');
            observer.observe(el);
        });

        // Parallax effect for hero
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.bg-gradient-to-br');
            const speed = scrolled * 0.5;
            hero.style.transform = `translateY(${speed}px)`;
        });
    </script>

</body>
</html>
</echo>