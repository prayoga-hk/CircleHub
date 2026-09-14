@props(['type' => 'success'])

@php
    $styles = match ($type) {
        'error' => 'bg-rose-500/10 border-rose-500/20 text-rose-400',
        default => 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400',
    };
@endphp

<div class="{{ $styles }} border px-4 py-3 rounded-lg text-xs">
    {{ $slot }}
</div>
