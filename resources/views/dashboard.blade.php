<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - CircleHub</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #0b1120;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
    </style>
</head>
<body class="h-screen w-screen bg-[#0b1120] text-white overflow-hidden m-0 p-0">

    <!-- Outer Container FULL SCREEN -->
    <div class="w-full h-full flex flex-col md:flex-row overflow-hidden">
        
        <!-- Sidebar Kiri -->
        <aside class="w-full md:w-64 bg-[#0b1120] p-6 flex flex-col justify-between border-b md:border-b-0 md:border-r border-sky-500/20 shrink-0">
            <div>
                <!-- Brand Title -->
                <div class="text-sky-500 font-semibold text-lg mb-6">
                    admin dashboard
                </div>

                <!-- Navigasi -->
                <nav class="space-y-2 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2.5 rounded-xl bg-sky-500/10 text-sky-400 border border-sky-500/30 font-semibold transition">
                        Dashboard
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition">
                        Statistik
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition">
                        Member
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition">
                        Postingan
                    </a>
                    <a href="#" class="flex items-center px-4 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/50 transition">
                        Kategori
                    </a>
                </nav>
            </div>

            <!-- Bagian Bawah Sidebar -->
            <div class="pt-8 space-y-2 text-sm">
                <a href="/" class="flex items-center px-4 py-2 text-slate-300 hover:text-white transition">
                    Back to Home
                </a>
                
                <!-- Form Logout Resmi Breeze -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full px-4 py-2 text-slate-300 hover:text-red-400 transition text-left cursor-pointer">
                        Sign out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <main class="flex-1 p-6 md:p-10 bg-[#0b1120] overflow-y-auto">
            <h1 class="text-3xl font-bold text-white mb-8">Dashboard</h1>

            <!-- Grid Stat Cards -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
                <div class="bg-[#1b2234] p-5 rounded-2xl border border-slate-800/80 shadow-md">
                    <span class="text-xs font-medium text-slate-400 block mb-2">Member</span>
                    <span class="text-3xl font-bold text-white">00</span>
                </div>
                <div class="bg-[#1b2234] p-5 rounded-2xl border border-slate-800/80 shadow-md">
                    <span class="text-xs font-medium text-slate-400 block mb-2">Admin</span>
                    <span class="text-3xl font-bold text-white">00</span>
                </div>
                <div class="bg-[#1b2234] p-5 rounded-2xl border border-slate-800/80 shadow-md">
                    <span class="text-xs font-medium text-red-400 block mb-2">Banned</span>
                    <span class="text-3xl font-bold text-white">00</span>
                </div>
                <div class="bg-[#1b2234] p-5 rounded-2xl border border-slate-800/80 shadow-md">
                    <span class="text-xs font-medium text-slate-400 block mb-2">Komunitas</span>
                    <span class="text-3xl font-bold text-white">00</span>
                </div>
                <div class="bg-[#1b2234] p-5 rounded-2xl border border-slate-800/80 shadow-md">
                    <span class="text-xs font-medium text-slate-400 block mb-2">Postingan</span>
                    <span class="text-3xl font-bold text-white">00</span>
                </div>
            </div>

            <!-- Tabel Aktivitas Terbaru -->
            <div class="bg-[#1b2234] p-6 rounded-2xl border border-slate-800/80 shadow-md">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-semibold text-white">Aktivitas Terbaru</h2>
                    <a href="#" class="text-xs text-sky-400 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-300">
                        <thead class="text-xs text-slate-400 border-b border-slate-700/50">
                            <tr>
                                <th class="pb-3 font-medium">Username</th>
                                <th class="pb-3 font-medium">Hobi</th>
                                <th class="pb-3 font-medium">Waktu</th>
                                <th class="pb-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800">
                            <tr>
                                <td class="py-4 flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-sky-600 flex items-center justify-center text-xs font-bold text-white">Y</div>
                                    <span class="font-medium text-white">YogaHobby</span>
                                </td>
                                <td class="py-4">Running</td>
                                <td class="py-4 text-slate-400">2 jam lalu</td>
                                <td class="py-4 text-right">
                                    <button class="px-3.5 py-1.5 bg-sky-500/20 text-sky-400 hover:bg-sky-500/30 rounded-lg text-xs font-medium transition cursor-pointer">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="py-4 flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-xs font-bold text-white">C</div>
                                    <span class="font-medium text-white">ChefJevan</span>
                                </td>
                                <td class="py-4">Hiking</td>
                                <td class="py-4 text-slate-400">4 jam lalu</td>
                                <td class="py-4 text-right">
                                    <button class="px-3.5 py-1.5 bg-sky-500/20 text-sky-400 hover:bg-sky-500/30 rounded-lg text-xs font-medium transition cursor-pointer">
                                        Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>

</body>
</html>