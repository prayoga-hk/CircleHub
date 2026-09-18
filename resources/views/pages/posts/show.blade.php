<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Detail Post</title>

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

        <main class="flex-1 relative bg-slate-50 dark:bg-[#000816] overflow-y-auto flex flex-col items-center p-6 transition-colors duration-200">

            <button id="theme-toggle" type="button" class="fixed top-20 right-6 z-50 p-3 rounded-full bg-white/80 dark:bg-zinc-800/80 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-lg backdrop-blur-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707-.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <div class="relative z-10 w-full max-w-xl space-y-4">
                
                <a href="{{ route('pages.posts.index') }}" class="inline-flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition mb-2">
                    &larr; Kembali ke Feed Utama
                </a>

                <x-post-card
                    :id="$post->id"
                    :username="$post->user->name ?? 'Anonim'"
                    :time="$post->created_at->diffForHumans()"
                    :title="$post->title"
                    :content="$post->content"
                    :image="$post->image"
                    :likes="$post->likes_count ?? 0"
                    :comments="$post->comments_count ?? 0"
                    :isLiked="auth()->check() ? $post->likes->contains('user_id', auth()->id()) : false"
                />

                <div class="p-5 rounded-xl border bg-white border-zinc-200 text-zinc-900 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white transition-colors duration-200 shadow-sm">
                    <h4 class="text-sm font-semibold mb-3">Tulis Komentar</h4>
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <textarea name="body" rows="3" required placeholder="Tulis balasan kamu..." class="w-full rounded-lg border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800/50 text-zinc-900 dark:text-white focus:ring-indigo-500 focus:border-indigo-500 text-sm p-3 resize-none"></textarea>
                        
                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition cursor-pointer">
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                </div>

                <div class="p-5 rounded-xl border bg-white border-zinc-200 text-zinc-900 dark:bg-zinc-900 dark:border-zinc-800 dark:text-white transition-colors duration-200 shadow-sm space-y-3">
                    <h4 class="text-sm font-semibold mb-3">
                        Komentar ({{ count($post->comments) }})
                    </h4>

                    @forelse ($post->comments as $comment)
                        <div class="p-3 rounded-lg bg-zinc-50 dark:bg-zinc-800/40 border border-zinc-100 dark:border-zinc-800/80 space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="font-medium text-xs text-zinc-900 dark:text-zinc-200">
                                    {{ $comment->user->name ?? 'User' }}
                                </span>
                                <span class="text-[10px] text-zinc-500 dark:text-zinc-400">
                                    {{ $comment->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-xs text-zinc-700 dark:text-zinc-300 leading-relaxed">
                                {{ $comment->body }}
                            </p>
                        </div>
                    @empty
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 text-center py-4">
                            Belum ada komentar. Jadilah yang pertama berkomentar!
                        </p>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

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