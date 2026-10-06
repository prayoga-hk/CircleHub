<header class="h-16 bg-white border-b border-zinc-200 text-zinc-900 dark:bg-[#18181b] dark:border-zinc-800 dark:text-zinc-100 flex items-center justify-between px-6 z-20 transition-colors duration-200">

    <!-- Logo / Brand Title -->
    <div class="flex items-center gap-2">
        <img src="https://i.ibb.co.com/LdRGnQbx/Whats-App-Image-2026-09-18-at-14-45-35-removebg-preview.png"
             alt="Logo CircleHub"
             class="h-12 w-auto object-contain">

        <div class="text-xl font-bold tracking-wide text-zinc-900 dark:text-zinc-100">
            CircleHub
        </div>
    </div>

    <!-- Profile Menu (klik → halaman edit profile) -->
    @auth
        <a href="{{ route('profile.edit') }}"
           class="flex items-center gap-3 px-2 py-1.5 rounded-full hover:bg-zinc-100 dark:hover:bg-zinc-800/60 transition cursor-pointer">

            <!-- Avatar -->
            @if(auth()->user()->avatar)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-8 h-8 rounded-full object-cover shadow-sm" />
            @else
                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            @endif

            <!-- Username -->
            <span class="text-sm font-medium text-zinc-800 dark:text-zinc-200 hidden sm:block">
                {{ auth()->user()->name }}
            </span>
        </a>
    @endauth

    @guest
        <!-- Tombol Login untuk tamu -->
        <a href="{{ route('login') }}"
           class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:underline">
            Login
        </a>
    @endguest
</header>
