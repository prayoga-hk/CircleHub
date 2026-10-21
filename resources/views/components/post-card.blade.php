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
    'isOwner' => false,
    'editUrl' => null,
    'deleteUrl' => null,
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
                /* PERBAIKAN: Tambahkan ?? '' agar tidak error jika null */
                title: @js($title ?? ''),
                text: @js($content ?? ''),
                url: @js($postUrl)
            }).catch(() => {});
        } else {
            navigator.clipboard.writeText(@js($postUrl));
            this.copied = true;
            setTimeout(() => this.copied = false, 2000);
        }
    }
}">
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="flex items-center justify-between px-1 gap-2">
        @if($userUrl)
            <a href="{{ $userUrl }}" class="flex items-center gap-3 group/user min-w-0">
                @if (!empty($avatar))
                    <img src="{{ asset('storage/' . $avatar) }}"
                         alt="{{ $username }}"
                         class="w-10 h-10 rounded-full object-cover shadow-sm group-hover/user:ring-2 group-hover/user:ring-indigo-500/50 transition-all shrink-0" />
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm group-hover/user:ring-2 group-hover/user:ring-indigo-500/50 transition-all shrink-0">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <h4 class="font-bold text-sm text-zinc-900 dark:text-white leading-tight group-hover/user:text-indigo-600 dark:group-hover/user:text-indigo-400 transition-colors truncate">
                        {{ $username }}
                    </h4>
                </div>
            </a>
        @else
            <div class="flex items-center gap-3 min-w-0">
                @if (!empty($avatar))
                    <img src="{{ asset('storage/' . $avatar) }}"
                         alt="{{ $username }}"
                         class="w-10 h-10 rounded-full object-cover shadow-sm shrink-0" />
                @else
                    <div class="w-10 h-10 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-sm shadow-sm shrink-0">
                        {{ strtoupper(substr($username, 0, 1)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <h4 class="font-bold text-sm text-zinc-900 dark:text-white leading-tight truncate">{{ $username }}</h4>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-1 shrink-0">
            <p class="text-xs text-zinc-400 dark:text-zinc-500">{{ $time }}</p>

            @if($isOwner && $editUrl && $deleteUrl)
                <div class="relative post-menu-container shrink-0">
                    <button type="button"
                            onclick="togglePostMenu(this)"
                            class="p-1.5 rounded-full text-zinc-500 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-800 dark:hover:text-white transition cursor-pointer"
                            aria-label="Menu postingan">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <circle cx="10" cy="4"  r="1.6"/>
                            <circle cx="10" cy="10" r="1.6"/>
                            <circle cx="10" cy="16" r="1.6"/>
                        </svg>
                    </button>

                    <div class="post-menu-dropdown hidden absolute right-0 mt-1 w-44 bg-white dark:bg-[#1f2028] border border-zinc-200 dark:border-zinc-700 rounded-xl shadow-2xl py-1.5 z-40">
                        <a href="{{ $editUrl }}"
                           class="flex items-center gap-2.5 px-4 py-2 text-sm text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition">
                            <svg class="w-4 h-4 text-indigo-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                            </svg>
                            Edit Postingan
                        </a>

                        <form action="{{ $deleteUrl }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus postingan ini? Tindakan ini tidak bisa dibatalkan.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="w-full flex items-center gap-2.5 px-4 py-2 text-sm text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition text-left cursor-pointer">
                                <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Hapus Postingan
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if (!empty($title))
        <div class="px-1">
            <h3 class="font-bold text-base text-zinc-900 dark:text-white">{{ $title }}</h3>
        </div>
    @endif

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

    {{-- BAGIAN KONTEN / CAPTION DENGAN FITUR READ MORE --}}
    @if (!empty($content))
        <div x-data="{ expanded: false }" class="px-1 text-sm text-zinc-800 dark:text-zinc-200 leading-relaxed prose dark:prose-invert prose-p:text-zinc-800 dark:prose-p:text-zinc-200 prose-headings:text-zinc-900 dark:prose-headings:text-white max-w-none relative">
            
            {{-- Konten dengan batasan tinggi --}}
            <div class="transition-all duration-300 overflow-hidden break-words"
                 x-bind:class="expanded ? '' : 'max-h-[5rem]'">
                {!! \Illuminate\Support\Str::markdown($content) !!}
            </div>

            {{-- Tombol Lihat Selengkapnya --}}
            {{-- Hanya muncul jika panjang teks lebih dari 180 karakter --}}
            @if(strlen(strip_tags($content)) > 180)
                <button 
                    type="button"
                    @click="expanded = !expanded" 
                    class="text-sm font-semibold text-indigo-500 hover:text-indigo-600 dark:text-indigo-400 dark:hover:text-indigo-300 mt-1 inline-block cursor-pointer focus:outline-none"
                    x-text="expanded ? 'Tampilkan lebih sedikit' : 'Lihat selengkapnya'"
                >
                </button>
            @endif
        </div>
    @endif

    <div class="flex items-center gap-5 pt-2 px-1">
        <button type="button"
                @click.prevent.stop="toggleLike($event)"
                class="flex items-center gap-1.5 transition cursor-pointer bg-transparent border-0 p-0 group text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400">
            <svg xmlns="http://www.w3.org/2000/svg"
                 width="22" height="22" viewBox="0 0 24 24"
                 :fill="liked ? 'currentColor' : 'none'"
                 stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"
                 class="transition-transform group-hover:scale-110"
                 :class="liked ? 'text-indigo-600 dark:text-indigo-400' : ''">
                <path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path>
            </svg>
            <span class="text-sm font-medium tracking-tight"
                  :class="liked ? 'text-indigo-600 dark:text-indigo-400 font-bold' : ''"
                  x-text="String(likesCount).padStart(2, '0')"></span>
        </button>

        <button type="button"
                @click.prevent.stop="window.location.href = '{{ $postUrl }}'"
                class="flex items-center gap-1.5 text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition cursor-pointer bg-transparent border-0 p-0 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:scale-110">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
            </svg>
            <span class="text-sm font-medium tracking-tight">{{ sprintf('%02d', $commentsCount) }}</span>
        </button>

        <div class="relative">
            <button type="button" @click.prevent.stop="sharePost($event)" class="flex items-center text-zinc-800 dark:text-zinc-200 hover:text-indigo-600 dark:hover:text-indigo-400 transition cursor-pointer bg-transparent border-0 p-0 group">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="transition-transform group-hover:scale-110">
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