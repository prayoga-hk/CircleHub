<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Kategori</title>

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
<body class="h-screen w-screen overflow-hidden flex flex-col m-0 p-0 bg-white dark:bg-[#121214] transition-colors duration-500 ease-in-out"
      x-data="{
          viewMode: 'grid',
          searchQuery: ''
      }">

    {{-- Navbar Utama --}}
    <div class="relative z-30">
        <x-navbar />
    </div>

    <div class="flex flex-1 w-full overflow-hidden relative">

        {{-- Sidebar Navigation --}}
        <x-sidebar />

        {{-- AREA UTAMA --}}
        <div class="flex-1 relative h-full w-full overflow-hidden flex flex-col">

            {{-- Background Images --}}
            <img src="{{ asset('images/lightBg.jpg') }}" alt="Light Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-100 dark:opacity-0 transition-opacity duration-500 ease-in-out" />
            <img src="{{ asset('images/darkBg.jpg') }}" alt="Dark Background" class="absolute inset-0 w-full h-full object-cover pointer-events-none z-0 opacity-0 dark:opacity-100 transition-opacity duration-500 ease-in-out" />

            {{-- Theme Toggle Button --}}
            <button id="theme-toggle" type="button" aria-label="Toggle Theme" class="absolute top-6 right-8 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200/80 dark:border-zinc-700/80 shadow-lg backdrop-blur-md hover:scale-105 active:scale-95 transition-all duration-300 cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- SCROLLABLE CONTENT AREA --}}
            <main class="relative z-10 w-full h-full overflow-y-auto p-6 md:p-10">
                <div class="max-w-6xl mx-auto space-y-8 pb-20">

                    {{-- HEADER & TOOLBAR (Search & View Toggle) --}}
                    <div class="bg-white/80 dark:bg-[#181920]/80 backdrop-blur-xl border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 shadow-xl flex flex-col md:flex-row items-center justify-between gap-4">
                        <div>
                            <h1 class="text-2xl font-extrabold text-zinc-900 dark:text-white tracking-tight">Eksplorasi Kategori</h1>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Temukan hobi dan komunitas yang sesuai dengan minatmu</p>
                        </div>

                        <div class="flex items-center gap-3 w-full md:w-auto">
                            {{-- Input Cari Kategori --}}
                            <div class="relative w-full md:w-64">
                                <input type="text"
                                       x-model="searchQuery"
                                       placeholder="Cari kategori..."
                                       class="w-full pl-9 pr-4 py-2 rounded-xl text-xs bg-zinc-100/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-white border border-zinc-200 dark:border-zinc-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all">
                                <svg class="w-4 h-4 text-zinc-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>

                            {{-- TOGGLE LAYOUT (GRID VS LIST) --}}
                            <div class="flex items-center bg-zinc-100 dark:bg-zinc-800/80 p-1 rounded-xl border border-zinc-200 dark:border-zinc-700">
                                {{-- Button Grid --}}
                                <button @click="viewMode = 'grid'"
                                        :class="viewMode === 'grid' ? 'bg-white dark:bg-indigo-600 text-indigo-600 dark:text-white shadow-sm' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'"
                                        class="p-2 rounded-lg transition-all duration-200 cursor-pointer"
                                        title="Tampilan Grid">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                </button>
                                {{-- Button List --}}
                                <button @click="viewMode = 'list'"
                                        :class="viewMode === 'list' ? 'bg-white dark:bg-indigo-600 text-indigo-600 dark:text-white shadow-sm' : 'text-zinc-500 hover:text-zinc-900 dark:hover:text-white'"
                                        class="p-2 rounded-lg transition-all duration-200 cursor-pointer"
                                        title="Tampilan List">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- GRID VIEW MODE --}}
                    <div x-show="viewMode === 'grid'"
                         x-transition
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($categories as $cat)
                            <div x-show="searchQuery === '' || '{{ strtolower($cat->name) }}'.includes(searchQuery.toLowerCase())"
                                 class="bg-white/85 dark:bg-[#181920]/85 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-3xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-black text-xl flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                        {{ strtoupper(substr($cat->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $cat->name }}</h3>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $cat->posts_count ?? $cat->users_count ?? 0 }} Postingan</p>
                                    </div>
                                </div>
                                <div class="mt-6 pt-4 border-t border-zinc-200/60 dark:border-zinc-800/60 flex items-center justify-between">
                                    <span class="text-[11px] font-semibold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/50 px-3 py-1 rounded-full">Komunitas</span>
                                    <a href="{{ route('pages.categories.show', $cat->id) }}" class="px-5 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs transition-all shadow-md hover:shadow-indigo-500/30">
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full bg-white/80 dark:bg-[#181920]/80 backdrop-blur-md rounded-3xl p-8 text-center text-zinc-500">
                                Belum ada kategori tersedia.
                            </div>
                        @endforelse
                    </div>

                    {{-- LIST VIEW MODE --}}
                    <div x-show="viewMode === 'list'"
                         x-transition
                         class="space-y-4">
                        @forelse ($categories as $cat)
                            <div x-show="searchQuery === '' || '{{ strtolower($cat->name) }}'.includes(searchQuery.toLowerCase())"
                                 class="bg-white/85 dark:bg-[#181920]/85 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-4 shadow-md hover:shadow-xl transition-all duration-300 flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold text-lg flex items-center justify-center shadow-md">
                                        {{ strtoupper(substr($cat->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-base text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">{{ $cat->name }}</h3>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $cat->posts_count ?? $cat->users_count ?? 0 }} Anggota</p>
                                    </div>
                                </div>
                                <a href="{{ route('pages.categories.show', $cat->id) }}" class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs transition-all shadow-md">
                                    Lihat
                                </a>
                            </div>
                        @empty
                            <div class="bg-white/80 dark:bg-[#181920]/80 backdrop-blur-md rounded-3xl p-8 text-center text-zinc-500">
                                Belum ada kategori tersedia.
                            </div>
                        @endforelse
                    </div>

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
