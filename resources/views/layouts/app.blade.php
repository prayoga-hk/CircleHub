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
            --header-bg: rgba(11, 15, 25, .9);
            --glass-bg: linear-gradient(145deg, rgba(26, 32, 44, .94), rgba(15, 23, 42, .78));
            --glass-border: rgba(129, 140, 248, .20);
            --card-shadow: 0 12px 40px rgba(0, 0, 0, .15);
        }

        html[data-theme="light"] {
            color-scheme: light;
            --bg: #F8FAFC;
            --surface: #FFFFFF;
            --surface-light: #F1F5F9;
            --text: #0F172A;
            --muted: #64748B;
            --header-bg: rgba(255, 255, 255, .9);
            --glass-bg: linear-gradient(145deg, rgba(255, 255, 255, .96), rgba(241, 245, 249, .9));
            --glass-border: rgba(139, 92, 246, .18);
            --card-shadow: 0 12px 40px rgba(15, 23, 42, .08);
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 90px;
        }

        /* ===== CUSTOM CURSOR ===== */
        @media (pointer: fine) {
            body, a, button, input, textarea, select, [role="button"] {
                cursor: none !important;
            }
        }

        .custom-cursor {
            position: fixed;
            top: 0;
            left: 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--violet), var(--cyan));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 900;
            font-size: 16px;
            pointer-events: none;
            z-index: 999999;
            transform: translate(-50%, -50%);
            transition: transform 0.1s ease-out, width 0.2s ease, height 0.2s ease, opacity 0.2s ease;
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.6), 0 0 30px rgba(34, 211, 238, 0.3);
            mix-blend-mode: difference;
            opacity: 0;
        }

        .custom-cursor-trail {
            position: fixed;
            top: 0;
            left: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--cyan);
            pointer-events: none;
            z-index: 999998;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out, opacity 0.3s ease;
            opacity: 0;
            box-shadow: 0 0 10px var(--cyan);
        }

        .custom-cursor.hovering {
            width: 48px;
            height: 48px;
            font-size: 22px;
            background: linear-gradient(135deg, var(--cyan), var(--violet));
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.8), 0 0 50px rgba(139, 92, 246, 0.5);
        }

        @media (pointer: coarse) {
            .custom-cursor, .custom-cursor-trail {
                display: none !important;
            }
        }

        /* ===== SPLASH SCREEN ===== */
        #splash-screen {
            position: fixed;
            inset: 0;
            background: var(--bg);
            z-index: 9999999;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: opacity 0.6s ease, visibility 0.6s ease;
            opacity: 1;
            visibility: visible;
        }

        #splash-screen.hidden-splash {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .splash-logo {
            width: 100px;
            height: 100px;
            object-fit: contain;
            animation: splashPulse 1.5s ease-in-out infinite;
        }

        .splash-title {
            margin-top: 1rem;
            font-size: 1.75rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
            animation: splashFadeIn 1s ease-out;
        }

        .splash-title span {
            background: linear-gradient(100deg, #A78BFA 0%, #7567FF 48%, #38BDF8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .splash-progress-container {
            margin-top: 2rem;
            width: 200px;
            height: 4px;
            background: rgba(139, 92, 246, 0.2);
            border-radius: 9999px;
            overflow: hidden;
            position: relative;
        }

        .splash-progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--violet), var(--cyan));
            border-radius: 9999px;
            box-shadow: 0 0 10px var(--cyan);
            transition: width 0.3s ease;
        }

        @keyframes splashPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.08); opacity: 0.85; }
        }

        @keyframes splashFadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== Transition & lainnya ===== */
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            transition: background-color 0.15s ease, color 0.15s ease;
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
            transition: opacity 0.15s ease;
        }

        html[data-theme="light"] .page-glow { opacity: .22; }

        .glow-purple { background: #6D4AFF; }
        .glow-blue { background: #176BFF; }

        .gradient-text {
            background: linear-gradient(100deg, #A78BFA 0%, #7567FF 48%, #38BDF8 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .glass-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            box-shadow: var(--card-shadow);
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease, background 0.15s ease;
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
            color: #fff;
        }

        .primary-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(99, 102, 241, .4);
        }

        .outline-button {
            border: 1px solid rgba(139, 92, 246, .55);
            background: rgba(15, 23, 42, .65);
            color: var(--text);
            transition: background .2s ease, border-color .2s ease, color .15s ease;
        }

        html[data-theme="light"] .outline-button {
            background: rgba(255, 255, 255, .8);
        }

        .outline-button:hover {
            background: rgba(80, 70, 229, .16);
            border-color: #8B5CF6;
        }

        .category-chip {
            border: 1px solid rgba(99, 102, 241, .25);
            background: rgba(26, 32, 44, .78);
            color: var(--text);
            transition: .25s ease;
        }

        html[data-theme="light"] .category-chip {
            background: rgba(255, 255, 255, .9);
        }

        .category-chip:hover {
            border-color: #8B5CF6;
            background: rgba(80, 70, 229, .2);
            transform: translateY(-3px);
        }

        .section-label {
            border: 1px solid rgba(34, 211, 238, .3);
            background: rgba(34, 211, 238, .06);
            transition: border-color 0.15s ease, background 0.15s ease;
        }

        .hero-orb { animation: float 6s ease-in-out infinite; }
        .hero-orb-delay { animation: float 7s ease-in-out 1s infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .feature-number {
            background: linear-gradient(140deg, #8B5CF6, #5046E5);
            box-shadow: 0 5px 20px rgba(80, 70, 229, .25);
            color: #fff;
        }

        .footer-link { transition: color .2s ease; }
        .footer-link:hover { color: #A78BFA; }

        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text);
            font-size: 18px;
            cursor: pointer;
            border: 1px solid rgba(139, 92, 246, .55);
            background: rgba(15, 23, 42, .65);
            transition: background .15s ease, border-color .15s ease, transform .2s ease, color .15s ease;
        }

        html[data-theme="light"] .theme-toggle {
            background: #fff;
            border-color: rgba(139, 92, 246, .35);
            color: #4C1D95;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
            border-color: #8B5CF6;
        }

        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity .8s cubic-bezier(.16, 1, .3, 1), transform .8s cubic-bezier(.16, 1, .3, 1);
            will-change: opacity, transform;
        }
        .reveal.is-visible { opacity: 1; transform: translateY(0); }

        .reveal-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: opacity .8s cubic-bezier(.16, 1, .3, 1), transform .8s cubic-bezier(.16, 1, .3, 1);
        }
        .reveal-left.is-visible { opacity: 1; transform: translateX(0); }

        .reveal-right {
            opacity: 0;
            transform: translateX(50px);
            transition: opacity .8s cubic-bezier(.16, 1, .3, 1), transform .8s cubic-bezier(.16, 1, .3, 1);
        }
        .reveal-right.is-visible { opacity: 1; transform: translateX(0); }

        .reveal-zoom {
            opacity: 0;
            transform: scale(.92);
            transition: opacity .8s cubic-bezier(.16, 1, .3, 1), transform .8s cubic-bezier(.16, 1, .3, 1);
        }
        .reveal-zoom.is-visible { opacity: 1; transform: scale(1); }

        [data-delay="1"] { transition-delay: .1s; }
        [data-delay="2"] { transition-delay: .2s; }
        [data-delay="3"] { transition-delay: .3s; }
        [data-delay="4"] { transition-delay: .4s; }
        [data-delay="5"] { transition-delay: .5s; }
        [data-delay="6"] { transition-delay: .6s; }
        [data-delay="7"] { transition-delay: .7s; }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
            .reveal, .reveal-left, .reveal-right, .reveal-zoom {
                opacity: 1 !important;
                transform: none !important;
            }
        }
    </style>

    <script>
        (function () {
            try {
                var saved = localStorage.getItem('circlehub-theme');
                var prefersLight = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches;
                var theme = saved || (prefersLight ? 'light' : 'dark');
                document.documentElement.setAttribute('data-theme', theme);
            } catch (e) {}
        })();
    </script>
