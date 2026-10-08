@props(['title' => 'Statistik Platform'])

<header class="w-full bg-[#0B0F19] border-b border-gray-800/60 px-8 py-4 flex items-center justify-between">
    <!-- Nama Halaman yang Sedang Dibuka -->
    <div>
        <h1 class="text-2xl font-bold text-white tracking-tight">
            {{ $title }}
        </h1>
    </div>

    <!-- Profil & Username Admin -->
    <div class="flex items-center space-x-3">
        <!-- Nama Admin -->
        <span class="text-sm font-medium text-gray-300">
            {{ auth()->user()->name ?? 'Admin CircleHub' }}
        </span>

        <!-- Foto / Avatar Admin -->
        <div class="relative group">
            @php
                $user = auth()->user();
                // Mengambil foto profil berdasarkan kolom avatar atau profile_photo_path
                $avatarPath = $user?->avatar ?? $user?->profile_photo_path;
            @endphp

            @if($avatarPath)
                <img class="w-9 h-9 rounded-full object-cover border border-indigo-500/50"
                     src="{{ str_starts_with($avatarPath, 'http') ? $avatarPath : asset('storage/' . $avatarPath) }}"
                     alt="{{ $user->name ?? 'Admin' }}">
            @else
                <div class="w-9 h-9 rounded-full bg-[#5046E5] text-white flex items-center justify-center font-semibold text-sm border border-indigo-400/30">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
            @endif
        </div>
    </div>
</header>
