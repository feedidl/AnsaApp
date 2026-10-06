@extends('admin.layout')

@section('title', 'Estimator Harga')
@section('page_title', 'Estimator Harga — Beli Putus vs Sewa Bulanan')

@php
    $buyFields = [
        ['key' => 'upfront_cost', 'label' => 'Upfront Cost / Biaya Pembuatan Awal', 'hint' => 'Termasuk hosting & domain Tahun ke-1', 'min' => 0, 'max' => 100000000, 'step' => 500000, 'unit' => 'money'],
        ['key' => 'annual_fee', 'label' => 'Perpanjangan Tahunan (Hosting/Maintenance)', 'hint' => 'Mulai dibayar Tahun ke-2', 'min' => 0, 'max' => 20000000, 'step' => 250000, 'unit' => 'money'],
        ['key' => 'warranty_months', 'label' => 'Masa Garansi Awal', 'hint' => null, 'min' => 0, 'max' => 12, 'step' => 1, 'unit' => 'Bulan'],
    ];
    $subFields = [
        ['key' => 'setup_fee', 'label' => 'Uang Muka / Setup Fee Awal', 'hint' => null, 'min' => 0, 'max' => 20000000, 'step' => 250000, 'unit' => 'money'],
        ['key' => 'monthly_fee', 'label' => 'Biaya Sewa Bulanan', 'hint' => null, 'min' => 100000, 'max' => 10000000, 'step' => 50000, 'unit' => 'money'],
        ['key' => 'min_contract_months', 'label' => 'Durasi Minimal Kontrak', 'hint' => null, 'min' => 1, 'max' => 36, 'step' => 1, 'unit' => 'Bulan'],
        ['key' => 'maintenance_quota_hours', 'label' => 'Kuota Maintenance Minor', 'hint' => null, 'min' => 0, 'max' => 20, 'step' => 1, 'unit' => 'Jam/Bulan'],
        ['key' => 'penalty_percent', 'label' => 'Penalti Putus Kontrak Dini', 'hint' => 'Dari sisa bulan minimal kontrak', 'min' => 50, 'max' => 100, 'step' => 5, 'unit' => '%'],
    ];
@endphp

@section('content')
<style>
    body.presentation-mode aside,
    body.presentation-mode > header,
    body.presentation-mode main > div:first-child,
    body.presentation-mode [data-hide-presentation] { display: none !important; }
    body.presentation-mode main { background: radial-gradient(ellipse at top, rgba(20,184,166,.08), transparent 60%); }
    .est-range { height: 6px; cursor: pointer; }
</style>

