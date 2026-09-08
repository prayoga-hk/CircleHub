<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - CircleHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-[#161f33] p-8 rounded-2xl border border-slate-800 shadow-xl">
        <h2 class="text-xl font-bold mb-1">Tambah Kategori Baru</h2>
        <p class="text-xs text-slate-400 mb-6">Masukkan informasi kategori hobi/komunitas baru.</p>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Gaming, Coding, Music"
                       class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] text-sm">
                @error('name') 
                    <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> 
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Deskripsi singkat mengenai kategori ini..."
                          class="w-full px-3.5 py-2.5 bg-[#0b1120] text-white rounded-xl border border-slate-700/70 focus:outline-none focus:border-[#6C5CE7] focus:ring-1 focus:ring-[#6C5CE7] text-sm">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                <a href="{{ route('categories.index') }}" class="px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold rounded-xl transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white text-xs font-semibold rounded-xl transition shadow-md shadow-[#6C5CE7]/20">Simpan Kategori</button>
            </div>
        </form>
    </div>

</body>
</html>