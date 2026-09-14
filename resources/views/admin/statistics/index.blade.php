@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')
<div class="space-y-6 w-full relative">

    <h2 class="text-3xl font-normal text-white">Statistik Platform</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-admin.stat-card label="Member" :value="$totalMembers" />
        <x-admin.stat-card label="Admin" :value="$totalAdmins" />
        <x-admin.stat-card label="Banned" :value="$totalBanned" />
        <x-admin.stat-card label="Kategori" :value="$totalCategories" />
        <x-admin.stat-card label="Posting" :value="$totalPosts" />
    </div>

</div>
@endsection
