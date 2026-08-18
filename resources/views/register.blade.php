<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - CircleHub</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0B0E1B] text-white font-sans min-h-screen flex items-center justify-center p-4 my-8">

    <!-- Card Register -->
    <div class="w-full max-w-md bg-[#111625] border border-gray-800 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
        
        <!-- Glow Effect Background -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-[#6C5CE7] opacity-20 blur-3xl rounded-full"></div>

        <!-- Header -->
        <div class="text-center mb-6 relative z-10">
            <a href="/" class="text-2xl font-bold tracking-wide flex items-center justify-center gap-2 mb-2">
                <span class="w-8 h-8 rounded-full bg-[#6C5CE7] flex items-center justify-center text-white text-sm font-extrabold">C</span>
                <span>Circle<span class="text-[#6C5CE7]">Hub</span></span>
            </a>
            <h1 class="text-xl font-semibold mt-4">Buat Akun Baru</h1>
            <p class="text-gray-400 text-sm mt-1">Gabung dan temukan komunitas hobimu</p>
        </div>

        <!-- Form Register -->
        <form action="{{ route('register') }}" method="POST" class="space-y-4 relative z-10">
            @csrf

            <!-- Name Field -->
            <div>
                <label for="name" class="block text-xs font-medium text-gray-300 mb-1.5">Nama Lengkap</label>
                <input type="text" id="name" name="name" required placeholder="John Doe" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-xs font-medium text-gray-300 mb-1.5">Alamat Email</label>
                <input type="email" id="email" name="email" required placeholder="nama@email.com" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Category Selection (Hobi) -->
            <div>
                <label for="hobby" class="block text-xs font-medium text-gray-300 mb-1.5">Kategori Hobi Utama</label>
                <select id="hobby" name="hobby" class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-300">
                    <option value="" disabled selected>Pilih hobi favoritmu</option>
                    <option value="gaming">Gaming</option>
                    <option value="art">Art & Design</option>
                    <option value="music">Music</option>
                    <option value="tech">Tech</option>
                    <option value="sport">Sport</option>
                    <option value="cosplay">Cosplay</option>
                </select>
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-xs font-medium text-gray-300 mb-1.5">Kata Sandi</label>
                <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="block text-xs font-medium text-gray-300 mb-1.5">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata sandi" 
                    class="w-full px-4 py-3 bg-[#171D30] border border-gray-700/60 rounded-xl text-sm focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] transition duration-200 text-gray-100 placeholder-gray-500">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 mt-2 bg-[#6C5CE7] hover:bg-[#5b4cc4] text-white text-sm font-semibold rounded-full shadow-lg transition duration-200">
                Daftar Sekarang
            </button>
        </form>

        <!-- Login Link -->
        <p class="text-center text-xs text-gray-400 mt-6 relative z-10">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="text-[#6C5CE7] font-medium hover:underline">Masuk di sini</a>
        </p>
    </div>

</body>
</html>