<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - CircleHub</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b1120] text-white font-sans min-h-screen p-6 sm:p-10">

    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold tracking-wide">Daftar Kategori <span class="text-[#6C5CE7]">CircleHub</span></h1>
                <p class="text-slate-400 text-sm">Kelola topik dan komunitas hobi di platform ini.</p>
            </div>
            <a href="{{ route('categories.create') }}" 
               class="px-4 py-2.5 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white font-semibold rounded-xl text-sm transition shadow-lg shadow-[#6C5CE7]/20">
                + Tambah Kategori
            </a>
        </div>

        <!-- Alert Notifikasi -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Kategori -->
        <div class="bg-[#161f33] border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-[#0b1120]/60 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-6 py-4">No</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4">Slug</th>
                        <th class="px-6 py-4">Deskripsi</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($categories as $index => $cat)
                        <tr class="hover:bg-slate-800/30 transition">
                            <td class="px-6 py-4 font-mono text-slate-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold text-white">{{ $cat->name }}</td>
                            <td class="px-6 py-4 text-[#6C5CE7] font-mono text-xs">{{ $cat->slug }}</td>
                            <td class="px-6 py-4 text-slate-400 text-xs">{{ $cat->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('categories.edit', $cat->id) }}" 
                                       class="px-3 py-1.5 bg-amber-500/10 text-amber-400 hover:bg-amber-500/20 border border-amber-500/30 rounded-lg text-xs font-medium transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-rose-500/10 text-rose-400 hover:bg-rose-500/20 border border-rose-500/30 rounded-lg text-xs font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                                Belum ada kategori tersimpan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>