@extends('layouts.admin')

@section('title', 'Postingan')

@section('content')
<div class="space-y-6 w-full relative">

    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-normal text-white">Postingan</h2>
    </div>

    @if (session('success'))
        <x-admin.alert>{{ session('success') }}</x-admin.alert>
    @endif

    <div class="bg-[#1D2132] rounded-xl overflow-hidden shadow-2xl border border-slate-800/40 min-h-[32rem]">
        <table class="w-full text-left text-sm text-slate-200">
            <thead class="border-b border-slate-700/50 text-slate-300">
                <tr>
                    <th class="px-6 py-4 font-normal w-1/3">Username</th>
                    <th class="px-6 py-4 font-normal">Postingan</th>
                    <th class="px-6 py-4 font-normal text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
                @forelse ($posts as $post)
                    @php($username = $post->user->name ?? 'Anonim')
                    <tr class="hover:bg-slate-800/20 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#6358e1] flex items-center justify-center text-white text-xs font-bold select-none shrink-0">
                                    {{ mb_strtoupper(mb_substr($username, 0, 1)) }}
                                </div>
                                <span>{{ $username }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3 max-w-lg">
                                @if ($post->image)
                                    <button type="button"
                                        data-src="{{ asset('storage/' . $post->image) }}"
                                        onclick="openImageModal(this.dataset.src)"
                                        class="shrink-0 cursor-zoom-in"
                                        aria-label="Lihat foto postingan">
                                        <img src="{{ asset('storage/' . $post->image) }}" alt="Foto postingan"
                                            class="w-6 h-6 rounded-sm object-cover hover:ring-2 hover:ring-[#6C5CE7] transition">
                                    </button>
                                @else
                                    <span class="w-6 h-6 rounded-sm bg-zinc-300 shrink-0"></span>
                                @endif
                                <span class="truncate">{{ $post->content }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right relative">
                            <button type="button"
                                onclick="toggleDropdown(event, 'dropdown-post-{{ $post->id }}')"
                                class="text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800/60 transition leading-none cursor-pointer">
                                &#8942;
                            </button>

                            <div id="dropdown-post-{{ $post->id }}" class="dropdown-menu hidden absolute right-16 top-1/2 -translate-y-1/2 w-32 bg-[#181D2D] border border-slate-700/60 rounded-lg shadow-xl z-30 text-left py-1">
                                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus postingan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-4 py-2 text-xs text-rose-400 hover:bg-rose-500/10 transition text-left cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-slate-500 text-xs">
                            Belum ada postingan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($posts->hasPages())
        <div class="pt-2">
            {{ $posts->links() }}
        </div>
    @endif
</div>

<div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50 p-4" onclick="closeImageModal()">
    <button type="button" onclick="closeImageModal()" class="absolute top-4 right-6 text-white/70 hover:text-white text-3xl leading-none cursor-pointer" aria-label="Tutup">&times;</button>
    <img id="imageModalImg" src="" alt="Foto postingan" class="max-w-full max-h-full rounded-lg shadow-2xl object-contain" onclick="event.stopPropagation()">
</div>

<script>
    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.add('hidden'));
    }

    function toggleDropdown(event, id) {
        event.stopPropagation();

        const targetDropdown = document.getElementById(id);
        const isCurrentlyHidden = targetDropdown.classList.contains('hidden');

        closeAllDropdowns();

        if (isCurrentlyHidden) {
            targetDropdown.classList.remove('hidden');
        }
    }

    function openImageModal(src) {
        closeAllDropdowns();
        document.getElementById('imageModalImg').src = src;

        const modal = document.getElementById('imageModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.remove('flex');
        modal.classList.add('hidden');
        document.getElementById('imageModalImg').src = '';
    }

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown-menu')) {
            closeAllDropdowns();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAllDropdowns();
            closeImageModal();
        }
    });
</script>
@endsection
