<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Postingan Baru</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#000816] text-zinc-300">

    <div class="flex h-screen overflow-hidden">

        <!-- Panggil Komponen Sidebar di sini -->
        <x-sidebar />

        <!-- Konten Utama -->
        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl font-bold mb-8 text-white">Buat Postingan Baru</h1>

                @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/20 text-green-400 p-4 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 p-4 rounded-lg mb-6">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('pages.posts.store') }}" method="POST" enctype="multipart/form-data"
                      class="bg-[#18181b] border border-zinc-800 p-8 rounded-2xl shadow-lg">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-zinc-400 font-medium mb-2">Judul</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full bg-[#09090b] border border-zinc-700 text-zinc-100 p-3 rounded-xl focus:outline-none focus:border-blue-500 transition"
                               placeholder="Masukkan judul postingan...">
                    </div>

                    <div class="mb-6">
                        <label class="block text-zinc-400 font-medium mb-2">Kategori</label>
                        <select name="category_id"
                                class="w-full bg-[#09090b] border border-zinc-700 text-zinc-100 p-3 rounded-xl focus:outline-none focus:border-blue-500 transition">
                            <option value="">-- Belum Dipilih --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-zinc-400 font-medium mb-2">Konten</label>
                        <textarea name="content" rows="6"
                                  class="w-full bg-[#09090b] border border-zinc-700 text-zinc-100 p-3 rounded-xl focus:outline-none focus:border-blue-500 transition"
                                  placeholder="Tulis isi postingan di sini...">{{ old('content') }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-zinc-400 font-medium mb-2">Gambar (Opsional)</label>
                        <input type="file" name="image"
                               class="w-full bg-[#09090b] border border-zinc-700 text-zinc-400 p-2 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20 transition">
                    </div>

                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3 px-4 rounded-xl transition duration-200">
                        Simpan Postingan
                    </button>
                </form>
            </div>
        </main>

    </div>

</body>
</html>
