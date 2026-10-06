<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Perjanjian Kerja Sama - {{ $contract_number }}</title>
    <style>
        @page { margin: 2.5cm 2cm 2.5cm 2.5cm; }
        * { box-sizing: border-box; }
        body { font-family: 'DejaVu Serif', serif; font-size: 10.5pt; line-height: 1.55; color: #111827; }
        h1 { font-size: 14pt; text-align: center; margin: 0; letter-spacing: 1px; }
        .subtitle { text-align: center; font-size: 10.5pt; font-weight: bold; margin: 2px 0 0; }
        .doc-number { text-align: center; font-size: 9.5pt; margin: 4px 0 0; color: #374151; }
        .rule { border: 0; border-top: 2px solid #111827; margin: 12px 0 2px; }
        .rule-thin { border: 0; border-top: 0.5px solid #111827; margin: 0 0 16px; }
        p { margin: 0 0 8px; text-align: justify; }
        .pasal { text-align: center; font-weight: bold; margin: 18px 0 6px; page-break-after: avoid; }
        .pasal span { display: block; font-size: 10.5pt; }
        ol, ul { margin: 0 0 8px; padding-left: 20px; }
        li { margin-bottom: 4px; text-align: justify; }
        table.identity { width: 100%; border-collapse: collapse; margin: 0 0 6px 18px; }
        table.identity td { vertical-align: top; padding: 1px 4px; font-size: 10.5pt; }
        table.identity td.k { width: 30%; }
        table.identity td.c { width: 3%; }
        table.fee { width: 100%; border-collapse: collapse; margin: 6px 0 10px; font-size: 10pt; }
        table.fee th, table.fee td { border: 0.6px solid #6b7280; padding: 5px 8px; }
        table.fee th { background: #f3f4f6; text-align: left; }
        table.fee td.r { text-align: right; white-space: nowrap; font-family: 'DejaVu Sans Mono', monospace; font-size: 9.5pt; }
        .note { font-size: 9pt; color: #4b5563; font-style: italic; }
        .box { border: 0.8px solid #9ca3af; background: #f9fafb; padding: 8px 10px; margin: 6px 0 10px; }
        .sign { width: 100%; margin-top: 26px; border-collapse: collapse; page-break-inside: avoid; }
        .sign td { width: 50%; text-align: center; vertical-align: top; padding: 0 10px; }
        .sign .space { height: 80px; }
        .materai { display: inline-block; border: 0.8px dashed #9ca3af; color: #9ca3af; font-size: 7.5pt; padding: 14px 8px; margin: 6px 0; }
        .name { font-weight: bold; text-decoration: underline; }
        .muted { color: #4b5563; }
        .nowrap { white-space: nowrap; }
    </style>
</head>
<body>

    {{-- ================= KOP ================= --}}
    <h1>PERJANJIAN KERJA SAMA</h1>
    <p class="subtitle">LAYANAN PENGEMBANGAN APLIKASI — SKEMA {{ strtoupper($is_subscription ? 'Sewa Bulanan' : 'Beli Putus') }}</p>
    <p class="subtitle" style="font-weight: normal;">"{{ $project_name }}"</p>
    <p class="doc-number">Nomor: {{ $contract_number }}</p>
    <hr class="rule"><hr class="rule-thin">

    <p>
        Pada hari ini, <strong>{{ $contract_day }}</strong>, tanggal <strong>{{ $contract_date_fmt }}</strong>,
        bertempat di {{ $contract_city }}, yang bertanda tangan di bawah ini:
    </p>

    <p style="margin-bottom: 2px;"><strong>1.</strong></p>
    <table class="identity">
        <tr><td class="k">Nama</td><td class="c">:</td><td><strong>{{ $first_pic_name }}</strong></td></tr>
        <tr><td class="k">Jabatan</td><td class="c">:</td><td>{{ $first_pic_position }}</td></tr>
        <tr><td class="k">Perusahaan / Individu</td><td class="c">:</td><td>{{ $first_company }}</td></tr>
        <tr><td class="k">Alamat</td><td class="c">:</td><td>{{ $first_address }}</td></tr>
        <tr><td class="k">Email / No. HP</td><td class="c">:</td><td>{{ $first_contact }}</td></tr>
    </table>
    <p>Dalam hal ini bertindak untuk dan atas nama {{ $first_company }}, selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong> (Penyedia Jasa).</p>

    <p style="margin-bottom: 2px;"><strong>2.</strong></p>
    <table class="identity">
        <tr><td class="k">Nama</td><td class="c">:</td><td><strong>{{ $second_pic_name }}</strong></td></tr>
        <tr><td class="k">Jabatan</td><td class="c">:</td><td>{{ $second_pic_position }}</td></tr>
        <tr><td class="k">Perusahaan / Instansi</td><td class="c">:</td><td>{{ $second_company }}</td></tr>
        <tr><td class="k">Alamat</td><td class="c">:</td><td>{{ $second_address }}</td></tr>
        <tr><td class="k">Email / No. HP</td><td class="c">:</td><td>{{ $second_contact }}</td></tr>
    </table>
    <p>Dalam hal ini bertindak untuk dan atas nama {{ $second_company }}, selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong> (Klien).</p>

    <p>
        PIHAK PERTAMA dan PIHAK KEDUA secara bersama-sama disebut <strong>PARA PIHAK</strong>. PARA PIHAK sepakat untuk
        mengikatkan diri dalam Perjanjian Kerja Sama ini dengan skema <strong>{{ $scheme_label }}</strong>,
        yang berlaku sejak <strong>{{ $start_date_fmt }}</strong> sampai dengan <strong>{{ $end_date_fmt }}</strong>,
        dengan ketentuan sebagai berikut:
    </p>

    {{-- ================= PASAL 1 ================= --}}
    <div class="pasal">PASAL 1<span>RUANG LINGKUP LAYANAN & HAK AKSES</span></div>
    <ol>
        <li>PIHAK PERTAMA menyediakan layanan pengembangan, implementasi, dan pengoperasian aplikasi
            <strong>"{{ $project_name }}"</strong> sesuai spesifikasi yang telah disepakati PARA PIHAK.</li>
        @if ($is_subscription)
            <li>PIHAK KEDUA memperoleh <strong>hak guna (lisensi) non-eksklusif dan tidak dapat dialihkan</strong> atas aplikasi
                selama masa sewa aktif dan seluruh kewajiban pembayaran dipenuhi.</li>
            <li>Akses akun administrator aplikasi diberikan kepada PIHAK KEDUA. Akses ke server, basis kode (source code),
                dan infrastruktur tetap dikelola oleh PIHAK PERTAMA.</li>
        @else
            <li>Biaya pembuatan sudah <strong>termasuk hosting dan domain untuk Tahun ke-1</strong> terhitung sejak tanggal mulai kontrak.
                Mulai Tahun ke-2, biaya perpanjangan hosting/maintenance dikenakan sesuai Pasal 2.</li>
            <li>Setelah pelunasan, PIHAK KEDUA memperoleh hak akses penuh atas aplikasi termasuk akun administrator,
                basis data, dan source code. PIHAK PERTAMA memberikan masa garansi selama
                <strong>{{ $warranty_months }} ({{ \App\Support\Terbilang::make($warranty_months) }}) bulan</strong> sejak serah terima.</li>
        @endif
        <li>Fasilitas layanan yang termasuk dalam Perjanjian ini adalah:
            @if (count($sla_selected))
                <ul>
                    @foreach ($sla_selected as $key => $feat)
                        <li><strong>{{ $feat['label'] }}</strong> — {{ $feat['desc'] }}
                            @if ($key === 'minor_support') Kuota: {{ $maintenance_quota_hours }} jam per bulan. @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <em>tidak ada fasilitas tambahan di luar pengembangan aplikasi.</em>
            @endif
        </li>
    </ol>

    {{-- ================= PASAL 2 ================= --}}
    <div class="pasal">PASAL 2<span>SKEMA PEMBAYARAN & KETENTUAN JATUH TEMPO</span></div>
    @if ($is_subscription)
        <table class="fee">
            <tr><th style="width: 60%;">Komponen Biaya</th><th>Nilai</th></tr>
            <tr><td>Setup Fee / Uang Muka (dibayar sekali di awal)</td><td class="r">{{ $rupiah($setup_fee) }}</td></tr>
            <tr><td>Biaya Sewa Bulanan</td><td class="r">{{ $rupiah($monthly_fee) }} / bulan</td></tr>
            <tr><td>Durasi Minimal Kontrak</td><td class="r">{{ $min_contract_months }} bulan</td></tr>
            <tr><td><strong>Nilai Minimal Kontrak</strong> (setup + sewa × durasi minimal)</td><td class="r"><strong>{{ $rupiah($setup_fee + $monthly_fee * $min_contract_months) }}</strong></td></tr>
        </table>
        <ol>
            <li>Biaya sewa sebesar <strong>{{ $rupiah($monthly_fee) }}</strong> (<em>{{ $terbilang($monthly_fee) }}</em>) per bulan
                dibayarkan di muka selambat-lambatnya <strong>setiap tanggal {{ $payment_due_day }}</strong> pada bulan berjalan.</li>
            @if ($setup_fee > 0)
                <li>Setup fee sebesar <strong>{{ $rupiah($setup_fee) }}</strong> (<em>{{ $terbilang($setup_fee) }}</em>) dibayarkan
                    sebelum pekerjaan dimulai dan tidak dapat dikembalikan.</li>
            @endif
            <li>Keterlambatan pembayaran lebih dari 14 (empat belas) hari kalender sejak tanggal jatuh tempo memberikan hak kepada
                PIHAK PERTAMA untuk menangguhkan (suspend) layanan sementara hingga kewajiban pembayaran dipenuhi.</li>
            <li>Setelah durasi minimal kontrak berakhir, sewa diperpanjang otomatis per bulan kecuali salah satu pihak
                memberitahukan secara tertulis paling lambat 30 (tiga puluh) hari sebelumnya.</li>
        </ol>
    @else
        <table class="fee">
            <tr><th style="width: 60%;">Komponen Biaya</th><th>Nilai</th></tr>
            <tr><td>Nilai Transaksi (Pembuatan Aplikasi + Hosting & Domain Tahun ke-1)</td><td class="r">{{ $rupiah($upfront_cost) }}</td></tr>
            <tr><td>Uang Muka (DP)</td><td class="r">{{ $rupiah($down_payment) }}</td></tr>
            <tr><td>Pelunasan</td><td class="r">{{ $rupiah($remaining_payment) }}</td></tr>
            <tr><td>Perpanjangan Hosting/Maintenance (mulai Tahun ke-2)</td><td class="r">{{ $rupiah($annual_fee) }} / tahun</td></tr>
        </table>
        <ol>
            <li>Nilai transaksi sebesar <strong>{{ $rupiah($upfront_cost) }}</strong> (<em>{{ $terbilang($upfront_cost) }}</em>).</li>
            @if ($down_payment > 0)
                <li>Uang muka sebesar <strong>{{ $rupiah($down_payment) }}</strong> (<em>{{ $terbilang($down_payment) }}</em>)
                    dibayarkan saat penandatanganan Perjanjian dan menjadi dasar dimulainya pekerjaan.</li>
            @endif
            <li>Pelunasan sebesar <strong>{{ $rupiah($remaining_payment) }}</strong> (<em>{{ $terbilang($remaining_payment) }}</em>)
                dibayarkan paling lambat 7 (tujuh) hari kalender setelah Berita Acara Serah Terima aplikasi ditandatangani.</li>
            @if ($annual_fee > 0)
                <li>Biaya perpanjangan hosting/maintenance sebesar <strong>{{ $rupiah($annual_fee) }}</strong> per tahun berlaku mulai Tahun ke-2,
                    dibayarkan paling lambat tanggal {{ $payment_due_day }} pada bulan berakhirnya masa layanan tahun berjalan.
                    Apabila PIHAK KEDUA hanya membutuhkan aplikasi tanpa hosting & domain, besaran biaya dapat dirundingkan kembali secara tertulis.</li>
            @endif
        </ol>
    @endif
    <p class="note">Seluruh pembayaran dilakukan melalui transfer ke rekening resmi PIHAK PERTAMA. Harga belum termasuk pajak kecuali dinyatakan lain.</p>

    {{-- ================= PASAL 3 ================= --}}
    <div class="pasal">PASAL 3<span>BATASAN MAINTENANCE VS CHANGE REQUEST</span></div>
    <ol>
        <li><strong>Maintenance</strong> meliputi perbaikan kesalahan (bug) pada fitur yang telah disepakati, pembaruan keamanan,
            serta penyesuaian minor (teks, konten, konfigurasi ringan)
            @if ($maintenance_quota_hours > 0)
                dengan kuota maksimal <strong>{{ $maintenance_quota_hours }} ({{ \App\Support\Terbilang::make($maintenance_quota_hours) }}) jam per bulan</strong>.
                Kuota yang tidak terpakai tidak dapat diakumulasikan ke bulan berikutnya.
            @else
                sesuai kebutuhan wajar.
            @endif
        </li>
        <li><strong>Change Request</strong> meliputi penambahan fitur baru, perubahan alur bisnis, perubahan desain mayor, integrasi
            dengan sistem pihak ketiga, maupun pekerjaan yang melebihi kuota maintenance.</li>
        <li>Setiap Change Request diajukan secara tertulis oleh PIHAK KEDUA dan akan dibuatkan penawaran biaya serta estimasi waktu
            terpisah oleh PIHAK PERTAMA. Pekerjaan dimulai setelah penawaran disetujui PIHAK KEDUA.</li>
    </ol>

    {{-- ================= PASAL 4 ================= --}}
    <div class="pasal">PASAL 4<span>KEPEMILIKAN INTELEKTUAL & SOURCE CODE</span></div>
    @if ($is_subscription)
        <div class="box">
            Hak Kekayaan Intelektual dan seluruh <strong>source code</strong> aplikasi adalah dan tetap menjadi
            <strong>MILIK PIHAK PERTAMA (Penyedia Jasa)</strong>.
        </div>
        <ol>
            <li>PIHAK KEDUA hanya memperoleh hak guna aplikasi selama masa sewa aktif sebagaimana dimaksud dalam Pasal 1.</li>
            <li>PIHAK KEDUA dilarang menyalin, memodifikasi, merekayasa balik (reverse engineering), menjual, atau mengalihkan aplikasi kepada pihak lain.</li>
            <li>Seluruh <strong>data operasional</strong> yang diinput oleh PIHAK KEDUA tetap menjadi milik PIHAK KEDUA dan dapat diekspor
                dalam format standar apabila Perjanjian berakhir.</li>
        </ol>
    @else
        <div class="box">
            Hak Kekayaan Intelektual dan seluruh <strong>source code</strong> aplikasi <strong>DIALIHKAN KEPADA PIHAK KEDUA (Klien)</strong>
            setelah seluruh kewajiban pembayaran (pelunasan) sebagaimana Pasal 2 dipenuhi.
        </div>
        <ol>
            <li>Sebelum pelunasan, seluruh hak atas aplikasi dan source code masih berada pada PIHAK PERTAMA.</li>
            <li>Setelah pelunasan, PIHAK PERTAMA menyerahkan source code, dokumentasi teknis, dan kredensial terkait kepada PIHAK KEDUA.</li>
            <li>PIHAK PERTAMA tetap berhak menggunakan pustaka (library), komponen generik, dan pengetahuan teknis yang bukan bersifat
                khusus milik PIHAK KEDUA untuk proyek lain, serta mencantumkan proyek ini sebagai portofolio tanpa membuka data rahasia.</li>
        </ol>
    @endif

    {{-- ================= PASAL 5 ================= --}}
    <div class="pasal">PASAL 5<span>KERAHASIAAN DATA (NDA) & SLA RESPON BUG</span></div>
    <ol>
        <li>PARA PIHAK wajib menjaga kerahasiaan seluruh informasi, data bisnis, data pengguna, dan kredensial yang diperoleh
            selama pelaksanaan Perjanjian ini, dan tidak mengungkapkannya kepada pihak ketiga tanpa persetujuan tertulis.</li>
        <li>Kewajiban kerahasiaan tetap berlaku selama 2 (dua) tahun setelah Perjanjian ini berakhir.</li>
        <li>Respon awal atas laporan gangguan/bug yang disampaikan PIHAK KEDUA melalui kanal resmi:
            @if ($has_sla_response)
                <strong>maksimal 2–4 jam</strong> pada jam kerja (Senin–Jumat, 08.00–17.00 WITA/WIB setempat).
            @else
                <strong>maksimal 1×24 jam</strong> pada hari kerja.
            @endif
        </li>
        <li>Klasifikasi penanganan: (a) <em>Kritis</em> — aplikasi tidak dapat diakses, diupayakan pulih dalam 1×24 jam;
            (b) <em>Mayor</em> — fitur utama terganggu, maksimal 3 hari kerja; (c) <em>Minor</em> — maksimal 7 hari kerja.</li>
        <li>SLA tidak berlaku atas gangguan yang disebabkan keadaan kahar (force majeure), gangguan penyedia infrastruktur pihak ketiga,
            atau kesalahan penggunaan oleh PIHAK KEDUA.</li>
    </ol>

    {{-- ================= PASAL 6 ================= --}}
    <div class="pasal">PASAL 6<span>JANGKA WAKTU, PENGAKHIRAN & PENALTI</span></div>
    <ol>
        <li>Perjanjian ini berlaku sejak <strong>{{ $start_date_fmt }}</strong> sampai dengan <strong>{{ $end_date_fmt }}</strong>.</li>
        @if ($is_subscription)
            <li>Apabila PIHAK KEDUA mengakhiri sewa sebelum durasi minimal kontrak <strong>{{ $min_contract_months }} bulan</strong>
                terpenuhi, PIHAK KEDUA dikenakan denda pelunasan sebesar <strong>{{ $penalty_percent }}%</strong>
                dari sisa biaya sewa bulan berjalan hingga akhir durasi minimal kontrak, dengan rumus:
                <div class="box" style="text-align: center;">
                    Denda = {{ $penalty_percent }}% × (Sisa Bulan Minimal Kontrak) × {{ $rupiah($monthly_fee) }}
                </div>
            </li>
            <li>Setelah Perjanjian berakhir, layanan dihentikan dan PIHAK PERTAMA menyerahkan ekspor data operasional milik PIHAK KEDUA
                paling lambat 14 (empat belas) hari kalender.</li>
        @else
            <li>Apabila PIHAK KEDUA membatalkan Perjanjian sebelum pelunasan, uang muka yang telah dibayarkan tidak dapat dikembalikan
                dan seluruh hak atas aplikasi tetap berada pada PIHAK PERTAMA.</li>
            <li>Apabila biaya perpanjangan tahunan tidak dibayarkan, PIHAK PERTAMA berhak menghentikan layanan hosting/maintenance
                setelah pemberitahuan tertulis 14 (empat belas) hari kalender; source code yang telah diserahkan tetap menjadi milik PIHAK KEDUA.</li>
        @endif
        <li>Salah satu pihak dapat mengakhiri Perjanjian apabila pihak lain melanggar ketentuan Perjanjian ini dan tidak memperbaikinya
            dalam waktu 14 (empat belas) hari kalender setelah menerima teguran tertulis.</li>
    </ol>

    {{-- ================= PASAL 7 ================= --}}
    <div class="pasal">PASAL 7<span>PENYELESAIAN PERSELISIHAN & PENUTUP</span></div>
    <ol>
        <li>Perselisihan yang timbul akan diselesaikan secara musyawarah untuk mufakat. Apabila tidak tercapai, PARA PIHAK sepakat
            menyelesaikannya melalui Pengadilan Negeri yang berwenang di wilayah {{ $contract_city }}.</li>
        <li>Hal-hal yang belum diatur dalam Perjanjian ini akan diatur kemudian dalam addendum yang disepakati secara tertulis oleh PARA PIHAK
            dan merupakan bagian yang tidak terpisahkan dari Perjanjian ini.</li>
        <li>Perjanjian ini dibuat dalam rangkap 2 (dua), masing-masing bermeterai cukup dan mempunyai kekuatan hukum yang sama.</li>
    </ol>

    <p style="margin-top: 14px;">Demikian Perjanjian ini dibuat dan ditandatangani oleh PARA PIHAK dalam keadaan sadar dan tanpa paksaan dari pihak mana pun.</p>

    {{-- ================= TANDA TANGAN ================= --}}
    <p style="text-align: right; margin-top: 16px;">{{ $contract_city }}, {{ $contract_date_fmt }}</p>
    <table class="sign">
        <tr>
            <td><strong>PIHAK PERTAMA</strong><br><span class="muted">{{ $first_company }}</span></td>
            <td><strong>PIHAK KEDUA</strong><br><span class="muted">{{ $second_company }}</span></td>
        </tr>
        <tr>
            <td class="space">&nbsp;</td>
            <td class="space"><span class="materai">Meterai<br>Rp 10.000</span></td>
        </tr>
        <tr>
            <td><span class="name">{{ $first_pic_name }}</span><br>{{ $first_pic_position }}</td>
            <td><span class="name">{{ $second_pic_name }}</span><br>{{ $second_pic_position }}</td>
        </tr>
    </table>

</body>
</html>
