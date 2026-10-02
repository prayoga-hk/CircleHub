<aside class="w-64 bg-white dark:bg-[#181920] border-r border-zinc-200 dark:border-zinc-800 h-full flex flex-col justify-between p-4 shrink-0 transition-colors duration-200 z-20">
    <div class="space-y-6">
        
        {{-- Menu Navigasi Utama --}}
        <nav class="space-y-1">
            
            {{-- Home --}}
            <a href="{{ route('pages.posts.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('pages.posts.index') ? 'bg-zinc-200/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Home</span>
            </a>

            {{-- Kategori --}}
            <a href="{{ route('pages.categories.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('pages.categories.*') ? 'bg-zinc-200/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Kategori</span>
            </a>

            {{-- Buat Postingan --}}
            <a href="{{ route('pages.posts.create') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('pages.posts.create') ? 'bg-zinc-200/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Buat</span>
            </a>

            {{-- Notifikasi --}}
            <a href="#" 
               class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <span>Notifikasi</span>
            </a>

        </nav>
    </div>

    {{-- Menu Bawah (Akun & Logout) --}}
    <div class="space-y-1 pt-4 border-t border-zinc-200 dark:border-zinc-800">
        
        {{-- Akun --}}
        <a href="{{ route('profile.edit') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-zinc-200/80 dark:bg-zinc-800/80 text-zinc-900 dark:text-white shadow-sm' : 'text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800/50 hover:text-zinc-900 dark:hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <span>Akun</span>
        </a>

        {{-- Log Out --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-2xl text-sm font-semibold text-zinc-600 dark:text-zinc-400 hover:bg-red-500/10 hover:text-red-600 dark:hover:text-red-400 transition-all duration-200 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                <span>Log Out</span>
            </button>
        </form>

    </div>
</aside>