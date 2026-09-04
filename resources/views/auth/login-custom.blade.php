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
    </style>
</head>
<body class="h-screen w-screen bg-[#0b1120] text-white overflow-hidden m-0 p-0 flex items-center justify-center">

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
                            <input id="remember_me" type="checkbox" class="rounded bg-[#0b1120] border-slate-700 text-[#6C5CE7] shadow-sm focus:ring-[#6C5CE7]" name="remember">
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

</body>
</html>
