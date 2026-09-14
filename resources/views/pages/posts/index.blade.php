<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CircleHub - Home</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0B0F19] text-slate-100 flex min-h-screen">

    <!-- Komponen Sidebar Modular -->
    <x-sidebar />

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col">

        <!-- Top Search Bar Header -->
        <header class="h-16 border-b border-slate-800/60 px-8 flex items-center justify-end bg-[#0B0F19]/80 backdrop-blur sticky top-0 z-20">
            <div class="relative w-72">
                <input type="text" placeholder="Cari sesuatu..." class="w-full bg-[#1D2132] border border-slate-700/60 rounded-xl pl-4 pr-10 py-2 text-xs text-white focus:outline-none focus:border-[#6C5CE7]">
                <span class="absolute right-3 top-2.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
            </div>
        </header>

        <!-- Feed / Timeline Section -->
        <div class="p-8 flex-1 overflow-y-auto space-y-6 flex flex-col items-center justify-start bg-gradient-to-br from-[#0B0F19] via-[#121623] to-[#1A1829]">

            @forelse($posts as $post)
                <!-- Card Postingan Langsung (Tanpa Komponen Terpisah) -->
                <div class="bg-[#1D2132]/90 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 shadow-2xl max-w-xl w-full mx-auto space-y-4">
                    <!-- 1. Header Post -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#6C5CE7] flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr($post->user->name ?? 'Anonymous', 0, 2)) }}
                            </div>
                            <span class="text-white font-medium text-sm">{{ $post->user->name ?? 'Anonymous' }}</span>
                        </div>
                        <span class="text-xs text-slate-400">
                            {{ $post->created_at ? $post->created_at->diffForHumans() : 'Baru saja' }}
                        </span>
                    </div>

                    <!-- 2. Media / Image Box Placeholder -->
                    <div class="w-full h-64 bg-[#6C5CE7]/60 rounded-xl flex flex-col items-center justify-center gap-2 overflow-hidden border border-slate-600/30 text-indigo-100">
                        <span class="text-xs font-medium tracking-wide">gambar akan muncul di sini</span>
                    </div>

                    <!-- 3. Action Buttons -->
                    <div class="flex items-center gap-6 text-slate-300 text-sm pt-1">
                        <button type="button" class="flex items-center gap-2 hover:text-[#6C5CE7] transition cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                            <span>0</span>
                        </button>
                        <button type="button" class="flex items-center gap-2 hover:text-[#6C5CE7] transition cursor-pointer">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                            <span>0</span>
                        </button>
                        <button type="button" class="hover:text-[#6C5CE7] transition cursor-pointer ml-auto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>

                    <!-- 4. Caption / Text Content -->
                    <div class="text-slate-200 text-xs sm:text-sm leading-relaxed pt-1">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            @empty
                <div class="text-center text-slate-500 py-12">
                    <p class="text-sm">Belum ada postingan yang dibagikan.</p>
                </div>
            @endforelse

        </div>
    </main>

</body>
</html>
