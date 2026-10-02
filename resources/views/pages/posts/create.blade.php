<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Postingan Baru - CircleHub</title>

    {{-- Script pencegah flicker saat tema dimuat --}}
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-zinc-900 dark:bg-[#000816] dark:text-zinc-300 h-screen overflow-hidden transition-colors duration-200">
    
    <!-- Navbar Atas -->
    <x-navbar />

    <div class="flex h-[calc(100vh-4rem)] overflow-hidden relative">
        <!-- Sidebar Kiri -->
        <x-sidebar />

        <!-- Konten Utama -->
        <main class="flex-1 overflow-y-auto p-8 relative">

            {{-- Tombol Toggle Dark / Light Mode --}}
            <button id="theme-toggle" type="button" title="Ubah Tema" class="fixed top-20 right-8 z-50 p-3 rounded-full bg-white dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700 shadow-md hover:scale-105 transition-all cursor-pointer">
                {{-- Icon Matahari (Dark Mode Active) --}}
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4.22 2.78a1 1 0 011.415 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm2.78 4.22a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.22 5.657a1 1 0 010 1.415l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM4.78 14.22a1 1 0 010-1.414l.707.707a1 1 0 011.414 1.414l-.707.707a1 1 0 01-1.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.78-5.657a1 1 0 011.414 0l.707.707a1 1 0 11-1.414 1.414l-.707-.707a1 1 0 010-1.414zM10 6a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
                {{-- Icon Bulan (Light Mode Active) --}}
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 fill-current" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                </svg>
            </button>

            <div class="max-w-3xl mx-auto pb-12">
                <h1 class="text-3xl font-bold mb-8 text-zinc-900 dark:text-white transition-colors duration-200">Buat Postingan Baru</h1>

                {{-- Notifikasi Sukses --}}
                @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/20 text-green-600 dark:text-green-400 p-4 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Notifikasi Error --}}
                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 p-4 rounded-xl mb-6">
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Buat Postingan --}}
                <form action="{{ route('pages.posts.store') }}" method="POST" enctype="multipart/form-data"
                      class="bg-white dark:bg-[#18181b] border border-zinc-200 dark:border-zinc-800 p-8 rounded-2xl shadow-lg transition-colors duration-200">
                    @csrf
                    
                    {{-- Input Judul --}}
                    <div class="mb-6">
                        <label class="block text-zinc-700 dark:text-zinc-300 font-medium mb-2">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                               class="w-full bg-zinc-50 dark:bg-[#09090b] border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                               placeholder="Masukkan judul postingan...">
                    </div>

                    {{-- Select Kategori --}}
                    <div class="mb-6">
                        <label class="block text-zinc-700 dark:text-zinc-300 font-medium mb-2">Kategori</label>
                        <select name="category_id" required
                                class="w-full bg-zinc-50 dark:bg-[#09090b] border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Textarea Konten --}}
                    <div class="mb-6">
                        <label class="block text-zinc-700 dark:text-zinc-300 font-medium mb-2">Konten</label>
                        <textarea name="content" rows="6" required
                                  class="w-full bg-zinc-50 dark:bg-[#09090b] border border-zinc-300 dark:border-zinc-700 text-zinc-900 dark:text-zinc-100 p-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                  placeholder="Tulis isi postingan di sini...">{{ old('content') }}</textarea>
                    </div>

                    {{-- Input File Multiple Gambar --}}
                    <div class="mb-6">
                        <label class="block text-zinc-700 dark:text-zinc-300 font-medium mb-2">Gambar (Opsional, bisa lebih dari 1)</label>
                        <input type="file" name="images[]" id="image-input" multiple accept="image/*"
                               class="w-full bg-zinc-50 dark:bg-[#09090b] border border-zinc-300 dark:border-zinc-700 text-zinc-600 dark:text-zinc-400 p-2 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/10 file:text-blue-600 dark:file:text-blue-400 hover:file:bg-blue-500/20 transition cursor-pointer">
                        <p class="text-xs text-zinc-500 mt-1">Gunakan tombol Ctrl / Cmd saat memilih file untuk memilih beberapa foto sekaligus.</p>

                        {{-- Container Preview Gambar --}}
                        <div id="image-preview-container" class="grid grid-cols-3 sm:grid-cols-4 gap-4 mt-4 hidden"></div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-blue-500/20 transition duration-200 cursor-pointer">
                        Simpan Postingan
                    </button>
                </form>
            </div>
        </main>
    </div>

    {{-- Script Toggle Dark / Light Mode & Multiple Image Preview --}}
    <script>
        const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
        const themeToggleBtn = document.getElementById('theme-toggle');

        // Set Icon yang Tepat Berdasarkan Status Mode
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        // Event Listener Klik Tombol Toggle
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

        // Script Preview Multiple Gambar
        const imageInput = document.getElementById('image-input');
        const previewContainer = document.getElementById('image-preview-container');

        imageInput.addEventListener('change', function() {
            previewContainer.innerHTML = '';
            
            if (this.files && this.files.length > 0) {
                previewContainer.classList.remove('hidden');

                Array.from(this.files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const imgCard = document.createElement('div');
                            imgCard.className = 'relative group aspect-square rounded-xl overflow-hidden border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800';
                            imgCard.innerHTML = `
                                <img src="${e.target.result}" class="w-full h-full object-cover">
                            `;
                            previewContainer.appendChild(imgCard);
                        }

                        reader.readAsDataURL(file);
                    }
                });
            } else {
                previewContainer.classList.add('hidden');
            }
        });
    </script>
</body>
</html>