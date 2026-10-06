<?php

/*
|--------------------------------------------------------------------------
| Konfigurasi Modul Estimator Harga & Generator Kontrak PDF
|--------------------------------------------------------------------------
| Nilai default simulasi dan daftar paket SLA yang dipakai bersama oleh
| halaman Estimator, Form Kontrak, dan template PDF.
*/

return [

    'defaults' => [
        // Model Beli Putus
        'upfront_cost' => 15_000_000,
        'annual_fee' => 3_000_000,        // mulai tahun ke-2 (tahun 1 include hosting & domain)
        'warranty_months' => 3,

        // Model Sewa Bulanan
        'setup_fee' => 0,
        'monthly_fee' => 1_250_000,
        'min_contract_months' => 12,
        'maintenance_quota_hours' => 2,
        'penalty_percent' => 50,

        // Proyeksi
        'horizon_years' => 3,

        // Kontrak
        'payment_due_day' => 5,
        'down_payment_percent' => 50,      // DP default beli putus (% dari upfront)
    ],

    'sla_features' => [
        'hosting_ssl' => [
            'label' => 'Free Hosting & SSL',
            'desc' => 'Server hosting, domain, dan sertifikat SSL dikelola Penyedia Jasa.',
        ],
        'bug_fix' => [
            'label' => 'Corrective Bug Fixes',
            'desc' => 'Perbaikan kesalahan (bug) pada fitur yang telah disepakati tanpa biaya tambahan.',
        ],
        'monitoring' => [
            'label' => 'Monitoring Server',
            'desc' => 'Pemantauan uptime, performa, dan keamanan server secara berkala.',
        ],
        'minor_support' => [
            'label' => 'Quota Minor Support',
            'desc' => 'Kuota penyesuaian minor (konten, teks, konfigurasi ringan) per bulan.',
        ],
        'sla_response' => [
            'label' => 'SLA Response Time (2-4 Jam)',
            'desc' => 'Respon awal atas laporan gangguan maksimal 2-4 jam pada jam kerja.',
        ],
    ],

];
