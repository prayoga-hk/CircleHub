@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')

<div class="space-y-6 w-full relative">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-admin.stat-card label="Member" :value="$totalMembers" />
        <x-admin.stat-card label="Kategori" :value="$totalCategories" />
        <x-admin.stat-card label="Posting" :value="$totalPosts" />
    </div>

</div>
@endsection
