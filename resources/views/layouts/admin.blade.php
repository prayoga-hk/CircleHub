<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0B0F19] text-slate-200 font-sans flex h-screen overflow-hidden antialiased">

    <aside class="w-56 bg-[#0B0F19] border-r border-slate-800/60 flex flex-col justify-between p-6 shrink-0">
        <div class="space-y-8">
            <h1 class="text-white font-bold text-lg px-2">Dashboard</h1>

            <nav class="space-y-2">
                <a href="{{ route('admin.statistics.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.statistics.*') ? 'bg-[#3B3A82] text-white font-medium' : 'bg-[#181D2D] text-slate-300 hover:bg-[#21273A]' }}">
                    Statistik
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#3B3A82] text-white font-medium' : 'bg-[#181D2D] text-slate-300 hover:bg-[#21273A]' }}">
                    Member
                </a>

                <a href="#"
                   class="block px-4 py-2 rounded-lg text-sm transition-colors bg-[#181D2D] text-slate-300 hover:bg-[#21273A]">
                    Postingan
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="block px-4 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-[#3B3A82] text-white font-medium' : 'bg-[#181D2D] text-slate-300 hover:bg-[#21273A]' }}">
                    Kategori
                </a>
            </nav>
        </div>

        <div class="space-y-3">
            <a href="/" class="block text-sm text-slate-300 hover:text-white px-2 transition-colors">
                Back to Home
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-sm text-slate-300 hover:text-white px-2 transition-colors">
                    Sign out
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 overflow-y-auto p-10 bg-[#0B0F19]">
        @yield('content')
    </main>

</body>
</html>
