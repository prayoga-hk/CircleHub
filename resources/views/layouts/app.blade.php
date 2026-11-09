<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0B0F19">

    <title>CircleHub — Temukan Komunitas Hobimu</title>
    <meta name="description" content="Temukan komunitas hobi, bagikan karya, dan berkembang bersama CircleHub.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
<body class="min-h-screen antialiased bg-[#0B0F19] text-[#F8FAFC] dark:bg-[#0B0F19] dark:text-[#F8FAFC] transition-colors duration-200 overflow-x-hidden selection:bg-violet-500 selection:text-white">

    <!-- SPLASH SCREEN -->
    <div id="splash-screen" class="fixed inset-0 bg-[#0B0F19] z-[9999999] flex flex-col items-center justify-center transition-opacity duration-600 visibility-visible">
        <img src="{{ asset('images/logo.png') }}" alt="Logo CircleHub" class="w-25 h-25 object-contain animate-[pulse_1.5s_ease-in-out_infinite]">
        <h1 class="mt-4 text-[1.75rem] font-extrabold tracking-tight text-[#F8FAFC] animate-[fadeIn_1s_ease-out]">
            Circle<span class="bg-gradient-to-r from-[#A78BFA] via-[#7567FF] to-[#38BDF8] bg-clip-text text-transparent">Hub</span>
        </h1>
        <div class="mt-8 w-[200px] h-[4px] bg-violet-500/20 rounded-full overflow-hidden relative">
            <div class="h-full w-0 bg-gradient-to-r from-[#8B5CF6] to-[#22D3EE] rounded-full shadow-[0_0_10px_#22D3EE] transition-all duration-300" id="splash-progress"></div>
        </div>
    </div>

    <!-- CUSTOM CURSOR -->
    <div class="fixed top-0 left-0 w-8 h-8 rounded-full bg-gradient-to-br from-[#8B5CF6] to-[#22D3EE] flex items-center justify-center text-white font-black text-base pointer-events-none z-[999999] -translate-x-1/2 -translate-y-1/2 transition-[transform,width,height,opacity] duration-100 shadow-[0_0_15px_rgba(139,92,246,0.6),0_0_30px_rgba(34,211,238,0.3)] mix-blend-difference opacity-0" id="custom-cursor">C</div>
    <div class="fixed top-0 left-0 w-3 h-3 rounded-full bg-[#22D3EE] pointer-events-none z-[999998] -translate-x-1/2 -translate-y-1/2 transition-all duration-150 opacity-0 shadow-[0_0_10px_#22D3EE]" id="custom-cursor-trail"></div>

    <!-- BACKGROUND DECORATION -->
    <div class="fixed inset-0 pointer-events-none overflow-hidden -z-10">
        <div class="absolute top-0 right-[-120px] w-[360px] h-[360px] rounded-full blur-[110px] opacity-15 bg-[#6D4AFF]"></div>
        <div class="absolute top-[700px] left-[-180px] w-[360px] h-[360px] rounded-full blur-[110px] opacity-15 bg-[#176BFF]"></div>
        <div class="absolute inset-0 opacity-[0.035]" style="background-image: radial-gradient(#A5B4FC 1px, transparent 1px); background-size: 30px 30px;"></div>
    </div>

    <!-- NAVBAR -->
    <header class="sticky top-0 z-50 border-b border-white/10 backdrop-blur-xl bg-[#0B0F19]/90">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="h-[76px] flex items-center justify-between gap-4">

                <a href="#beranda" class="flex items-center gap-2.5 shrink-0">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo CircleHub" class="w-10 h-10 object-contain">
                    <span class="text-xl font-extrabold tracking-tight text-[#F8FAFC]">Circle<span class="bg-gradient-to-r from-[#A78BFA] via-[#7567FF] to-[#38BDF8] bg-clip-text text-transparent">Hub</span></span>
                </a>

                <nav class="hidden md:flex items-center gap-7 text-sm text-[#94A3B8]">
                    <a href="#beranda" class="hover:text-violet-300 transition-colors">Beranda</a>
                    <a href="#tentang-kami" class="hover:text-violet-300 transition-colors">Tentang Kami</a>
                    <a href="#fitur" class="hover:text-violet-300 transition-colors">Fitur</a>
                    <a href="#kategori" class="hover:text-violet-300 transition-colors">Kategori</a>
                </nav>

                <div class="flex items-center gap-2.5 sm:gap-3">
                    <button id="theme-toggle" type="button" class="w-10 h-10 rounded-xl flex items-center justify-center text-lg cursor-pointer border border-violet-500/55 bg-slate-900/65 text-[#F8FAFC] hover:translate-y-[-2px] hover:border-violet-500 transition-all" aria-label="Ganti tema terang/gelap" title="Ganti tema">
                        <span id="theme-icon" aria-hidden="true">🌙</span>
                    </button>

                    <a href="/login" class="hidden sm:inline-flex px-5 py-2.5 rounded-xl text-sm border border-violet-500/55 bg-slate-900/65 text-[#F8FAFC] hover:bg-violet-500/15 transition-all">Masuk</a>
                    <a href="/register" class="inline-flex items-center gap-2 px-4 sm:px-5 py-2.5 rounded-xl text-sm font-semibold bg-gradient-to-r from-violet-600 to-indigo-600 text-white shadow-[0_5px_25px_rgba(80,70,229,0.22)] hover:translate-y-[-2px] hover:shadow-[0_8px_30px_rgba(99,102,241,0.4)] transition-all">Daftar <span aria-hidden="true">↗</span></a>

                    <button id="mobile-menu-button" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-menu" class="md:hidden w-10 h-10 rounded-xl border border-violet-500/55 bg-slate-900/65 flex items-center justify-center text-xl text-[#F8FAFC]">
                        ☰
                    </button>
                </div>
            </div>

            <nav id="mobile-menu" class="hidden md:hidden pb-5">
                <div class="grid gap-2 text-sm text-[#94A3B8]">
                    <a href="#beranda" class="rounded-lg px-4 py-3 hover:bg-white/5 transition-colors">Beranda</a>
                    <a href="#tentang-kami" class="rounded-lg px-4 py-3 hover:bg-white/5 transition-colors">Tentang Kami</a>
                    <a href="#kategori" class="rounded-lg px-4 py-3 hover:bg-white/5 transition-colors">Kategori</a>
                    <a href="#fitur" class="rounded-lg px-4 py-3 hover:bg-white/5 transition-colors">Fitur</a>
                    <a href="/login" class="rounded-lg px-4 py-3 hover:bg-white/5 transition-colors">Masuk</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="border-t border-white/10 bg-[#151B28]">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 pt-14 pb-7">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12">

                <div class="opacity-0 translate-y-10 transition-all duration-800 ease-[cubic-bezier(.16,1,.3,1)]" data-reveal>
                    <a href="#beranda" class="inline-flex items-center gap-2">
                        <img src="{{ asset('images/logo.png') }}" alt="CircleHub" class="w-10 h-10 object-contain" loading="lazy">
                        <span class="text-lg font-extrabold text-[#F8FAFC]">Circle<span class="bg-gradient-to-r from-[#A78BFA] via-[#7567FF] to-[#38BDF8] bg-clip-text text-transparent">Hub</span></span>
                    </a>
                    <p class="text-sm leading-7 mt-4 max-w-xs text-[#94A3B8]">
                        Hobi yang kamu cintai, komunitas yang kamu butuhkan. Temukan circle-mu dan berkembang bersama.
                    </p>
                    <div class="flex gap-3 mt-5">
                        <a href="https://instagram.com/bimbimjoevanka" target="_blank" rel="noopener noreferrer" aria-label="Instagram" class="w-10 h-10 rounded-xl border border-violet-500/55 bg-slate-900/65 flex items-center justify-center hover:bg-violet-500/20 transition-all">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r=".8" fill="currentColor"/></svg>
                        </a>
                        <a href="#fitur" aria-label="Fitur" class="w-10 h-10 rounded-xl border border-violet-500/55 bg-slate-900/65 flex items-center justify-center hover:bg-violet-500/20 transition-all">
                            <svg viewBox="0 0 24 24" class="w-5 h-5 text-white" fill="currentColor" aria-hidden="true"><path d="M21.6 7.2a2.8 2.8 0 0 0-2-2C17.9 4.7 12 4.7 12 4.7s-5.9 0-7.6.5a2.8 2.8 0 0 0-2 2A29 29 0 0 0 2 12a29 29 0 0 0 .4 4.8 2.8 2.8 0 0 0 2 2c1.7.5 7.6.5 7.6.5s5.9 0 7.6-.5a2.8 2.8 0 0 0 2-2A29 29 0 0 0 22 12a29 29 0 0 0-.4-4.8ZM10 15.2V8.8l5.5 3.2Z"/></svg>
                        </a>
                    </div>
                </div>

                <div class="opacity-0 translate-y-10 transition-all duration-800 ease-[cubic-bezier(.16,1,.3,1)] delay-100" data-reveal>
                    <h3 class="text-sm font-bold mb-5 text-[#F8FAFC]">Kontak</h3>
                    <div class="space-y-4 text-sm text-[#94A3B8]">
                        <p class="flex items-start gap-3"><span class="text-violet-400">✉</span><span>Email CircleHub</span></p>
                        <p class="flex items-start gap-3"><span class="text-violet-400">⌖</span><span>Malang, Indonesia</span></p>
                        <p class="text-xs leading-5 opacity-70">Hubungi kami melalui saluran kontak resmi yang tersedia.</p>
                    </div>
                </div>

                <div class="opacity-0 translate-y-10 transition-all duration-800 ease-[cubic-bezier(.16,1,.3,1)] delay-200" data-reveal>
                    <h3 class="text-sm font-bold mb-5 text-[#F8FAFC]">Quick Links</h3>
                    <div class="space-y-4 text-sm text-[#94A3B8]">
                        <a href="#beranda" class="flex justify-between gap-3 hover:text-violet-300 transition-colors">Beranda <span>↗</span></a>
                        <a href="#tentang-kami" class="flex justify-between gap-3 hover:text-violet-300 transition-colors">Tentang Kami <span>↗</span></a>
                        <a href="#kategori" class="flex justify-between gap-3 hover:text-violet-300 transition-colors">Kategori <span>↗</span></a>
                        <a href="#fitur" class="flex justify-between gap-3 hover:text-violet-300 transition-colors">Fitur <span>↗</span></a>
                    </div>
                </div>

                <div class="opacity-0 translate-y-10 transition-all duration-800 ease-[cubic-bezier(.16,1,.3,1)] delay-300" data-reveal>
                    <h3 class="text-sm font-bold mb-5 text-[#F8FAFC]">Mulai Sekarang</h3>
                    <p class="text-sm leading-7 mb-5 text-[#94A3B8]">Siap menemukan komunitas yang sesuai dengan hobimu?</p>
                    <a href="/register" class="inline-flex items-center gap-2 text-sm font-semibold text-violet-400 hover:text-cyan-300 transition-colors">Buak Akun <span aria-hidden="true">→</span></a>
                    <div class="mt-5">
                        <a href="/login" class="text-sm text-[#94A3B8] hover:text-violet-300 transition-colors">Sudah punya akun? Masuk</a>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/10 mt-12 pt-6 flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-[#94A3B8]">
                <p>© {{ date('Y') }} CircleHub. All rights reserved.</p>
                <p>Dibuat dengan <span class="text-violet-400">♥</span> untuk komunitas yang lebih baik.</p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. SPLASH SCREEN LOGIC
            const splash = document.getElementById('splash-screen');
            const progressBar = document.getElementById('splash-progress');
            const currentPath = window.location.pathname;
            const isLandingOrHome = currentPath === '/' || currentPath === '/home';

            if (splash && progressBar && isLandingOrHome) {
                const referrer = document.referrer;
                const isComingFromAuth = referrer.includes('/login') || referrer.includes('/register');

                if (isComingFromAuth) {
                    sessionStorage.removeItem('circlehub-splash-seen');
                }

                const hasSeenSplash = sessionStorage.getItem('circlehub-splash-seen');

                if (!hasSeenSplash) {
                    splash.style.display = 'flex';
                    progressBar.style.width = '0%';

                    let progress = 0;
                    const interval = setInterval(() => {
                        progress += Math.random() * 20;
                        if (progress >= 100) {
                            progress = 100;
                            clearInterval(interval);

                            setTimeout(() => {
                                splash.classList.add('opacity-0', 'pointer-events-none', 'transition-opacity', 'duration-500');
                                setTimeout(() => splash.remove(), 500);
                                sessionStorage.setItem('circlehub-splash-seen', 'true');
                            }, 300);
                        }
                        progressBar.style.width = progress + '%';
                    }, 100);
                } else {
                    splash.remove();
                }
            } else if (splash) {
                splash.remove();
            }

            // 2. CUSTOM CURSOR LOGIC
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

                const attachHoverEvents = () => {
                    const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
                    interactiveElements.forEach(el => {
                        if (!el.hasAttribute('data-cursor-bound')) {
                            el.addEventListener('mouseenter', () => {
                                cursor.style.width = '48px';
                                cursor.style.height = '48px';
                                cursor.style.fontSize = '22px';
                            });
                            el.addEventListener('mouseleave', () => {
                                cursor.style.width = '32px';
                                cursor.style.height = '32px';
                                cursor.style.fontSize = '16px';
                            });
                            el.setAttribute('data-cursor-bound', 'true');
                        }
                    });
                };

                attachHoverEvents();
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

            // 3. THEME TOGGLE LOGIC
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

            // 4. MOBILE MENU
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

            // 5. SCROLL REVEAL
            const revealElements = document.querySelectorAll('[data-reveal]');

            if ('IntersectionObserver' in window) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.remove('opacity-0', 'translate-y-10');
                            entry.target.classList.add('opacity-100', 'translate-y-0');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15,
                    rootMargin: '0px 0px -50px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                revealElements.forEach(el => {
                    el.classList.remove('opacity-0', 'translate-y-10');
                    el.classList.add('opacity-100', 'translate-y-0');
                });
            }
        });
    </script>
</body>
</html>
