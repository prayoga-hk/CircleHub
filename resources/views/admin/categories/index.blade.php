<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - CircleHub</title>

    {{-- Script anti-flicker mode tema --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; } 
        /* Efek Transisi Smooth */
        *, ::before, ::after {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>
<body class="bg-[#f3f4f6] dark:bg-[#0b0e14] text-zinc-800 dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col">

    {{-- Header Atas (Topbar) --}}
    <header class="h-16 bg-white dark:bg-[#16171d] border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between px-8 shrink-0 z-30">
        <div class="flex items-center gap-3">
            <span class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">CircleHub</span>
        </div>
        <div class="flex items-center gap-4">
            <button type="button" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition p-2 cursor-pointer">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        {{-- Sidebar Kiri --}}
        <aside class="w-64 bg-white dark:bg-[#16171d] border-r border-zinc-200 dark:border-zinc-800 flex flex-col justify-between py-6 px-4 shrink-0 z-20">
            <nav class="space-y-2">
                {{-- Home --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                    <span>Home</span>
                </a>

                {{-- Kategori (Menu Aktif) --}}
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-200 dark:bg-[#2a2b32] text-zinc-900 dark:text-white font-medium transition">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a5.97 5.97 0 00-.942 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    <span>Kategori</span>
                </a>

                {{-- Buat --}}
                <a href="{{ route('pages.posts.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Buat</span>
                </a>

                {{-- Notifikasi --}}
                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                    <span>Notifikasi</span>
                </a>
            </nav>

            {{-- Bottom Links --}}
            <div class="space-y-2 border-t border-zinc-200 dark:border-zinc-800 pt-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Akun</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-red-500/10 hover:text-red-500 transition text-left cursor-pointer">
                        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 overflow-y-auto bg-[#f3f4f6] dark:bg-[#0b0e14] p-8 relative flex flex-col items-center">
            
            {{-- Tombol Toggle Theme (Berganti Otomatis Icon Bulan/Matahari) --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-40 p-2.5 rounded-full bg-white dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition cursor-pointer">
                <svg id="theme-toggle-dark-icon" class="hidden dark:block w-5 h-5 fill-current text-zinc-300" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg id="theme-toggle-light-icon" class="block dark:hidden w-5 h-5 fill-current text-zinc-700" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>

            {{-- Container Kategori --}}
            <div class="w-full max-w-xl space-y-6 pt-4">
                @forelse($categories as $category)
                    <div class="flex items-center justify-between p-2">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-full bg-zinc-300 dark:bg-zinc-600 shrink-0"></div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">{{ $category->name }}</h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 font-normal">{{ $category->posts_count ?? 0 }} member</p>
                            </div>
                        </div>

                        <a href="{{ route('categories.show', $category->id) }}" 
                           class="bg-[#6366f1] hover:bg-[#4f46e5] text-white font-medium px-8 py-2.5 rounded-full transition duration-200 text-sm shadow-md">
                           Lihat
                        </a>
                    </div>
                @empty
                    <div class="flex items-center justify-between p-2">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-full bg-zinc-300 dark:bg-zinc-600 shrink-0"></div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">Coding</h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">0 member</p>
                            </div>
                        </div>
                        <button class="bg-[#6366f1] text-white font-medium px-8 py-2.5 rounded-full text-sm">Lihat</button>
                    </div>

                    <div class="flex items-center justify-between p-2">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-full bg-zinc-300 dark:bg-zinc-600 shrink-0"></div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">Music</h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">0 member</p>
                            </div>
                        </div>
                        <button class="bg-[#6366f1] text-white font-medium px-8 py-2.5 rounded-full text-sm">Lihat</button>
                    </div>

                    <div class="flex items-center justify-between p-2">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-full bg-zinc-300 dark:bg-zinc-600 shrink-0"></div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">Gaming</h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400">0 member</p>
                            </div>
                        </div>
                        <button class="bg-[#6366f1] text-white font-medium px-8 py-2.5 rounded-full text-sm">Lihat</button>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    {{-- Script Theme Switcher Smooth --}}
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
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