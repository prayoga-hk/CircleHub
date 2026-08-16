<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Temukan Komunitas Hobimu</title>
    <!-- Tailwind CSS CDN (atau jalankan via @vite('resources/css/app.css')) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkbg: '#0F121E',        /* Background utama gelap */
                        cardbg: '#181C2B',        /* Background card/hub */
                        pillPurple: '#5850EC',    /* Tombol/Tag Ungu */
                        activeBlue: '#3B82F6',    /* Tag Biru Aktif */
                        placeholderGrey: '#D1D5DB',/* Abu-abu placeholder */
                        badgeDark: '#1E2337',      /* Elemen badge dalam card */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darkbg text-white font-sans min-h-screen pb-20 antialiased">

    <!-- NAVBAR -->
    <header class="max-w-6xl mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <span class="text-xl font-bold tracking-tight text-white">CircleHub</span>
        </div>
        
        <nav class="flex items-center space-x-8 text-sm font-medium text-gray-300">
            <a href="#" class="hover:text-white transition">Beranda</a>
            <a href="#" class="hover:text-white transition">Komunitas</a>
            <a href="#" class="hover:text-white transition">Fitur</a>
            <a href="/register" class="bg-pillPurple hover:bg-indigo-600 text-white font-semibold px-5 py-2 rounded-lg transition text-xs">
                Daftar
            </a>
        </nav>
    </header>

    <!-- HERO SECTION -->
    <section class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Text Column -->
        <div class="space-y-6">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-white">
                Temukan Komunitas<br>Hobimu
            </h1>
            <p class="text-gray-400 text-sm md:text-base leading-relaxed max-w-md">
                CircleHub adalah tempat bagi kamu untuk menemukan hobi baru, terhubung dengan komunitas seru, dan berkembang bersama
            </p>
            <div class="flex items-center space-x-4 pt-2">
                <a href="/register" class="bg-pillPurple hover:bg-indigo-600 text-white font-semibold px-6 py-2.5 rounded-lg text-sm transition">
                    Daftar
                </a>
                <a href="/login" class="bg-[#1E2337] hover:bg-gray-800 text-gray-200 font-semibold px-6 py-2.5 rounded-lg text-sm border border-gray-700/50 transition">
                    Masuk
                </a>
            </div>
        </div>

        <!-- Mindmap Illustration (CircleHub SVG Graphic) -->
        <div class="flex justify-center items-center">
            <div class="relative w-80 h-80 flex justify-center items-center">
                <svg viewBox="0 0 300 300" class="w-full h-full">
                    <!-- Central Hub -->
                    <circle cx="150" cy="150" r="38" fill="#181C2B" stroke="#5850EC" stroke-width="2" />
                    <circle cx="150" cy="150" r="28" fill="#E07A5F" opacity="0.9"/>
                    <text x="150" y="146" text-anchor="middle" fill="#FFFFFF" font-size="12" font-weight="bold">H</text>
                    <text x="150" y="162" text-anchor="middle" fill="#FFFFFF" font-size="8" font-weight="bold">CircleHub</text>

                    <!-- Dashed Lines -->
                    <path d="M 150 112 L 150 65" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 178 122 L 220 85" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 188 150 L 235 150" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 178 178 L 220 215" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 150 188 L 150 235" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 122 178 L 80 215" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 112 150 L 65 150" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>
                    <path d="M 122 122 L 80 85" stroke="#374151" stroke-width="1.5" stroke-dasharray="3 3"/>

                    <!-- Outer Nodes -->
                    <circle cx="150" cy="50" r="18" fill="#181C2B" stroke="#06B6D4" stroke-width="1.5"/>
                    <circle cx="230" cy="75" r="18" fill="#181C2B" stroke="#6366F1" stroke-width="1.5"/>
                    <circle cx="245" cy="150" r="18" fill="#181C2B" stroke="#10B981" stroke-width="1.5"/>
                    <circle cx="230" cy="225" r="18" fill="#181C2B" stroke="#F59E0B" stroke-width="1.5"/>
                    <circle cx="150" cy="250" r="18" fill="#181C2B" stroke="#EC4899" stroke-width="1.5"/>
                    <circle cx="70" cy="225" r="18" fill="#181C2B" stroke="#3B82F6" stroke-width="1.5"/>
                    <circle cx="55" cy="150" r="18" fill="#181C2B" stroke="#14B8A6" stroke-width="1.5"/>
                    <circle cx="70" cy="75" r="18" fill="#181C2B" stroke="#EF4444" stroke-width="1.5"/>
                </svg>
            </div>
        </div>
    </section>

    <!-- CATEGORY PILLS -->
    <section class="max-w-6xl mx-auto px-6 py-6">
        <div class="flex flex-wrap gap-3">
            @php
                $categories = ['Gaming', 'Art', 'Music', 'Tech', 'Sport', 'Cosplay'];
            @endphp
            @foreach($categories as $category)
                <span class="bg-pillPurple text-white px-6 py-2 rounded-xl text-xs font-semibold cursor-pointer hover:opacity-90 transition">
                    {{ $category }}
                </span>
            @endforeach
            <!-- Placeholder Pill Button Tambahan -->
            <span class="bg-pillPurple text-white px-8 py-2 rounded-xl text-xs font-semibold cursor-pointer">&nbsp;</span>
            <span class="bg-activeBlue text-white px-10 py-2 rounded-xl text-xs font-semibold cursor-pointer">&nbsp;</span>
            <span class="bg-pillPurple text-white px-8 py-2 rounded-xl text-xs font-semibold cursor-pointer">&nbsp;</span>
        </div>
    </section>

    <!-- SECTION 1: TOP 3 CARDS -->
    <section class="max-w-6xl mx-auto px-6 py-8">
        <!-- Title Bar Placeholder -->
        <div class="w-40 h-7 bg-placeholderGrey rounded-lg mb-8"></div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for ($i = 0; $i < 3; $i++)
                <div class="bg-placeholderGrey rounded-3xl h-64 p-4 flex flex-col justify-between relative shadow-lg">
                    <div class="w-12 h-5 bg-badgeDark rounded-md self-end"></div>
                    <div class="w-8 h-8 bg-badgeDark rounded-md"></div>
                </div>
            @endfor
        </div>
    </section>

    <!-- SECTION 2: GRID CARDS (3x2) -->
    <section class="max-w-6xl mx-auto px-6 py-8">
        <!-- Center Title Bar Placeholder -->
        <div class="flex justify-center mb-8">
            <div class="w-48 h-7 bg-placeholderGrey rounded-lg"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @for ($i = 0; $i < 6; $i++)
                <div class="bg-placeholderGrey rounded-2xl h-36 p-3 relative shadow">
                    <div class="w-6 h-6 bg-badgeDark rounded-md"></div>
                </div>
            @endfor
        </div>
    </section>

    <!-- SECTION 3: LIST / ROW ITEMS -->
    <section class="max-w-6xl mx-auto px-6 py-8">
        <!-- Center Title Bar Placeholder -->
        <div class="flex justify-center mb-8">
            <div class="w-48 h-7 bg-placeholderGrey rounded-lg"></div>
        </div>

        <div class="space-y-4">
            @for ($i = 0; $i < 6; $i++)
                <div class="bg-placeholderGrey rounded-2xl h-14 w-full shadow"></div>
            @endfor
        </div>
    </section>

</body>
</html>