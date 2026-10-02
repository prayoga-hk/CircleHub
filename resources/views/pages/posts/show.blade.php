<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Home / Detail Post</title>

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
<body class="bg-gray-100 text-zinc-900 dark:bg-[#18181b] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200 relative">

    {{-- 1. Gambar Background Light Mode --}}
    <img 
        src="{{ asset('images/lightBg.jpg') }}" 
        alt="Light Background" 
        class="fixed inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-100 dark:opacity-0 transition-opacity duration-500"
    />

    {{-- 2. Gambar Background Dark Mode --}}
    <img 
        src="{{ asset('images/darkBg.jpg') }}" 
        alt="Dark Background" 
        class="fixed inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-0 dark:opacity-100 transition-opacity duration-500"
    />

    {{-- 3. Layer Pelapis Transparan & Blur untuk Keterbacaan Konten --}}
    <div class="fixed inset-0 pointer-events-none z-0 bg-white/30 dark:bg-black/50 backdrop-blur-[2px]"></div>

    {{-- Navbar Utama --}}
    <div class="relative z-20">
        <x-navbar />
    </div>

    <div class="flex flex-1 w-full overflow-hidden relative z-10">

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- Container Konten Utama (Wajib bg-transparent) --}}
        <main class="flex-1 relative bg-transparent overflow-y-auto flex flex-col items-center p-6 transition-colors duration-200">

            {{-- Tombol Toggle Theme --}}
            <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="fixed top-20 right-6 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-lg backdrop-blur-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <div class="relative z-10 w-full max-w-xl space-y-4 pb-12">
                
                {{-- Tombol Kembali --}}
                <a href="{{ route('pages.posts.index') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition mb-1">
                    &larr; Kembali ke Feed Utama
                </a>

                {{-- Card Utama Post & Komentar --}}
                <div class="w-full bg-white/80 dark:bg-[#181920]/80 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 shadow-xl transition-colors duration-300 space-y-4">
                    
                    <x-post-card
                        :id="$post->id"
                        :username="$post->user->name ?? 'Anonim'"
                        :time="$post->created_at ? $post->created_at->diffForHumans() : 'Baru saja'"
                        :title="$post->title"
                        :content="$post->content"
                        :images="$post->images"
                        :likes="$post->likes_count ?? $post->likes ?? 0"
                        :comments="$post->comments_count ?? $post->comments ?? 0"
                        :isLiked="auth()->check() ? ($post->is_liked_by_user ?? $post->likes()->where('user_id', auth()->id())->exists()) : false"
                    />

                    {{-- Section Komentar --}}
                    <div class="pt-2 space-y-3">
                        <div class="space-y-2 max-h-60 overflow-y-auto pr-1 custom-scrollbar">
                            @forelse ($post->comments as $comment)
                                <div class="w-full bg-zinc-100/80 dark:bg-zinc-800/60 border border-zinc-200/50 dark:border-zinc-700/40 px-4 py-2.5 rounded-2xl text-xs flex items-center gap-2 transition-colors duration-200">
                                    <span class="font-bold text-zinc-900 dark:text-white shrink-0">
                                        {{ $comment->user->name ?? 'User' }}:
                                    </span>
                                    <span class="text-zinc-700 dark:text-zinc-300 break-words flex-1">
                                        {{ $comment->body }}
                                    </span>
                                </div>
                            @empty
                                <div class="w-full bg-zinc-100/50 dark:bg-zinc-800/30 px-4 py-3 rounded-2xl text-xs text-center text-zinc-500 dark:text-zinc-400">
                                    Belum ada komentar. Jadilah yang pertama!
                                </div>
                            @endforelse
                        </div>

                        {{-- Form Input Komentar --}}
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="flex items-center gap-2 pt-2">
                            @csrf
                            <input 
                                type="text" 
                                name="body" 
                                required 
                                autocomplete="off"
                                placeholder="Tulis komentar..." 
                                class="flex-1 bg-zinc-100/90 dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700/80 text-zinc-900 dark:text-white placeholder-zinc-400 text-xs px-4 py-3 rounded-2xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                            />
                            <button 
                                type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-xs px-5 py-3 rounded-2xl transition-all duration-200 cursor-pointer shrink-0 shadow-md active:scale-95"
                            >
                                Kirim
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Script Switch Theme Dark / Light Mode -->
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
                localStorage.setItem('theme', 'dark') === false; // penanganan variabel
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });
    </script>
</body>
</html>