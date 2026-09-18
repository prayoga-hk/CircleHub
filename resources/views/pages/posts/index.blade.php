<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Posts</title>

    {{-- Script untuk mencegah flicker warna saat halaman baru dibuka --}}
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
<body class="bg-gray-100 text-zinc-900 dark:bg-[#18181b] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">

        <x-sidebar />

        {{-- Main Container --}}
        <main class="flex-1 relative bg-slate-50 dark:bg-[#000816] overflow-y-auto flex flex-col items-center p-6 transition-colors duration-200">

            {{-- Tombol Toggle Gelap / Terang --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-6 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-lg backdrop-blur-md hover:scale-105 transition-all cursor-pointer">
                <!-- Ikon Matahari (Tampil saat mode dark) -->
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <!-- Ikon Bulan (Tampil saat mode light) -->
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <div class="relative z-10 w-full max-w-xl space-y-4">
                @forelse ($posts as $post)
                    <x-post-card
                        :id="$post->id"
                        :username="$post->user->name ?? 'Anonim'"
                        :time="$post->created_at->diffForHumans()"
                        :title="$post->title"
                        :content="$post->content"
                        :image="$post->image"
                        :likes="$post->likes_count ?? 0"
                        :comments="$post->comments_count ?? 0"
                        :isLiked="auth()->check() ? $post->likes()->where('user_id', auth()->id())->exists() : false"
                    />
                @empty
                    <div class="p-6 text-center text-zinc-600 dark:text-zinc-400 bg-white/60 dark:bg-zinc-900/60 rounded-xl backdrop-blur-sm border border-zinc-200 dark:border-zinc-800">
                        Belum ada postingan saat ini.
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    <!-- Script logika penukaran mode -->
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