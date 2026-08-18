<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - CircleHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B0E1B] text-white font-sans min-h-screen flex items-center justify-center p-4">

    <!-- Card Login -->
    <div class="w-full max-w-md bg-[#111625] border border-gray-800 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        
        <!-- Glow Effect Background -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#6C5CE7] opacity-20 blur-3xl rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-[#6C5CE7] opacity-20 blur-3xl rounded-full"></div>

        <!-- Logo & Header -->
        <div class="text-center mb-8 relative z-10">
            <a href="/" class="text-2xl font-bold tracking-wide flex items-center justify-center gap-2 mb-2">
                <span class="w-8 h-8 rounded-full bg-[#6C5CE7] flex items-center justify-center text-white text-sm font-extrabold">C</span>
                <span>Circle<span class="text-[#6C5CE7]">Hub</span></span>
            </a>
            <h1 class="text-xl font-semibold mt-4">Selamat Datang Kembali</h1>
            <p class="text-gray-400 text-sm mt-1">Masuk untuk terhubung dengan komunitasmu</p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-5 relative z-10">
            @csrf

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-xs font-medium text-gray-300 mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" required placeholder="nama@email.com" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Password Field -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-xs font-medium text-gray-300">Kata Sandi</label>
                    <a href="{{ route('password.request') }}" class="text-xs text-[#6C5CE7] hover:underline">Lupa password?</a>
                </div>
                <input type="password" id="password" name="password" required placeholder="••••••••" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded bg-[#171D30] border-gray-700 text-[#6C5CE7] focus:ring-[#6C5CE7] focus:ring-offset-[#111625]">
                <label for="remember" class="ml-2 text-xs text-gray-400">Ingat saya di perangkat ini</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 bg-[#6C5CE7] hover:bg-[#5b4cc4] text-white text-sm font-semibold rounded-full shadow-lg transition duration-200">
                Masuk
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-center text-xs text-gray-400 mt-6 relative z-10">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-[#6C5CE7] font-medium hover:underline">Daftar sekarang</a>
        </p>
    </div>

</body>
</html>