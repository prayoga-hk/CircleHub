<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Home</title>

    {{-- Mencegah flicker tema saat reload --}}
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
<body class="h-screen w-screen overflow-hidden flex flex-col m-0 p-0 bg-white dark:bg-[#121214] transition-colors duration-200 ease-in-out">
    <x-custom-cursor />

    {{-- Navbar --}}
    <div class="relative z-30 shrink-0">
        <x-navbar />
    </div>

    <div class="flex flex-1 min-h-0 w-full overflow-hidden relative">

        {{-- AREA 1: Sidebar kiri (tinggi penuh, tidak ikut scroll) --}}
        <div class="h-full shrink-0 z-20">
            <x-sidebar />
        </div>

        {{-- PEMBUNGKUS UTAMA: satu-satunya area yang scroll (bukan body) --}}
        <div id="scroll-area" class="flex-1 min-w-0 relative h-full overflow-y-auto overflow-x-hidden">

            {{-- Background gambar (fixed, tidak ikut scroll) --}}
            <div class="fixed inset-0 pointer-events-none z-0">
                <img src="{{ asset('images/lightBg.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-100 dark:opacity-0 transition-opacity duration-200 ease-in-out" />
                <img src="{{ asset('images/darkBg.jpg') }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-0 dark:opacity-100 transition-opacity duration-200 ease-in-out" />
            </div>

            {{-- TOMBOL TOGGLE TEMA (Fixed di pojok kanan atas layar) --}}
            <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="absolute top-6 right-8 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200/80 dark:border-zinc-700/80 shadow-lg backdrop-blur-md hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <div class="relative z-10 w-full flex items-start gap-8 px-8 pb-20 pt-16 max-w-[1400px] mx-auto">

                {{-- AREA 2: FEED POSTINGAN --}}
                <main class="flex-1 min-w-0 max-w-[650px]">

                    {{-- SEARCH BAR --}}
                    <div class="sticky top-8 z-40 pb-4">
                        <form action="{{ route('pages.posts.index') }}" method="GET" class="w-full">
                            <div class="relative flex items-center">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="Cari berdasarkan judul, konten, atau username..."
                                       class="w-full pl-11 pr-16 py-3 rounded-2xl bg-white/80 dark:bg-[#181920]/80 border border-zinc-200/80 dark:border-zinc-800/80 text-sm text-zinc-900 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-500 shadow-lg backdrop-blur-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">

                                <div class="absolute left-4 text-zinc-400 pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                </div>

                                @if(request('search'))
                                    <a href="{{ route('pages.posts.index') }}" class="absolute right-4 text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 text-xs font-semibold">
                                        Batal
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    {{-- DAFTAR POSTINGAN --}}
                    <div class="space-y-5">
                        @forelse ($posts as $post)
                            <div class="w-full bg-white/70 dark:bg-[#181920]/70 backdrop-blur-xl border border-white/40 dark:border-zinc-700/40 rounded-3xl p-6 shadow-xl transition-colors duration-200 ease-in-out">
                                <x-post-card
                                    :id="$post->id"
                                    :userId="$post->user->id ?? null"
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
                            <div class="w-full bg-white/70 dark:bg-[#181920]/70 backdrop-blur-xl border border-white/40 dark:border-zinc-700/40 rounded-3xl p-8 text-center text-zinc-500 dark:text-zinc-400 shadow-lg">
                                @if(request('search'))
                                    Tidak ditemukan postingan untuk pencarian "<span class="font-bold text-zinc-800 dark:text-zinc-200">{{ request('search') }}</span>".
                                @else
                                    Belum ada postingan di beranda.
                                @endif
                            </div>
                        @endforelse
                    </div>
                </main>

                {{-- AREA 3: KOLOM KANAN --}}
                <aside class="hidden xl:block flex-1 w-full max-w-[500px] self-stretch">

                    {{-- CARD POPULAR MEMBER --}}
                    <div class="sticky top-8 z-30 flex flex-col max-h-[calc(100vh-6rem)] bg-[#212529]/90 backdrop-blur-xl border border-zinc-700/50 rounded-3xl p-6 shadow-xl">
                        <h3 class="text-lg font-medium text-white text-center mb-5 shrink-0">Popular Member</h3>

                        <div class="space-y-4 overflow-y-auto min-h-0 pr-2">
                            @forelse($popularMembers ?? [] as $member)
                                <div class="flex items-center justify-between gap-3 group cursor-pointer">
                                    <div class="flex items-center gap-4 min-w-0">
                                        {{-- Avatar --}}
                                        <div class="w-11 h-11 rounded-full overflow-hidden bg-indigo-600 text-white font-bold flex items-center justify-center shrink-0">
                                            @if ($member->avatar)
                                                <img src="{{ asset('storage/' . $member->avatar) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                            @else
                                                <span>{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        {{-- Nama & role --}}
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-zinc-100 truncate group-hover:text-indigo-400 transition-colors">{{ $member->name }}</p>
                                            <span class="text-xs text-zinc-400">Penghobi</span>
                                        </div>
                                    </div>

                                    {{-- Jumlah like --}}
                                    <div class="shrink-0 flex items-center gap-1.5 text-zinc-100">
                                        <svg class="w-4 h-4 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                        </svg>
                                        <span class="text-sm font-bold">{{ $member->likes_count ?? 0 }}</span>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-zinc-400 text-center py-4">Belum ada member populer.</p>
                            @endforelse
                        </div>

                        {{-- Pagination manual --}}
                        @if(isset($popularMembers) && $popularMembers instanceof \Illuminate\Pagination\AbstractPaginator)
                            <div class="shrink-0 border-t border-zinc-700/50 mt-4 pt-4 flex items-center justify-between text-sm font-medium">
                                @if($popularMembers->onFirstPage())
                                    <span class="text-zinc-600 cursor-not-allowed select-none">Prev</span>
                                @else
                                    <a href="{{ $popularMembers->previousPageUrl() }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">Prev</a>
                                @endif

                                <span class="text-xs text-zinc-400">
                                    Hal {{ $popularMembers->currentPage() }} / {{ max($popularMembers->lastPage(), 1) }}
                                </span>

                                @if($popularMembers->hasMorePages())
                                    <a href="{{ $popularMembers->nextPageUrl() }}" class="text-indigo-400 hover:text-indigo-300 transition-colors">Next</a>
                                @else
                                    <span class="text-zinc-600 cursor-not-allowed select-none">Next</span>
                                @endif
                            </div>
                        @endif
                    </div>
                </aside>

            </div>
        </div>
    </div>

    {{-- Theme switcher --}}
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        if (themeToggleBtn) {
            if (document.documentElement.classList.contains('dark')) {
                themeToggleLightIcon.classList.remove('hidden');
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
            }

            themeToggleBtn.addEventListener('click', function () {
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