<div x-data="estimatorApp(@js($defaults), @js(array_keys($slaFeatures)), @js(route('admin.contracts.create')))" class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg sm:text-xl font-bold text-white">Simulasi Investasi Aplikasi</h2>
            <p class="text-xs text-slate-400">Bandingkan skema <span class="text-amber-400 font-semibold">Beli Putus</span> dan <span class="text-teal-400 font-semibold">Sewa Bulanan</span> secara real-time.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
            <button type="button" @click="reset()" data-hide-presentation
                    class="px-3.5 py-2 rounded-xl text-xs font-semibold border border-slate-700 bg-slate-800 text-slate-300 hover:text-white cursor-pointer">
                Reset Default
            </button>
            <button type="button" @click="togglePresentation()"
                    class="px-3.5 py-2 rounded-xl text-xs font-semibold border border-teal-500/40 bg-teal-500/10 text-teal-300 hover:bg-teal-500/20 cursor-pointer flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
                <span x-text="presenting ? 'Keluar Mode Presentasi' : 'Mode Presentasi'"></span>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

        {{-- ================= PANEL PARAMETER ================= --}}
        <div class="xl:col-span-4 space-y-5">

            {{-- Beli Putus --}}
            <div class="bg-slate-900 border border-amber-500/20 rounded-3xl p-5 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-amber-400"></span>
                    <h3 class="text-sm font-bold text-white">Model Beli Putus</h3>
                </div>
                @foreach ($buyFields as $f)
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between gap-2">
                            <label class="text-[11px] font-semibold text-slate-300">{{ $f['label'] }}</label>
                            <span class="text-xs font-mono font-bold text-amber-300"
                                  x-text="{{ $f['unit'] === 'money' ? "fmt(p.{$f['key']})" : "num(p.{$f['key']}) + ' {$f['unit']}'" }}"></span>
                        </div>
                        <input type="range" min="{{ $f['min'] }}" max="{{ $f['max'] }}" step="{{ $f['step'] }}"
                               x-model.number="p.{{ $f['key'] }}" class="est-range w-full accent-amber-500">
                        <div class="flex items-center justify-between gap-2" data-hide-presentation>
                            <span class="text-[10px] text-slate-500">{{ $f['hint'] }}</span>
                            <input type="number" min="{{ $f['min'] }}" step="{{ $f['step'] }}" x-model.number="p.{{ $f['key'] }}"
                                   class="w-32 px-2 py-1 rounded-lg bg-slate-950 border border-slate-700 text-right text-[11px] font-mono text-slate-200 focus:border-amber-500 focus:outline-none">
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Sewa Bulanan --}}
            <div class="bg-slate-900 border border-teal-500/20 rounded-3xl p-5 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="h-2.5 w-2.5 rounded-full bg-teal-400"></span>
                    <h3 class="text-sm font-bold text-white">Model Sewa Bulanan (Subscription)</h3>
                </div>
                @foreach ($subFields as $f)
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between gap-2">
                            <label class="text-[11px] font-semibold text-slate-300">{{ $f['label'] }}</label>
                            <span class="text-xs font-mono font-bold text-teal-300"
                                  x-text="{{ $f['unit'] === 'money' ? "fmt(p.{$f['key']})" : "num(p.{$f['key']}) + ' {$f['unit']}'" }}"></span>
                        </div>
                        <input type="range" min="{{ $f['min'] }}" max="{{ $f['max'] }}" step="{{ $f['step'] }}"
                               x-model.number="p.{{ $f['key'] }}" class="est-range w-full accent-teal-500">
                        <div class="flex items-center justify-between gap-2" data-hide-presentation>
                            <span class="text-[10px] text-slate-500">{{ $f['hint'] }}</span>
                            <input type="number" min="{{ $f['min'] }}" step="{{ $f['step'] }}" x-model.number="p.{{ $f['key'] }}"
                                   class="w-32 px-2 py-1 rounded-lg bg-slate-950 border border-slate-700 text-right text-[11px] font-mono text-slate-200 focus:border-teal-500 focus:outline-none">
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Horizon --}}
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-sm font-bold text-white">Horizon Proyeksi</h3>
                    <span class="text-xs font-mono font-bold text-white" x-text="p.horizon_years + ' Tahun'"></span>
                </div>
                <div class="grid grid-cols-5 gap-2">
                    <template x-for="y in [1,2,3,4,5]" :key="y">
                        <button type="button" @click="p.horizon_years = y"
                                class="py-2 rounded-xl text-xs font-bold border transition-colors cursor-pointer"
                                :class="p.horizon_years === y ? 'bg-white text-slate-900 border-white' : 'bg-slate-950 text-slate-400 border-slate-700 hover:text-white'"
                                x-text="y + ' Th'"></button>
                    </template>
                </div>
            </div>
        </div>

        {{-- ================= PANEL OUTPUT ================= --}}
        <div class="xl:col-span-8 space-y-6">

            {{-- Highlight Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="rounded-3xl p-5 border border-teal-500/30 bg-gradient-to-br from-teal-500/15 to-slate-900">
                    <p class="text-[11px] font-semibold text-teal-300 uppercase tracking-wider">Cashflow Saving Awal</p>
                    <p class="mt-2 text-2xl font-extrabold text-white font-mono" x-text="fmt(Math.max(0, cashflowSaving))"></p>
                    <p class="mt-1 text-[11px] text-slate-400">
                        Bulan pertama: <span class="text-amber-300" x-text="fmt(buyAt(1))"></span> vs
                        <span class="text-teal-300" x-text="fmt(subAt(1))"></span>
                    </p>
                </div>

                <div class="rounded-3xl p-5 border border-rose-500/30 bg-gradient-to-br from-rose-500/10 to-slate-900">
                    <p class="text-[11px] font-semibold text-rose-300 uppercase tracking-wider">Titik Temu (Break-even)</p>
                    <p class="mt-2 text-2xl font-extrabold text-white" x-text="breakEvenLabel"></p>
                    <p class="mt-1 text-[11px] text-slate-400" x-text="breakEvenHint"></p>
                </div>

                <div class="rounded-3xl p-5 border border-slate-700 bg-slate-900">
                    <p class="text-[11px] font-semibold text-slate-300 uppercase tracking-wider">Total s/d Tahun ke-<span x-text="p.horizon_years"></span></p>
                    <p class="mt-2 text-2xl font-extrabold font-mono"
                       :class="horizonDiff >= 0 ? 'text-amber-300' : 'text-teal-300'"
                       x-text="fmt(Math.abs(horizonDiff))"></p>
                    <p class="mt-1 text-[11px] text-slate-400">
                        lebih hemat dengan skema
                        <span class="font-bold" :class="horizonDiff >= 0 ? 'text-amber-300' : 'text-teal-300'"
                              x-text="horizonDiff >= 0 ? 'Beli Putus' : 'Sewa Bulanan'"></span>
                    </p>
                </div>
            </div>

            {{-- Chart --}}
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                    <div>
                        <h3 class="text-sm font-bold text-white">Grafik Akumulasi Pengeluaran Klien</h3>
                        <p class="text-[11px] text-slate-400">Proyeksi per bulan selama <span x-text="p.horizon_years"></span> tahun</p>
                    </div>
                    <div class="flex items-center gap-4 text-[11px]">
                        <span class="flex items-center gap-1.5 text-slate-300"><span class="h-2 w-5 rounded bg-amber-400"></span>Beli Putus</span>
                        <span class="flex items-center gap-1.5 text-slate-300"><span class="h-2 w-5 rounded bg-teal-400"></span>Sewa Bulanan</span>
                        <span class="flex items-center gap-1.5 text-slate-300"><span class="h-3 w-3 rounded-full bg-rose-500"></span>Titik Temu</span>
                    </div>
                </div>
                <div class="relative h-72 sm:h-80">
                    <canvas x-ref="chart"></canvas>
                </div>
            </div>

            {{-- Comparison per Year --}}
            <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
                <div class="px-5 pt-5 pb-3">
                    <h3 class="text-sm font-bold text-white">Ringkasan Finansial per Tahun</h3>
                    <p class="text-[11px] text-slate-400">Total akumulasi pengeluaran klien di akhir setiap tahun</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-800/60 text-slate-400">
                            <tr>
                                <th class="px-5 py-3 text-left font-semibold">Periode</th>
                                <th class="px-5 py-3 text-right font-semibold text-amber-300">Beli Putus</th>
                                <th class="px-5 py-3 text-right font-semibold text-teal-300">Sewa Bulanan</th>
                                <th class="px-5 py-3 text-right font-semibold">Selisih</th>
                                <th class="px-5 py-3 text-center font-semibold">Lebih Hemat</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 font-mono">
                            <template x-for="row in years" :key="row.y">
                                <tr class="hover:bg-slate-800/30">
                                    <td class="px-5 py-3 font-sans font-semibold text-white" x-text="'Tahun ' + row.y"></td>
                                    <td class="px-5 py-3 text-right text-slate-200" x-text="fmt(row.buy)"></td>
                                    <td class="px-5 py-3 text-right text-slate-200" x-text="fmt(row.sub)"></td>
                                    <td class="px-5 py-3 text-right text-slate-300" x-text="fmt(Math.abs(row.buy - row.sub))"></td>
                                    <td class="px-5 py-3 text-center font-sans">
                                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold"
                                              :class="row.sub < row.buy ? 'bg-teal-500/15 text-teal-300' : (row.sub > row.buy ? 'bg-amber-500/15 text-amber-300' : 'bg-slate-700 text-slate-300')"
                                              x-text="row.sub < row.buy ? 'Sewa' : (row.sub > row.buy ? 'Beli Putus' : 'Sama')"></span>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- SLA Package --}}
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 space-y-4">
                <div>
                    <h3 class="text-sm font-bold text-white">Paket SLA & Maintenance</h3>
                    <p class="text-[11px] text-slate-400">Fasilitas yang termasuk dalam penawaran (akan tercantum di Pasal 1 kontrak)</p>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach ($slaFeatures as $key => $feat)
                        <label class="flex items-start gap-3 p-3.5 rounded-2xl border cursor-pointer transition-colors"
                               :class="sla.includes('{{ $key }}') ? 'border-teal-500/50 bg-teal-500/10' : 'border-slate-700 bg-slate-950 opacity-60'">
                            <input type="checkbox" value="{{ $key }}" x-model="sla" class="mt-0.5 h-4 w-4 accent-teal-500">
                            <span>
                                <span class="block text-xs font-bold text-white">{{ $feat['label'] }}</span>
                                <span class="block text-[10px] text-slate-400 leading-relaxed">
                                    {{ $feat['desc'] }}
                                    @if ($key === 'minor_support')
                                        <span class="text-teal-300 font-semibold" x-text="'(' + num(p.maintenance_quota_hours) + ' jam/bulan)'"></span>
                                    @endif
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Deal Actions --}}
            <div class="rounded-3xl p-5 border border-slate-800 bg-slate-900/60" data-hide-presentation>
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h3 class="text-sm font-bold text-white">Sudah Deal?</h3>
                        <p class="text-[11px] text-slate-400">Lanjutkan ke Generator Kontrak — seluruh angka simulasi & paket SLA akan terisi otomatis.</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a :href="contractUrl('buy_out')"
                           class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-900 bg-gradient-to-r from-amber-400 to-amber-500 hover:opacity-90">
                            Buat Kontrak Beli Putus →
                        </a>
                        <a :href="contractUrl('subscription')"
                           class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90">
                            Buat Kontrak Sewa Bulanan →
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Load Chart.js locally (offline-friendly) with CDN fallback --}}
<script src="{{ asset('vendor/chartjs/chart.umd.min.js') }}"></script>
<script>
    if (typeof Chart === 'undefined') {
        const cdnScript = document.createElement('script');
        cdnScript.src = 'https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js';
        document.head.appendChild(cdnScript);
    }

    function estimatorApp(defaults, slaKeys, contractBase) {
        let chart = null;
        const idr = new Intl.NumberFormat('id-ID');
        const idrShort = new Intl.NumberFormat('id-ID', { notation: 'compact', maximumFractionDigits: 1 });

        return {
            p: { ...defaults },
            sla: [...slaKeys],
            presenting: false,

            // ---------- Helpers ----------
            n(key) { return Math.max(0, Number(this.p[key]) || 0); },
            num(v) { return idr.format(Number(v) || 0); },
            fmt(v) { return 'Rp ' + idr.format(Math.round(Number(v) || 0)); },

            // ---------- Rumus ----------
            buyAt(m) { return this.n('upfront_cost') + this.n('annual_fee') * Math.max(0, Math.floor((m - 1) / 12)); },
            subAt(m) { return this.n('setup_fee') + this.n('monthly_fee') * m; },

            get months() { return Math.min(5, Math.max(1, this.p.horizon_years)) * 12; },
            get cashflowSaving() { return this.buyAt(1) - this.subAt(1); },
            get horizonDiff() { return this.subAt(this.months) - this.buyAt(this.months); },
            get years() {
                return Array.from({ length: this.months / 12 }, (_, i) => {
                    const y = i + 1;
                    return { y, buy: this.buyAt(y * 12), sub: this.subAt(y * 12) };
                });
            },

            get breakEven() {
                const limit = 120;
                let last = -1;
                for (let m = 0; m <= limit; m++) {
                    if (this.subAt(m) < this.buyAt(m)) last = m;
                }
                if (last === limit) return null;
                return last + 1;
            },
            get breakEvenLabel() {
                const be = this.breakEven;
                if (be === null) return '> 10 Tahun';
                if (be === 0) return 'Sejak Awal';
                return 'Bulan ke-' + be;
            },
            get breakEvenHint() {
                const be = this.breakEven;
                if (be === null) return 'Skema sewa tetap lebih hemat selama 10 tahun.';
                if (be === 0) return 'Biaya sewa sudah melampaui beli putus sejak awal.';
                const y = Math.floor((be - 1) / 12) + 1;
                return 'Sewa lebih hemat hingga bulan ke-' + (be - 1) + ' (Tahun ke-' + y + ').';
            },

            // ---------- Aksi ----------
            reset() {
                this.p = { ...defaults };
                this.sla = [...slaKeys];
            },

            togglePresentation() {
                this.presenting = !this.presenting;
                document.body.classList.toggle('presentation-mode', this.presenting);
                if (this.presenting && document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen().catch(() => {});
                } else if (!this.presenting && document.fullscreenElement) {
                    document.exitFullscreen().catch(() => {});
                }
                this.$nextTick(() => chart && chart.resize());
            },

            contractUrl(scheme) {
                const q = new URLSearchParams({ scheme });
                ['upfront_cost', 'annual_fee', 'warranty_months', 'setup_fee', 'monthly_fee',
                 'min_contract_months', 'maintenance_quota_hours', 'penalty_percent']
                    .forEach(k => q.append(k, this.n(k)));
                this.sla.forEach(s => q.append('sla[]', s));
                if (this.sla.length === 0) q.append('sla[]', '');
                return contractBase + '?' + q.toString();
            },

            // ---------- Chart ----------
            chartData() {
                const labels = [], buy = [], sub = [], point = [];
                const be = this.breakEven;
                for (let m = 0; m <= this.months; m++) {
                    labels.push(m);
                    buy.push(this.buyAt(m));
                    sub.push(this.subAt(m));
                    point.push(m === be ? this.subAt(m) : null);
                }
                return { labels, buy, sub, point };
            },

            renderChart() {
                if (typeof Chart === 'undefined') {
                    setTimeout(() => this.renderChart(), 100);
                    return;
                }

                const canvas = this.$refs.chart;
                if (!canvas) {
                    this.$nextTick(() => this.renderChart());
                    return;
                }

                const d = this.chartData();
                if (chart) {
                    chart.data.labels = d.labels;
                    chart.data.datasets[0].data = d.buy;
                    chart.data.datasets[1].data = d.sub;
                    chart.data.datasets[2].data = d.point;
                    chart.update('none');
                    return;
                }

                const ctx = canvas.getContext('2d');
                if (!ctx) return;

                const gTeal = ctx.createLinearGradient(0, 0, 0, 320);
                gTeal.addColorStop(0, 'rgba(20,184,166,0.25)');
                gTeal.addColorStop(1, 'rgba(20,184,166,0)');
                const gAmber = ctx.createLinearGradient(0, 0, 0, 320);
                gAmber.addColorStop(0, 'rgba(245,158,11,0.18)');
                gAmber.addColorStop(1, 'rgba(245,158,11,0)');

                chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: d.labels,
                        datasets: [
                            { label: 'Beli Putus', data: d.buy, borderColor: '#f59e0b', backgroundColor: gAmber, fill: true, stepped: 'before', borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 },
                            { label: 'Sewa Bulanan', data: d.sub, borderColor: '#14b8a6', backgroundColor: gTeal, fill: true, tension: 0, borderWidth: 2.5, pointRadius: 0, pointHoverRadius: 5 },
                            { label: 'Titik Temu', data: d.point, borderColor: '#f43f5e', backgroundColor: '#f43f5e', showLine: false, pointRadius: 7, pointHoverRadius: 9, pointBorderWidth: 3, pointBorderColor: '#fff1f2' },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: { duration: 300 },
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                backgroundColor: '#0f172a', borderColor: '#334155', borderWidth: 1, padding: 10,
                                filter: (item) => item.raw !== null,
                                callbacks: {
                                    title: (items) => {
                                        const m = Number(items[0].label);
                                        return m === 0 ? 'Awal Proyek' : 'Bulan ke-' + m + ' (Tahun ke-' + (Math.floor((m - 1) / 12) + 1) + ')';
                                    },
                                    label: (item) => ' ' + item.dataset.label + ': Rp ' + idr.format(item.raw),
                                },
                            },
                        },
                        scales: {
                            x: {
                                grid: { color: 'rgba(51,65,85,0.35)' },
                                ticks: {
                                    color: '#94a3b8', autoSkip: false, maxRotation: 0,
                                    callback: function (val) {
                                        const m = Number(this.getLabelForValue(val));
                                        if (m === 0) return 'Awal';
                                        return m % 12 === 0 ? 'Tahun ' + (m / 12) : '';
                                    },
                                },
                            },
                            y: {
                                beginAtZero: true,
                                grid: { color: 'rgba(51,65,85,0.35)' },
                                ticks: { color: '#94a3b8', callback: (v) => 'Rp ' + idrShort.format(v) },
                            },
                        },
                    },
                });
            },

            init() {
                this.$nextTick(() => {
                    this.renderChart();
                });
                this.$watch('p', () => this.renderChart());
                document.addEventListener('fullscreenchange', () => {
                    if (!document.fullscreenElement && this.presenting) {
                        this.presenting = false;
                        document.body.classList.remove('presentation-mode');
                        this.$nextTick(() => chart && chart.resize());
                    }
                });
            },
        };
    }
</script>
@endpush
