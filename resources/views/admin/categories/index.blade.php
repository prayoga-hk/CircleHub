@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('header', 'Daftar Kategori CircleHub')

@section('content')
    <div class="py-12 bg-slate-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center">
                <p class="text-sm text-slate-400">Kelola kategori postingan untuk feed komunitas CircleHub.</p>
                <button onclick="openAddModal()" class="bg-indigo-600 hover:bg-indigo-500 text-white text-sm px-4 py-2 rounded-lg font-medium transition shadow">
                    + Tambah Kategori
                </button>
            </div>

            <div class="bg-slate-800 border border-slate-700/60 rounded-xl overflow-hidden shadow-xl">
                <table class="w-full text-left text-sm text-slate-300">
                    <thead class="bg-slate-900/60 text-slate-400 uppercase text-xs tracking-wider border-b border-slate-700/60">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Kategori</th>
                            <th class="px-6 py-4">Slug</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700/50">
                        @forelse ($categories as $index => $category)
                            <tr class="hover:bg-slate-700/30 transition">
                                <td class="px-6 py-4 font-medium text-slate-400">
                                    {{ $categories->firstItem() + $index }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-white">
                                    {{ $category->name }}
                                </td>
                                <td class="px-6 py-4 text-slate-400 font-mono text-xs">
                                    {{ $category->slug }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button
                                        onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')"
                                        class="bg-amber-500/10 hover:bg-amber-500/20 text-amber-400 px-3 py-1.5 rounded-md text-xs font-medium border border-amber-500/20 transition">
                                        Edit
                                    </button>

                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 px-3 py-1.5 rounded-md text-xs font-medium border border-rose-500/20 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                    Belum ada kategori yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($categories->hasPages())
                    <div class="px-6 py-4 border-t border-slate-700/60 bg-slate-800">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div id="categoryModal" class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-slate-800 border border-slate-700 rounded-xl max-w-md w-full p-6 shadow-2xl relative">
            <h3 id="modalTitle" class="text-lg font-bold text-white mb-4">Tambah Kategori</h3>

            <form id="categoryForm" action="" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="mb-5">
                    <label for="categoryName" class="block text-xs font-medium text-slate-400 mb-2">Nama Kategori</label>
                    <input
                        type="text"
                        name="name"
                        id="categoryName"
                        required
                        placeholder="Contoh: Teknologi, Diskusi Umum"
                        class="w-full bg-slate-900 border border-slate-700 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                    >
                    @error('name')
                        <span class="text-rose-400 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-slate-700 hover:bg-slate-600 text-slate-300 rounded-lg text-sm font-medium transition">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg text-sm font-medium transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const modal = document.getElementById('categoryModal');
        const modalTitle = document.getElementById('modalTitle');
        const categoryForm = document.getElementById('categoryForm');
        const formMethod = document.getElementById('formMethod');
        const categoryNameInput = document.getElementById('categoryName');

        function openAddModal() {
            modalTitle.innerText = 'Tambah Kategori Baru';
            categoryForm.action = "{{ route('admin.categories.store') }}";
            formMethod.value = 'POST';
            categoryNameInput.value = '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function openEditModal(id, name) {
            modalTitle.innerText = 'Edit Kategori';
            categoryForm.action = `/dashboard/categories/${id}`;
            formMethod.value = 'PUT';
            categoryNameInput.value = name;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        window.onclick = function(event) {
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
    @endsection
