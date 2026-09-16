@props([
    'username' => 'User',
    'time' => '0 jam yang lalu',
    'content' => '',
    'image' => null,
    'likes' => '00',
    'comments' => '00'
])

<div class="bg-[#27272a] border border-zinc-800/50 rounded-2xl p-5 shadow-2xl text-zinc-100 font-sans">

    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-[#6358e1]"></div>
            <span class="font-medium text-base tracking-wide text-zinc-200">{{ $username }}</span>
        </div>
        <span class="text-xs text-zinc-400">{{ $time }}</span>
    </div>

    @if ($image)
        <div class="w-full h-64 overflow-hidden rounded-2xl mb-4 bg-[#6358e1]">
            <img src="{{ asset('storage/' . $image) }}" alt="Post Media" class="w-full h-full object-cover">
        </div>
    @else
        <div class="w-full h-64 bg-[#6358e1] rounded-2xl mb-4"></div>
    @endif

    <div class="flex items-center gap-5 text-zinc-200 mb-4">
        <!-- Like -->
        <button class="flex items-center gap-2 hover:text-indigo-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
            </svg>
            <span class="text-sm font-medium">{{ sprintf('%02d', $likes) }}</span>
        </button>

        <button class="flex items-center gap-2 hover:text-indigo-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <span class="text-sm font-medium">{{ sprintf('%02d', $comments) }}</span>
        </button>

        <button class="hover:text-indigo-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
        </button>
    </div>

    <p class="text-sm text-zinc-200 leading-relaxed whitespace-pre-line">
        {{ $content }}
    </p>

</div>
