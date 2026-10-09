@props([
    'id',
    'userId' => null,
    'username' => 'Anonim',
    'avatar' => '',
    'time' => 'Baru saja',
    'title' => '',
    'content' => '',
    'images' => [],
    'likes' => 0,
    'comments' => 0,
    'isLiked' => false,
])

@php
    $likesCount = is_countable($likes) ? count($likes) : (int) $likes;
    $commentsCount = is_countable($comments) ? count($comments) : (int) $comments;
    $imagesArray = is_array($images) ? $images : (json_decode($images, true) ?? []);
    $postUrl = route('pages.posts.show', $id);
    $userUrl = $userId ? route('users.show', $userId) : null;
@endphp

<div class="space-y-3" x-data="{
    liked: {{ $isLiked ? 'true' : 'false' }},
    likesCount: {{ $likesCount }},
    copied: false,
    async toggleLike(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        this.liked = !this.liked;
        this.likesCount += this.liked ? 1 : -1;

        try {
            let response = await fetch('{{ route('posts.like', $id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            });

            if (!response.ok) {
                this.liked = !this.liked;
                this.likesCount += this.liked ? 1 : -1;
            }
        } catch (error) {
            this.liked = !this.liked;
            this.likesCount += this.liked ? 1 : -1;
        }
    },
    sharePost(e) {
        if (e) {
            e.preventDefault();
            e.stopPropagation();
        }
        if (navigator.share) {
            navigator.share({
                title: '{{ addslashes($title) }}',
                text: '{{ addslashes($content) }}',
                url: '{{ $postUrl }}'
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText('{{ $postUrl }}');
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        }
    }
}">
    {{-- Style Menyembunyikan Scrollbar --}}
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    {{-- 1. Header Post (User Avatar, Nama & Waktu) — SEKARANG BISA DIKLIK --}}
    <div class="flex items-center justify-between px-1">
        @if($userUrl)
            <a href="{{ $userUrl }}" class="flex items-center gap-3 group/user">
                @if (!empty($avatar))
                    <img src="{{ asset('storage/' . $avatar) }}"
                         alt="{{ $username }}"
                         class="w-10 h-10 rounded-full object-cover shadow-sm group-hover/user:ring-2 group-hover/user:ring-indigo-500/50 transition-all" />
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm group-hover/user:ring-2 group-hover/user:ring-indigo-500/50 transition-all">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h4 class="font-bold text-sm text-zinc-900 dark:text-white leading-tight group-hover/user:text-indigo-600 dark:group-hover/user:text-indigo-400 transition-colors">
                        {{ $username }}
                    </h4>
                </div>
            </a>
        @else
            <div class="flex items-center gap-3">
                @if (!empty($avatar))
                    <img src="{{ asset('storage/' . $avatar) }}"
                         alt="{{ $username }}"
                         class="w-10 h-10 rounded-full object-cover shadow-sm" />
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <h4 class="font-bold text-sm text-zinc-900 dark:text-white leading-tight">{{ $username }}</h4>
                </div>
            </div>
        @endif
        <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $time }}</p>
    </div>

    {{-- 2. JUDUL --}}
    @if (!empty($title))
        <div class="px-1">
            <h3 class="font-bold text-base text-zinc-900 dark:text-white">{{ $title }}</h3>
        </div>
    @endif

    {{-- 3. Carousel Gambar --}}
    @if (!empty($imagesArray))
        <div x-data="{
                activeSlide: 0,
                totalSlides: {{ count($imagesArray) }},
                scrollNext() {
                    if (this.activeSlide < this.totalSlides - 1) {
                        this.activeSlide++;
                        this.$refs.slider.scrollTo({ left: this.$refs.slider.clientWidth * this.activeSlide, behavior: 'smooth' });
                    }
                },
                scrollPrev() {
                    if (this.activeSlide > 0) {
                        this.activeSlide--;
                        this.$refs.slider.scrollTo({ left: this.$refs.slider.clientWidth * this.activeSlide, behavior: 'smooth' });
                    }
                },
                updateActiveSlide() {
                    const scrollLeft = this.$refs.slider.scrollLeft;
                    const width = this.$refs.slider.clientWidth;
                    this.activeSlide = Math.round(scrollLeft / width);
                }
             }"
             class="relative rounded-2xl overflow-hidden group border border-zinc-200/60 dark:border-zinc-800 bg-black/5">

            <div x-ref="slider"
                 @scroll.debounce.50ms="updateActiveSlide()"
                 class="flex w-full overflow-x-auto snap-x snap-mandatory no-scrollbar scrollbar-none scroll-smooth">
                @foreach ($imagesArray as $img)
                    <div class="w-full shrink-0 snap-start flex items-center justify-center bg-zinc-900/10">
                        <img src="{{ asset('storage/' . $img) }}"
                             alt="Post Image"
                             class="w-full max-h-[480px] object-cover" />
                    </div>
                @endforeach
            </div>

            @if (count($imagesArray) > 1)
                <button x-show="activeSlide > 0"
                        @click.prevent.stop="scrollPrev()"
                        type="button"
                        class="absolute left-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-black/50 text-white hover:bg-black/80 transition duration-200 shadow-md backdrop-blur-sm z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <button x-show="activeSlide < totalSlides - 1"
                        @click.prevent.stop="scrollNext()"
                        type="button"
                        class="absolute right-3 top-1/2 -translate-y-1/2 p-2 rounded-full bg-black/50 text-white hover:bg-black/80 transition duration-200 shadow-md backdrop-blur-sm z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>

                <div class="absolute bottom-3 inset-x-0 flex justify-center gap-1.5 z-10">
                    @foreach ($imagesArray as $index => $img)
                        <div class="w-2 h-2 rounded-full transition-all duration-300"
                             :class="activeSlide === {{ $index }} ? 'bg-white w-4' : 'bg-white/50'"></div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- 4. Konten Teks --}}
    @if (!empty($content))
        <div class="px-1">
            <p class="text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-line leading-relaxed">{{ $content }}</p>
        </div>
    @endif

    {{-- 5. Baris Ikon Interaksi --}}
    <div class="flex items-center gap-5 pt-2 px-1">

        {{-- TOMBOL LIKE --}}
        <button type="button"
                @click.prevent.stop="toggleLike($event)"
                class="flex items-center gap-1.5 transition cursor-pointer bg-transparent border-0 p-0 group text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="22"
                 height="22"
                 viewBox="0 0 24 24"
                 :fill="liked ? 'currentColor' : 'none'"
                 stroke="currentColor"
                 stroke-width="1.8"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="transition-transform group-hover:scale-110"
                 :class="liked ? 'text-indigo-600 dark:text-indigo-400' : ''">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
            </svg>
            <span class="text-sm font-medium tracking-tight"
                  :class="liked ? 'text-indigo-600 dark:text-indigo-400 font-bold' : ''"
                  x-text="String(likesCount).padStart(2, '0')"></span>
        </button>

        {{-- TOMBOL KOMENTAR --}}
        <button type="button"
                @click.prevent.stop="window.location.href = '{{ $postUrl }}'"
                class="flex items-center gap-1.5 text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition cursor-pointer bg-transparent border-0 p-0 group">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="22"
                 height="22"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="1.8"
                 stroke-linecap="round"
                 stroke-linejoin="round"
                 class="transition-transform group-hover:scale-110">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
            <span class="text-sm font-medium tracking-tight">{{ sprintf('%02d', $commentsCount) }}</span>
        </button>

        {{-- TOMBOL SHARE --}}
        <div class="relative">
            <button type="button"
                    @click.prevent.stop="sharePost($event)"
                    class="flex items-center text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition cursor-pointer bg-transparent border-0 p-0 group">
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="22"
                     height="22"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="1.8"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     class="transition-transform group-hover:scale-110">
                    <line x1="22" y1="2" x2="11" y2="13"></line>
                    <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                </svg>
            </button>

            <span x-show="copied"
                  x-transition
                  class="absolute bottom-full left-0 mb-2 px-2.5 py-1 bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 text-[10px] font-medium rounded-lg shadow-lg whitespace-nowrap z-20">
                Link tersalin!
            </span>
        </div>
    </div>
</div>