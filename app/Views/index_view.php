<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#E1B44C',    // Mustard Yellow (Brand Color)
                        primaryDark: '#D9A441', // Mustard Dark untuk hover
                        secondary: '#1F1F1F',  // Dark Charcoal (Background Gelap)
                        accent: '#9C3A2F',     // Terracotta (Aksen)
                        supporting: '#8B5A2B', // Cokelat Kayu
                        neutral: '#F5F5F5'     // Abu terang
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-gray-900">
    <!-- Navbar -->
    <nav class="bg-white sticky top-0 z-50 shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= base_url() ?>" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primaryDark rounded-lg flex items-center justify-center">
                        <i class="fas fa-key text-secondary"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">SmartKos</span>
                </a>
                
                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-1">
                    <a href="#keunggulan" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition">Keunggulan</a>
                    <a href="#galeri" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition">Galeri</a>
                    <a href="#testimoni" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition">Testimoni</a>
                    <a href="#kontak" class="px-3 py-2 text-gray-700 hover:text-primary font-medium transition">Kontak</a>
                </div>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="<?= route_to('login') ?>" class="px-4 py-2 bg-primary text-secondary rounded-lg hover:bg-primaryDark font-medium transition">
                        Login
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="navToggle" class="md:hidden text-gray-700 hover:text-primary">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden border-t border-gray-200 py-4 space-y-2">
                <a href="#keunggulan" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Keunggulan</a>
                <a href="#galeri" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Galeri</a>
                <a href="#testimoni" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Testimoni</a>
                <a href="#kontak" class="block px-4 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">Kontak</a>
                <div class="pt-4 space-y-2 border-t border-gray-200">
                    <a href="<?= route_to('login') ?>" class="block px-4 py-2 bg-primary text-secondary rounded-lg text-center font-medium">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-neutral to-white py-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-6">
                        Temukan Hunian <span class="text-primary">Impianmu</span> di SmartKos
                    </h1>
                    <p class="text-lg text-gray-600 mb-8">
                        Pesan kamar kos dengan mudah, aman, dan terpercaya. Sistem manajemen modern untuk kenyamanan maksimal Anda.
                    </p>

                    <!-- Search Form -->
                    <div class="flex flex-col sm:flex-row gap-3 mb-8">
                        <input type="text" placeholder="Cari lokasi atau fasilitas..." class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent">
                        <button class="px-6 py-3 bg-primary text-secondary font-semibold rounded-lg hover:bg-primaryDark transition duration-200">
                        </button>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#keunggulan" class="px-6 py-3 border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-secondary transition text-center">
                            <i class="fas fa-info-circle mr-2"></i>Pelajari Lebih
                        </a>
                    </div>
                </div>

                <!-- Right Image -->
                <div class="hidden lg:block">
                    <img src="<?= base_url('img/kos/depankos.jpeg') ?>" alt="Hunian Modern" class="rounded-2xl shadow-2xl w-full h-96 object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="keunggulan" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Mengapa Memilih SmartKos?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kami menyediakan solusi hunian terbaik dengan fasilitas lengkap dan layanan profesional</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 bg-gradient-to-br from-neutral to-white rounded-xl hover:shadow-lg transition duration-300 border border-primary/20">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-couch text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Fasilitas Premium</h3>
                    <p class="text-gray-600 text-sm">AC, kamar mandi dalam, Wi-Fi super cepat, dan meja belajar tersedia di setiap unit</p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-gradient-to-br from-neutral to-white rounded-xl hover:shadow-lg transition duration-300 border border-primary/20">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-shield-alt text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Keamanan 24/7</h3>
                    <p class="text-gray-600 text-sm">CCTV 24 jam, akses kartu pintar, dan penjaga kos yang sigap setiap waktu</p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-gradient-to-br from-neutral to-white rounded-xl hover:shadow-lg transition duration-300 border border-primary/20">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-laptop text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Manajemen Digital</h3>
                    <p class="text-gray-600 text-sm">Booking, pembayaran, dan komunikasi dalam satu platform yang mudah digunakan</p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 bg-gradient-to-br from-neutral to-white rounded-xl hover:shadow-lg transition duration-300 border border-primary/20">
                    <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                        <i class="fas fa-map-marker-alt text-secondary text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Lokasi Strategis</h3>
                    <p class="text-gray-600 text-sm">Dekat kampus, pusat perbelanjaan, dan transportasi publik yang mudah diakses</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimoni" class="py-20 px-4 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Apa Kata Mereka?</h2>
                <p class="text-lg text-gray-600">Ribuan pengguna telah merasakan kenyamanan tinggal di SmartKos</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Testimonial 1 -->
                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4 italic">"Sangat merekomendasikan SmartKos! Proses bookingnya cepat, huniannya nyaman, dan lingkungan kosnya bersih. Wi-Fi-nya juga kencang untuk belajar online."</p>
                    <div class="border-t pt-4">
                        <p class="font-semibold text-gray-900">Dinda S.</p>
                        <p class="text-sm text-gray-600">Mahasiswa</p>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4 italic">"Sebagai pekerja, saya butuh tempat tenang dan aman. SmartKos memberikan itu semua. Lokasinya strategis, dekat kantor, dan keamanannya modern."</p>
                    <div class="border-t pt-4">
                        <p class="font-semibold text-gray-900">Rian P.</p>
                        <p class="text-sm text-gray-600">Karyawan Swasta</p>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="flex items-center mb-4">
                        <div class="flex text-primary">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4 italic">"Puas dengan pelayanan di sini. Tim responsif ketika ada kendala. Pembayaran bulanan jadi lebih mudah pakai aplikasi. Solusi hunian modern yang sempurna!"</p>
                    <div class="border-t pt-4">
                        <p class="font-semibold text-gray-900">Putra A.</p>
                        <p class="text-sm text-gray-600">Digital Freelancer</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600">Punya pertanyaan? Jangan ragu untuk menghubungi kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Contact Info 1 -->
                <div class="p-8 bg-gradient-to-br from-neutral to-white rounded-xl text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-map-marker-alt text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600">Jl. Kebenaran No.08, Kurao Pagang, Nanggalo, Kota Padang, Sumatera Barat 25118</p>
                </div>

                <!-- Contact Info 2 -->
                <div class="p-8 bg-gradient-to-br from-neutral to-white rounded-xl text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-phone-alt text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600">+62 812 3456 7890</p>
                    <p class="text-sm text-gray-600 mt-2">Admin: Senin - Jumat, 09:00 - 17:00</p>
                </div>

                <!-- Contact Info 3 -->
                <div class="p-8 bg-gradient-to-br from-neutral to-white rounded-xl text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-primary rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg">
                        <i class="fas fa-envelope text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">info@smartkos-agezitomik.com</p>
                    <p class="text-sm text-gray-600 mt-2">Respons dalam 24 jam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <!-- About -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <i class="fas fa-key text-secondary"></i>
                        </div>
                        <span class="text-lg font-bold text-white">SmartKos</span>
                    </div>
                    <p class="text-sm text-gray-400">Platform penyewaan kamar kos modern yang memudahkan Anda menemukan hunian impian.</p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#keunggulan" class="text-gray-400 hover:text-white transition">Keunggulan</a></li>
                        <li><a href="#galeri" class="text-gray-400 hover:text-white transition">Galeri</a></li>
                        <li><a href="#testimoni" class="text-gray-400 hover:text-white transition">Testimoni</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                        <li><a href="#kontak" class="text-gray-400 hover:text-white transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Social -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-primary text-xl transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-gray-400 hover:text-primary text-xl transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-pink-400 text-xl transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-red-400 text-xl transition"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 text-center text-sm text-gray-400">
                <p>&copy; 2025 SmartKos Agezitomik. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('navToggle')?.addEventListener('click', function(){
            const menu = document.getElementById('mobileMenu');
            if (menu) menu.classList.toggle('hidden');
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                        document.getElementById('mobileMenu')?.classList.add('hidden');
                    }
                }
            });
        });
    </script>

</body>
</html>