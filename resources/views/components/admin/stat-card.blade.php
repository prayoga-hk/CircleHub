@props(['label', 'value'])

<div class="bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex items-center justify-between">
    <div>
        <p class="text-xs uppercase tracking-wider text-slate-400 font-medium">{{ $label }}</p>
        <h3 class="text-3xl font-bold text-white mt-2">{{ $value }}</h3>
    </div>
</div>
