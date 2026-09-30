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
                    {{-- Card Postingan --}}
                    <div class="w-full bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-xl transition-colors duration-300 mb-6">

                        {{-- Header: Avatar + Username + Waktu --}}
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                @if (isset($post->user) && $post->user->avatar)
                                    <img src="{{ asset('storage/' . $post->user->avatar) }}"
                                         class="w-10 h-10 rounded-full object-cover shadow-sm"
                                         alt="{{ $post->user->name }}">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                                        {{ strtoupper(substr(optional($post->user)->name ?? 'U', 0, 1)) }}
                                    </div>
                                @endif
                                <span class="font-bold text-zinc-900 dark:text-white text-base transition-colors duration-300">
                                    {{ optional($post->user)->name ?? 'Anonim' }}
                                </span>
                            </div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 transition-colors duration-300">
                                {{ $post->created_at ? $post->created_at->diffForHumans() : '' }}
                            </span>
                        </div>

                        {{-- Gambar Postingan --}}
                        <div class="w-full h-80 bg-[#6366f1] rounded-2xl mb-4 overflow-hidden flex items-center justify-center shadow-inner">
                            @if (isset($post->image) && $post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     class="w-full h-full object-cover"
                                     alt="Post Image">
                            @endif
                        </div>

                        {{-- Action Icons --}}
                        <div class="flex items-center gap-6 mb-4 text-zinc-700 dark:text-zinc-300 transition-colors duration-300">
                            <button onclick="toggleLike(this)" class="flex items-center gap-2 hover:text-indigo-500 transition-colors duration-300 group cursor-pointer focus:outline-none">
                                <svg class="like-icon w-6 h-6 stroke-current transition-transform transform group-active:scale-125" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.25A2.25 2.25 0 013 18V12a2.25 2.25 0 012.25-2.25h1.383z"/>
                                </svg>
                                <span class="like-count text-sm font-medium">
                                    {{ str_pad($post->likes_count ?? 0, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </button>

                            <button onclick="toggleCommentBox(this)" class="flex items-center gap-2 hover:text-indigo-500 transition-colors duration-300 group cursor-pointer focus:outline-none">
                                <svg class="w-6 h-6 stroke-current transition-transform group-active:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 0012 20.25z"/>
                                </svg>
                                <span class="comment-count text-sm font-medium">
                                    {{ str_pad($post->comments_count ?? 0, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </button>

                            <button onclick="copyShareLink()" class="hover:text-indigo-500 transition-colors duration-300 cursor-pointer focus:outline-none" title="Bagikan Link">
                                <svg class="w-6 h-6 stroke-current transition-transform active:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                                </svg>
                            </button>
                        </div>

                        {{-- Deskripsi / Caption --}}
                        <p class="text-sm text-zinc-800 dark:text-zinc-200 leading-relaxed mb-4 transition-colors duration-300">
                            {{ $post->caption ?? $post->body ?? $post->content ?? '' }}
                        </p>

                        {{-- Section Komentar --}}
                        <div class="comment-section hidden border-t border-zinc-200 dark:border-zinc-800 pt-4 mt-4 space-y-4 transition-colors duration-300">
                            <div class="comments-list space-y-3 max-h-48 overflow-y-auto pr-1">
                                @if (isset($post->comments) && count($post->comments) > 0)
                                    @foreach ($post->comments as $comment)
                                        <div class="flex gap-2.5 text-xs bg-zinc-50 dark:bg-zinc-800/50 p-2.5 rounded-xl border border-zinc-200/50 dark:border-zinc-700/50 transition-colors duration-300">
                                            <span class="font-bold text-zinc-900 dark:text-white">{{ optional($comment->user)->name ?? 'Anonim' }}:</span>
                                            <span class="text-zinc-700 dark:text-zinc-300">{{ $comment->body ?? $comment->content ?? '' }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>

                            <form onsubmit="submitComment(event, this)" class="flex items-center gap-2 pt-2">
                                @csrf
                                <input type="text" placeholder="Tulis komentar..." required
                                       class="comment-input flex-1 text-sm bg-zinc-100 dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-300">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-xl text-sm transition-colors duration-300 cursor-pointer shrink-0">Kirim</button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="w-full bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-10 shadow-xl text-center transition-colors duration-300">
                        <p class="text-zinc-500 dark:text-zinc-400 text-sm">Belum ada postingan di kategori ini.</p>
                    </div>
                @endforelse
            </div>
        </main>
    </div>

    {{-- Script JavaScript --}}
    <script>
        // ====== Toggle Dark / Light Mode ======
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

        // ====== Like (per postingan) ======
        function toggleLike(btn) {
            const icon = btn.querySelector('.like-icon');
            const countEl = btn.querySelector('.like-count');
            let count = parseInt(countEl.textContent) || 0;
            const isLiked = icon.getAttribute('fill') === 'currentColor';

            if (isLiked) {
                icon.setAttribute('fill', 'none');
                icon.classList.remove('text-indigo-500');
                count = Math.max(0, count - 1);
            } else {
                icon.setAttribute('fill', 'currentColor');
                icon.classList.add('text-indigo-500');
                count++;
            }
            countEl.textContent = String(count).padStart(2, '0');
        }

        // ====== Toggle Komentar (per postingan) ======
        function toggleCommentBox(btn) {
            const card = btn.closest('.rounded-2xl');
            const section = card.querySelector('.comment-section');
            section.classList.toggle('hidden');
        }

        // ====== Submit Komentar (Aman dari XSS) ======
        function submitComment(event, form) {
            event.preventDefault();
            const input = form.querySelector('.comment-input');
            const card = form.closest('.rounded-2xl');
            const list = card.querySelector('.comments-list');
            const countEl = card.querySelector('.comment-count');

            const text = input.value.trim();
            if (text !== "") {
                const box = document.createElement('div');
                box.className = "flex gap-2.5 text-xs bg-zinc-50 dark:bg-zinc-800/50 p-2.5 rounded-xl border border-zinc-200/50 dark:border-zinc-700/50 transition-colors duration-300";

                const userSpan = document.createElement('span');
                userSpan.className = "font-bold text-zinc-900 dark:text-white";
                userSpan.textContent = "Anda:";

                const commentSpan = document.createElement('span');
                commentSpan.className = "text-zinc-700 dark:text-zinc-300";
                commentSpan.textContent = text;

                box.appendChild(userSpan);
                box.appendChild(document.createTextNode(" "));
                box.appendChild(commentSpan);

                list.appendChild(box);

                let count = parseInt(countEl.textContent) || 0;
                countEl.textContent = String(count + 1).padStart(2, '0');
                input.value = "";
            }
        }

        // ====== Copy Share Link ======
        function copyShareLink() {
            navigator.clipboard.writeText(window.location.href);
            const toast = document.getElementById('toast-share');
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 3000);
        }
    </script>
</body>
</html>