<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CircleHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0b1120;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .animate-float {
            animation: float 4s ease-in-out infinite;
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
            background: linear-gradient(135deg, #8B5CF6, #22D3EE); /* violet ke cyan */
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
            background: #22D3EE;
            pointer-events: none;
            z-index: 999998;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease-out, opacity 0.3s ease;
            opacity: 0;
            box-shadow: 0 0 10px #22D3EE;
        }

        .custom-cursor.hovering {
            width: 48px;
            height: 48px;
            font-size: 22px;
            background: linear-gradient(135deg, #22D3EE, #8B5CF6);
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.8), 0 0 50px rgba(139, 92, 246, 0.5);
        }

        @media (pointer: coarse) {
            .custom-cursor, .custom-cursor-trail {
                display: none !important;
            }
        }
    </style>
</head>
<body class="h-screen w-screen bg-[#0b1120] text-white overflow-hidden m-0 p-0 flex items-center justify-center">

    <!-- CUSTOM CURSOR -->
    <div class="custom-cursor" id="custom-cursor">C</div>
    <div class="custom-cursor-trail" id="custom-cursor-trail"></div>

    <div class="flex flex-col md:flex-row items-center justify-center gap-6 lg:gap-8 p-4 max-w-7xl mx-auto">

        <!-- Gambar Banner -->
        <div class="hidden md:block w-auto flex-shrink-0">
            <img src="{{ asset('images/banner.jpg') }}"
                 alt="CircleHub Banner"
                 class="h-[75vh] max-h-[600px] w-auto object-contain rounded-2xl shadow-2xl animate-float">
        </div>

        <!-- Form Login -->
        <div class="w-full max-w-md flex-shrink-0">
            <div class="w-full bg-[#161f33] p-8 rounded-2xl border border-slate-800 shadow-xl">

                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-white tracking-wide mb-1">
                        Selamat Datang Kembali
                    </h1>
                    <p class="text-xs text-slate-400">Masuk ke akun <span class="text-[#6C5CE7] font-semibold">CircleHub</span> kamu</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="login" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">Email atau Username</label>
                        <input id="login" type="text" name="login" value="{{ old('login') }}" required autofocus placeholder="Email atau Username"
                            class="w-full px-4 py-3 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('login')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs text-[#6C5CE7] hover:underline">Lupa password?</a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="w-full px-4 py-3 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" value="1" class="rounded bg-[#0b1120] border-slate-700 text-[#6C5CE7] shadow-sm focus:ring-[#6C5CE7]" name="remember">
                            <span class="ms-2 text-xs text-slate-400">Ingat saya</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-3.5 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white font-semibold rounded-xl transition duration-200 shadow-md shadow-[#6C5CE7]/20 active:scale-[0.99] cursor-pointer">
                            Masuk
                        </button>
                    </div>

                    <p class="text-center text-xs text-slate-400 pt-2">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-[#6C5CE7] font-semibold hover:underline">Daftar di sini</a>
                    </p>
                </form>

            </div>
        </div>

    </div>

    <!-- JAVASCRIPT CUSTOM CURSOR -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

                // Deteksi hover pada elemen interaktif
                const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
                interactiveElements.forEach(el => {
                    el.addEventListener('mouseenter', () => { cursor.classList.add('hovering'); });
                    el.addEventListener('mouseleave', () => { cursor.classList.remove('hovering'); });
                });

                document.addEventListener('mouseleave', () => {
                    cursor.style.opacity = '0';
                    trail.style.opacity = '0';
                });
                document.addEventListener('mouseenter', () => {
                    cursor.style.opacity = '1';
                    trail.style.opacity = '0.6';
                });
            }
        });
    </script>
</body>
</html>