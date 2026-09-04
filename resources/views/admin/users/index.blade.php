@extends('layouts.admin')

@section('title', 'Member')

@section('content')
<div class="space-y-6 w-full relative" onclick="closeAllDropdowns(event)">

    <div class="flex justify-between items-center">
        <h2 class="text-3xl font-normal text-white">Member</h2>
    </div>

    @if (session('success'))
        <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-lg text-xs">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-[#1D2132] rounded-xl overflow-hidden shadow-2xl border border-slate-800/40">
        <table class="w-full text-left text-sm text-slate-200">
            <thead class="border-b border-slate-700/50 text-slate-300">
                <tr>
                    <th class="px-6 py-4 font-normal">Username</th>
                    <th class="px-6 py-4 font-normal">Role</th>
                    <th class="px-6 py-4 font-normal text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
                @forelse ($users as $user)
                    <tr class="hover:bg-slate-800/20 transition-colors">
                        <td class="px-6 py-4">
                            {{ $user->name }}
                            @if($user->is_suspended)
                                <span class="ml-2 px-2 py-0.5 text-[10px] bg-rose-500/10 text-rose-400 border border-rose-500/20 rounded">Banned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 capitalize">{{ $user->role ?? 'Member' }}</td>
                        <td class="px-6 py-4 text-right relative">
                            <button
                                onclick="toggleDropdown(event, 'dropdown-user-{{ $user->id }}')"
                                class="text-slate-400 hover:text-white p-2 rounded-lg hover:bg-slate-800/60 transition leading-none">
                                &#8942;
                            </button>

                            <div id="dropdown-user-{{ $user->id }}" class="dropdown-menu hidden absolute right-6 top-12 w-36 bg-[#181D2D] border border-slate-700/60 rounded-lg shadow-xl z-30 overflow-hidden text-left py-1">

                                @if($user->role !== 'admin')
                                    <form action="{{ route('admin.users.promote', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full px-4 py-2 text-xs text-slate-300 hover:bg-slate-700/50 hover:text-white transition text-left">
                                            Jadikan Admin
                                        </button>
                                    </form>
                                @endif

                                @if($user->is_suspended)
                                    <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full px-4 py-2 text-xs text-emerald-400 hover:bg-emerald-500/10 transition text-left">
                                            Unban User
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin membanned user ini?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full px-4 py-2 text-xs text-rose-400 hover:bg-rose-500/10 transition text-left">
                                            Ban User
                                        </button>
                                    </form>
                                @endif

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                            Tidak ada data member.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if(method_exists($users, 'hasPages') && $users->hasPages())
        <div class="pt-2">
            {{ $users->links() }}
        </div>
    @endif
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

    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-menu').forEach(el => {
            el.classList.add('hidden');
        });
    }

    document.addEventListener('click', function (event) {
        if (!event.target.closest('.dropdown-menu')) {
            closeAllDropdowns();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeAllDropdowns();
        }
    });
</script>
@endsection
