@extends('layouts.admin')

@section('title', 'Statistik')

@section('content')

<div class="space-y-6 w-full relative">

    <!-- 3 Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-admin.stat-card label="Member"   :value="$totalMembers"    id="stat-member" />
        <x-admin.stat-card label="Kategori" :value="$totalCategories" id="stat-kategori" />
        <x-admin.stat-card label="Posting"  :value="$totalPosts"      id="stat-postingan" />
    </div>

    <!-- Bagian Bawah: Chart (Kiri) & Tabel Top Users (Kanan) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Kolom Kiri: Chart 1 Hari (Span 2) -->
        <div class="lg:col-span-2 bg-[#1D2132] border border-slate-800/40 rounded-xl p-6 shadow-xl flex flex-col justify-between relative">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-medium text-slate-400">Statistik Postingan Harian (Per Jam)</span>
            </div>

            <div class="relative w-full h-[280px] flex items-center justify-center">
                <span class="absolute -left-2 top-1/2 -translate-y-1/2 -rotate-90 text-xs text-slate-400 font-medium tracking-wider">jumlah</span>
                <canvas id="statisticsChart" class="w-full h-full"></canvas>
            </div>

            <div class="text-center mt-3">
                <span class="text-xs text-slate-400 font-medium tracking-wider">Time</span>
            </div>
        </div>

        <!-- Kolom Kanan: Tabel Top Liked Users -->
        <div class="bg-[#1D2132] border border-slate-800/40 rounded-xl shadow-xl overflow-hidden flex flex-col h-full">
            <div class="p-6 border-b border-slate-800/60 shrink-0">
                <h3 class="text-sm font-medium text-slate-400">Top Liked Users</h3>
            </div>

            <!-- Area Tabel -->
            <div class="flex-1 overflow-y-auto">
                <table class="w-full text-left">
                    <thead class="sticky top-0 bg-[#1D2132] z-10">
                        <tr class="text-slate-400 text-sm border-b border-slate-800/60">
                            <th class="px-6 py-4 font-medium">User</th>
                            <th class="px-6 py-4 font-medium text-right">Likes</th>
                        </tr>
                    </thead>
                    <tbody id="top-users-feed">
                        <tr>
                            <td colspan="2" class="px-6 py-8 text-center text-slate-500">
                                Memuat data...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Navigasi Pagination (Baru) -->
            <div class="p-3 border-t border-slate-800/60 flex items-center justify-between shrink-0 bg-[#1D2132]">
                <button id="prev-user-btn" class="px-3 py-1.5 text-xs font-medium bg-slate-800 text-slate-300 rounded hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed transition" disabled>
                    Prev
                </button>
                <span id="user-page-info" class="text-xs text-slate-400">Hal 1 / 1</span>
                <button id="next-user-btn" class="px-3 py-1.5 text-xs font-medium bg-slate-800 text-slate-300 rounded hover:bg-slate-700 disabled:opacity-50 disabled:cursor-not-allowed transition" disabled>
                    Next
                </button>
            </div>
        </div>

    </div>

</div>

