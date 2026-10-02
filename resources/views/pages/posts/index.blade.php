<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Home</title>

    {{-- Script Mencegah Flicker Tema Saat Page Reload --}}
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
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col m-0 p-0 bg-white dark:bg-[#121214] transition-colors duration-500 ease-in-out">

    {{-- Navbar Utama --}}
    <div class="relative z-30">
        <x-navbar />
    </div>

    <div class="flex flex-1 w-full overflow-hidden relative">

        {{-- Sidebar Menu Navigasi --}}
        <x-sidebar />

        {{-- AREA UTAMA LAYOUT --}}
        <div class="flex-1 relative h-full w-full overflow-hidden">

            {{-- GAMBAR BACKGROUND --}}
            <img src="{{ asset('images/lightBg.jpg') }}" alt="Light Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-100 dark:opacity-0 transition-opacity duration-500 ease-in-out" />
            <img src="{{ asset('images/darkBg.jpg') }}" alt="Dark Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-0 dark:opacity-100 transition-opacity duration-500 ease-in-out" />

            {{-- TOMBOL TOGGLE GELAP / TERANG --}}
            <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="absolute top-6 right-8 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200/80 dark:border-zinc-700/80 shadow-lg backdrop-blur-md hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- CONTAINER SCROLLABLE FEED POSTINGAN --}}
            <main class="relative z-10 w-full h-full overflow-y-auto flex flex-col items-center p-6">
                <div class="w-full max-w-xl space-y-6 pb-16">

                    {{-- KOTAK PENCARIAN (SEARCH BAR) --}}
                    <form action="{{ route('pages.posts.index') }}" method="GET" class="w-full">
                        <div class="relative flex items-center">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Cari berdasarkan judul, konten, atau username..."
                                   class="w-full pl-11 pr-10 py-3 rounded-2xl bg-white/90 dark:bg-[#181920]/90 border border-zinc-200/80 dark:border-zinc-800/80 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 shadow-lg backdrop-blur-md focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-300">

                            {{-- Ikon Search --}}
                            <div class="absolute left-4 text-zinc-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </div>

                            {{-- Tombol Reset Pencarian --}}
                            @if(request('search'))
                                <a href="{{ route('pages.posts.index') }}" class="absolute right-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 text-xs font-semibold">
                                    Batal
                                </a>
                            @endif
                        </div>
                    </form>

                    {{-- DAFTAR POSTINGAN --}}
                    @forelse ($posts as $post)
                        <div class="w-full bg-white/95 dark:bg-[#181920]/95 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 shadow-xl transition-colors duration-500 ease-in-out">
                            <x-post-card
                                :id="$post->id"
                                :username="$post->user->name ?? 'Anonim'"
                                :avatar="$post->user->avatar ?? ''"
                                :time="$post->created_at ? $post->created_at->diffForHumans() : 'Baru saja'"
                                :title="$post->title"
                                :content="$post->content"
                                :images="$post->images"
                                :likes="is_numeric($post->likes) ? (int)$post->likes : ($post->likes_count ?? $post->likes()->count())"
                                :comments="is_numeric($post->comments) ? (int)$post->comments : ($post->comments_count ?? $post->comments()->count())"
                                :isLiked="auth()->check() ? ($post->is_liked_by_user ?? $post->isLikedBy(auth()->id())) : false"
                            />
                        </div>
                    @empty
                        <div class="w-full bg-white/95 dark:bg-[#181920]/95 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-8 text-center text-zinc-500 dark:text-zinc-400 shadow-lg transition-colors duration-500 ease-in-out">
                            @if(request('search'))
                                Tidak ditemukan postingan untuk pencarian "<span class="font-bold text-zinc-800 dark:text-zinc-200">{{ request('search') }}</span>".
                            @else
                                Belum ada postingan di beranda.
                            @endif
                        </div>
                    @endforelse

                </div>
            </main>

        </div>
    </div>

    {{-- Script Theme Switcher --}}
    <script>
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
