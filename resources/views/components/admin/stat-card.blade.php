@props([
    'label',
    'value' => 0,
    'id' => null,
])

@php
    $iconName = strtolower($label);
@endphp

<div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
    <div>
        <p class="text-sm font-medium text-slate-400 mb-1">{{ $label }}</p>
        <h3 class="text-3xl font-bold text-white tracking-tight" @if($id) id="{{ $id }}" data-stat-id="{{ $id }}" @endif>
            {{ sprintf('%02d', $value) }}
        </h3>
    </div>

    <div class="text-white/90">
        @if(str_contains($iconName, 'member') || str_contains($iconName, 'user'))
            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
                <path d="M20 8v6M23 11h-6"></path>
            </svg>

        @elseif(str_contains($iconName, 'kategori') || str_contains($iconName, 'category'))
            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                <rect x="3" y="3" width="9" height="9" rx="2"></rect>
                <rect x="14" y="3" width="7" height="18" rx="2"></rect>
                <rect x="3" y="14" width="9" height="7" rx="2"></rect>
            </svg>

        @elseif(str_contains($iconName, 'posting') || str_contains($iconName, 'post'))
            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                <path d="M6 2h9l5 5v13a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" opacity="0.9"></path>
                <path d="M14 2v6h6" fill="none" stroke="#1D2132" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <line x1="8" y1="12" x2="16" y2="12" stroke="#1D2132" stroke-width="2" stroke-linecap="round"></line>
                <line x1="8" y1="16" x2="13" y2="16" stroke="#1D2132" stroke-width="2" stroke-linecap="round"></line>
            </svg>

        @else
            <svg class="w-12 h-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="3" width="18" height="18" rx="2"></rect>
            </svg>
        @endif
    </div>
</div>
