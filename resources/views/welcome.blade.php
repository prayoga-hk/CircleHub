<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Temukan Komunitas Hobimu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0B0F19] text-white font-sans min-h-screen antialiased flex flex-col justify-between">

    <!-- NAVBAR -->
    <header class="max-w-6xl mx-auto w-full px-6 py-6 flex justify-between items-center sticky top-0 bg-[#0B0F19]/90 backdrop-blur-md z-50">
        <div class="flex items-center space-x-3">
            <img src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png" alt="CircleHub Logo" class="w-16 *: h-16 object-contain block" />
            <span class="text-xl font-bold tracking-tight text-white">CircleHub</span>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex items-center space-x-6 text-xs font-medium text-gray-300">
            <a href="#beranda" class="hover:text-white transition">Beranda</a>
            <a href="#tentang-kami" class="hover:text-white transition">Tentang kami</a>
            <a href="#fitur" class="hover:text-white transition">Fitur</a>
            <a href="/register" class="bg-[#5046E5] hover:bg-indigo-600 text-white font-semibold px-4 py-1.5 rounded-md transition">
                Daftar
            </a>
            <a href="/login" class="bg-[#1A202C] hover:bg-gray-800 text-gray-200 font-semibold px-4 py-1.5 rounded-md transition">
                login
            </a>
        </nav>
    </header>

    <!-- HERO SECTION (Beranda) -->
    <section id="beranda" class="max-w-6xl mx-auto w-full px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-white">
                Temukan Komunitas<br>Hobimu
            </h1>
            <p class="text-gray-400 text-sm leading-relaxed max-w-md">
                Circlehub adalah tempat bagi kamu untuk menemukan hobi baru, terhubung dengan komunitas seru, dan berkembang bersama
            </p>
            <div class="flex items-center space-x-4 pt-4">
                <a href="/register" class="bg-[#5046E5] hover:bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                    Daftar
                </a>
                <a href="/login" class="bg-[#1A202C] hover:bg-gray-800 text-gray-200 font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                    Masuk
                </a>
            </div>
        </div>

        <div class="flex justify-center items-center">
            <div class="w-108 max-w-108">
                <img src="https://cdn.phototourl.com/member/2026-10-08-9f49b445-a560-45e5-82fd-d6efec6477a1.png" alt="Hero Illustration" class="w-full h-auto object-contain block opacity-90" />
            </div>
        </div>
    </section>

    <section class="max-w-6xl mx-auto w-full px-6 py-8">
        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-3">
            @php
                $categories = ['Tech/Dev', 'Sports', 'Gaming', 'Music', 'Anime', 'Cosplay', 'Art'];
            @endphp
            @foreach($categories as $category)
                <button class="bg-[#1A202C] hover:bg-gray-800 text-gray-300 py-2.5 rounded-lg text-xs font-semibold text-center transition border border-gray-800/40">
                    {{ $category }}
                </button>
            @endforeach
        </div>
    </section>

    <!-- entang Kami -->
    <section id="tentang-kami" class="max-w-6xl mx-auto w-full px-6 py-16 scroll-mt-20">
        <h2 class="text-2xl md:text-3xl font-bold text-center text-white mb-12">
            Apa itu CircleHub
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="w-full h-64 md:h-72 bg-[#151B28] rounded-2xl border border-gray-800 overflow-hidden relative flex items-center justify-center">
                <img src="https://via.placeholder.com/500x350/151B28/FFFFFF?text=CircleHub+App+UI+Preview" alt="CircleHub UI Preview" class="w-full h-full object-cover" />
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-bold text-white">
                    Rumah untuk Setiap Passion & Komunitas
                </h3>
                <p class="text-gray-400 text-xs md:text-sm leading-relaxed">
                    CircleHub adalah platform sosial tempat kamu bisa menemukan, berbagi, dan berkembang bersama orang-orang yang memiliki minat serupa. Baik kamu seorang coder, gamer, seniman, maupun pencinta alam, CircleHub menghubungkanmu dengan circle yang tepat.
                </p>
            </div>
        </div>
    </section>

    <!-- FITUR UTAMA -->
    <section id="fitur" class="max-w-5xl mx-auto w-full px-6 py-12 scroll-mt-20">
        <h2 class="text-2xl font-bold text-center text-white mb-10">
            Fitur Utama
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-[#151B28] rounded-2xl p-6 border border-gray-800/60 relative space-y-3">
                <div class="flex items-center space-x-3">
                    <span class="bg-[#5046E5] text-white font-bold text-lg px-3 py-1 rounded-lg">01</span>
                    <h3 class="text-base font-bold text-white">Tampilan Modern</h3>
                </div>
                <p class="text-gray-400 text-xs leading-relaxed pl-12">
                    Tersedia opsi gelap yang konsisten di semua perangkat, membuat pengguna betah berselancar tanpa membuat mata cepat lelah.
                </p>
            </div>

            <div class="bg-[#151B28] rounded-2xl p-6 border border-gray-800/60 relative space-y-3">
                <div class="flex items-center space-x-3">
                    <span class="bg-[#5046E5] text-white font-bold text-lg px-3 py-1 rounded-lg">02</span>
                    <h3 class="text-base font-bold text-white">Interaksi Komunitas</h3>
                </div>
                <p class="text-gray-400 text-xs leading-relaxed pl-12">
                    Pengguna dapat saling memberikan apresiasi berupa like dan bertukar pikiran melalui kolom komentar pada setiap postingan di linimasa.
                </p>
            </div>

            <div class="bg-[#151B28] rounded-2xl p-6 border border-gray-800/60 relative space-y-3">
                <div class="flex items-center space-x-3">
                    <span class="bg-[#5046E5] text-white font-bold text-lg px-3 py-1 rounded-lg">03</span>
                    <h3 class="text-base font-bold text-white">Ruang Diskusi Aman</h3>
                </div>
                <p class="text-gray-400 text-xs leading-relaxed pl-12">
                    Dilengkapi panel kendali khusus bagi Admin untuk menangani postingan yang melanggar aturan demi menjaga komunitas tetap kondusif.
                </p>
            </div>

            <div class="bg-[#151B28] rounded-2xl p-6 border border-gray-800/60 relative space-y-3">
                <div class="flex items-center space-x-3">
                    <span class="bg-[#5046E5] text-white font-bold text-lg px-3 py-1 rounded-lg">04</span>
                    <h3 class="text-base font-bold text-white">Showcase Proyek</h3>
                </div>
                <p class="text-gray-400 text-xs leading-relaxed pl-12">
                    Pamerkan galeri portofolio hobi, koleksi unik, atau pameran karya untuk mendapat feedback bermanfaat.
                </p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-[#080B12] border-t border-gray-800/50 mt-16 py-12">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-xs text-gray-400">
            <div class="space-y-2">
                <h4 class="text-white font-bold mb-3 text-sm">Contact</h4>
                <p>IG: @bimbimjoevanka</p>
                <p>WA: 085726694073</p>
            </div>

            <div class="space-y-2">
                <h4 class="text-white font-bold mb-3 text-sm">Follow Us</h4>
                <p>Follow Updates</p>
            </div>

            <div class="space-y-2">
                <h4 class="text-white font-bold mb-3 text-sm">Software</h4>
                <p><a href="#beranda" class="hover:text-white transition">Home</a></p>
                <p><a href="#tentang-kami" class="hover:text-white transition">Tentang</a></p>
            </div>

            <div class="space-y-2">
                <h4 class="text-white font-bold mb-3 text-sm">Social</h4>
                <p><a href="#" class="hover:text-white transition">Email</a></p>
                <p><a href="#" class="hover:text-white transition">Whatsapp</a></p>
            </div>
        </div>
    </footer>

</body>
</html>
