<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} - CircleHub</title>

    {{-- Prevent Theme Flicker --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-screen w-screen overflow-hidden flex flex-col m-0 p-0 bg-white dark:bg-[#121214] transition-colors duration-500 ease-in-out">

    {{-- Navbar --}}
    <div class="relative z-30">
        <x-navbar />
    </div>

    <div class="flex flex-1 w-full overflow-hidden relative">

        {{-- Sidebar --}}
        <x-sidebar />

        {{-- AREA UTAMA --}}
        <div class="flex-1 relative h-full w-full overflow-hidden flex flex-col">

            {{-- Background Images --}}
            <img src="{{ asset('images/lightBg.jpg') }}" alt="Light Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-100 dark:opacity-0 transition-opacity duration-500 ease-in-out" />
            <img src="{{ asset('images/darkBg.jpg') }}" alt="Dark Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-0 dark:opacity-100 transition-opacity duration-500 ease-in-out" />

            {{-- Theme Toggle Button --}}
            <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="absolute top-6 right-8 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200/80 dark:border-zinc-700/80 shadow-lg backdrop-blur-md hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- SCROLLABLE CONTENT --}}
            <main class="relative z-10 w-full h-full overflow-y-auto flex flex-col items-center p-6">
                <div class="w-full max-w-3xl space-y-6 pb-16">

                    {{-- HEADER PROFIL (Horizontal — Avatar kiri, Info kanan) --}}
                    <div class="bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 md:p-8 shadow-xl transition-colors duration-500">
                        <div class="flex flex-row items-center gap-6 md:gap-10">

                            {{-- FOTO PROFIL --}}
                            <div class="w-24 h-24 md:w-32 md:h-32 rounded-full overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 text-white text-3xl md:text-4xl font-black flex items-center justify-center shadow-xl ring-4 ring-indigo-500/20 shrink-0">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                         alt="{{ $user->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>

                            {{-- INFO USER --}}
                            <div class="flex-1 min-w-0 flex flex-col items-start text-left">

                                {{-- NAMA --}}
                                <h1 class="text-xl md:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight truncate">
                                    {{ $user->name }}
                                </h1>

                                {{-- BIO --}}
                                @if($user->bio)
                                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed line-clamp-3">
                                        {{ $user->bio }}
                                    </p>
                                @else
                                    <p class="mt-2 text-sm text-zinc-400 italic">Belum ada bio.</p>
                                @endif

                                {{-- STATISTIK (Horizontal) --}}
                                <div class="flex items-center gap-6 md:gap-8 mt-4">
                                    <div>
                                        <p class="text-base font-bold text-zinc-900 dark:text-white leading-none">{{ $posts->count() }}</p>
                                        <p class="text-[10px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mt-1">Postingan</p>
                                    </div>
                                    <div class="w-px h-6 bg-zinc-200 dark:bg-zinc-800"></div>
                                    <div>
                                        <p class="text-base font-bold text-zinc-900 dark:text-white leading-none">
                                            {{ $user->created_at ? $user->created_at->format('Y') : '-' }}
                                        </p>
                                        <p class="text-[10px] uppercase tracking-wider text-zinc-500 dark:text-zinc-400 mt-1">Bergabung</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- JUDUL POSTINGAN --}}
                    <div class="w-full">
                        <h2 class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 drop-shadow-sm">
                            Postingan {{ $user->name }}
                        </h2>
                    </div>

                    {{-- DAFTAR POSTINGAN --}}
                    @forelse ($posts as $post)
                        <div class="w-full bg-white/95 dark:bg-[#181920]/95 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 shadow-xl transition-colors duration-500">
                            <x-post-card
                                :id="$post->id"
                                :username="$post->user->name ?? 'Anonim'"
                                :avatar="$post->user->avatar ?? ''"
                                :time="$post->created_at ? $post->created_at->diffForHumans() : 'Baru saja'"
                                :title="$post->title"
                                :content="$post->content"
                                :images="$post->images ?? []"
                                :likes="$post->likes_count ?? 0"
                                :comments="$post->comments_count ?? 0"
                                :isLiked="auth()->check() ? ($post->likes()->where('user_id', auth()->id())->exists()) : false"
                            />
                        </div>
                    @empty
                        <div class="w-full bg-white/95 dark:bg-[#181920]/95 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-10 text-center text-zinc-500 dark:text-zinc-400 shadow-lg">
                            <p class="text-sm">Belum ada postingan dari {{ $user->name }}.</p>
                        </div>
                    @endforelse

                </div>
            </main>

        </div>
    </div>

    {{-- Script Theme Toggle --}}
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