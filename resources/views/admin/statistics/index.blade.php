@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')
<div class="space-y-6 w-full relative">

    <h2 class="text-3xl font-normal text-white">Statistik Platform</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Member</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalMembers }}</h3>
            </div>
        </div>

        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Admin</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalAdmins }}</h3>
            </div>
        </div>

        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Banned</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalBanned }}</h3>
            </div>
        </div>

        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Kategori</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalCategories }}</h3>
            </div>
        </div>

        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">Posting</p>
                <h3 class="text-3xl font-bold text-white mt-2">{{ $totalPosts }}</h3>
            </div>
        </div>

    </div>

</div>
@endsection
