@extends('admin.layout')

@section('title', 'Generator Kontrak PDF')
@section('page_title', 'Generator Kontrak PDF (PKS)')

@php
    $val = fn (string $key) => old($key, $prefill[$key] ?? '');
    $input = 'w-full px-3 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-xs text-slate-100 placeholder-slate-600 focus:border-teal-500 focus:outline-none';
    $label = 'block text-[11px] font-semibold text-slate-300 mb-1.5';
    $parties = [
        'first' => ['title' => 'Pihak Pertama — Penyedia Jasa / Developer', 'badge' => 'PIHAK I', 'color' => 'text-teal-300 bg-teal-500/10 border-teal-500/30'],
        'second' => ['title' => 'Pihak Kedua — Klien', 'badge' => 'PIHAK II', 'color' => 'text-indigo-300 bg-indigo-500/10 border-indigo-500/30'],
    ];
    $selectedSla = old('sla', $prefill['sla']);
@endphp

@section('content')
<form method="POST" action="{{ route('admin.contracts.generate') }}"
      x-data="contractForm(@js(old('scheme', $prefill['scheme'])), @js((int) $val('min_contract_months')))"
      class="space-y-6">
    @csrf

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-white">Perjanjian Kerja Sama (PKS)</h2>
            <p class="text-xs text-slate-400">Lengkapi data di bawah, lalu Preview atau Download PDF siap tanda tangan. Data tidak disimpan ke database.</p>
        </div>
        <a href="{{ route('admin.estimator.index') }}" class="px-3.5 py-2 rounded-xl text-xs font-semibold border border-slate-700 bg-slate-800 text-slate-300 hover:text-white">
            ← Kembali ke Estimator
        </a>
    </div>

    {{-- Informasi Dokumen --}}
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6">
        <h3 class="text-sm font-bold text-white mb-4">Informasi Dokumen</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-2">
                <label class="{{ $label }}">Nama Proyek / Aplikasi *</label>
                <input type="text" name="project_name" value="{{ $val('project_name') }}" required placeholder="cth: Sistem Informasi Manajemen Klinik" class="{{ $input }}">
            </div>
            <div>
                <label class="{{ $label }}">Nomor Kontrak *</label>
                <input type="text" name="contract_number" value="{{ $val('contract_number') }}" required class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Tanggal Penandatanganan *</label>
                <input type="date" name="contract_date" value="{{ $val('contract_date') }}" required class="{{ $input }}">
            </div>
            <div>
                <label class="{{ $label }}">Kota Penandatanganan *</label>
                <input type="text" name="contract_city" value="{{ $val('contract_city') }}" required placeholder="cth: Makassar" class="{{ $input }}">
            </div>
        </div>
    </div>

    {{-- Para Pihak --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        @foreach ($parties as $p => $meta)
            <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 space-y-4">
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 rounded-md border text-[10px] font-bold {{ $meta['color'] }}">{{ $meta['badge'] }}</span>
                    <h3 class="text-sm font-bold text-white">{{ $meta['title'] }}</h3>
                </div>
                <div>
                    <label class="{{ $label }}">Nama Perusahaan / Instansi / Individu *</label>
                    <input type="text" name="{{ $p }}_company" value="{{ $val($p.'_company') }}" required class="{{ $input }}">
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="{{ $label }}">Nama Penanggung Jawab *</label>
                        <input type="text" name="{{ $p }}_pic_name" value="{{ $val($p.'_pic_name') }}" required class="{{ $input }}">
                    </div>
                    <div>
                        <label class="{{ $label }}">Jabatan *</label>
                        <input type="text" name="{{ $p }}_pic_position" value="{{ $val($p.'_pic_position') }}" required class="{{ $input }}">
                    </div>
                </div>
                <div>
                    <label class="{{ $label }}">Alamat *</label>
                    <textarea name="{{ $p }}_address" rows="2" required class="{{ $input }}">{{ $val($p.'_address') }}</textarea>
                </div>
                <div>
                    <label class="{{ $label }}">Email / No. HP *</label>
                    <input type="text" name="{{ $p }}_contact" value="{{ $val($p.'_contact') }}" required placeholder="email@domain.com / 08xx" class="{{ $input }}">
                </div>
            </div>
        @endforeach
    </div>

    {{-- Spesifikasi Layanan & Pembayaran --}}
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 space-y-5">
        <h3 class="text-sm font-bold text-white">Spesifikasi Layanan & Pembayaran</h3>

        {{-- Pilihan Skema --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <label class="flex items-start gap-3 p-4 rounded-2xl border cursor-pointer transition-colors"
                   :class="scheme === 'buy_out' ? 'border-amber-500/60 bg-amber-500/10' : 'border-slate-700 bg-slate-950'">
                <input type="radio" name="scheme" value="buy_out" x-model="scheme" @change="suggestEndDate()" class="mt-0.5 accent-amber-500">
                <span>
                    <span class="block text-xs font-bold text-white">Beli Putus</span>
                    <span class="block text-[10px] text-slate-400">Source code dialihkan ke Klien setelah pelunasan.</span>
                </span>
            </label>
            <label class="flex items-start gap-3 p-4 rounded-2xl border cursor-pointer transition-colors"
                   :class="scheme === 'subscription' ? 'border-teal-500/60 bg-teal-500/10' : 'border-slate-700 bg-slate-950'">
                <input type="radio" name="scheme" value="subscription" x-model="scheme" @change="suggestEndDate()" class="mt-0.5 accent-teal-500">
                <span>
                    <span class="block text-xs font-bold text-white">Sewa Bulanan (Subscription)</span>
                    <span class="block text-[10px] text-slate-400">Source code tetap milik Penyedia Jasa. Berlaku penalti putus kontrak dini.</span>
                </span>
            </label>
        </div>

        {{-- Field Beli Putus --}}
        <div x-show="scheme === 'buy_out'" x-cloak class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="{{ $label }}">Nilai Transaksi (Rp) *</label>
                <input type="number" name="upfront_cost" min="0" step="1000" value="{{ $val('upfront_cost') }}" :required="scheme === 'buy_out'" :disabled="scheme !== 'buy_out'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Uang Muka / DP (Rp)</label>
                <input type="number" name="down_payment" min="0" step="1000" value="{{ $val('down_payment') }}" :disabled="scheme !== 'buy_out'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Perpanjangan Tahunan (Rp) — mulai Th. ke-2</label>
                <input type="number" name="annual_fee" min="0" step="1000" value="{{ $val('annual_fee') }}" :disabled="scheme !== 'buy_out'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Masa Garansi (Bulan)</label>
                <input type="number" name="warranty_months" min="0" max="60" value="{{ $val('warranty_months') }}" :disabled="scheme !== 'buy_out'" class="{{ $input }} font-mono">
            </div>
        </div>

        {{-- Field Sewa --}}
        <div x-show="scheme === 'subscription'" x-cloak class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="{{ $label }}">Biaya Sewa Bulanan (Rp) *</label>
                <input type="number" name="monthly_fee" min="0" step="1000" value="{{ $val('monthly_fee') }}" :required="scheme === 'subscription'" :disabled="scheme !== 'subscription'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Setup Fee / DP (Rp)</label>
                <input type="number" name="setup_fee" min="0" step="1000" value="{{ $val('setup_fee') }}" :disabled="scheme !== 'subscription'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Minimal Kontrak (Bulan) *</label>
                <input type="number" name="min_contract_months" min="1" max="120" x-model.number="minMonths" @input="suggestEndDate()" :required="scheme === 'subscription'" :disabled="scheme !== 'subscription'" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Penalti Putus Dini (50–100%)</label>
                <input type="number" name="penalty_percent" min="50" max="100" step="5" value="{{ $val('penalty_percent') }}" :disabled="scheme !== 'subscription'" class="{{ $input }} font-mono">
            </div>
        </div>

        {{-- Field Umum --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="{{ $label }}">Kuota Maintenance Minor (Jam/Bulan)</label>
                <input type="number" name="maintenance_quota_hours" min="0" max="200" value="{{ $val('maintenance_quota_hours') }}" class="{{ $input }} font-mono">
            </div>
            <div>
                <label class="{{ $label }}">Jatuh Tempo Pembayaran (Tanggal) *</label>
                <select name="payment_due_day" required class="{{ $input }}">
                    @for ($i = 1; $i <= 28; $i++)
                        <option value="{{ $i }}" @selected((int) $val('payment_due_day') === $i)>Setiap tanggal {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="{{ $label }}">Tanggal Mulai Kontrak *</label>
                <input type="date" name="start_date" x-ref="start" value="{{ $val('start_date') }}" @change="suggestEndDate()" required class="{{ $input }}">
            </div>
            <div>
                <label class="{{ $label }}">Tanggal Berakhir Kontrak *</label>
                <input type="date" name="end_date" x-ref="end" value="{{ $val('end_date') }}" required class="{{ $input }}">
            </div>
        </div>
    </div>

    {{-- Paket SLA --}}
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 space-y-4">
        <div>
            <h3 class="text-sm font-bold text-white">Paket SLA & Maintenance</h3>
            <p class="text-[11px] text-slate-400">Fasilitas tercentang akan dicantumkan pada Pasal 1 & Pasal 5.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
            @foreach ($slaFeatures as $key => $feat)
                <label class="flex items-start gap-3 p-3.5 rounded-2xl border border-slate-700 bg-slate-950 cursor-pointer has-[:checked]:border-teal-500/50 has-[:checked]:bg-teal-500/10">
                    <input type="checkbox" name="sla[]" value="{{ $key }}" @checked(in_array($key, $selectedSla)) class="mt-0.5 h-4 w-4 accent-teal-500">
                    <span>
                        <span class="block text-xs font-bold text-white">{{ $feat['label'] }}</span>
                        <span class="block text-[10px] text-slate-400 leading-relaxed">{{ $feat['desc'] }}</span>
                    </span>
                </label>
            @endforeach
        </div>
    </div>

    {{-- Aksi --}}
    <div class="sticky bottom-0 z-20 -mx-4 sm:-mx-6 px-4 sm:px-6 py-4 bg-slate-950/90 backdrop-blur border-t border-slate-800 flex flex-wrap items-center justify-end gap-3">
        <p class="mr-auto text-[11px] text-slate-500 hidden sm:block">Format A4 • Penomoran halaman otomatis • Siap cetak & tanda tangan</p>
        <button type="submit" name="action" value="preview" formtarget="_blank"
                class="px-5 py-2.5 rounded-xl text-xs font-bold border border-teal-500/40 bg-teal-500/10 text-teal-300 hover:bg-teal-500/20 cursor-pointer">
            Preview Kontrak PDF
        </button>
        <button type="submit" name="action" value="download"
                class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 cursor-pointer">
            Download PDF
        </button>
    </div>
</form>
@endsection

@push('scripts')
<style>[x-cloak]{display:none !important;}</style>
<script>
    function contractForm(initialScheme, initialMinMonths) {
        return {
            scheme: initialScheme,
            minMonths: initialMinMonths || 12,

            // Saran tanggal berakhir: Sewa = minimal kontrak, Beli Putus = 12 bulan (masa hosting Tahun 1).
            suggestEndDate() {
                const start = this.$refs.start.value;
                if (!start) return;
                const months = this.scheme === 'subscription' ? (Number(this.minMonths) || 12) : 12;
                const d = new Date(start + 'T00:00:00');
                d.setMonth(d.getMonth() + months);
                d.setDate(d.getDate() - 1);
                const pad = (n) => String(n).padStart(2, '0');
                this.$refs.end.value = `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
            },
        };
    }
</script>
@endpush
