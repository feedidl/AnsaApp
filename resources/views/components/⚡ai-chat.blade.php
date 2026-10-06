<?php

use Livewire\Component;

new class extends Component
{
    public bool $isOpen = false;
    public string $userInput = '';
    public array $messages = [];

    public function mount(): void
    {
        $this->messages = [
            [
                'role' => 'assistant',
                'content' => "Halo! 👋 Saya **Ansa AI**, asisten cerdas AnsaApp. Saya siap menjawab segala pertanyaan Anda seputar layanan development aplikasi, konsultasi IT, estimasi biaya, teknologi, tim, dan portofolio kami. Ada yang ingin Anda tanyakan?",
                'time' => now()->format('H:i'),
            ]
        ];
    }

    public function toggleChat(): void
    {
        $this->isOpen = !$this->isOpen;
    }

    public function sendQuickPrompt(string $prompt): void
    {
        $this->userInput = $prompt;
        $this->sendMessage();
    }

    public function sendMessage(): void
    {
        $text = trim($this->userInput);
        if (empty($text)) {
            return;
        }

        $this->messages[] = [
            'role' => 'user',
            'content' => $text,
            'time' => now()->format('H:i'),
        ];

        $this->userInput = '';

        // Generate intelligent response based on AnsaApp Knowledge Base
        $response = $this->generateAnsaResponse($text);

        $this->messages[] = [
            'role' => 'assistant',
            'content' => $response,
            'time' => now()->format('H:i'),
        ];
    }

    public function clearChat(): void
    {
        $this->messages = [
            [
                'role' => 'assistant',
                'content' => "Riwayat percakapan telah dibersihkan. Silakan ajukan pertanyaan seputar layanan dan solusi IT AnsaApp!",
                'time' => now()->format('H:i'),
            ]
        ];
    }

    protected function generateAnsaResponse(string $query): string
    {
        $q = strtolower($query);

        // 1. Services & Layanan
        if (str_contains($q, 'layanan') || str_contains($q, 'service') || str_contains($q, 'bisa apa') || str_contains($q, 'buat apa') || str_contains($q, 'jasa')) {
            return "🚀 **Layanan Utama AnsaApp:**\n\n" .
                   "1. **Development Aplikasi Web & Mobile**: Pembuatan sistem kustom, web app enterprise, PWA, dan mobile apps (Flutter, iOS & Android).\n" .
                   "2. **Konsultasi IT & Solusi Arsitektur**: Audit performa & keamanan, perencanaan arsitektur microservices, dan roadmap transformasi digital.\n" .
                   "3. **Infrastruktur Cloud & DevOps**: Setup CI/CD otomatis, containerization Docker & Kubernetes, serta monitoring server 24/7.\n" .
                   "4. **Sistem Kustom Enterprise**: ERP, CRM, POS, sinkronisasi multi-cabang, dan integrasi multi payment gateway.\n\n" .
                   "Apakah Anda memiliki rencana pengembangan aplikasi dalam waktu dekat?";
        }

        // 2. Harga / Biaya / Estimasi
        if (str_contains($q, 'harga') || str_contains($q, 'biaya') || str_contains($q, 'estimasi') || str_contains($q, 'tarif') || str_contains($q, 'price') || str_contains($q, 'budget') || str_contains($q, 'bayar')) {
            return "💰 **Estimasi Biaya di AnsaApp:**\n\n" .
                   "Biaya investasi bersifat fleksibel dan disesuaikan dengan skala kompleksitas, modul fitur, serta target waktu:\n\n" .
                   "• **Sistem Kustom / MVP**: Mulai dari paket terjangkau dengan arsitektur scalable.\n" .
                   "• **Aplikasi Enterprise & ERP**: Disesuaikan dengan kebutuhan integrasi modul & cabang.\n" .
                   "• **Konsultasi IT & Audit**: Paket per sesi konsultasi atau pendampingan arsitektur bulanan.\n\n" .
                   "💡 **Kabar Baik**: Kami menyediakan **Sesi Konsultasi & Discovery Awal GRATIS**! Silakan isi formulir kontak atau chat WhatsApp admin kami untuk mendapatkan rincian penawaran resmi (RAB/Proposal).";
        }

        // 3. Portofolio / Project
        if (str_contains($q, 'project') || str_contains($q, 'proyek') || str_contains($q, 'portofolio') || str_contains($q, 'contoh') || str_contains($q, 'karya')) {
            return "🏆 **Beberapa Recent Projects Unggulan AnsaApp:**\n\n" .
                   "1. **Ansa ERP Cloud Enterprise**: Sistem manajemen supply chain dan akuntansi multi-gudang (PT Global Logistik Nusantara).\n" .
                   "2. **MediConnect Smart Telemedicine**: Platform konsultasi dokter video WebRTC dan resep obat digital.\n" .
                   "3. **FinFlow Payment Engine**: Otomasi penagihan dan rekonsiliasi mutasi 500k+ transaksi harian.\n" .
                   "4. **SmartRetail POS Multi-Store**: Kasir offline-first dengan cloud sync untuk 60+ cabang ritel.\n" .
                   "5. **EduSphere AI Adaptive Learning**: Platform e-learning cerdas bertenaga AI.\n\n" .
                   "Anda dapat mengklik tombol **'Lihat Detail'** pada section Recent Projects untuk membaca studi kasus lengkapnya!";
        }

        // 4. Tim / Team / Founder
        if (str_contains($q, 'tim') || str_contains($q, 'team') || str_contains($q, 'founder') || str_contains($q, 'siapa') || str_contains($q, 'iqdal') || str_contains($q, 'aria') || str_contains($q, 'dimas')) {
            return "👥 **Tim Inti Profesional AnsaApp:**\n\n" .
                   "• **Iqdal Ansa, S.Kom** - *Founder & Principal Solutions Architect* (Pengalaman 8+ tahun arsitektur enterprise, AWS Certified, spesialis sistem high-throughput).\n" .
                   "• **Aria Pratama, S.Kom** - *Lead Full-Stack & UI/UX Specialist* (Ahli Tailwind CSS v4, Livewire 4, responsive reactive engineering).\n" .
                   "• **Dimas Setyawan, S.Kom** - *Mobile Engineer & Cloud DevOps* (Pakar Flutter, Docker cluster, dan otomasi pipeline CI/CD).\n\n" .
                   "Anda bisa mengecek **Curriculum Vitae (CV)** lengkap tiap anggota tim langsung di bagian Tim!";
        }

        // 5. Tech Stack / Teknologi
        if (str_contains($q, 'tech') || str_contains($q, 'teknologi') || str_contains($q, 'bahasa') || str_contains($q, 'laravel') || str_contains($q, 'flutter') || str_contains($q, 'database') || str_contains($q, 'stack')) {
            return "⚡ **Teknologi Modern yang Digunakan di AnsaApp:**\n\n" .
                   "• **Backend & Core**: Laravel 12, PHP 8.2+, Node.js, Python\n" .
                   "• **Frontend & Reaktivitas**: Livewire 4, Tailwind CSS v4, Vue.js 3, React, Alpine.js\n" .
                   "• **Mobile**: Flutter & Dart (Cross-platform iOS & Android)\n" .
                   "• **Database**: PostgreSQL, MySQL, Redis, SQLite Local Sync\n" .
                   "• **DevOps & Cloud**: Docker, Kubernetes, AWS, Google Cloud, GitHub Actions CI/CD.\n\n" .
                   "Kami selalu mengutamakan stack yang teruji, cepat, aman, dan mudah dikembangkan dalam jangka panjang.";
        }

        // 6. Alur Kerja / Prosedur / Cara Order
        if (str_contains($q, 'alur') || str_contains($q, 'cara') || str_contains($q, 'prosedur') || str_contains($q, 'order') || str_contains($q, 'langkah') || str_contains($q, 'mulai') || str_contains($q, 'kontrak')) {
            return "📋 **5 Tahapan Alur Kerja di AnsaApp:**\n\n" .
                   "1. **Discovery & Konsultasi Kebutuhan**: Diskusi mendalam memahami tujuan bisnis, fitur wajib, dan batasan teknis.\n" .
                   "2. **Blueprint & Estimasi Transparan**: Kami menyusun diagram arsitektur, timeline pengerjaan, dan proposal biaya.\n" .
                   "3. **Agile Development Sprints**: Pengerjaan bertahap dengan demo berkala sehingga progres dapat Anda pantau langsung.\n" .
                   "4. **Quality Assurance & Security Audit**: Pengujian menyeluruh fungsi, keamanan data, dan kecepatan akses.\n" .
                   "5. **Deployment & Garansi Support**: Serah terima sistem, pelatihan staf klien, dan garansi maintenance.";
        }

        // 7. Kontak & Booking
        if (str_contains($q, 'kontak') || str_contains($q, 'hubungi') || str_contains($q, 'telepon') || str_contains($q, 'wa') || str_contains($q, 'whatsapp') || str_contains($q, 'email') || str_contains($q, 'alamat') || str_contains($q, 'kantor')) {
            return "📞 **Informasi Kontak Resmi AnsaApp:**\n\n" .
                   "• **WhatsApp Admin**: [+62 812-3456-7890](https://wa.me/6281234567890)\n" .
                   "• **Email**: contact@ansaapp.com\n" .
                   "• **Kantor**: Gedung Menara Cyber Lt. 8, Jl. Kuningan Barat No. 26, Jakarta Selatan\n" .
                   "• **Jam Kerja**: Senin - Jumat (09.00 - 18.00 WIB)\n\n" .
                   "Anda juga bisa langsung mengisi **Formulir Kontak** di halaman bawah untuk kami hubungi kembali!";
        }

        // Default intelligent fallback
        return "Terima kasih atas pertanyaan Anda! 😊\n\n" .
               "Di **AnsaApp**, kami berfokus membantu mewujudkan sistem digital yang andal mulai dari **pembuatan aplikasi web/mobile**, **konsultasi arsitektur IT**, hingga **otomasi cloud devops**.\n\n" .
               "Anda dapat menanyakan hal lebih spesifik mengenai: \n" .
               "• Layanan & solusi IT yang tersedia\n" .
               "• Estimasi biaya & alur pengerjaan\n" .
               "• Profil tim pengembang & CV\n" .
               "• Portofolio studi kasus proyek kami\n\n" .
               "Atau klik tombol WhatsApp admin kami di halaman untuk berdiskusi langsung!";
    }
};
?>

