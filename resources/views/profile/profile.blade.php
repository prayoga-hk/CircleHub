<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - CircleHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Konfigurasi tailwind untuk mode gelap berbasis class 'dark'
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 dark:bg-[#0b1120] text-slate-800 dark:text-white font-sans min-h-screen flex m-0 p-0 overflow-x-hidden transition-colors duration-200">

    <!-- 1. SIDEBAR KIRI -->
    <aside class="w-64 bg-white dark:bg-[#141824] border-r border-slate-200 dark:border-slate-800/60 flex flex-col justify-between p-6 h-screen sticky top-0 shrink-0">
        <div class="space-y-8">
            <h1 class="text-slate-900 dark:text-white font-bold text-lg tracking-wide">CircleHub</h1>

            <nav class="space-y-2 text-sm">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/40 transition">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    Home
                </a>
                <a href="{{ route('categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/40 transition">
                    <i data-lucide="grid" class="w-5 h-5"></i>
                    Kategori
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/40 transition">
                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                    Buat
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-800/40 transition">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    Notifikasi
                </a>
            </nav>
        </div>

        <!-- Bottom Menu -->
        <div class="space-y-2 text-sm pt-4 border-t border-slate-200 dark:border-slate-800/60">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-indigo-600 dark:text-white bg-indigo-50 dark:bg-[#1D2132] font-medium transition">
                <i data-lucide="user" class="w-5 h-5"></i>
                Akun
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition cursor-pointer">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. KONTEN UTAMA -->
    <main class="flex-1 p-8 relative flex flex-col min-h-screen overflow-y-auto">

        <!-- Flash Message Notification -->
        @if (session('status') === 'profile-updated')
            <div class="max-w-6xl mb-4 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 dark:text-emerald-400 text-sm">
                Profil dan foto berhasil diperbarui!
            </div>
        @endif

        <div class="grid grid-cols-12 gap-6 items-start max-w-6xl">
            
            <!-- KARTU KIRI: FORM EDIT PROFIL & FOTO -->
            <div class="col-span-12 lg:col-span-8 bg-white dark:bg-[#232838]/80 backdrop-blur-md p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm space-y-6">
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    @method('patch')

                    <!-- Header Foto Profil -->
                    <div class="flex items-center justify-between pb-6 border-b border-slate-200 dark:border-slate-700/40">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                @if (Auth::user()->avatar)
                                    <img id="avatar-preview" src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500">
                                @else
                                    <div id="avatar-placeholder" class="w-20 h-20 rounded-full bg-indigo-600 text-white flex items-center justify-center text-3xl font-bold">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'J', 0, 1)) }}
                                    </div>
                                    <img id="avatar-preview" class="w-20 h-20 rounded-full object-cover border-2 border-indigo-500 hidden" alt="Preview">
                                @endif
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-800 dark:text-white">Foto Profil</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Klik ikon pensil di sebelah kanan untuk mengubah foto</p>
                            </div>
                        </div>

                        <!-- Tombol Pensil (Trigger Input File) -->
                        <button type="button" onclick="document.getElementById('avatar-input').click()" class="p-2.5 text-slate-500 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-slate-700 rounded-xl transition cursor-pointer border border-slate-200 dark:border-slate-700/60" title="Ubah Foto">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </button>

                        <!-- Input File Tersembunyi -->
                        <input type="file" id="avatar-input" name="avatar" class="hidden" accept="image/*" onchange="previewImage(event)">
                    </div>

                    @error('avatar')
                        <p class="text-xs text-rose-500">{{ $message }}</p>
                    @enderror

                    <!-- Input Username -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Username</label>
                        <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#1a1f2c] text-slate-800 dark:text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#1a1f2c] text-slate-800 dark:text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @error('email') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input Bio -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 dark:text-slate-400 mb-1">Bio</label>
                        <textarea name="bio" rows="3" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#1a1f2c] text-slate-800 dark:text-white text-sm font-medium focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old('bio', Auth::user()->bio) }}</textarea>
                        @error('bio') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="pt-2 flex justify-end">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-xs px-5 py-2.5 rounded-xl shadow-sm transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

            </div>

            <!-- KARTU KANAN: INFO & DANGER ZONE -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                
                <!-- Info Role & Toggle Theme -->
                <div class="bg-white dark:bg-[#232838]/80 backdrop-blur-md p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-slate-400">Role</p>
                            <p class="text-base font-bold text-slate-800 dark:text-white">{{ ucfirst(Auth::user()->role ?? 'Member') }}</p>
                        </div>

                        <!-- Tombol Saklar Gelap / Terang -->
                        <button id="theme-toggle" type="button" class="p-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition cursor-pointer">
                            <i id="theme-toggle-dark-icon" data-lucide="moon" class="w-5 h-5 hidden"></i>
                            <i id="theme-toggle-light-icon" data-lucide="sun" class="w-5 h-5 hidden"></i>
                        </button>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-400">Join at</p>
                        <p class="text-sm font-bold text-slate-800 dark:text-white">{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y-m-d') : '2026-09-29' }}</p>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="bg-white dark:bg-[#232838]/80 backdrop-blur-md p-6 rounded-2xl border border-slate-200 dark:border-slate-700/50 shadow-sm space-y-3">
                    <p class="text-xs font-bold text-slate-700 dark:text-slate-300">Danger Zone</p>

                    <button type="button" class="w-full bg-slate-700 hover:bg-slate-800 dark:bg-slate-800 dark:hover:bg-slate-700 text-white py-2.5 rounded-xl text-xs font-semibold transition cursor-pointer">
                        Ubah Password
                    </button>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')
                        <button type="submit" onclick="return confirm('Apakah kamu yakin ingin menghapus akun ini?')" class="w-full bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-xl text-xs font-semibold transition cursor-pointer">
                            Hapus Akun
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </main>

    <script>
        lucide.createIcons();

        // 1. Logika Preview Foto Profil Saat Dipilih
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');
            const placeholder = document.getElementById('avatar-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) {
                        placeholder.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        // 2. Logika Dark/Light Mode Switcher
        const themeToggleBtn = document.getElementById('theme-toggle');
        const darkIcon = document.getElementById('theme-toggle-dark-icon');
        const lightIcon = document.getElementById('theme-toggle-light-icon');

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
            lightIcon.classList.remove('hidden');
        } else {
            document.documentElement.classList.remove('dark');
            darkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            darkIcon.classList.toggle('hidden');
            lightIcon.classList.toggle('hidden');

            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }
        });
    </script>
</body>
</html>