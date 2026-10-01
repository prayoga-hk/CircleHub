<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi - CircleHub</title>

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

            {{-- Container Notifikasi --}}
            <div class="w-full max-w-2xl space-y-4 pt-4">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">Notifikasi</h1>

                    @if(auth()->user()->unreadNotifications()->count() > 0)
                        <form method="POST" action="{{ route('pages.notification.readAll') }}">
                            @csrf
                            <button type="submit" class="text-sm text-blue-500 hover:underline cursor-pointer">
                                Tandai semua dibaca
                            </button>
                        </form>
                    @endif
                </div>

                @if(session('success'))
                    <div class="px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-[#18181b] border border-zinc-200 dark:border-zinc-800 rounded-xl overflow-hidden">
                    @forelse($notifications as $notif)
                        <a href="{{ route('pages.notification.read', $notif->id) }}"
                           class="flex items-start gap-3 px-4 py-4 border-b border-zinc-100 dark:border-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-900 transition
                                  {{ is_null($notif->read_at) ? 'bg-blue-50/50 dark:bg-blue-950/20' : '' }}">

                            {{-- Icon Lucide --}}
                            <div class="shrink-0 mt-0.5">
                                @if($notif->data['type'] === 'like')
                                    {{-- Lucide: heart --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                    </svg>
                                @else
                                    {{-- Lucide: message-circle --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
                                    </svg>
                                @endif
                            </div>

                            <div class="flex-1 min-w-0">
                                <p class="text-sm text-zinc-900 dark:text-zinc-100">
                                    {{ $notif->data['message'] }}
                                </p>
                                @if(!empty($notif->data['preview']))
                                    <p class="text-xs text-zinc-500 mt-1 truncate">
                                        "{{ $notif->data['preview'] }}"
                                    </p>
                                @endif
                                <p class="text-xs text-zinc-400 mt-2">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if(is_null($notif->read_at))
                                <span class="w-2 h-2 rounded-full bg-blue-500 mt-2 shrink-0"></span>
                            @endif
                        </a>
                    @empty
                        <div class="px-4 py-12 flex flex-col items-center text-center">
                            {{-- Lucide: bell-off --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-zinc-400 dark:text-zinc-600 mb-3"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M8.7 3A6 6 0 0 1 18 8a21.3 21.3 0 0 0 .6 5"/>
                                <path d="M17 17H3s3-2 3-9a4.67 4.67 0 0 1 .3-1.7"/>
                                <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/>
                                <path d="m2 2 20 20"/>
                            </svg>
                            <p class="text-zinc-500 text-sm">Belum ada notifikasi</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-4">
                    {{ $notifications->links() }}
                </div>
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