<div>
    <!-- Floating Trigger Button -->
    <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 z-40">
        <button 
            wire:click="toggleChat"
            class="relative flex items-center gap-2 sm:gap-2.5 px-3.5 sm:px-4 py-3 sm:py-3.5 rounded-full shadow-2xl transition-all transform hover:scale-105 active:scale-95 cursor-pointer border"
            style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent)); border-color: rgba(255,255,255,0.2); color: #ffffff;"
            aria-label="Buka Asisten Ansa AI"
        >
            <span class="relative flex h-2.5 w-2.5 sm:h-3 sm:w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 sm:h-3 sm:w-3 bg-white"></span>
            </span>
            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
            <span class="font-bold text-xs sm:text-sm tracking-wide">Tanya Ansa AI</span>
        </button>
    </div>

    <!-- Chat Modal / Drawer (Responsive full-screen on mobile, floating on sm+) -->
    @if ($isOpen)
        <div class="fixed inset-0 sm:inset-auto sm:bottom-24 sm:right-6 z-50 flex flex-col w-full sm:w-[420px] h-full sm:h-[600px] shadow-2xl rounded-none sm:rounded-3xl border overflow-hidden transition-all backdrop-blur-2xl"
             style="background-color: var(--bg-surface); border-color: var(--border-subtle); color: var(--text-primary);">
            
            <!-- Chat Header -->
            <div class="p-3.5 sm:p-4 border-b flex items-center justify-between"
                 style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle);">
                <div class="flex items-center gap-2.5 sm:gap-3">
                    <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-xl flex items-center justify-center font-bold text-white shadow-md text-xs sm:text-sm"
                         style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent));">
                        AI
                    </div>
                    <div>
                        <h4 class="text-xs sm:text-sm font-bold flex items-center gap-1.5" style="color: var(--text-primary);">
                            <span>Ansa Assistant AI</span>
                            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        </h4>
                        <p class="text-[10px] sm:text-[11px]" style="color: var(--text-muted);">
                            Asisten Cerdas Portofolio & Solusi IT
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-1">
                    <button 
                        wire:click="clearChat" 
                        title="Bersihkan Percakapan"
                        class="p-2 rounded-lg transition-colors cursor-pointer hover:bg-slate-800"
                        style="color: var(--text-muted);"
                    >
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                    <button 
                        wire:click="toggleChat" 
                        class="p-2 rounded-lg transition-colors cursor-pointer hover:bg-slate-800"
                        style="color: var(--text-secondary);"
                    >
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="flex-1 p-3.5 sm:p-4 overflow-y-auto space-y-3 text-xs leading-relaxed">
                @foreach ($messages as $msg)
                    @if ($msg['role'] === 'user')
                        <div class="flex justify-end">
                            <div class="max-w-[85%] rounded-2xl rounded-tr-sm px-3.5 sm:px-4 py-2 sm:py-2.5 text-white font-medium shadow-md text-xs"
                                 style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-primary-light));">
                                <p>{{ $msg['content'] }}</p>
                                <span class="text-[9px] opacity-75 block text-right mt-1">{{ $msg['time'] }}</span>
                            </div>
                        </div>
                    @else
                        <div class="flex justify-start items-start gap-2">
                            <div class="w-6 h-6 rounded-lg shrink-0 flex items-center justify-center text-[10px] font-bold text-white mt-1"
                                 style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent));">
                                AI
                            </div>
                            <div class="max-w-[88%] sm:max-w-[85%] rounded-2xl rounded-tl-sm px-3.5 sm:px-4 py-2.5 sm:py-3 border shadow-sm text-xs"
                                 style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                <div class="prose prose-invert prose-xs max-w-none whitespace-pre-line leading-relaxed">
                                    {!! nl2br(e($msg['content'])) !!}
                                </div>
                                <span class="text-[9px] block mt-1.5" style="color: var(--text-muted);">{{ $msg['time'] }}</span>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Quick Suggestions Chips (Horizontally Scrollable) -->
            <div class="px-3 py-2 border-t overflow-x-auto flex gap-1.5 no-scrollbar shrink-0"
                 style="background-color: var(--bg-surface-card); border-color: var(--border-subtle);">
                <button 
                    wire:click="sendQuickPrompt('Apa saja layanan utama AnsaApp?')"
                    class="whitespace-nowrap px-2.5 py-1 rounded-full text-[11px] border transition-colors cursor-pointer shrink-0"
                    style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                >
                    💡 Layanan Kami
                </button>
                <button 
                    wire:click="sendQuickPrompt('Berapa estimasi biaya pembuatan aplikasi?')"
                    class="whitespace-nowrap px-2.5 py-1 rounded-full text-[11px] border transition-colors cursor-pointer shrink-0"
                    style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                >
                    💰 Estimasi Biaya
                </button>
                <button 
                    wire:click="sendQuickPrompt('Ceritakan tentang portofolio dan recent project AnsaApp')"
                    class="whitespace-nowrap px-2.5 py-1 rounded-full text-[11px] border transition-colors cursor-pointer shrink-0"
                    style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                >
                    🏆 Portfolio
                </button>
                <button 
                    wire:click="sendQuickPrompt('Siapa saja tim ahli di AnsaApp?')"
                    class="whitespace-nowrap px-2.5 py-1 rounded-full text-[11px] border transition-colors cursor-pointer shrink-0"
                    style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                >
                    👥 Profil Tim
                </button>
            </div>

            <!-- Chat Input Form -->
            <form wire:submit="sendMessage" class="p-3 border-t flex items-center gap-2 shrink-0"
                  style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle);">
                <input 
                    type="text" 
                    wire:model="userInput" 
                    placeholder="Tanya apa saja seputar AnsaApp..."
                    class="flex-1 px-3.5 sm:px-4 py-2.5 rounded-xl border text-base sm:text-xs focus:outline-none focus:ring-1"
                    style="background-color: var(--bg-surface); border-color: var(--border-subtle); color: var(--text-primary);"
                >
                <button 
                    type="submit" 
                    class="px-4 py-2.5 rounded-xl text-xs font-bold btn-brand-primary flex items-center justify-center cursor-pointer shrink-0"
                >
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    @endif
</div>