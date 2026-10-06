<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@ansaapp.com'],
            [
                'name' => 'Administrator AnsaApp',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Company Settings
        $settings = [
            'company_name' => 'AnsaApp',
            'company_tagline' => 'IT System Development • Consulting • Solutions',
            'company_description' => 'Mitra strategis transformasi digital yang menghadirkan pengembangan aplikasi enterprise berstandar tinggi, konsultasi arsitektur IT, dan solusi komputasi cloud yang andal dan terukur.',
            'company_phone' => '+62 812-3456-7890',
            'company_whatsapp' => '6281234567890',
            'company_email' => 'contact@ansaapp.com',
            'company_address' => 'Gedung Menara Cyber Lt. 8, Jl. Kuningan Barat No. 26, Jakarta Selatan, 12710',
            'social_instagram' => 'https://instagram.com/ansaapp',
            'social_linkedin' => 'https://linkedin.com/company/ansaapp',
            'social_github' => 'https://github.com/ansaapp',
            'hero_title' => 'Solusi Rekayasa Perangkat Lunak & Konsultasi IT Terdepan',
            'hero_subtitle' => 'Membangun ekosistem digital enterprise yang scalable, aman, dan berkinerja tinggi untuk mengakselerasi pertumbuhan bisnis Anda.',
            'ai_bot_name' => 'Ansa Assistant AI',
            'ai_greeting' => 'Halo! Saya Ansa AI Assistant. Ada yang bisa saya bantu terkait layanan development aplikasi, konsultasi IT, estimasi biaya, atau portofolio AnsaApp?',
        ];

        foreach ($settings as $key => $val) {
            Setting::updateOrCreate(['key' => $key], ['value' => $val, 'group' => 'general']);
        }

        // 3. Services
        $services = [
            [
                'title' => 'Development Aplikasi Web & Mobile',
                'slug' => 'development-aplikasi-web-mobile',
                'icon' => 'code-bracket',
                'short_description' => 'Pengembangan sistem web modern, progressive web apps (PWA), serta aplikasi mobile native & hybrid (iOS & Android) yang scalable dan responsif.',
                'full_description' => 'Kami merancang dan membangun aplikasi kustom berstandar internasional menggunakan stack mutakhir seperti Laravel, Livewire, Vue.js, React, dan Flutter. Setiap baris kode dioptimalkan untuk kecepatan akses, arsitektur modular yang mudah di-maintain, dan keamanan tinggi.',
                'features' => [
                    'Aplikasi Web Enterprise & Portal Bisnis',
                    'Mobile Apps Multi-platform (Flutter / iOS & Android)',
                    'Single Page Applications (SPA) & Progressive Web App',
                    'Desain UI/UX Responsif & Aksesibilitas Modern',
                    'Integrasi REST API, GraphQL, & WebSockets Realtime'
                ],
                'order' => 1,
            ],
            [
                'title' => 'Konsultasi IT & Solusi Arsitektur',
                'slug' => 'konsultasi-it-solusi-arsitektur',
                'icon' => 'light-bulb',
                'short_description' => 'Konsultasi strategis perencanaan sistem TI, modernisasi sistem warisan (legacy systems), audit performa kode, dan blueprint arsitektur terpadu.',
                'full_description' => 'Membantu organisasi dan perusahaan menentukan arah strategi teknologi informasi yang tepat guna. Tim konsultan senior kami mengevaluasi bottlenecks infrastruktur, celah keamanan, skalabilitas database, dan menyusun roadmap digital yang selaras dengan tujuan bisnis Anda.',
                'features' => [
                    'Audit Sistem, Performa & Keamanan Kode',
                    'Perencanaan Arsitektur Microservices & Monolith Modular',
                    'Roadmap Transformasi Digital & Pemilihan Tech Stack',
                    'Advisory Standar Keamanan & Manajemen Data',
                    'Technical Due Diligence & Evaluasi Vendor'
                ],
                'order' => 2,
            ],
            [
                'title' => 'Infrastruktur Cloud & Solusi DevOps',
                'slug' => 'infrastruktur-cloud-solusi-devops',
                'icon' => 'cloud-arrow-up',
                'short_description' => 'Otomasi pipeline CI/CD, manajemen server cloud (AWS, GCP, DigitalOcean), containerization Docker & Kubernetes, dan monitoring 24/7.',
                'full_description' => 'Menghilangkan downtime dan mempercepat deployment aplikasi dengan pipeline DevOps otomatis. Kami mengonfigurasi arsitektur cloud berkemampuan auto-scaling, backup redundan, mitigasi DDoS, dan observabilitas metrik performa secara real-time.',
                'features' => [
                    'Pipeline CI/CD Otomatis (GitHub Actions / GitLab CI)',
                    'Containerization Docker & Kubernetes Orchestration',
                    'Optimasi Biaya Cloud & High-Availability Clustering',
                    'Sistem Monitoring Metrik & Uptime 99.9% 24/7',
                    'Automated Database Backup & Disaster Recovery'
                ],
                'order' => 3,
            ],
            [
                'title' => 'Sistem Kustom Enterprise & Integrasi API',
                'slug' => 'sistem-kustom-enterprise-integrasi-api',
                'icon' => 'squares-plus',
                'short_description' => 'Pengembangan software enterprise terintegrasi seperti ERP kustom, CRM, Point of Sale, sinkronisasi gudang, dan integrasi multi payment gateway.',
                'full_description' => 'Solusi sistem informasi yang disesuaikan secara presisi dengan alur kerja operasional perusahaan Anda tanpa keterbatasan software paket kaku. Dilengkapi dashboard analitik interaktif, role-based access control berjenjang, dan audit trail lengkap.',
                'features' => [
                    'Custom Enterprise Resource Planning (ERP)',
                    'Customer Relationship Management (CRM) Terpadu',
                    'Integrasi Payment Gateway & Rekening Virtual Perbankan',
                    'Sinkronisasi Gudang & Inventori Multi-Cabang',
                    'Role-Based Access Control (RBAC) & Audit Log'
                ],
                'order' => 4,
            ],
        ];

        foreach ($services as $srv) {
            Service::updateOrCreate(['slug' => $srv['slug']], $srv);
        }

        // 4. Projects (Recent Projects)
        $projects = [
            [
                'title' => 'Ansa ERP Cloud Enterprise',
                'slug' => 'ansa-erp-cloud-enterprise',
                'category' => 'Enterprise System',
                'client' => 'PT Global Logistik Nusantara',
                'completion_date' => 'Agustus 2026',
                'featured_image' => '/storage/images/logo/logo.png',
                'gallery_images' => [
                    '/storage/images/logo/logo.png'
                ],
                'demo_url' => 'https://demo.ansaapp.com/erp',
                'github_url' => 'https://github.com/ansaapp/erp-cloud',
                'short_description' => 'Sistem ERP komprehensif berbasis web untuk manajemen rantai pasok (supply chain), pergudangan multi-lokasi, dan otomatisasi akuntansi.',
                'full_description' => 'Ansa ERP Cloud Enterprise dirancang untuk menangani jutaan transaksi harian dengan latensi rendah. Mengintegrasikan modul pembelian, inventori barcode scanner, pencatatan jurnal akuntansi otomatis, manajemen aset, dan dashboard visualisasi performa bisnis eksekutif.',
                'tech_stack' => ['Laravel 12', 'Livewire 4', 'Tailwind CSS v4', 'PostgreSQL', 'Redis', 'Docker'],
                'features' => [
                    'Real-time Multi-Warehouse Stock Tracking',
                    'Otomatisasi Jurnal Keuangan & Neraca Rugi Laba',
                    'Export Laporan Pajak & Dokumen PDF Dinamis',
                    'Dukungan Barcode / QR Code Scanner Terintegrasi',
                    'Otorisasi Hirarki Multi-Level Approval'
                ],
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'MediConnect Smart Telemedicine',
                'slug' => 'mediconnect-smart-telemedicine',
                'category' => 'Mobile & Web App',
                'client' => 'PT Medika Prima Sehat',
                'completion_date' => 'Juli 2026',
                'featured_image' => '/storage/images/logo/logo.png',
                'gallery_images' => [
                    '/storage/images/logo/logo.png'
                ],
                'demo_url' => 'https://demo.ansaapp.com/mediconnect',
                'github_url' => 'https://github.com/ansaapp/mediconnect',
                'short_description' => 'Platform konsultasi dokter online terpadu dengan fitur video call terenkripsi, resep digital, dan pemesanan obat ke apotek mitra.',
                'full_description' => 'MediConnect menghubungkan pasien dengan ratusan dokter spesialis melalui konsultasi video terenkripsi end-to-end. Memfasilitasi rekam medis elektronik (EMR) yang memenuhi standar kepatuhan regulasi medis dan integrasi pembayaran instan.',
                'tech_stack' => ['Flutter', 'Laravel REST API', 'WebRTC', 'MySQL', 'Tailwind CSS', 'Redis Pub/Sub'],
                'features' => [
                    'Video & Audio Call Real-time WebRTC Terenkripsi',
                    'Digital Prescription & Otomasi Pemesanan Apotek',
                    'Pencatatan Rekam Medis Pasien (EMR) Terstandar',
                    'Notifikasi Jadwal Obat & Push Notifications',
                    'Integrasi Asuransi Kesehatan & Klaim Online'
                ],
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'FinFlow Payment & Billing Engine',
                'slug' => 'finflow-payment-billing-engine',
                'category' => 'Fintech Solution',
                'client' => 'FinTech Pratama Global',
                'completion_date' => 'Mei 2026',
                'featured_image' => '/storage/images/logo/logo.png',
                'gallery_images' => [
                    '/storage/images/logo/logo.png'
                ],
                'demo_url' => 'https://demo.ansaapp.com/finflow',
                'github_url' => null,
                'short_description' => 'Mesin pemrosesan penagihan berlangganan dan rekonsiliasi transaksi pembayaran otomatis dengan skalabilitas tinggi.',
                'full_description' => 'FinFlow memproses lebih dari 500.000 transaksi harian dengan akurasi 99.999%. Dilengkapi modul deteksi anomali fraud berbasis aturan cerdas, rekonsiliasi mutasi bank secara otomatis, dan webhook dispatcher dengan mekanisme retry andal.',
                'tech_stack' => ['Laravel 12', 'Vue.js 3', 'Tailwind CSS', 'PostgreSQL', 'Kafka', 'Docker'],
                'features' => [
                    'Otomatisasi Billing & Invoicing Berulang (Subscription)',
                    'Multi-channel Payment Gateways (VA, QRIS, CC, E-Wallet)',
                    'Auto-reconciliation Mutasi Bank',
                    'Fraud Detection Scoring Engine',
                    'Comprehensive Financial Audit Trail'
                ],
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'SmartRetail POS Multi-Store Sync',
                'slug' => 'smartretail-pos-multi-store-sync',
                'category' => 'Retail IT Solution',
                'client' => 'Kopi Kenangan Jaya Network',
                'completion_date' => 'Maret 2026',
                'featured_image' => '/storage/images/logo/logo.png',
                'gallery_images' => [
                    '/storage/images/logo/logo.png'
                ],
                'demo_url' => 'https://demo.ansaapp.com/smartretail',
                'github_url' => 'https://github.com/ansaapp/smartretail-pos',
                'short_description' => 'Aplikasi kasir Point of Sale (POS) offline-first dengan sinkronisasi cloud real-time antar 60+ cabang ritel F&B.',
                'full_description' => 'Menghadirkan kasir pintar yang tetap dapat bertransaksi saat koneksi internet terputus berkat arsitektur SQLite offline sync. Ketika koneksi pulih, sistem secara otomatis menyelaraskan stok, omzet penjualan, dan poin loyalitas pelanggan.',
                'tech_stack' => ['Laravel 12', 'Livewire', 'Alpine.js', 'Tailwind CSS v4', 'SQLite Local Sync'],
                'features' => [
                    'Operasional Kasir Offline-First Tanpa Khawatir Internet Padam',
                    'Pencetakan Struk Thermal Bluetooth & USB',
                    'Program Loyalitas Poin Pelanggan & Promo Diskon',
                    'Laporan Penjualan Real-time per Kasir / Cabang',
                    'Manajemen Bahan Baku & Resep Produk Dinamis'
                ],
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'title' => 'EduSphere AI Adaptive Learning',
                'slug' => 'edusphere-ai-adaptive-learning',
                'category' => 'EdTech Platform',
                'client' => 'Yayasan Edukasi Cerdas Mandiri',
                'completion_date' => 'Januari 2026',
                'featured_image' => '/storage/images/logo/logo.png',
                'gallery_images' => [
                    '/storage/images/logo/logo.png'
                ],
                'demo_url' => 'https://demo.ansaapp.com/edusphere',
                'github_url' => null,
                'short_description' => 'Platform pembelajaran adaptif bertenaga AI yang mempersonalisasi materi dan evaluasi sesuai daya tangkap siswa.',
                'full_description' => 'EduSphere menganalisis kelemahan dan kecepatan belajar setiap murid secara individual. AI engine merekomendasikan video materi penjelasan serta latihan soal terarah guna memaksimalkan retensi pemahaman murid.',
                'tech_stack' => ['Laravel 12', 'Tailwind CSS', 'Livewire 4', 'Python FastAPI', 'MySQL'],
                'features' => [
                    'Personalized Learning Path & Difficulty Adjustment',
                    'Ujian Online dengan AI Anti-Cheating & Proctoring',
                    'Gamifikasi Peringkat & Sertifikat Kelulusan Otomatis',
                    'Portal Interaktif Guru, Siswa, dan Orang Tua',
                    'Bank Soal Adaptif dengan Pembahasan Detail'
                ],
                'is_featured' => false,
                'order' => 5,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 5. Team Members (Detailed CV)
        $team = [
            [
                'name' => 'Iqdal Ansa, S.Kom',
                'slug' => 'iqdal-ansa',
                'role' => 'Founder & Principal Solutions Architect',
                'photo' => '/storage/images/logo/logo.png',
                'bio' => 'Praktisi teknologi informasi dengan pengalaman lebih dari 8 tahun dalam merancang arsitektur sistem enterprise, konsultasi TI skala nasional, dan kepemimpinan rekayasa perangkat lunak modern.',
                'email' => 'iqdal@ansaapp.com',
                'linkedin' => 'https://linkedin.com/in/iqdal-ansa',
                'github' => 'https://github.com/iqdal',
                'whatsapp' => '6281234567890',
                'skills' => [
                    ['name' => 'Enterprise System Architecture', 'level' => 96],
                    ['name' => 'Laravel Framework & PHP Core', 'level' => 98],
                    ['name' => 'Cloud Infrastructure & AWS', 'level' => 91],
                    ['name' => 'Database Optimization & SQL', 'level' => 94],
                    ['name' => 'IT Strategic Consulting', 'level' => 95],
                    ['name' => 'DevOps & Microservices', 'level' => 88],
                ],
                'experiences' => [
                    [
                        'period' => '2022 - Sekarang',
                        'role' => 'Founder & Principal Solutions Architect',
                        'company' => 'AnsaApp IT Solutions',
                        'desc' => 'Menetapkan arah strategi teknologi, memimpin rancangan arsitektur enterprise untuk klien multinasional, serta mengawasi keberhasilan implementasi solusi perangkat lunak.'
                    ],
                    [
                        'period' => '2019 - 2022',
                        'role' => 'Senior Solutions Architect & Lead Engineer',
                        'company' => 'PT Nusantara Digital Inovasi',
                        'desc' => 'Mengarsiteki sistem billing, API gateway, dan ERP berskala jutaan request harian dengan arsitektur high-availability dan failover multi-server.'
                    ],
                    [
                        'period' => '2017 - 2019',
                        'role' => 'Full-Stack Software Engineer',
                        'company' => 'Apex Global Technology',
                        'desc' => 'Mengembangkan lebih dari 20 aplikasi berbasis Laravel, Vue.js, dan RESTful microservices untuk sektor perbankan dan retail.'
                    ],
                ],
                'educations' => [
                    [
                        'year' => '2013 - 2017',
                        'degree' => 'Sarjana Komputer (S.Kom) - Teknik Informatika',
                        'institution' => 'Fakultas Ilmu Komputer, Universitas Indonesia',
                        'desc' => 'Lulusan dengan predikat Cum Laude. Fokus riset pada Distributed Computing Systems dan Optimasi Basis Data Terdistribusi.'
                    ],
                    [
                        'year' => '2021',
                        'degree' => 'AWS Certified Solutions Architect - Associate',
                        'institution' => 'Amazon Web Services',
                        'desc' => 'Sertifikasi profesional arsitektur komputasi awan skala enterprise.'
                    ],
                ],
                'order' => 1,
            ],
            [
                'name' => 'Aria Pratama, S.Kom',
                'slug' => 'aria-pratama',
                'role' => 'Lead Full-Stack & UI/UX Specialist',
                'photo' => '/storage/images/logo/logo.png',
                'bio' => 'Full-Stack Engineer dengan spesialisasi frontend interaktif reaktif, desain sistem modern, dan integrasi backend Laravel Livewire berkecepatan tinggi.',
                'email' => 'aria@ansaapp.com',
                'linkedin' => 'https://linkedin.com/in/aria-pratama',
                'github' => 'https://github.com/ariapratama',
                'whatsapp' => '6281234567891',
                'skills' => [
                    ['name' => 'Tailwind CSS & Modern CSS', 'level' => 97],
                    ['name' => 'Livewire & Alpine.js', 'level' => 95],
                    ['name' => 'Vue.js 3 & React', 'level' => 91],
                    ['name' => 'PHP / Laravel Backend', 'level' => 92],
                    ['name' => 'UI/UX Design & Prototyping (Figma)', 'level' => 89],
                    ['name' => 'Performance & SEO Optimization', 'level' => 93],
                ],
                'experiences' => [
                    [
                        'period' => '2023 - Sekarang',
                        'role' => 'Lead Full-Stack & UI Architect',
                        'company' => 'AnsaApp IT Solutions',
                        'desc' => 'Merancang antarmuka frontend berstandar internasional, interaktivitas Livewire tanpa refresh, dan memastikan standar performa Core Web Vitals tertinggi.'
                    ],
                    [
                        'period' => '2020 - 2023',
                        'role' => 'Senior Frontend Developer',
                        'company' => 'Creative Tech Studio',
                        'desc' => 'Membangun antarmuka dashboard analitik SaaS responsif dan sistem desain terpadu untuk 30+ produk klien.'
                    ],
                ],
                'educations' => [
                    [
                        'year' => '2016 - 2020',
                        'degree' => 'Sarjana Komputer (S.Kom) - Sistem Informasi',
                        'institution' => 'Institut Teknologi Bandung',
                        'desc' => 'Spesialisasi Human-Computer Interaction (HCI) dan rekayasa antarmuka web modern.'
                    ],
                ],
                'order' => 2,
            ],
            [
                'name' => 'Dimas Setyawan, S.Kom',
                'slug' => 'dimas-setyawan',
                'role' => 'Mobile Engineer & Cloud DevOps',
                'photo' => '/storage/images/logo/logo.png',
                'bio' => 'Spesialis rekayasa aplikasi mobile multi-platform berbasis Flutter serta arsitek otomasi infrastruktur cloud menggunakan Docker dan CI/CD.',
                'email' => 'dimas@ansaapp.com',
                'linkedin' => 'https://linkedin.com/in/dimas-setyawan',
                'github' => 'https://github.com/dimassetyawan',
                'whatsapp' => '6281234567892',
                'skills' => [
                    ['name' => 'Flutter & Dart Mobile Dev', 'level' => 95],
                    ['name' => 'Docker & Containerization', 'level' => 90],
                    ['name' => 'CI/CD Pipelines (GitHub Actions)', 'level' => 92],
                    ['name' => 'Linux Server Administration', 'level' => 89],
                    ['name' => 'REST API Design & WebSockets', 'level' => 91],
                    ['name' => 'Cloud Management (GCP/DigitalOcean)', 'level' => 87],
                ],
                'experiences' => [
                    [
                        'period' => '2023 - Sekarang',
                        'role' => 'Mobile & Cloud DevOps Engineer',
                        'company' => 'AnsaApp IT Solutions',
                        'desc' => 'Bertanggung jawab atas delivery aplikasi mobile ke Google Play & App Store serta mengotomatisasi deployment backend tanpa downtime.'
                    ],
                    [
                        'period' => '2021 - 2023',
                        'role' => 'Mobile Developer',
                        'company' => 'AppVenture Lab Nusantara',
                        'desc' => 'Mengembangkan 12+ aplikasi mobile e-commerce, tracking logistik, dan fintech dengan arsitektur clean-code BLOC.'
                    ],
                ],
                'educations' => [
                    [
                        'year' => '2017 - 2021',
                        'degree' => 'Sarjana Komputer (S.Kom) - Teknik Komputer',
                        'institution' => 'Universitas Gadjah Mada',
                        'desc' => 'Fokus pada Embedded Systems, Jaringan Komputer, dan Pengembangan Mobile Terdistribusi.'
                    ],
                ],
                'order' => 3,
            ],
        ];

        foreach ($team as $member) {
            TeamMember::updateOrCreate(['slug' => $member['slug']], $member);
        }

        // 6. Galleries
        $galleries = [
            [
                'title' => 'Arsitektur & Blueprint Diskusi Sistem Enterprise',
                'category' => 'Konsultasi IT',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Sesi perancangan arsitektur microservices dan skema database bersama klien korporasi.',
                'order' => 1,
            ],
            [
                'title' => 'AnsaApp Tech Stack Review & Sprint Planning',
                'category' => 'Team & Culture',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Evaluasi performa sprint mingguan dan adopsi teknologi mutakhir Laravel 12 & Livewire 4.',
                'order' => 2,
            ],
            [
                'title' => 'Desain Antarmuka Modern & User Testing Lab',
                'category' => 'Design & UI/UX',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Pengujian interaktivitas pengguna dan prototipe aplikasi sebelum tahap development.',
                'order' => 3,
            ],
            [
                'title' => 'Implementasi Server Cloud & Containerization Cluster',
                'category' => 'Infrastruktur',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Konfigurasi server produksi high-availability dengan backup otomatis dan monitoring uptime.',
                'order' => 4,
            ],
            [
                'title' => 'Sesi Pelatihan Pengguna & Serah Terima Sistem',
                'category' => 'Project Delivery',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Pendampingan langsung kepada staf operasional klien pasca-go-live sistem baru.',
                'order' => 5,
            ],
            [
                'title' => 'Audit Keamanan & Penetrasi Tes Sistem Perbankan',
                'category' => 'Security Audit',
                'image_url' => '/storage/images/logo/logo.png',
                'description' => 'Pengujian kerentanan berkala memastikan seluruh sistem terlindung dari eksploitasi siber.',
                'order' => 6,
            ],
        ];

        foreach ($galleries as $gal) {
            Gallery::updateOrCreate(['title' => $gal['title']], $gal);
        }

        // 7. Initial Contact Sample
        Contact::updateOrCreate(
            ['email' => 'client@mitrausaha.co.id'],
            [
                'name' => 'Budi Santoso',
                'phone' => '+62 811-9876-5432',
                'subject' => 'Permohonan Konsultasi Pembuatan Sistem ERP Pergudangan',
                'message' => 'Halo tim AnsaApp, kami tertarik dengan portfolio ERP Anda. Bisakah kami menjadwalkan sesi konsultasi IT untuk membahas kebutuhan sistem pergudangan multi-cabang kami?',
                'is_read' => false,
            ]
        );
    }
}
