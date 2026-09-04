@extends('layouts.admin')

@section('title', 'Manajemen Member')
@section('header', 'Daftar Member CircleHub')

@section('content')
<div class="space-y-6">

    <div class="bg-[#1E293B] border border-slate-800 rounded-2xl p-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-white">Kontrol Pengguna</h2>
            <p class="text-slate-400 text-sm mt-1">Kelola peran akses akun atau lakukan pembatasan suspend bagi pengguna.</p>
        </div>
        <div class="bg-blue-500/10 border border-blue-500/20 text-blue-400 px-4 py-2 rounded-xl text-sm font-semibold">
            Total Member: {{ $users->total() }}
        </div>
    </div>

    <div class="bg-[#1E293B] border border-slate-800 rounded-2xl overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-800 bg-slate-900/50 text-slate-400 text-xs uppercase tracking-wider">
                        <th class="py-4 px-6">Nama & Email</th>
                        <th class="py-4 px-6">Role</th>
                        <th class="py-4 px-6">Status Akun</th>
                        <th class="py-4 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-sm">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-800/30 transition">

                            <td class="py-4 px-6">
                                <div class="font-medium text-white">{{ $user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                            </td>

                            <td class="py-4 px-6">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                        Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-800 text-slate-300 border border-slate-700">
                                        Member
                                    </span>
                                @endif
                            </td>

                            <td class="py-4 px-6">
                                @if($user->is_suspended)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        Banned
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        Aktif
                                    </span>
                                @endif
                            </td>

                            <!-- Kolom Aksi -->
                            <td class="py-4 px-6 text-right space-x-2">
                                <div class="inline-flex items-center justify-end gap-2">
                                    <!-- Tombol Promote (Jika bukan admin) -->
                                    @if($user->role !== 'admin')
                                        <form action="{{ route('admin.users.promote', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" onclick="return confirm('Jadikan {{ $user->name }} sebagai Admin?')"
                                                    class="px-3 py-1.5 bg-blue-600/20 hover:bg-blue-600 text-blue-400 hover:text-white border border-blue-500/30 rounded-lg text-xs font-medium transition">
                                                Promote
                                            </button>
                                        </form>
                                    @endif

                                    <!-- Tombol Ban / Unban -->
                                    @if($user->id !== auth()->id())
                                        @if($user->is_suspended)
                                            <form action="{{ route('admin.users.unban', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="px-3 py-1.5 bg-emerald-600/20 hover:bg-emerald-600 text-emerald-400 hover:text-white border border-emerald-500/30 rounded-lg text-xs font-medium transition">
                                                    Aktifkan
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" onclick="return confirm('Yakin ingin membanned akun {{ $user->name }}?')"
                                                        class="px-3 py-1.5 bg-rose-600/20 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/30 rounded-lg text-xs font-medium transition">
                                                    Ban
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-slate-500 text-sm">
                                Belum ada data member terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="p-4 border-t border-slate-800 bg-slate-900/30">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