<script>
(function () {
    'use strict';

    const DATA_URL      = '{{ route('admin.statistics.data') }}';
    const POLL_INTERVAL = 5000;
    let myChart;
    let currentUserPage = 1; // Menyimpan halaman tabel user saat ini

    function initChart() {
        const canvas = document.getElementById('statisticsChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        const hours = ['00:00', '01:00', '02:00', '03:00', '04:00', '05:00', '06:00', '07:00', '08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00', '17:00', '18:00', '19:00', '20:00', '21:00', '22:00', '23:59'];

        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: hours,
                datasets: [{
                    label: 'Jumlah Postingan',
                    data: new Array(24).fill(0),
                    borderColor: '#cbd5e1',
                    borderWidth: 2,
                    tension: 0.4,
                    pointRadius: 0,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8', font: { size: 10 }, maxTicksLimit: 8 } },
                    y: { grid: { color: 'rgba(255, 255, 255, 0.05)' }, ticks: { color: '#94a3b8', font: { size: 11 }, precision: 0 }, beginAtZero: true }
                }
            }
        });
    }

    async function fetchStatistics() {
        try {
            // Tambahkan parameter ?page= untuk mengambil halaman user yang sesuai
            const res = await fetch(`${DATA_URL}?page=${currentUserPage}`, {
                headers: { 'Accept': 'application/json' }
            });
            if (!res.ok) throw new Error('HTTP ' + res.status);
            const data = await res.json();

            updateStat('stat-member',    data.members);
            updateStat('stat-kategori',  data.categories);
            updateStat('stat-postingan', data.posts);

            if (data.chartData && myChart) {
                myChart.data.datasets[0].data = data.chartData;
                myChart.update('none');
            }

            // Render User & Pagination
            if (data.topUsers) {
                renderTopUsers(data.topUsers.data);
                updatePaginationControls(data.topUsers);
            }
        } catch (err) {
            console.error('Gagal fetch statistik:', err);
        }
    }

    function updateStat(id, value) {
        const el = document.getElementById(id) || document.querySelector(`[data-stat-id="${id}"]`);
        if (el) el.textContent = value ?? 0;
    }

    function renderTopUsers(users) {
        const feed = document.getElementById('top-users-feed');
        if (!feed) return;
        feed.innerHTML = '';

        if (!users || users.length === 0) {
            feed.innerHTML = `
                <tr>
                    <td colspan="2" class="px-6 py-8 text-center text-slate-500">
                        Belum ada data user.
                    </td>
                </tr>`;
            return;
        }

        users.forEach(u => feed.appendChild(createUserRow(u)));
    }

    function createUserRow(user) {
        const tr = document.createElement('tr');
        tr.className = 'border-b border-slate-800/40 hover:bg-white/5 transition';

        tr.innerHTML = `
            <td class="px-6 py-3 flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold text-xs shrink-0">
                    ${escapeHtml(user.name.charAt(0).toUpperCase())}
                </div>
                <span class="text-white font-medium text-sm">${escapeHtml(user.name)}</span>
            </td>
            <td class="px-6 py-3 text-right text-indigo-400 font-bold">
                ${user.total_likes ?? 0}
            </td>
        `;
        return tr;
    }

    // Fungsi untuk mengatur tombol Prev / Next
    function updatePaginationControls(paginator) {
        const prevBtn = document.getElementById('prev-user-btn');
        const nextBtn = document.getElementById('next-user-btn');
        const pageInfo = document.getElementById('user-page-info');

        // Set teks halaman (misal: Hal 1 / 3)
        pageInfo.textContent = `Hal ${paginator.current_page} / ${paginator.last_page}`;

        // Atur status tombol Prev
        if (paginator.current_page <= 1) {
            prevBtn.disabled = true;
        } else {
            prevBtn.disabled = false;
        }

        // Atur status tombol Next
        if (paginator.current_page >= paginator.last_page) {
            nextBtn.disabled = true;
        } else {
            nextBtn.disabled = false;
        }
    }

    // Event Listener untuk Tombol Prev & Next
    document.getElementById('prev-user-btn').addEventListener('click', () => {
        if (currentUserPage > 1) {
            currentUserPage--;
            fetchStatistics(); // Langsung ambil data halaman sebelumnya
        }
    });

    document.getElementById('next-user-btn').addEventListener('click', () => {
        currentUserPage++;
        fetchStatistics(); // Langsung ambil data halaman berikutnya
    });

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function startDashboard() {
        if (typeof window.Chart !== 'undefined') {
            initChart();
            fetchStatistics();
            setInterval(fetchStatistics, POLL_INTERVAL);
        } else {
            setTimeout(startDashboard, 100);
        }
    }

    startDashboard();

})();
</script>

@endsection