</head>

<body class="min-h-screen antialiased">

    <!-- SPLASH SCREEN -->
    <!-- Menggunakan inline style untuk menyembunyikan dari awal jika bukan landing/home, menghindari flicker -->
    <div id="splash-screen" style="display: none;">
        <img src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png" alt="Logo CircleHub" class="splash-logo">
        <h1 class="splash-title">Circle<span>Hub</span></h1>
        <div class="splash-progress-container">
            <div class="splash-progress-bar" id="splash-progress"></div>
        </div>
    </div>

    <!-- CUSTOM CURSOR -->
    <div class="custom-cursor" id="custom-cursor">C</div>
    <div class="custom-cursor-trail" id="custom-cursor-trail"></div>

    <!-- BACKGROUND DECORATION -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="page-glow glow-purple" style="top: 0; right: -120px;"></div>
        <div class="page-glow glow-blue" style="top: 700px; left: -180px;"></div>
        <div class="absolute inset-0 opacity-[0.035]"
             style="background-image: radial-gradient(#A5B4FC 1px, transparent 1px); background-size: 30px 30px;">
        </div>
    </div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 border-b border-white/[0.06] backdrop-blur-xl" style="background: var(--header-bg);">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="h-[76px] flex items-center justify-between gap-4">

                <a href="#beranda" class="flex items-center gap-2.5 shrink-0">
                    <img src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png" alt="Logo CircleHub" class="w-10 h-10 object-contain">
                    <span class="text-xl font-extrabold tracking-tight">Circle<span class="gradient-text">Hub</span></span>
                </a>

                <nav class="hidden md:flex items-center gap-7 text-sm" style="color: var(--muted);">
                    <a href="#beranda" class="hover:text-violet-300 transition">Beranda</a>
                    <a href="#tentang-kami" class="hover:text-violet-300 transition">Tentang Kami</a>
                    <a href="#fitur" class="hover:text-violet-300 transition">Fitur</a>
                    <a href="#kategori" class="hover:text-violet-300 transition">Kategori</a>
                </nav>

                <div class="flex items-center gap-2.5 sm:gap-3">
                    <button id="theme-toggle" type="button" class="theme-toggle" aria-label="Ganti tema terang/gelap" title="Ganti tema">
                        <span id="theme-icon" aria-hidden="true">🌙</span>
                    </button>

                    <a href="/login" class="hidden sm:inline-flex px-5 py-2.5 rounded-xl text-sm outline-button" style="color: var(--text);">Masuk</a>
                    <a href="/register" class="primary-button inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl text-sm font-semibold">Daftar <span aria-hidden="true">↗</span></a>

                    <button id="mobile-menu-button" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden w-10 h-10 rounded-xl outline-button flex items-center justify-center text-xl" style="color: var(--text);">
                        ☰
                    </button>
                </div>
            </div>

            <nav id="mobile-menu" class="hidden md:hidden pb-5">
                <div class="grid gap-2 text-sm" style="color: var(--muted);">
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
        @yield('content') 
    </main>

    <footer class="border-t border-white/[0.07]" style="background: var(--surface);">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-14 pb-7">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">
                
                <div class="reveal">
                    <a href="#beranda" class="inline-flex items-center gap-2">
                        <img src="https://cdn.phototourl.com/member/2026-10-08-0243e666-f2a5-4124-b999-48635e9aaff4.png" alt="CircleHub" class="w-10 h-10 object-contain" loading="lazy">
                        <span class="text-lg font-extrabold">Circle<span class="gradient-text">Hub</span></span>
                    </a>
                    <p class="text-sm leading-7 mt-4 max-w-xs" style="color: var(--muted);">
                        Hobi yang kamu cintai, komunitas yang kamu butuhkan. Temukan circle-mu dan berkembang bersama.
                    </p>
                    <div class="flex gap-3 mt-5">
                        <a href="https://instagram.com/bimbimjoevanka" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-10 h-10 rounded-xl outline-button flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/></svg>
                        </a>
                        <a href="#fitur" aria-label="Fitur" class="w-10 h-10 rounded-xl outline-button flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="w-5 h-5" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2a2.8 2.8 0 0 0-2-2C17.9 4.7 12 4.7 12 4.7s-5.9 0-7.6.5a2.8 2.8 0 0 0-2 2A29 29 0 0 0 2 12a29 29 0 0 0 .4 4.8 2.8 2.8 0 0 0 2 2c1.7.5 7.6.5 7.6.5s5.9 0 7.6-.5a2.8 2.8 0 0 0 2-2A29 29 0 0 0 22 12a29 29 0 0 0-.4-4.8ZM10 15.2V8.8l5.5 3.2Z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="reveal" data-delay="1">
                    <h3 class="text-sm font-bold mb-5">Kontak</h3>
                    <div class="space-y-4 text-sm" style="color: var(--muted);">
                        <p class="flex items-start gap-3"><span class="text-violet-400">✉</span><span>Email CircleHub</span></p>
                        <p class="flex items-start gap-3"><span class="text-violet-400">⌖</span><span>Malang, Indonesia</span></p>
                        <p class="text-xs leading-5 opacity-70">Hubungi kami melalui saluran kontak resmi yang tersedia.</p>
                    </div>
                </div>

                <div class="reveal" data-delay="2">
                    <h3 class="text-sm font-bold mb-5">Quick Links</h3>
                    <div class="space-y-4 text-sm" style="color: var(--muted);">
                        <a href="#beranda" class="footer-link flex justify-between gap-3">Beranda <span>↗</span></a>
                        <a href="#tentang-kami" class="footer-link flex justify-between gap-3">Tentang Kami <span>↗</span></a>
                        <a href="#kategori" class="footer-link flex justify-between gap-3">Kategori <span>↗</span></a>
                        <a href="#fitur" class="footer-link flex justify-between gap-3">Fitur <span>↗</span></a>
                    </div>
                </div>

                <div class="reveal" data-delay="3">
                    <h3 class="text-sm font-bold mb-5">Mulai Sekarang</h3>
                    <p class="text-sm leading-7 mb-5" style="color: var(--muted);">Siap menemukan komunitas yang sesuai dengan hobimu?</p>
                    <a href="/register" class="inline-flex items-center gap-2 text-sm font-semibold text-violet-400 hover:text-cyan-300 transition">Buat Akun <span aria-hidden="true">→</span></a>
                    <div class="mt-5">
                        <a href="/login" class="footer-link text-sm" style="color: var(--muted);">Sudah punya akun? Masuk</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/[0.07] mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs" style="color: var(--muted);">
                <p>© {{ date('Y') }} CircleHub. All rights reserved.</p>
                <p>Dibuat dengan <span class="text-violet-400">♥</span> untuk komunitas yang lebih baik.</p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // ==========================================
            // 1. SPLASH SCREEN LOGIC
            // ==========================================
            const splash = document.getElementById('splash-screen');
            const progressBar = document.getElementById('splash-progress');
            const currentPath = window.location.pathname;
            
            // Cek apakah ini halaman landing (/) atau home (/home)
            const isLandingOrHome = currentPath === '/' || currentPath === '/home';

            if (splash && progressBar && isLandingOrHome) {
                // Cek apakah datang dari halaman login/register
                const referrer = document.referrer;
                const isComingFromAuth = referrer.includes('/login') || referrer.includes('/register');

                // KUNCI UTAMA: 
                // Jika datang dari login/register, HAPUS memori sessionStorage agar splash muncul.
                if (isComingFromAuth) {
                    sessionStorage.removeItem('circlehub-splash-seen');
                }

                // Cek apakah splash screen sudah tampil di sesi ini
                const hasSeenSplash = sessionStorage.getItem('circlehub-splash-seen');

                if (!hasSeenSplash) {
                    // Tampilkan splash screen
                    splash.style.display = 'flex';
                    // Reset progress bar ke 0 jika sebelumnya sudah pernah jalan
                    progressBar.style.width = '0%';
                    
                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += Math.random() * 20;
                        if (progress >= 100) {
                            progress = 100;
                            clearInterval(interval);
                            
                            setTimeout(() => {
                                splash.classList.add('hidden-splash');
                                // Tandai bahwa splash sudah dilihat di sesi ini
                                sessionStorage.setItem('circlehub-splash-seen', 'true');
                            }, 300);
                        }
                        progressBar.style.width = progress + '%';
                    }, 100);
                }
            }

            // ==========================================
            // 2. CUSTOM CURSOR LOGIC
            // ==========================================
            const cursor = document.getElementById('custom-cursor');
            const trail = document.getElementById('custom-cursor-trail');
            const isFinePointer = window.matchMedia('(pointer: fine)').matches;

            if (cursor && trail && isFinePointer) {
                let mouseX = 0, mouseY = 0;
                let cursorX = 0, cursorY = 0;
                let trailX = 0, trailY = 0;

                document.addEventListener('mousemove', (e) => {
                    mouseX = e.clientX;
                    mouseY = e.clientY;
                    
                    if (cursor.style.opacity === '' || cursor.style.opacity === '0') {
                        cursor.style.opacity = '1';
                        trail.style.opacity = '0.6';
                    }
                });

                function animateCursor() {
                    cursorX += (mouseX - cursorX) * 0.2;
                    cursorY += (mouseY - cursorY) * 0.2;
                    cursor.style.left = cursorX + 'px';
                    cursor.style.top = cursorY + 'px';

                    trailX += (mouseX - trailX) * 0.1;
                    trailY += (mouseY - trailY) * 0.1;
                    trail.style.left = trailX + 'px';
                    trail.style.top = trailY + 'px';

                    requestAnimationFrame(animateCursor);
                }
                animateCursor();

                // Fungsi untuk mendeteksi elemen interaktif baru
                const attachHoverEvents = () => {
                    const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
                    interactiveElements.forEach(el => {
                        if (!el.hasAttribute('data-cursor-bound')) {
                            el.addEventListener('mouseenter', () => cursor.classList.add('hovering'));
                            el.addEventListener('mouseleave', () => cursor.classList.remove('hovering'));
                            el.setAttribute('data-cursor-bound', 'true'); 
                        }
                    });
                };
                
                attachHoverEvents();

                // Pantau perubahan DOM
                const observer = new MutationObserver(attachHoverEvents);
                observer.observe(document.body, { childList: true, subtree: true });

                document.addEventListener('mouseleave', () => {
                    cursor.style.opacity = '0';
                    trail.style.opacity = '0';
                });
                document.addEventListener('mouseenter', () => {
                    cursor.style.opacity = '1';
                    trail.style.opacity = '0.6';
                });
            }

            // ==========================================
            // 3. THEME TOGGLE LOGIC
            // ==========================================
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const htmlEl = document.documentElement;

            function updateThemeIcon(theme) {
                if (themeIcon) {
                    themeIcon.textContent = theme === 'dark' ? '🌙' : '☀️';
                }
                const meta = document.querySelector('meta[name="theme-color"]');
                if (meta) meta.setAttribute('content', theme === 'light' ? '#F8FAFC' : '#0B0F19');
            }

            updateThemeIcon(htmlEl.getAttribute('data-theme'));

            if (themeToggle) {
                themeToggle.addEventListener('click', function () {
                    const currentTheme = htmlEl.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    
                    htmlEl.setAttribute('data-theme', newTheme);
                    localStorage.setItem('circlehub-theme', newTheme);
                    updateThemeIcon(newTheme);
                });
            }

            // ==========================================
            // 4. MOBILE MENU
            // ==========================================
            const button = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if (button && menu) {
                button.addEventListener('click', function () {
                    const isHidden = menu.classList.contains('hidden');
                    menu.classList.toggle('hidden', !isHidden);
                    button.setAttribute('aria-expanded', String(isHidden));
                    button.setAttribute('aria-label', isHidden ? 'Tutup menu navigasi' : 'Buka menu navigasi');
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
            }

            // ==========================================
            // 5. SCROLL REVEAL
            // ==========================================
            const revealElements = document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-zoom');

            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                revealElements.forEach(el => el.classList.add('is-visible'));
            }
        });
    </script>
</body>
</html>