<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name ?? 'Detail Kategori' }} - CircleHub</title>

    {{-- Script Anti-Flicker Mode Tema --}}
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

        /* Background Fixed & Terpusat */
        .bg-layer-light {
            background-image: url('{{ asset("images/lightbg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .bg-layer-dark {
            background-image: url('{{ asset("images/darkBg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    {{-- Toast Notification --}}
    <div id="toast-share" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm font-medium">
        <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span>Link postingan berhasil disalin!</span>
    </div>

    <div class="flex flex-1 w-full overflow-hidden relative">
        <x-sidebar />

        <main class="flex-1 relative overflow-y-auto p-8 transition-colors duration-200 bg-slate-50 dark:bg-[#000816] flex flex-col items-center">

            {{-- Layer Gambar Background Fixed (Diam saat di-scroll) --}}
            <div class="fixed inset-0 pointer-events-none z-0 bg-layer-light opacity-100 dark:opacity-0 transition-opacity duration-300"></div>
            <div class="fixed inset-0 pointer-events-none z-0 bg-layer-dark opacity-0 dark:opacity-100 transition-opacity duration-300"></div>

            {{-- Tombol Toggle Dark / Light Mode --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- Content Wrapper --}}
            <div class="relative z-10 w-full max-w-2xl flex flex-col items-center">
                <div class="w-full mb-3">
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 capitalize drop-shadow-sm transition-colors duration-300">
                        {{ $category->name ?? '' }}
                    </span>
                </div>

                @forelse ($category->posts as $post)
                    <div class="w-full bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-xl transition-colors duration-300 mb-6">

                        <x-post-card
                            :id="$post->id"
                            :username="$post->user->name ?? 'Anonim'"
                            :avatar="$post->user->avatar ?? null"
                            :time="$post->created_at ? $post->created_at->diffForHumans() : 'Baru saja'"
                            :title="$post->title ?? ''"
                            :content="$post->caption ?? $post->body ?? $post->content ?? ''"
                            :images="$post->images ?? []"
                            :likes="$post->likes_count ?? 0"
                            :comments="$post->comments_count ?? 0"
                            :isLiked="auth()->check() ? ($post->likes()->where('user_id', auth()->id())->exists()) : false"
                        />

                    </div>
                @empty
                    <div class="w-full bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-10 shadow-xl text-center transition-colors duration-300">
                        <p class="text-zinc-500 dark:text-zinc-400 text-sm">Belum ada postingan di kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    {{-- Script Toggle Dark / Light Mode --}}
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (themeToggleBtn && themeToggleDarkIcon && themeToggleLightIcon) {
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
        }
    </script>
</body>
</html>