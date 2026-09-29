<!DOCTYPE html>
<html lang="id" class="dark">
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

        /* Crossfade Gambar Background */
        .bg-layer-light {
            background-image: url('{{ asset("images/lightbg.jpg") }}');
            background-size: cover;
            background-position: center;
        }

        .bg-layer-dark {
            background-image: url('{{ asset("images/darkBg.jpg") }}');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-slate-100 dark:bg-zinc-950 text-zinc-800 dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col transition-colors duration-300">

    {{-- Toast Notification --}}
    <div id="toast-share" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-300 bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 px-4 py-3 rounded-xl shadow-lg flex items-center gap-2 text-sm font-medium">
        <svg class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <span>Link postingan berhasil disalin!</span>
    </div>

    {{-- Header Atas --}}
    <header class="h-16 bg-white/80 dark:bg-[#16171d]/80 backdrop-blur-md border-b border-zinc-200/60 dark:border-zinc-800/60 flex items-center justify-between px-8 shrink-0 z-30 transition-colors duration-300">
        <div class="flex items-center gap-3">
            <span class="text-xl font-bold text-zinc-900 dark:text-white tracking-wide transition-colors duration-300">CircleHub</span>
        </div>
        <div class="flex items-center gap-4">
            <button type="button" class="text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white transition-colors duration-300 p-2 cursor-pointer">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </button>
        </div>
    </header>

    <div class="flex flex-1 overflow-hidden">
        {{-- Sidebar Kiri --}}
        <aside class="w-64 bg-white/70 dark:bg-[#16171d]/70 backdrop-blur-md border-r border-zinc-200/60 dark:border-zinc-800/60 flex flex-col justify-between py-6 px-4 shrink-0 z-20 transition-colors duration-300">
            <nav class="space-y-2">
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100/70 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                    </svg>
                    <span>Home</span>
                </a>

                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-zinc-200/80 dark:bg-[#2a2b32] text-zinc-900 dark:text-white font-medium transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a5.97 5.97 0 00-.942 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                    </svg>
                    <span>Kategori</span>
                </a>

                <a href="{{ route('pages.posts.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100/70 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Buat</span>
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100/70 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                    <span>Notifikasi</span>
                </a>
            </nav>

            <div class="space-y-2 border-t border-zinc-200/60 dark:border-zinc-800/60 pt-4">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100/70 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Akun</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-zinc-600 dark:text-zinc-400 hover:bg-red-500/10 hover:text-red-500 transition-colors duration-300 text-left cursor-pointer">
                        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Area --}}
        <main class="flex-1 overflow-y-auto relative flex flex-col items-center p-8">
            
            {{-- Layer Gambar Mode Terang --}}
            <div class="absolute inset-0 bg-layer-light opacity-100 dark:opacity-0 transition-opacity duration-300 pointer-events-none"></div>

            {{-- Layer Gambar Mode Gelap --}}
            <div class="absolute inset-0 bg-layer-dark opacity-0 dark:opacity-100 transition-opacity duration-300 pointer-events-none"></div>

            {{-- Tombol Toggle Theme --}}
            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-40 p-2.5 rounded-full bg-white/80 dark:bg-zinc-800/80 backdrop-blur-md text-zinc-700 dark:text-zinc-300 border border-zinc-200 dark:border-zinc-700 shadow-lg hover:scale-105 transition-all duration-300 cursor-pointer">
                <svg id="theme-toggle-dark-icon" class="hidden dark:block w-5 h-5 fill-current text-zinc-300" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z"/>
                </svg>
                <svg id="theme-toggle-light-icon" class="block dark:hidden w-5 h-5 fill-current text-zinc-700" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>

            {{-- Content Wrapper --}}
            <div class="relative z-10 w-full max-w-2xl flex flex-col items-center">
                <div class="w-full mb-3">
                    <span class="text-sm font-semibold text-zinc-700 dark:text-zinc-300 capitalize drop-shadow-sm transition-colors duration-300">{{ $category->name ?? 'Coding' }}</span>
                </div>

                {{-- Card Postingan Utama --}}
                <div class="w-full bg-white/90 dark:bg-[#181920]/90 backdrop-blur-md border border-zinc-200/80 dark:border-zinc-800/80 rounded-2xl p-6 shadow-xl transition-colors duration-300">
                    
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-base shadow-sm">
                                B
                            </div>
                            <span class="font-bold text-zinc-900 dark:text-white text-base transition-colors duration-300">bimbimbapp</span>
                        </div>
                        <span class="text-xs text-zinc-500 dark:text-zinc-400 transition-colors duration-300">1 week ago</span>
                    </div>

                    {{-- Gambar Postingan --}}
                    <div class="w-full h-80 bg-[#6366f1] rounded-2xl mb-4 overflow-hidden flex items-center justify-center shadow-inner">
                        @if(isset($post->image))
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-full h-full object-cover" alt="Post Image">
                        @endif
                    </div>

                    {{-- Action Icons --}}
                    <div class="flex items-center gap-6 mb-4 text-zinc-700 dark:text-zinc-300 transition-colors duration-300">
                        
                        <button id="like-btn" onclick="toggleLike()" class="flex items-center gap-2 hover:text-indigo-500 transition-colors duration-300 group cursor-pointer focus:outline-none">
                            <svg id="like-icon" class="w-6 h-6 stroke-current transition-transform transform group-active:scale-125" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.25A2.25 2.25 0 013 18V12a2.25 2.25 0 012.25-2.25h1.383z"/>
                            </svg>
                            <span id="like-count" class="text-sm font-medium">01</span>
                        </button>

                        <button onclick="toggleCommentBox()" class="flex items-center gap-2 hover:text-indigo-500 transition-colors duration-300 group cursor-pointer focus:outline-none">
                            <svg class="w-6 h-6 stroke-current transition-transform group-active:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 01-.923 1.785A5.969 5.969 0 0012 20.25z"/>
                            </svg>
                            <span id="comment-count" class="text-sm font-medium">01</span>
                        </button>

                        <button onclick="copyShareLink()" class="hover:text-indigo-500 transition-colors duration-300 cursor-pointer focus:outline-none" title="Bagikan Link">
                            <svg class="w-6 h-6 stroke-current transition-transform active:scale-110" fill="none" viewBox="0 0 24 24" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Deskripsi Caption --}}
                    <p class="text-sm text-zinc-800 dark:text-zinc-200 leading-relaxed mb-4 transition-colors duration-300">
                        hari ini berta sedang belajar coding menggunakan html dan css, bantu semangatin dongg guyss
                    </p>

                    {{-- Section Komentar --}}
                    <div id="comment-section" class="hidden border-t border-zinc-200 dark:border-zinc-800 pt-4 mt-4 space-y-4 transition-colors duration-300">
                        <div id="comments-list" class="space-y-3 max-h-48 overflow-y-auto pr-1"></div>

                        <form onsubmit="submitComment(event)" class="flex items-center gap-2 pt-2">
                            <input id="comment-input" type="text" placeholder="Tulis komentar..." required class="flex-1 text-sm bg-zinc-100 dark:bg-zinc-800/80 border border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white px-4 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-300">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-xl text-sm transition-colors duration-300 cursor-pointer shrink-0">Kirim</button>
                        </form>
                    </div>

                </div>
            </div>
        </main>
    </div>

    {{-- Script JavaScript Interaktif --}}
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        themeToggleBtn.addEventListener('click', function() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            }
        });

        let isLiked = false;
        let likes = 1;
        function toggleLike() {
            const likeIcon = document.getElementById('like-icon');
            const likeCount = document.getElementById('like-count');
            
            isLiked = !isLiked;
            if(isLiked) {
                likes++;
                likeIcon.setAttribute('fill', 'currentColor');
                likeIcon.classList.add('text-indigo-500');
            } else {
                likes--;
                likeIcon.setAttribute('fill', 'none');
                likeIcon.classList.remove('text-indigo-500');
            }
            likeCount.textContent = String(likes).padStart(2, '0');
        }

        let commentCount = 1;
        function toggleCommentBox() {
            const commentSection = document.getElementById('comment-section');
            commentSection.classList.toggle('hidden');
        }

        function submitComment(event) {
            event.preventDefault();
            const input = document.getElementById('comment-input');
            const list = document.getElementById('comments-list');
            const countElem = document.getElementById('comment-count');

            if(input.value.trim() !== "") {
                const commentBox = document.createElement('div');
                commentBox.className = "flex gap-2.5 text-xs bg-zinc-50 dark:bg-zinc-800/50 p-2.5 rounded-xl border border-zinc-200/50 dark:border-zinc-700/50 transition-colors duration-300";
                commentBox.innerHTML = `
                    <span class="font-bold text-zinc-900 dark:text-white">Anda:</span>
                    <span class="text-zinc-700 dark:text-zinc-300">${input.value}</span>
                `;
                list.appendChild(commentBox);
                
                commentCount++;
                countElem.textContent = String(commentCount).padStart(2, '0');
                input.value = "";
            }
        }

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