@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="space-y-6 w-full relative">

    <div class="flex items-center justify-between">
        <button type="button" onclick="openCategoryAddModal()" class="px-4 py-2 bg-[#6C5CE7] hover:bg-[#5b4bc4] text-white text-xs font-semibold rounded-xl transition shadow-lg shadow-[#6C5CE7]/20 cursor-pointer">
            + Tambah Kategori
        </button>
    </div>

    @if (session('success'))
        <x-admin.alert>{{ session('success') }}</x-admin.alert>
    @endif

    <div class="bg-[#1D2132] rounded-xl overflow-hidden shadow-2xl border border-slate-800/40">
        <table class="w-full text-left text-sm text-slate-200">
            <thead class="border-b border-slate-700/50 text-slate-300">
                <tr>
                    <th class="px-6 py-4 font-normal">Foto</th>
                    <th class="px-6 py-4 font-normal">Nama Kategori</th>
                    <th class="px-6 py-4 font-normal">Slug</th>
                    <th class="px-6 py-4 font-normal">Deskripsi</th>
                    <th class="px-6 py-4 font-normal text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
                @if (isset($categories) && count($categories) > 0)
                    @foreach ($categories as $category)
                        <tr class="hover:bg-slate-800/20 transition-colors">
                            {{-- KOLOM FOTO --}}
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-lg overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold text-sm flex items-center justify-center shadow-md shrink-0">
                                    @if($category->image_url)
                                        <img src="{{ $category->image_url }}"
                                             alt="{{ $category->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($category->name, 0, 1)) }}
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4 text-white">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-slate-400 font-mono text-xs">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-slate-400 text-xs max-w-xs truncate">{{ $category->description ?? '-' }}</td>
                            <td class="px-6 py-4 text-right relative">
                                <button type="button" onclick="toggleDropdown(event, 'dropdown-category-{{ $category->id }}')" class="text-slate-400 hover:text-white p-2 rounded-lg cursor-pointer">
                                    &#8942;
                                </button>

                                <div id="dropdown-category-{{ $category->id }}" class="dropdown-menu hidden absolute right-12 top-0 w-32 bg-[#181D2D] border border-slate-700/60 rounded-lg shadow-xl z-50 text-left py-1">
                                    <button type="button" onclick="openCategoryEditModal('{{ route('admin.categories.update', $category) }}', @js($category->name), @js($category->description), '{{ $category->image_url ?? '' }}')" class="w-full px-4 py-2 text-xs text-slate-300 hover:bg-slate-700/50 text-left cursor-pointer">
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
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 text-xs">Belum ada kategori yang ditambahkan.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

</div>

{{-- MODAL TAMBAH / EDIT KATEGORI --}}
<div id="categoryModal" class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
    <div class="bg-[#1D2132] border border-slate-700/60 rounded-xl max-w-md w-full p-6 shadow-2xl">
        <h3 id="modalCategoryTitle" class="text-base font-medium text-white mb-4">Tambah Kategori</h3>

        {{-- PENTING: enctype multipart untuk upload file --}}
        <form id="categoryForm" action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div id="methodContainer"></div>

            {{-- INPUT NAMA KATEGORI --}}
            <div>
                <label class="block text-xs text-slate-400 mb-1">Nama Kategori</label>
                <input type="text" name="name" id="categoryNameInput" required placeholder="Contoh: Teknologi"
                    class="w-full bg-[#0B0F19] border border-slate-700 text-white text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-[#3B3A82]">
            </div>

            {{-- INPUT DESKRIPSI --}}
            <div>
                <label class="block text-xs text-slate-400 mb-1">Deskripsi <span class="text-slate-500">(opsional)</span></label>
                <textarea name="description" id="categoryDescriptionInput" rows="3" placeholder="Deskripsi singkat kategori..."
                    class="w-full bg-[#0B0F19] border border-slate-700 text-white text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-[#3B3A82] resize-none"></textarea>
            </div>

            {{-- INPUT FOTO KATEGORI --}}
            <div>
                <label class="block text-xs text-slate-400 mb-1">Foto / Icon Kategori</label>

                {{-- Preview Foto --}}
                <div class="flex items-center gap-3 mb-2">
                    <div id="categoryImagePreview" class="w-14 h-14 rounded-xl overflow-hidden bg-gradient-to-br from-indigo-500 to-purple-600 text-white font-bold flex items-center justify-center shadow-md shrink-0">
                        <span id="categoryImagePreviewLetter" class="text-lg">?</span>
                        <img id="categoryImagePreviewImg" src="" alt="Preview" class="w-full h-full object-cover hidden">
                    </div>
                    <p class="text-[10px] text-slate-500">Format: JPG, PNG, WEBP (maks 2MB)</p>
                </div>

                <input type="file"
                       name="image"
                       id="categoryImageInput"
                       accept="image/*"
                       onchange="previewCategoryImage(event)"
                       class="w-full bg-[#0B0F19] border border-slate-700 text-white text-xs rounded-lg px-3 py-2 focus:outline-none focus:border-[#3B3A82] file:mr-3 file:py-1 file:px-3 file:rounded-md file:border-0 file:text-xs file:bg-[#3B3A82] file:text-white hover:file:bg-[#4846A3] file:cursor-pointer cursor-pointer">
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

    // Preview foto saat user pilih file
    function previewCategoryImage(event) {
        const file = event.target.files[0];
        const previewImg = document.getElementById('categoryImagePreviewImg');
        const previewLetter = document.getElementById('categoryImagePreviewLetter');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                previewLetter.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Reset preview foto
    function resetCategoryImagePreview(imageUrl = null) {
        const previewImg = document.getElementById('categoryImagePreviewImg');
        const previewLetter = document.getElementById('categoryImagePreviewLetter');
        const fileInput = document.getElementById('categoryImageInput');

        fileInput.value = ''; // clear file input

        if (imageUrl) {
            previewImg.src = imageUrl;
            previewImg.classList.remove('hidden');
            previewLetter.classList.add('hidden');
        } else {
            previewImg.src = '';
            previewImg.classList.add('hidden');
            previewLetter.classList.remove('hidden');
            previewLetter.innerText = '?';
        }
    }

    function openCategoryAddModal() {
        closeAllDropdowns();
        document.getElementById('modalCategoryTitle').innerText = 'Tambah Kategori';
        document.getElementById('categoryForm').action = "{{ route('admin.categories.store') }}";
        document.getElementById('methodContainer').innerHTML = '';
        document.getElementById('categoryNameInput').value = '';
        document.getElementById('categoryDescriptionInput').value = '';
        resetCategoryImagePreview();

        const modal = document.getElementById('categoryModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openCategoryEditModal(actionUrl, name, description = '', imageUrl = null) {
        closeAllDropdowns();
        document.getElementById('modalCategoryTitle').innerText = 'Edit Kategori';
        document.getElementById('categoryForm').action = actionUrl;
        document.getElementById('methodContainer').innerHTML = '<input type="hidden" name="_method" value="PUT">';
        document.getElementById('categoryNameInput').value = name;
        document.getElementById('categoryDescriptionInput').value = description || '';
        resetCategoryImagePreview(imageUrl);

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