@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')

<div class="space-y-6 w-full relative">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <x-admin.stat-card label="Member"   :value="$totalMembers"    id="stat-member" />
        <x-admin.stat-card label="Kategori" :value="$totalCategories" id="stat-kategori" />
        <x-admin.stat-card label="Posting"  :value="$totalPosts"      id="stat-postingan" />
    </div>

    <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl shadow-xl overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-400 text-sm border-b border-slate-800/60">
                    <th class="px-6 py-4 font-medium">Username</th>
                    <th class="px-6 py-4 font-medium">Aktivitas</th>
                    <th class="px-6 py-4 font-medium text-right">Waktu</th>
                </tr>
            </thead>
            <tbody id="activity-feed">
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                        Memuat data...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
(function () {
    'use strict';

    const DATA_URL      = '{{ route('admin.statistics.data') }}';
    const POLL_INTERVAL = 5000;
    let lastActivityId;

    async function fetchStatistics() {
        try {
            const res = await fetch(DATA_URL, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();

            updateStat('stat-member',    data.members);
            updateStat('stat-kategori',  data.categories);
            updateStat('stat-postingan', data.posts);

            const newestId = data.activities[0]?.id ?? null;
            if (newestId !== lastActivityId) {
                lastActivityId = newestId;
                renderFeed(data.activities);
            }
        } catch (err) {
            console.error('Gagal fetch statistik:', err);
        }
    }

    function updateStat(id, value) {
        const el = document.querySelector(`[data-stat-id="${id}"]`);
        if (el) el.textContent = value ?? 0;
    }

    function renderFeed(activities) {
        const feed = document.getElementById('activity-feed');
        feed.innerHTML = '';

        if (!activities.length) {
            feed.innerHTML = `
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-slate-500">
                        Belum ada aktivitas
                    </td>
                </tr>`;
            return;
        }

        activities.forEach(a => feed.appendChild(createRow(a)));
    }

    function createRow(act) {
        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-800/40 hover:bg-white/5 transition';

        const label = {
            post:    'Posting',
            comment: 'Komentar',
            like:    'Like',
        }[act.type] || act.type;

        tr.innerHTML = `
            <td class="px-6 py-4 text-white">${escapeHtml(act.user.name)}</td>
            <td class="px-6 py-4 text-slate-300">${label}</td>
            <td class="px-6 py-4 text-right text-slate-300">${act.created_at}</td>
        `;
        return tr;
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    fetchStatistics();
    setInterval(fetchStatistics, POLL_INTERVAL);
})();
</script>

@endsection
