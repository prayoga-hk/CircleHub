<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Postingan - CircleHub</title>

    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-100 h-screen w-screen overflow-hidden flex flex-col m-0 p-0 transition-colors duration-200">

    <x-navbar />

    <div class="flex flex-1 w-full overflow-hidden relative">
        <x-sidebar />

        <main class="flex-1 relative overflow-y-auto p-8 transition-colors duration-200 bg-slate-50 dark:bg-[#000816]">

            <button id="theme-toggle" type="button" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <a href="{{ route('users.show', $post->user_id) }}"
               class="inline-flex items-center gap-1.5 text-xs font-semibold text-zinc-500 dark:text-zinc-400 hover:text-indigo-600 dark:hover:text-white transition mb-2">
                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                </svg>
                Kembali ke Profil
            </a>

            <h2 class="text-2xl font-bold mb-6 text-zinc-900 dark:text-white transition-colors duration-200">Edit Postingan</h2>

            @if (session('success'))
                <div class="max-w-6xl mb-4 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 max-w-6xl">

                <form action="{{ route('posts.update', $post) }}" method="POST"
                      class="lg:col-span-2 bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-6 transition-colors duration-200 shadow-sm">
                    @csrf
                    @method('PUT')

                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="category_id" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Kategori</label>
                        <select id="category_id" name="category_id"
                                class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-sm font-medium focus:outline-none transition">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" @selected(old('category_id', $post->category_id) == $cat->id)>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pb-4 border-b border-zinc-100 dark:border-zinc-800">
                        <label for="title" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Judul Postingan</label>
                        <input type="text" id="title" name="title"
                               value="{{ old('title', $post->title) }}"
                               maxlength="255"
                               class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-base font-semibold focus:outline-none transition">
                        @error('title')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Isi Postingan</label>
                        <textarea id="content" name="content" rows="12" required
                                  class="w-full bg-zinc-50 dark:bg-zinc-800/60 border border-zinc-300 dark:border-zinc-700 p-2.5 rounded-lg focus:ring-2 focus:ring-indigo-500 text-zinc-900 dark:text-white text-base font-medium focus:outline-none resize-y transition leading-relaxed">{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <p class="text-xs text-rose-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800">
                        <a href="{{ route('users.show', $post->user_id) }}"
                           class="px-5 py-2.5 bg-zinc-100 dark:bg-zinc-800 hover:bg-zinc-200 dark:hover:bg-zinc-700 text-zinc-700 dark:text-zinc-300 rounded-xl text-sm font-medium transition cursor-pointer">
                            Batal
                        </a>
                        <button type="submit"
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-medium transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>

                <div class="space-y-6">

                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-4 transition-colors duration-200 shadow-sm">
                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Dibuat</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-sm">
                                {{ $post->created_at->format('d M Y, H:i') }}
                            </p>
                        </div>

                        <div>
                            <span class="text-xs text-zinc-500 dark:text-zinc-400 block mb-1">Terakhir Diubah</span>
                            <p class="font-semibold text-zinc-900 dark:text-white text-sm">
                                @if ($post->updated_at && $post->updated_at->ne($post->created_at))
                                    {{ $post->updated_at->diffForHumans() }}
                                @else
                                    <span class="text-zinc-400 dark:text-zinc-500 font-normal italic">Belum pernah diedit</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-[#212529] p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 space-y-3 transition-colors duration-200 shadow-sm">
                        <h3 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">Danger Zone</h3>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus postingan ini? Tindakan ini tidak bisa dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 dark:bg-red-900/80 dark:hover:bg-red-800 text-white dark:text-red-200 text-sm font-medium rounded-xl transition cursor-pointer text-center">
                                Hapus Postingan
                            </button>
                        </form>
                    </div>

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
