@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="space-y-6 w-full relative">

    <div class="flex items-center justify-between">
        <h2 class="text-3xl font-normal text-white">Kategori</h2>
        <button type="button" onclick="openCategoryAddModal()" class="px-4 py-2 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white text-xs font-semibold rounded-xl transition shadow-lg shadow-[#6C5CE7]/20 cursor-pointer">
            + Tambah Kategori
        </button>
    </div>

    <div class="bg-[#1D2132] rounded-xl overflow-hidden shadow-2xl border border-slate-800/40">
        <table class="w-full text-left text-sm text-slate-200">
            <thead class="border-b border-slate-700/50 text-slate-300">
                <tr>
                    <th class="px-6 py-4 font-normal">Nama Kategori</th>
                    <th class="px-6 py-4 font-normal">Slug</th>
                    <th class="px-6 py-4 font-normal text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
                @forelse ($categories as $category)
                    <tr class="hover:bg-slate-800/20 transition-colors">
                        <td class="px-6 py-4 text-white">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-slate-400 font-mono text-xs">{{ $category->slug }}</td>
                        <td class="px-6 py-4 text-right relative">
                            <button type="button" onclick="toggleDropdown(event, 'dropdown-category-{{ $category->id }}')" class="text-slate-400 hover:text-white p-2 rounded-lg cursor-pointer">
                                &#8942;
                            </button>

                            <div id="dropdown-category-{{ $category->id }}" class="dropdown-menu hidden absolute right-12 top-0 w-32 bg-[#181D2D] border border-slate-700/60 rounded-lg shadow-xl z-50 text-left py-1">                                <button type="button" onclick="openCategoryEditModal('{{ route('admin.categories.update', $category) }}', '{{ $category->name }}')" class="w-full px-4 py-2 text-xs text-slate-300 hover:bg-slate-700/50 text-left cursor-pointer">
                                    Edit
                                </button>

                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 text-xs text-rose-400 hover:bg-rose-500/10 text-left cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-slate-500 text-xs">Belum ada kategori yang ditambahkan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div id="categoryModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1D2132] border border-slate-700/60 rounded-xl max-w-md w-full p-6 shadow-2xl">
        <h3 id="modalCategoryTitle" class="text-base font-medium text-white mb-4">Tambah Kategori</h3>

        <form id="categoryForm" action="" method="POST" class="space-y-4">
            @csrf
            <div id="methodContainer"></div>

            <div>
                <label class="block text-xs text-slate-400 mb-1">Nama Kategori</label>
                <input type="text" name="name" id="categoryNameInput" required placeholder="Contoh: Teknologi"
                    class="w-full bg-[#0B0F19] border border-slate-700 text-white text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-[#3B3A82]">
            </div>

            <div class="flex justify-end gap-2 pt-2">
                <button type="button" onclick="closeCategoryModal()" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded-lg text-xs transition cursor-pointer">Batal</button>
                <button type="submit" class="px-3 py-1.5 bg-[#3B3A82] hover:bg-[#4846A3] text-white rounded-lg text-xs transition cursor-pointer">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleDropdown(event, id) {
        event.stopPropagation();
        const targetDropdown = document.getElementById(id);
        const isCurrentlyHidden = targetDropdown.classList.contains('hidden');

        closeAllDropdowns();

        if (isCurrentlyHidden) {
            targetDropdown.classList.remove('hidden');
        }
    }

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('hidden'));
    }

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown-menu')) {
            closeAllDropdowns();
        }
    });

    function openCategoryAddModal() {
        closeAllDropdowns();
        document.getElementById('modalCategoryTitle').innerText = 'Tambah Kategori';
        document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
        document.getElementById('methodContainer').innerHTML = '';
        document.getElementById('categoryNameInput').value = '';

        const modal = document.getElementById('categoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openCategoryEditModal(actionUrl, name) {
        closeAllDropdowns();
        document.getElementById('modalCategoryTitle').innerText = 'Edit Kategori';
        document.getElementById('categoryForm').action = actionUrl;
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('categoryNameInput').value = name;

        const modal = document.getElementById('categoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeCategoryModal() {
        const modal = document.getElementById('categoryModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endsection
