@props(['href', 'active' => false])

<a href="{{ $href }}"
   class="block px-4 py-2 rounded-lg text-sm transition-colors {{ $active ? 'bg-[#3B3A82] text-white font-medium' : 'bg-[#181D2D] text-slate-300 hover:bg-[#21273A]' }}">
    {{ $slot }}
</a>
