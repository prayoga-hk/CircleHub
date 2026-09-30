<!DOCTYPE html>
<html lang="id">
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
        *, ::before, ::after {
            transition-property: background-color, border-color, color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 300ms;
        }
    </style>
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">
        <x-sidebar />

        <main class="flex-1 relative overflow-y-auto p-8 transition-colors duration-200 bg-slate-50 dark:bg-[#000816] flex flex-col items-center">

            {{-- Tombol Toggle Dark / Light Mode --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            {{-- Container Kategori --}}
            <div class="w-full max-w-xl space-y-6 pt-4">
                @forelse ($categories as $category)
                    <div class="flex items-center justify-between p-2">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-full bg-zinc-300 dark:bg-zinc-600 shrink-0"></div>
                            <div>
                                <h3 class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide">{{ $category->name }}</h3>
                                <p class="text-sm text-zinc-500 dark:text-zinc-400 font-normal">{{ $category->posts_count ?? 0 }} member</p>
                            </div>
                        </div>

                        <a href="{{ route('pages.categories.show', $category->id) }}"
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