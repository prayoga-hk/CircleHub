<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CircleHub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0b1120;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="min-h-screen bg-[#0b1120] text-white flex flex-col justify-center items-center p-4">

    <!-- Header Teks Login -->
    <div class="w-full max-w-5xl mb-1 text-slate-400 font-sans text-lg">
        Login
    </div>

    <!-- Outer Box dengan Border Biru -->
    <div class="w-full max-w-5xl border-2 border-sky-500 bg-[#0b1120] flex flex-col md:flex-row items-stretch overflow-hidden">
        
        <!-- Sisi Kiri: Banner Poster Hobi -->
        <div class="w-full md:w-[38%] border-b-2 md:border-b-0 md:border-r-2 border-sky-500 flex items-center justify-center bg-[#0b1120]">
            <img src="{{ asset('images/banner.jpg') }}" 
                 alt="CircleHub Banner" 
                 class="w-full h-full object-cover">
        </div>

        <!-- Sisi Kanan: Form Login -->
        <div class="w-full md:w-[62%] p-8 md:p-12 flex items-center justify-center bg-[#0b1120]">
            
            <div class="w-full max-w-md bg-[#232a3b] p-8 md:p-10 rounded-2xl shadow-2xl">
                
                <h2 class="text-2xl md:text-3xl font-bold text-center text-white mb-8">
                    Selamat Datang Kembali
                </h2>

                <!-- Display Errors jika login gagal -->
                @if ($errors->any())
                    <div class="mb-6 p-3 bg-red-500/10 border border-red-500/40 rounded-lg text-red-400 text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Input Username -->
                    <div>
                        <label for="login" class="block text-sm font-medium text-slate-200 mb-2">Username</label>
                        <input type="text" 
                               id="login" 
                               name="login" 
                               value="{{ old('login') }}"
                               class="w-full px-4 py-3 bg-[#414b5e] border border-transparent rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                               required 
                               autofocus>
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-200 mb-2">Password</label>
                        <input type="password" 
                               id="password" 
                               name="password" 
                               class="w-full px-4 py-3 bg-[#414b5e] border border-transparent rounded-xl text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                               required>
                    </div>

                    <!-- Tombol Masuk Purple CircleHub -->
                    <div class="pt-4 flex justify-center">
                        <button type="submit" 
                                class="w-1/2 min-w-[140px] py-3 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white font-semibold rounded-full shadow-lg shadow-[#6C5CE7]/30 transition duration-200 text-center cursor-pointer">
                            Masuk
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>
</html>