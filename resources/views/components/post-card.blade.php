@props(['name' => 'Musicken', 'time' => '5 jam yang lalu', 'content' => '', 'likes' => 0, 'comments' => 0])

<div class="bg-[#1D2132]/90 backdrop-blur-md border border-slate-700/50 rounded-2xl p-6 shadow-2xl max-w-xl w-full mx-auto space-y-4">
    <!-- 1. Header Post (Avatar & Nama User) -->
    <div class="flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#6C5CE7] flex items-center justify-center text-white font-bold text-sm">
                {{ strtoupper(substr($name, 0, 2)) }}
            </div>
            <span class="text-white font-medium text-sm">{{ $name }}</span>
        </div>
        <span class="text-xs text-slate-400">{{ $time }}</span>
    </div>

    <!-- 2. Media / Image Box Placeholder (Di Tengah) -->
    <div class="w-full h-64 bg-[#6C5CE7]/60 rounded-xl flex flex-col items-center justify-center gap-2 overflow-hidden border border-slate-600/30 text-indigo-100">
        <svg class="w-12 h-12 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
        <span class="text-xs font-medium tracking-wide">Preview Lagu / Banner Hobi</span>

        {{-- Pengecekan aman untuk slot --}}
        @isset($slot)
            {{ $slot }}
        @endisset
    </div>

    <!-- 3. Action Buttons (Like, Comment, Share) -->
    <div class="flex items-center gap-6 text-slate-300 text-sm pt-1">
        <button type="button" class="flex items-center gap-2 hover:text-[#6C5CE7] transition cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
            <span>{{ $likes }}</span>
        </button>
        <button type="button" class="flex items-center gap-2 hover:text-[#6C5CE7] transition cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            <span>{{ $comments }}</span>
        </button>
        <button type="button" class="hover:text-[#6C5CE7] transition cursor-pointer ml-auto">
           <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-forward"><path d="m15 17 5-5-5-5"/><path d="M4 18v-2a4 4 0 0 1 4-4h12"/></svg>
        </button>
    </div>

    <!-- 4. Caption / Text Content -->
    <div class="text-slate-200 text-xs sm:text-sm leading-relaxed pt-1">
        {!! nl2br(e($content)) !!}
    </div>
</div>
