
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0B0F19">

    <title>CircleHub — Temukan Komunitas Hobimu</title>
    <meta name="description" content="Temukan komunitas hobi, bagikan karya, dan berkembang bersama CircleHub.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            color-scheme: dark;
            --bg: #0B0F19;
            --surface: #151B28;
            --surface-light: #1A202C;
            --primary: #5046E5;
            --violet: #8B5CF6;
            --cyan: #22D3EE;
            --text: #F8FAFC;
            --muted: #94A3B8;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
        }

        a, button {
            -webkit-tap-highlight-color: transparent;
        }

        a:focus-visible, button:focus-visible {
            outline: 2px solid var(--cyan);
            outline-offset: 4px;
        }

        .page-glow {
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            filter: blur(110px);
            opacity: .15;
            pointer-events: none;
        }

        .glow-purple {
            background: #6D4AFF;
        }

        .glow-blue {
            background: #176BFF;
        }

        .gradient-text {
            background: linear-gradient(100deg, #A78BFA 0%, #7567FF 48%, #38BDF8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .glass-card {
            background: linear-gradient(
                145deg,
                rgba(26, 32, 44, .94),
                rgba(15, 23, 42, .78)
            );
            border: 1px solid rgba(129, 140, 248, .20);
            box-shadow: 0 12px 40px rgba(0, 0, 0, .15);
            transition: transform .3s ease, border-color .3s ease,
                        box-shadow .3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            border-color: rgba(139, 92, 246, .65);
            box-shadow: 0 15px 40px rgba(80, 70, 229, .12);
        }

        .primary-button {
            background: linear-gradient(110deg, #8B5CF6, #5046E5);
            box-shadow: 0 5px 25px rgba(80, 70, 229, .22);
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, .4);
        }

        .outline-button {
            border: 1px solid rgba(139, 92, 246, .55);
            background: rgba(15, 23, 42, .65);
            transition: background .2s ease, border-color .2s ease;
        }

        .outline-button:hover {
            background: rgba(80, 70, 229, .16);
            border-color: #8B5CF6;
        }

        .category-chip {
            border: 1px solid rgba(99, 102, 241, .25);
            background: rgba(26, 32, 44, .78);
            transition: .25s ease;
        }

        .category-chip:hover {
            border-color: #8B5CF6;
            background: rgba(80, 70, 229, .2);
            transform: translateY(-3px);
        }

        .section-label {
            border: 1px solid rgba(34, 211, 238, .3);
            background: rgba(34, 211, 238, .06);
        }

        .dashboard-sidebar {
            background: rgba(8, 12, 28, .78);
        }

        .dashboard-active {
            background: linear-gradient(90deg, rgba(80, 70, 229, .4), rgba(80, 70, 229, .08));
            border: 1px solid rgba(139, 92, 246, .18);
        }

        .hero-orb {
            animation: float 6s ease-in-out infinite;
        }

        .hero-orb-delay {
            animation: float 7s ease-in-out 1s infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .feature-number {
            background: linear-gradient(140deg, #8B5CF6, #5046E5);
            box-shadow: 0 5px 20px rgba(80, 70, 229, .25);
        }

        .footer-link {
            transition: color .2s ease;
        }

        .footer-link:hover {
            color: #A78BFA;
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body class="min-h-screen antialiased">

    <!-- BACKGROUND DECORATION -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="page-glow glow-purple" style="top: 0; right: -120px;"></div>
        <div class="page-glow glow-blue" style="top: 700px; left: -180px;"></div>
        <div class="absolute inset-0 opacity-[0.035]"
             style="background-image: radial-gradient(#A5B4FC 1px, transparent 1px); background-size: 30px 30px;">
        </div>
    </div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 border-b border-white/[0.06] bg-[#0B0F19]/90 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="h-[76px] flex items-center justify-between gap-4">

                <a href="#beranda" class="flex items-center gap-2.5 shrink-0">
                    <img
                        src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png"
                        alt="Logo CircleHub"
                        class="w-10 h-10 object-contain"
                    >
                    <span class="text-xl font-extrabold tracking-tight">
                        Circle<span class="gradient-text">Hub</span>
                    </span>
                </a>

                <nav class="hidden md:flex items-center gap-7 text-sm text-gray-400">
                    <a href="#beranda" class="text-white hover:text-violet-300 transition">Beranda</a>
                    <a href="#tentang-kami" class="hover:text-violet-300 transition">Tentang Kami</a>
                    <a href="#fitur" class="hover:text-violet-300 transition">Fitur</a>
                    <a href="#kategori" class="hover:text-violet-300 transition">Kategori</a>
                </nav>

                <div class="flex items-center gap-2.5 sm:gap-3">
                    <a href="/login"
                       class="hidden sm:inline-flex px-5 py-2.5 rounded-xl text-sm text-gray-300 outline-button">
                        Masuk
                    </a>

                    <a href="/register"
                       class="primary-button inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl text-sm font-semibold text-white">
                        Daftar <span aria-hidden="true">↗</span>
                    </a>

                    <button
                        id="mobile-menu-button"
                        type="button"
                        aria-label="Buka menu navigasi"
                        aria-expanded="false"
                        aria-controls="mobile-menu"
                        class="md:hidden w-10 h-10 rounded-xl outline-button flex items-center justify-center text-xl"
                    >
                        ☰
                    </button>
                </div>
            </div>

            <!-- MOBILE NAVIGATION -->
            <nav id="mobile-menu" class="hidden md:hidden pb-5">
                <div class="grid gap-2 text-sm text-gray-300">
                    <a href="#beranda" class="rounded-lg px-4 py-3 hover:bg-white/5">Beranda</a>
                    <a href="#tentang-kami" class="rounded-lg px-4 py-3 hover:bg-white/5">Tentang Kami</a>
                    <a href="#kategori" class="rounded-lg px-4 py-3 hover:bg-white/5">Kategori</a>
                    <a href="#fitur" class="rounded-lg px-4 py-3 hover:bg-white/5">Fitur</a>
                    <a href="/login" class="rounded-lg px-4 py-3 hover:bg-white/5">Masuk</a>
                </div>
            </nav>
        </div>
    </header>

    <main>

        <!-- HERO / BERANDA -->
        <section id="beranda" class="relative max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-14 sm:pt-20 pb-12 sm:pb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-6 items-center">

                <div class="relative z-10 max-w-2xl">

                    <div class="inline-flex items-center gap-2 rounded-full section-label px-4 py-2 mb-7 text-xs sm:text-sm text-cyan-300">
                        <span class="w-2 h-2 rounded-full bg-cyan-300 animate-pulse"></span>
                        Komunitas Hobi, Satu Tempat
                        <span aria-hidden="true">✦</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-[1.12] tracking-tight">
                        Temukan Komunitas
                        <span class="gradient-text block mt-1">Hobimu.</span>
                    </h1>

                    <p class="mt-6 max-w-lg text-gray-400 text-base sm:text-lg leading-8">
                        CircleHub adalah tempat bagi kamu untuk menemukan hobi baru,
                        terhubung dengan komunitas seru, dan berkembang bersama
                        orang-orang yang memiliki passion yang sama.
                    </p>

                    <div class="flex flex-wrap gap-3 mt-8">
                        <a href="/register"
                           class="primary-button inline-flex items-center gap-3 rounded-xl px-6 py-3.5 font-semibold text-sm sm:text-base">
                            Daftar Sekarang <span class="text-lg" aria-hidden="true">→</span>
                        </a>

                        <a href="/login"
                           class="outline-button inline-flex items-center gap-3 rounded-xl px-6 py-3.5 font-semibold text-sm sm:text-base text-gray-200">
                            Masuk ke Akun
                        </a>
                    </div>

                    <div class="mt-8 flex items-center gap-4">
                        <div class="flex -space-x-3">
                            <span class="w-10 h-10 rounded-full bg-violet-500 border-2 border-[#0B0F19] flex items-center justify-center text-lg">🎮</span>
                            <span class="w-10 h-10 rounded-full bg-blue-500 border-2 border-[#0B0F19] flex items-center justify-center text-lg">📷</span>
                            <span class="w-10 h-10 rounded-full bg-pink-500 border-2 border-[#0B0F19] flex items-center justify-center text-lg">🎨</span>
                            <span class="w-10 h-10 rounded-full bg-cyan-500 border-2 border-[#0B0F19] flex items-center justify-center text-lg">🎵</span>
                        </div>

                        <div>
                            <p class="text-sm font-semibold text-white">Temukan circle-mu</p>
                            <p class="text-xs sm:text-sm text-gray-500 mt-1">Mulai perjalanan hobimu bersama CircleHub.</p>
                        </div>
                    </div>
                </div>

                <!-- HERO ILLUSTRATION -->
                <div class="relative min-w-0">
                    <div class="absolute inset-10 rounded-full bg-violet-600/20 blur-[90px]"></div>
                    <div class="absolute top-8 right-12 w-20 h-20 border border-violet-400/20 rounded-3xl rotate-12"></div>
                    <div class="absolute bottom-12 left-4 w-14 h-14 border border-cyan-400/20 rounded-2xl -rotate-12"></div>

                    <div class="relative hero-orb">
                        <img
                            src="https://cdn.phototourl.com/member/2026-10-08-9f49b445-a560-45e5-82fd-d6efec6477a1.png"
                            alt="Ilustrasi orang-orang yang berkumpul dan mengeksplorasi hobi bersama"
                            fetchpriority="high"
                            class="relative z-10 w-full max-w-2xl mx-auto h-auto object-contain drop-shadow-[0_15px_40px_rgba(80,70,229,0.2)]"
                        >
                    </div>

                    <div class="hero-orb absolute top-[12%] left-0 sm:left-2 z-20 glass-card rounded-2xl px-4 py-3 flex items-center gap-3">
                        <span class="text-2xl">🎮</span>
                        <div>
                            <p class="text-xs font-bold text-white">Gaming</p>
                            <p class="text-[10px] text-gray-400">Main bareng</p>
                        </div>
                    </div>

                    <div class="hero-orb-delay absolute bottom-[12%] right-0 sm:right-2 z-20 glass-card rounded-2xl px-4 py-3 flex items-center gap-3">
                        <span class="text-2xl">🎨</span>
                        <div>
                            <p class="text-xs font-bold text-white">Creative Space</p>
                            <p class="text-[10px] text-gray-400">Berkarya bersama</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- KATEGORI HOBI -->
        <section id="kategori" class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pb-16">
            <div class="glass-card rounded-3xl p-4 sm:p-5">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5 px-1">
                    <div>
                        <p class="text-white font-semibold">Jelajahi minatmu</p>
                        <p class="text-gray-500 text-xs sm:text-sm mt-1">Temukan komunitas sesuai hobimu.</p>
                    </div>
                    <span class="text-xs text-violet-300">Pilih passion-mu ✦</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-7 gap-3">
                    @php
                        $categories = [
                            ['name' => 'Tech/Dev', 'icon' => '💻'],
                            ['name' => 'Sports', 'icon' => '⚽'],
                            ['name' => 'Gaming', 'icon' => '🎮'],
                            ['name' => 'Music', 'icon' => '🎵'],
                            ['name' => 'Anime', 'icon' => '🌸'],
                            ['name' => 'Cosplay', 'icon' => '🎭'],
                            ['name' => 'Art', 'icon' => '🎨'],
                        ];
                    @endphp

                    @foreach($categories as $category)
                        <a href="/login"
                           aria-label="Jelajahi kategori {{ $category['name'] }}"
                           class="category-chip flex items-center justify-center gap-2 rounded-2xl px-3 py-4 text-sm text-gray-300">
                            <span class="text-xl">{{ $category['icon'] }}</span>
                            <span class="font-medium">{{ $category['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- TENTANG CIRCLEHUB -->
        <section id="tentang-kami" class="relative max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 sm:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                <!-- MOCKUP DASHBOARD -->
                <div class="relative min-w-0">
                    <div class="absolute inset-5 rounded-3xl bg-violet-600/20 blur-[65px]"></div>

                    <div class="relative glass-card rounded-2xl sm:rounded-3xl p-3 sm:p-5">
                        <div class="flex items-center justify-between px-2 pb-4 border-b border-white/[0.07]">
                            <div class="flex items-center gap-2">
                                <span class="text-violet-400 text-lg">✦</span>
                                <span class="font-bold text-sm">CircleHub</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span class="text-[10px] text-gray-400">Community space</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-[85px_minmax(0,1fr)] sm:grid-cols-[115px_minmax(0,1fr)] gap-3 pt-4">
                            <aside class="dashboard-sidebar rounded-xl p-2 space-y-2 text-[10px] text-gray-400">
                                <div class="dashboard-active rounded-lg p-2 text-violet-200">⌂ Beranda</div>
                                <div class="rounded-lg p-2">◉ Komunitas</div>
                                <div class="rounded-lg p-2">▤ Postingan</div>
                                <div class="rounded-lg p-2">♡ Disukai</div>
                                <div class="rounded-lg p-2">♙ Profil</div>
                            </aside>

                            <div class="min-w-0 space-y-4">
                                <div class="flex items-center justify-between gap-2">
                                    <div class="bg-[#0B0F19] border border-white/[0.06] rounded-lg px-3 py-2 text-[10px] text-gray-500 flex-1">
                                        🔎 Cari komunitas...
                                    </div>
                                    <div class="w-8 h-8 rounded-lg bg-violet-500/20 flex items-center justify-center">🔔</div>
                                </div>

                                <div class="rounded-xl overflow-hidden border border-violet-400/20 bg-gradient-to-r from-violet-900/50 to-[#111827] p-3 sm:p-4">
                                    <p class="text-[10px] text-violet-300 mb-1">KOMUNITAS PILIHAN</p>
                                    <div class="flex items-center justify-between gap-2">
                                        <div>
                                            <h3 class="text-xs sm:text-sm font-bold text-white">Gaming Community</h3>
                                            <p class="text-[10px] text-gray-400 mt-1">Bermain · Diskusi · Teman baru</p>
                                        </div>
                                        <span class="text-2xl">🎮</span>
                                    </div>
                                    <div class="mt-3 inline-flex rounded-lg primary-button px-3 py-1.5 text-[10px] font-semibold">
                                        Temukan komunitas
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-xs font-semibold mb-3">Rekomendasi Hobi</h3>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                                        <div class="rounded-xl border border-white/[0.07] bg-[#0B0F19]/70 p-2.5">
                                            <div class="rounded-lg bg-gradient-to-br from-violet-500/30 to-pink-500/20 h-12 flex items-center justify-center text-2xl">🌸</div>
                                            <p class="text-[10px] font-semibold mt-2">Anime Lovers</p>
                                            <p class="text-[9px] text-gray-500 mt-1">Berbagi kesukaan</p>
                                        </div>
                                        <div class="rounded-xl border border-white/[0.07] bg-[#0B0F19]/70 p-2.5">
                                            <div class="rounded-lg bg-gradient-to-br from-blue-500/30 to-cyan-500/20 h-12 flex items-center justify-center text-2xl">📷</div>
                                            <p class="text-[10px] font-semibold mt-2">Photography</p>
                                            <p class="text-[9px] text-gray-500 mt-1">Berburu momen</p>
                                        </div>
                                        <div class="hidden sm:block rounded-xl border border-white/[0.07] bg-[#0B0F19]/70 p-2.5">
                                            <div class="rounded-lg bg-gradient-to-br from-pink-500/30 to-purple-500/20 h-12 flex items-center justify-center text-2xl">🎵</div>
                                            <p class="text-[10px] font-semibold mt-2">Music Vibes</p>
                                            <p class="text-[9px] text-gray-500 mt-1">Berbagi musik</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-white/[0.07] flex items-center justify-between text-[10px] text-gray-500">
                            <span>Temukan circle-mu.</span>
                            <span class="text-cyan-300">Explore together ↗</span>
                        </div>
                    </div>

                    <div class="hidden sm:block absolute -left-4 bottom-12 glass-card rounded-xl px-4 py-3">
                        <p class="text-xs font-semibold">💜 Satu minat, banyak cerita</p>
                        <p class="text-[10px] text-gray-400 mt-1">Tumbuh bersama komunitasmu</p>
                    </div>
                </div>

                <!-- ABOUT COPY -->
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full section-label px-4 py-2 text-xs font-medium text-cyan-300 mb-6">
                        <span>✦</span> Tentang CircleHub
                    </div>

                    <h2 class="text-3xl sm:text-4xl lg:text-[42px] font-extrabold leading-tight tracking-tight">
                        Rumah untuk Setiap
                        <span class="gradient-text">Pecinta Hobi & Komunitas.</span>
                    </h2>

                    <div class="mt-5 w-20 h-1 rounded-full bg-gradient-to-r from-violet-500 to-cyan-400"></div>

                    <p class="mt-6 text-gray-400 text-sm sm:text-base leading-8">
                        CircleHub bukan hanya sekadar platform, tetapi juga ruang
                        untuk berbagi, belajar, dan bertumbuh bersama orang-orang
                        dengan minat yang sama.
                    </p>

                    <p class="mt-4 text-gray-400 text-sm sm:text-base leading-8">
                        Baik kamu seorang programmer, gamer, seniman, maupun
                        pencinta alam, CircleHub membantumu menemukan teman baru,
                        mengikuti diskusi, dan membagikan karya bersama komunitas.
                    </p>

                    <a href="#fitur"
                       class="outline-button inline-flex items-center gap-3 rounded-xl px-5 py-3 mt-8 text-sm font-semibold">
                        Kenali Fitur Kami <span aria-hidden="true">→</span>
                    </a>

                    <div class="grid grid-cols-2 gap-4 mt-9">
                        <div class="border-l-2 border-violet-500 pl-4">
                            <p class="text-sm font-bold text-white">Satu Platform</p>
                            <p class="text-xs text-gray-500 mt-1">Beragam minat dan hobi</p>
                        </div>
                        <div class="border-l-2 border-cyan-400 pl-4">
                            <p class="text-sm font-bold text-white">Satu Komunitas</p>
                            <p class="text-xs text-gray-500 mt-1">Berbagi dan berkembang</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FITUR UTAMA -->
        <section id="fitur" class="relative border-y border-white/[0.05] bg-gradient-to-b from-[#11172A]/70 via-[#0B0F19] to-[#10162A]/70">
            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-20 sm:py-24">

                <div class="text-center max-w-2xl mx-auto mb-12 sm:mb-16">
                    <div class="inline-flex items-center gap-2 rounded-full section-label px-4 py-2 text-xs font-medium text-cyan-300">
                        ✦ Fitur Utama
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-extrabold mt-5 tracking-tight">
                        Kenapa Harus <span class="gradient-text">CircleHub?</span>
                    </h2>

                    <p class="text-gray-400 text-sm sm:text-base mt-4 leading-7">
                        Semua yang kamu butuhkan untuk menikmati hobi,
                        menemukan teman, dan berkembang ada di sini.
                    </p>
                </div>

                @php
                    $features = [
                        [
                            'number' => '01',
                            'icon' => '✦',
                            'color' => 'from-violet-500 to-indigo-600',
                            'title' => 'Tampilan Modern',
                            'description' => 'Desain modern dengan tema gelap yang konsisten dan nyaman digunakan saat menjelajahi setiap halaman.'
                        ],
                        [
                            'number' => '02',
                            'icon' => '♧',
                            'color' => 'from-blue-500 to-cyan-500',
                            'title' => 'Interaksi Komunitas',
                            'description' => 'Berikan apresiasi melalui like dan bertukar pikiran melalui komentar pada postingan anggota.'
                        ],
                        [
                            'number' => '03',
                            'icon' => '⬡',
                            'color' => 'from-cyan-400 to-teal-500',
                            'title' => 'Ruang Diskusi Aman',
                            'description' => 'Panel kendali admin membantu menangani postingan yang melanggar aturan dan menjaga komunitas tetap kondusif.'
                        ],
                        [
                            'number' => '04',
                            'icon' => '⌘',
                            'color' => 'from-orange-400 to-amber-500',
                            'title' => 'Showcase Proyek',
                            'description' => 'Bagikan karya, koleksi, ide kreatif, dan hasil proyek hobi untuk memperoleh masukan dari komunitas.'
                        ],
                    ];
                @endphp

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 lg:gap-6">
                    @foreach($features as $feature)
                        <article class="glass-card rounded-2xl sm:rounded-3xl p-6 sm:p-7">
                            <div class="flex items-start gap-4 sm:gap-5">

                                <div class="shrink-0 flex flex-col gap-3 items-center">
                                    <span class="feature-number rounded-2xl w-14 h-14 sm:w-16 sm:h-16 flex items-center justify-center text-xl sm:text-2xl font-extrabold">
                                        {{ $feature['number'] }}
                                    </span>
                                    <span class="w-12 h-12 rounded-xl bg-white/[0.04] border border-white/[0.06] flex items-center justify-center text-2xl text-violet-300">
                                        {{ $feature['icon'] }}
                                    </span>
                                </div>

                                <div class="flex-1 min-w-0 pt-1">
                                    <div class="flex items-center justify-between gap-3">
                                        <h3 class="text-base sm:text-lg font-bold text-white">
                                            {{ $feature['title'] }}
                                        </h3>
                                        <span class="text-gray-500 text-xl shrink-0" aria-hidden="true">↗</span>
                                    </div>

                                    <p class="mt-3 text-gray-400 text-sm leading-7">
                                        {{ $feature['description'] }}
                                    </p>

                                    <div class="mt-5 h-1 w-full rounded-full bg-white/[0.05] overflow-hidden">
                                        <div class="h-full w-1/3 rounded-full bg-gradient-to-r {{ $feature['color'] }}"></div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- CTA BANNER -->
                <div class="relative overflow-hidden rounded-3xl mt-12 sm:mt-16 p-7 sm:p-10 lg:p-12 border border-violet-400/20 bg-gradient-to-r from-violet-950/80 via-[#171A3B] to-[#0D2536]">
                    <div class="absolute -right-12 -top-24 w-64 h-64 bg-violet-500/20 rounded-full blur-[70px]"></div>
                    <div class="absolute right-28 bottom-0 w-40 h-40 bg-cyan-400/10 rounded-full blur-[60px]"></div>

                    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-7">
                        <div class="max-w-2xl">
                            <p class="text-cyan-300 text-xs font-semibold tracking-[0.2em] uppercase">
                                Your people are here
                            </p>
                            <h2 class="text-2xl sm:text-3xl font-extrabold mt-3 leading-snug">
                                Hobi yang sama.
                                <span class="gradient-text">Cerita yang berbeda.</span>
                            </h2>
                            <p class="text-sm text-gray-400 mt-4 leading-7">
                                Mulai perjalananmu bersama orang-orang yang memahami
                                passion-mu. Temukan komunitasmu di CircleHub.
                            </p>
                        </div>

                        <a href="/register"
                           class="primary-button shrink-0 inline-flex items-center justify-center gap-3 rounded-xl px-6 py-4 font-semibold text-sm">
                            Gabung CircleHub <span aria-hidden="true">→</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-[#080B12] border-t border-white/[0.07]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-14 pb-7">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

                <!-- BRAND -->
                <div>
                    <a href="#beranda" class="inline-flex items-center gap-2">
                        <img
                            src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png"
                            alt=""
                            class="w-10 h-10 object-contain"
                            loading="lazy"
                        >
                        <span class="text-lg font-extrabold">
                            Circle<span class="gradient-text">Hub</span>
                        </span>
                    </a>

                    <p class="text-sm text-gray-400 leading-7 mt-4 max-w-xs">
                        Hobi yang kamu cintai, komunitas yang kamu butuhkan.
                        Temukan circle-mu dan berkembang bersama.
                    </p>

                    <div class="flex gap-3 mt-5">
                        <a href="https://instagram.com/bimbimjoevanka"
                           target="_blank" rel="noopener noreferrer"
                           aria-label="Instagram CircleHub"
                           class="w-10 h-10 rounded-xl outline-button flex items-center justify-center text-gray-300 hover:text-white">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <rect x="3" y="3" width="18" height="18" rx="5"/>
                                <circle cx="12" cy="12" r="4"/>
                                <circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/>
                            </svg>
                        </a>

                        <a href="#fitur"
                           aria-label="Fitur CircleHub"
                           class="w-10 h-10 rounded-xl outline-button flex items-center justify-center text-gray-300 hover:text-white">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" aria-hidden="true">
                                <path d="M21.6 7.2a2.8 2.8 0 0 0-2-2C17.9 4.7 12 4.7 12 4.7s-5.9 0-7.6.5a2.8 2.8 0 0 0-2 2A29 29 0 0 0 2 12a29 29 0 0 0 .4 4.8 2.8 2.8 0 0 0 2 2c1.7.5 7.6.5 7.6.5s5.9 0 7.6-.5a2.8 2.8 0 0 0 2-2A29 29 0 0 0 22 12a29 29 0 0 0-.4-4.8ZM10 15.2V8.8l5.5 3.2Z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- CONTACT -->
                <div>
                    <h3 class="text-white font-bold text-sm mb-5">Kontak</h3>
                    <div class="space-y-4 text-sm text-gray-400">
                        <p class="flex items-start gap-3">
                            <span class="text-violet-400">✉</span>
                            <span>Email CircleHub</span>
                        </p>
                        <p class="flex items-start gap-3">
                            <span class="text-violet-400">⌖</span>
                            <span>Malang, Indonesia</span>
                        </p>
                        <p class="text-xs text-gray-600 leading-5">
                            Hubungi kami melalui saluran kontak resmi yang tersedia.
                        </p>
                    </div>
                </div>

                <!-- QUICK LINKS -->
                <div>
                    <h3 class="text-white font-bold text-sm mb-5">Quick Links</h3>
                    <div class="space-y-4 text-sm text-gray-400">
                        <a href="#beranda" class="footer-link flex justify-between gap-3">
                            Beranda <span>↗</span>
                        </a>
                        <a href="#tentang-kami" class="footer-link flex justify-between gap-3">
                            Tentang Kami <span>↗</span>
                        </a>
                        <a href="#kategori" class="footer-link flex justify-between gap-3">
                            Kategori <span>↗</span>
                        </a>
                        <a href="#fitur" class="footer-link flex justify-between gap-3">
                            Fitur <span>↗</span>
                        </a>
                    </div>
                </div>

                <!-- ACCOUNT -->
                <div>
                    <h3 class="text-white font-bold text-sm mb-5">Mulai Sekarang</h3>
                    <p class="text-sm text-gray-400 leading-7 mb-5">
                        Siap menemukan komunitas yang sesuai dengan hobimu?
                    </p>
                    <a href="/register" class="inline-flex items-center gap-2 text-sm font-semibold text-violet-300 hover:text-cyan-300 transition">
                        Buat Akun <span aria-hidden="true">→</span>
                    </a>

                    <div class="mt-5">
                        <a href="/login" class="footer-link text-sm text-gray-400">Sudah punya akun? Masuk</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/[0.07] mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-gray-500">
                <p>© {{ date('Y') }} CircleHub. All rights reserved.</p>
                <p>Dibuat dengan <span class="text-violet-400">♥</span> untuk komunitas yang lebih baik.</p>
            </div>
        </div>
    </footer>

    <!-- MOBILE MENU SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (!button || !menu) return;

            button.addEventListener('click', function () {
                const isHidden = menu.classList.contains('hidden');

                menu.classList.toggle('hidden', !isHidden);
                button.setAttribute('aria-expanded', String(isHidden));
                button.setAttribute(
                    'aria-label',
                    isHidden ? 'Tutup menu navigasi' : 'Buka menu navigasi'
                );
                button.textContent = isHidden ? '✕' : '☰';
            });

            menu.querySelectorAll('a').forEach(function (link) {
                link.addEventListener('click', function () {
                    menu.classList.add('hidden');
                    button.setAttribute('aria-expanded', 'false');
                    button.setAttribute('aria-label', 'Buka menu navigasi');
                    button.textContent = '☰';
                });
            });
        });
    </script>

</body>
</html>
