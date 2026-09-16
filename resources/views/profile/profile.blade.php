<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CircleHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen flex m-0 p-0 overflow-x-hidden">

    <!-- 1. SIDEBAR KIRI -->
    <aside class="w-64 bg-[#141824] border-r border-slate-800/60 flex flex-col justify-between p-6 h-screen sticky top-0 shrink-0">
        <!-- Top Brand & Menu -->
        <div class="space-y-8">
            <h1 class="text-white font-bold text-lg tracking-wide">CircleHub</h1>

            <nav class="space-y-2 text-sm">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40 transition">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Home
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40 transition">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Kategori
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40 transition">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800/40 transition">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Notifikasi
                </a>
            </nav>
        </div>

        <!-- Bottom Menu (Account & Logout) -->
        <div class="space-y-2 text-sm pt-4 border-t border-slate-800/60">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-white bg-[#1D2132] font-medium transition">
                <svg class="w-5 h-5 text-[#6C5CE7]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Akun
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-400 hover:bg-rose-500/10 transition cursor-pointer">
                    <svg class="w-5 h-5 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. KONTEN UTAMA DENGAN BACKGROUND GAMBAR -->
    <main class="flex-1 bg-cover bg-center p-8 relative flex flex-col min-h-screen overflow-y-auto"
          style="background-image: linear-gradient(to bottom, rgba(11, 17, 32, 0.85), rgba(11, 17, 32, 0.95)), url('{{ asset('images/bgCirclehub.png') }}');">

        <h1 class="text-2xl font-bold text-white mb-6">Pengaturan Akun</h1>

        <div class="grid grid-cols-12 gap-6 items-start max-w-6xl">
            
            <!-- Kartu Kiri: Pengaturan Akun -->
            <div class="col-span-12 lg:col-span-7 bg-[#232838]/80 backdrop-blur-md p-6 rounded-2xl border border-slate-700/50 space-y-5 shadow-xl">
                
                <!-- Foto Profil -->
                <div class="flex items-center justify-between pb-2 border-b border-slate-700/40">
                    <div class="w-20 h-20 rounded-full bg-[#dcdcdc] text-black flex items-center justify-center text-3xl font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'Y', 0, 1)) }}
                    </div>
                    <button class="text-slate-400 hover:text-white transition">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Username -->
                <div class="flex items-center justify-between pt-1">
                    <div>
                        <p class="text-xs text-slate-400">Username</p>
                        <p class="text-sm font-medium text-white mt-0.5">{{ Auth::user()->name ?? 'YoogsGimang' }}</p>
                    </div>
                    <button class="text-slate-400 hover:text-white transition">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Email -->
                <div class="flex items-center justify-between pt-1">
                    <div>
                        <p class="text-xs text-slate-400">Email</p>
                        <p class="text-sm font-medium text-white mt-0.5 underline decoration-slate-500">{{ Auth::user()->email ?? 'yogssgg66@gmail.com' }}</p>
                    </div>
                    <button class="text-slate-400 hover:text-white transition">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Bio -->
                <div class="flex items-center justify-between pt-1">
                    <div>
                        <p class="text-xs text-slate-400">Bio</p>
                        <p class="text-sm font-medium text-white mt-0.5">{{ Auth::user()->bio ?? 'Gaming sleep repeat everyday' }}</p>
                    </div>
                    <button class="text-slate-400 hover:text-white transition">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Password -->
                <div class="flex items-center justify-between pt-2">
                    <div>
                        <p class="text-xs text-slate-400">Password</p>
                        <p class="text-sm font-medium text-white mt-0.5">********</p>
                    </div>
                    <button class="text-slate-400 hover:text-white transition">
                        <i data-lucide="square-pen" class="w-5 h-5"></i>
                    </button>
                </div>

            </div>

            <!-- Kartu Kanan: Detail & Danger Zone -->
            <div class="col-span-12 lg:col-span-5 space-y-6">
                
                <!-- Info ID, Role, Join at -->
                <div class="bg-[#232838]/80 backdrop-blur-md p-6 rounded-2xl border border-slate-700/50 space-y-4 shadow-xl">
                    <div>
                        <p class="text-xs text-slate-400">ID Pengguna</p>
                        <p class="text-sm font-medium text-white">{{ Auth::user()->id ?? '1' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Role</p>
                        <p class="text-sm font-medium text-white">{{ Auth::user()->role ?? 'Admin' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400">Join at</p>
                        <p class="text-sm font-medium text-white">{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y-m-d') : '2026-07-25' }}</p>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-[#232838]/80 backdrop-blur-md p-5 rounded-2xl border border-slate-700/50 space-y-3 shadow-xl">
                    <p class="text-xs font-medium text-slate-300">Danger Zone</p>
                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus akun ini?')" 
                                class="w-full bg-[#7a2828] hover:bg-[#8b2d2d] text-white py-2 rounded-lg text-xs font-medium transition cursor-pointer">
                            Hapus Akun
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>