<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Pengaturan Akun</title>

    {{-- Script pencegah flicker saat tema dimuat --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">
        <x-sidebar />

        <main class="flex-1 relative overflow-y-auto p-8 transition-colors duration-200 bg-slate-50 dark:bg-[#000816]">
            
            {{-- Tombol Toggle Dark / Light Mode --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <h2 class="text-2xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors duration-200">Pengaturan Akun</h2>

            {{-- Pesan Sukses Notification --}}
            @if (session('status') === 'profile-updated')
                <div class="max-w-6xl mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm">
                    Profil berhasil diperbarui!
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl">
                
                {{-- Kolom Kiri: Form Informasi Profil Utama --}}
                <form action="{{ route('profile.update') }}" method="POST" class="lg:col-span-2 bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-6 transition-colors duration-200 shadow-sm">
                    @csrf
                    @method('patch')

                    {{-- Header Profile Pic + Tombol Pensil Aktif --}}
                    <div class="flex items-center justify-between pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <div class="w-20 h-20 rounded-full bg-indigo-600 text-white dark:bg-zinc-300 dark:text-zinc-900 font-bold text-3xl flex items-center justify-center select-none transition-colors duration-200">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        
                        {{-- Tombol Pensil untuk toggle mode edit/baca --}}
                        <button type="button" id="edit-toggle-btn" title="Edit Profil" class="p-2 text-zinc-500 dark:text-zinc-400 hover:text-indigo-600 dark:hover:text-white transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>

                    {{-- Username --}}
                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="name" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Username</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" readonly required class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default">
                    </div>

                    {{-- Email --}}
                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="email" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" readonly required class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default">
                    </div>

                    {{-- Bio --}}
                    <div>
                        <label for="bio" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Bio</label>
                        <textarea id="bio" name="bio" rows="2" readonly class="editable-field w-full bg-transparent border-none p-0 font-semibold text-zinc-900 dark:text-white text-base focus:ring-0 cursor-default resize-none">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    {{-- Tombol Simpan (Awalnya tersembunyi, muncul saat pensil diklik) --}}
                    <div id="save-button-wrapper" class="hidden justify-end pt-2">
                        <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                {{-- Kolom Kanan: Info Role & Danger Zone --}}
                <div class="space-y-6">
                    
                    {{-- Card Role & Join Date --}}
                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-4 transition-colors duration-200 shadow-sm">
                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Role</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-base">{{ ucfirst($user->role ?? 'Member') }}</p>
                        </div>

                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Join at</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-base">{{ $user->created_at->format('Y-m-d') }}</p>
                        </div>
                    </div>

                    {{-- Danger Zone (Ubah Password) --}}
                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-4 transition-colors duration-200 shadow-sm">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">Danger Zone</h3>

                        <button type="button" onclick="alert('Fitur Ubah Password dapat diarahkan ke form password.');" class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 dark:bg-red-900/80 dark:hover:bg-red-800 text-white dark:text-red-200 text-sm font-medium rounded-xl transition cursor-pointer text-center">
                            Ubah Password
                        </button>
                    </div>

                </div>

            </div>
        </main>
    </div>

    {{-- Script JavaScript untuk Mengontrol Aksi Pensil & Dark Mode --}}
    <script>
        // --- Toggle Edit Mode dari Pensil ---
        const editBtn = document.getElementById('edit-toggle-btn');
        const editableFields = document.querySelectorAll('.editable-field');
        const saveBtnWrapper = document.getElementById('save-button-wrapper');
        let isEditing = false;

        editBtn.addEventListener('click', function() {
            isEditing = !isEditing;

            editableFields.forEach(field => {
                if (isEditing) {
                    field.removeAttribute('readonly');
                    field.classList.remove('bg-transparent', 'border-none', 'p-0', 'focus:ring-0', 'cursor-default');
                    field.classList.add('bg-zinc-50', 'dark:bg-zinc-800/60', 'border', 'border-zinc-300', 'dark:border-zinc-700', 'p-2.5', 'rounded-lg', 'focus:ring-indigo-500');
                } else {
                    field.setAttribute('readonly', 'readonly');
                    field.classList.add('bg-transparent', 'border-none', 'p-0', 'focus:ring-0', 'cursor-default');
                    field.classList.remove('bg-zinc-50', 'dark:bg-zinc-800/60', 'border', 'border-zinc-300', 'dark:border-zinc-700', 'p-2.5', 'rounded-lg', 'focus:ring-indigo-500');
                }
            });

            if (isEditing) {
                saveBtnWrapper.classList.remove('hidden');
                saveBtnWrapper.classList.add('flex');
                document.getElementById('name').focus();
            } else {
                saveBtnWrapper.classList.add('hidden');
                saveBtnWrapper.classList.remove('flex');
            }
        });

        // --- Toggle Dark / Light Mode ---
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        themeToggleBtn.addEventListener('click', function() {
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>