<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CircleHub</title>
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

    <!-- Blok Gabungan (Gambar + Form) Otomatis di Tengah Layar -->
    <div class="flex flex-col md:flex-row items-center justify-center gap-6 lg:gap-8 p-4 max-w-7xl mx-auto">
        
        <!-- Gambar (Sisi Kiri, nempel berdekatan) -->
        <div class="hidden md:block w-auto flex-shrink-0">
            <img src="{{ asset('images/banner.jpg') }}" 
                 alt="CircleHub Banner" 
                 class="h-[75vh] max-h-[600px] w-auto object-contain rounded-2xl shadow-2xl animate-float">
        </div>

        <!-- Form Register (Sisi Kanan, nempel berdekatan) -->
        <div class="w-full max-w-md flex-shrink-0">
            <div class="w-full bg-[#161f33] p-6 sm:p-8 rounded-2xl border border-slate-800 shadow-xl">
                
                <div class="text-center mb-5">
                    <h1 class="text-2xl font-bold text-white tracking-wide mb-1">
                        Selamat Datang di
                    </h1>
                    <span class="text-xl font-extrabold text-sky-400">CircleHub</span>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
                    @csrf

                    <div>
                        <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Username</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan username"
                            class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com"
                            class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Password</label>
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                            class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 font-medium text-sm transition">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full py-3 bg-sky-500 hover:bg-sky-600 text-white font-semibold rounded-xl transition duration-200 shadow-md shadow-sky-500/20 active:scale-[0.99]">
                            Daftar Sekarang
                        </button>
                    </div>

                    <p class="text-center text-xs text-slate-400 pt-1">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-sky-400 font-semibold hover:underline">Masuk di sini</a>
                    </p>
                </form>

            </div>
        </div>

    </div>

</body>
</html>