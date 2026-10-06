<!DOCTYPE html>
<html lang="id" data-theme="ansa-default" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $settings['company_name'] ?? 'AnsaApp' }} - IT System Development • Consulting • Solutions</title>
    <meta name="description" content="{{ $settings['company_description'] ?? 'Mitra strategis transformasi digital yang menghadirkan solusi teknologi mutakhir dan pengembangan aplikasi enterprise.' }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Vite Assets (Tailwind CSS v4 & JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <!-- Theme Initialization Script (Instant, prevents flicker) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('ansa_theme') || 'ansa-default';
            document.documentElement.setAttribute('data-theme', savedTheme);
        })();
    </script>
</head>
<body class="antialiased selection:bg-teal-500 selection:text-white relative overflow-x-hidden min-h-screen flex flex-col justify-between"
      x-data="{ mobileMenuOpen: false }">

    <!-- Dynamic Background Glow Elements -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-72 sm:w-96 h-72 sm:h-96 rounded-full blur-3xl opacity-20" style="background-color: var(--brand-primary);"></div>
        <div class="absolute top-1/3 -right-32 w-72 sm:w-96 h-72 sm:h-96 rounded-full blur-3xl opacity-20" style="background-color: var(--brand-accent);"></div>
        <div class="absolute -bottom-32 left-1/4 w-72 sm:w-96 h-72 sm:h-96 rounded-full blur-3xl opacity-15" style="background-color: var(--brand-primary-light);"></div>
    </div>

    <div class="relative z-10 flex flex-col min-h-screen">
        
        <!-- ================= NAVBAR ================= -->
        <header class="sticky top-0 z-40 backdrop-blur-xl border-b transition-colors"
                style="background-color: var(--nav-blur-bg); border-color: var(--border-subtle);">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-18 sm:h-20 flex items-center justify-between">
                
                <!-- Logo & Brand Name -->
                <a href="#hero" class="flex items-center gap-2.5 sm:gap-3 group">
                    <div class="h-9 sm:h-11 w-auto flex items-center justify-center p-1 rounded-xl border transition-transform group-hover:scale-105"
                         style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle);">
                        <img 
                            src="/storage/images/logo/logo.png" 
                            alt="AnsaApp Logo" 
                            class="h-7 sm:h-9 w-auto object-contain filter drop-shadow"
                            onerror="this.src='/storage/images/logo/logo.png'"
                        >
                    </div>
                    <div class="flex flex-col">
                        <span class="text-lg sm:text-xl font-extrabold tracking-tight font-sans leading-tight" style="color: var(--text-primary);">
                            ANSA<span style="color: var(--brand-primary-light);">APP</span>
                        </span>
                        <span class="text-[8px] sm:text-[9px] font-mono tracking-widest uppercase font-semibold" style="color: var(--brand-accent);">
                            IT SOLUTIONS
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8 text-sm font-medium" style="color: var(--text-secondary);">
                    <a href="#services" class="hover:text-white transition-colors">Layanan</a>
                    <a href="#projects" class="hover:text-white transition-colors">Recent Projects</a>
                    <!-- <a href="#gallery" class="hover:text-white transition-colors">Galeri</a> -->
                    <a href="#team" class="hover:text-white transition-colors">Tim & CV</a>
                    <a href="#contact" class="hover:text-white transition-colors">Kontak</a>
                </nav>

                <!-- Actions: Multi-Theme Switcher, CTA & Mobile Hamburger -->
                <div class="flex items-center gap-2 sm:gap-3">
                    
                    <!-- THEME SELECTOR DROPDOWN -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button 
                            @click="open = !open"
                            type="button"
                            class="flex items-center gap-1.5 sm:gap-2 px-2.5 sm:px-3 py-1.5 sm:py-2 rounded-xl border text-xs font-semibold transition-all cursor-pointer"
                            style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                            title="Ganti Tema UI"
                        >
                            <!-- Mini color dots indicator -->
                            <div class="flex -space-x-1">
                                <span class="w-2.5 h-2.5 rounded-full inline-block" style="background-color: var(--brand-primary);"></span>
                                <span class="w-2.5 h-2.5 rounded-full inline-block" style="background-color: var(--brand-accent);"></span>
                            </div>
                            <span class="hidden sm:inline">Tema</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Theme Options Menu -->
                        <div 
                            x-show="open" 
                            x-transition
                            class="absolute right-0 mt-2 w-56 rounded-2xl border shadow-2xl py-2 z-50 backdrop-blur-2xl"
                            style="background-color: var(--bg-surface); border-color: var(--border-highlight);"
                        >
                            <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider" style="color: var(--text-muted);">
                                Pilih Tema Antarmuka:
                            </div>

                            <!-- Option 1: Ansa Default (Logo) -->
                            <button 
                                onclick="setTheme('ansa-default')" 
                                @click="open = false"
                                class="w-full px-3 py-2 text-left text-xs flex items-center justify-between hover:bg-slate-800/50 transition-colors cursor-pointer"
                            >
                                <div class="flex items-center gap-2.5">
                                    <span class="w-3.5 h-3.5 rounded-full bg-[#0d9488] border border-teal-300"></span>
                                    <span class="font-semibold" style="color: var(--text-primary);">Ansa Navy & Teal</span>
                                </div>
                                <span class="text-[9px] px-1.5 py-0.5 rounded bg-teal-950 text-teal-300 border border-teal-800 font-bold">Default</span>
                            </button>

                            <!-- Option 2: Cyber Indigo -->
                            <button 
                                onclick="setTheme('cyber-indigo')" 
                                @click="open = false"
                                class="w-full px-3 py-2 text-left text-xs flex items-center gap-2.5 hover:bg-slate-800/50 transition-colors cursor-pointer"
                            >
                                <span class="w-3.5 h-3.5 rounded-full bg-[#6366f1] border border-indigo-300"></span>
                                <span class="font-medium" style="color: var(--text-primary);">Cyber Indigo</span>
                            </button>

                            <!-- Option 3: Emerald Forest -->
                            <button 
                                onclick="setTheme('emerald-forest')" 
                                @click="open = false"
                                class="w-full px-3 py-2 text-left text-xs flex items-center gap-2.5 hover:bg-slate-800/50 transition-colors cursor-pointer"
                            >
                                <span class="w-3.5 h-3.5 rounded-full bg-[#059669] border border-emerald-300"></span>
                                <span class="font-medium" style="color: var(--text-primary);">Emerald Forest</span>
                            </button>

                            <!-- Option 4: Executive Light -->
                            <button 
                                onclick="setTheme('executive-light')" 
                                @click="open = false"
                                class="w-full px-3 py-2 text-left text-xs flex items-center gap-2.5 hover:bg-slate-800/50 transition-colors cursor-pointer"
                            >
                                <span class="w-3.5 h-3.5 rounded-full bg-[#f8fafc] border border-slate-400"></span>
                                <span class="font-medium" style="color: var(--text-primary);">Executive Light</span>
                            </button>
                        </div>
                    </div>

                    <!-- Direct WhatsApp CTA (Tablet/Desktop) -->
                    @if (!empty($settings['company_whatsapp']))
                        <a 
                            href="https://wa.me/{{ $settings['company_whatsapp'] }}?text=Halo%20AnsaApp,%20saya%20tertarik%20untuk%20konsultasi%20pengembangan%20sistem."
                            target="_blank"
                            class="hidden md:inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold btn-brand-primary"
                        >
                            <span>Konsultasi WA</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @endif

                    <!-- Admin Portal Link (Desktop) -->
                    <!-- <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="hidden sm:inline-flex px-3 py-2 rounded-xl border text-xs font-semibold transition-all hover:border-slate-500"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                        title="Halaman Panel Portofolio"
                    >
                        Panel
                    </a> -->

                    <!-- Mobile Hamburger Button -->
                    <button 
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        type="button"
                        class="lg:hidden p-2 rounded-xl border transition-colors cursor-pointer flex items-center justify-center"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                        aria-label="Buka Menu Navigasi"
                    >
                        <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation Drawer / Overlay -->
            <div 
                x-show="mobileMenuOpen" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="lg:hidden border-b px-4 pt-3 pb-6 space-y-3 backdrop-blur-2xl"
                style="background-color: var(--bg-surface); border-color: var(--border-subtle); display: none;"
            >
                <div class="flex flex-col space-y-2 text-sm font-semibold" style="color: var(--text-secondary);">
                    <a @click="mobileMenuOpen = false" href="#services" class="px-3 py-2 rounded-xl hover:bg-slate-800/40 hover:text-white transition-colors">
                        Layanan AnsaApp
                    </a>
                    <a @click="mobileMenuOpen = false" href="#projects" class="px-3 py-2 rounded-xl hover:bg-slate-800/40 hover:text-white transition-colors">
                        Recent Projects (Portfolio)
                    </a>
                    <!-- <a @click="mobileMenuOpen = false" href="#gallery" class="px-3 py-2 rounded-xl hover:bg-slate-800/40 hover:text-white transition-colors">
                        Galeri Dokumentasi
                    </a> -->
                    <a @click="mobileMenuOpen = false" href="#team" class="px-3 py-2 rounded-xl hover:bg-slate-800/40 hover:text-white transition-colors">
                        Tim Ahli & CV
                    </a>
                    <a @click="mobileMenuOpen = false" href="#contact" class="px-3 py-2 rounded-xl hover:bg-slate-800/40 hover:text-white transition-colors">
                        Hubungi Admin & Form
                    </a>
                </div>

                <div class="pt-3 border-t flex flex-col gap-2" style="border-color: var(--border-subtle);">
                    @if (!empty($settings['company_whatsapp']))
                        <a 
                            href="https://wa.me/{{ $settings['company_whatsapp'] }}?text=Halo%20AnsaApp,%20saya%20ingin%20konsultasi%20layanan%20IT."
                            target="_blank"
                            class="w-full py-2.5 px-4 rounded-xl text-xs font-bold btn-brand-primary flex items-center justify-center gap-2"
                        >
                            <span>Konsultasi WhatsApp Admin</span>
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    @endif

                    <!-- <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="w-full py-2.5 px-4 rounded-xl border text-xs font-semibold text-center transition-colors"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                    >
                        Masuk ke Panel Portofolio (Admin)
                    </a> -->
                </div>
            </div>
        </header>

        <!-- ================= HERO SECTION ================= -->
        <section id="hero" class="relative pt-12 pb-16 sm:pt-20 sm:pb-24 lg:pt-28 lg:pb-32 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full text-center">
            <div class="max-w-4xl mx-auto space-y-5 sm:space-y-6">
                
                <!-- Badge Tagline -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full border text-[11px] sm:text-xs font-bold uppercase tracking-wider max-w-full"
                     style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    <span class="w-2 h-2 rounded-full animate-ping shrink-0" style="background-color: var(--brand-accent);"></span>
                    <span class="truncate">IT System Development • Consulting • Solutions</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight leading-[1.15] sm:leading-[1.1]" style="color: var(--text-primary);">
                    Membangun Solusi Digital 
                    <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, var(--brand-primary-light), var(--brand-accent));">
                        Enterprise & Modern
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-sm sm:text-lg md:text-xl max-w-2xl mx-auto leading-relaxed px-2" style="color: var(--text-secondary);">
                    {{ $settings['hero_subtitle'] ?? 'Mitra strategis transformasi teknologi: development aplikasi web & mobile, konsultasi arsitektur IT, dan sistem enterprise terintegrasi.' }}
                </p>

                <!-- Call to Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 pt-2 sm:pt-4 w-full max-w-md sm:max-w-none mx-auto">
                    <a href="#contact" class="w-full sm:w-auto px-7 py-3.5 rounded-2xl text-xs sm:text-sm font-bold btn-brand-primary flex items-center justify-center gap-2 cursor-pointer">
                        <span>Mulai Diskusi Proyek</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                    <a href="#projects" class="w-full sm:w-auto px-6 py-3.5 rounded-2xl text-xs sm:text-sm font-bold btn-brand-secondary flex items-center justify-center gap-2 cursor-pointer">
                        <span>Lihat Recent Projects</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </a>
                </div>

                <!-- Live Metrics Counter -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 pt-8 sm:pt-12 max-w-4xl mx-auto">
                    <div class="p-4 sm:p-5 rounded-2xl theme-card text-center">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-mono" style="color: var(--brand-primary-light);">{{count($projects)}}+</span>
                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--text-muted);">Sistem Delivered</p>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl theme-card text-center">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-mono" style="color: var(--brand-accent);">99.9%</span>
                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--text-muted);">Uptime SLA</p>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl theme-card text-center">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-mono" style="color: var(--brand-primary-light);">5+</span>
                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--text-muted);">Tahun Pengalaman</p>
                    </div>
                    <div class="p-4 sm:p-5 rounded-2xl theme-card text-center">
                        <span class="text-2xl sm:text-3xl md:text-4xl font-extrabold font-mono" style="color: var(--brand-accent);">100%</span>
                        <p class="text-[11px] sm:text-xs mt-1" style="color: var(--text-muted);">Kepuasan Klien</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ================= SERVICES SECTION ================= -->
        <section id="services" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 space-y-3">
                <span class="px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border"
                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    Layanan Unggulan
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold" style="color: var(--text-primary);">
                    Development Aplikasi, Konsultasi IT & Solusi
                </h2>
                <p class="text-xs sm:text-sm md:text-base px-2" style="color: var(--text-secondary);">
                    Solusi komprehensif dari tahap ide, perancangan arsitektur, hingga pemeliharaan sistem skala enterprise.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                @foreach ($services as $service)
                    <div class="p-6 sm:p-8 rounded-3xl theme-card relative group flex flex-col justify-between">
                        <div>
                            <!-- Header Icon & Title -->
                            <div class="flex items-center gap-3.5 sm:gap-4 mb-4 sm:mb-5">
                                <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-2xl flex items-center justify-center font-bold text-white shadow-lg shrink-0"
                                     style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-accent));">
                                    <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg sm:text-xl font-bold leading-snug" style="color: var(--text-primary);">
                                        {{ $service->title }}
                                    </h3>
                                    <span class="text-[11px] font-mono" style="color: var(--brand-primary-light);">
                                        AnsaApp Core Service
                                    </span>
                                </div>
                            </div>

                            <p class="text-xs sm:text-sm leading-relaxed mb-5 sm:mb-6" style="color: var(--text-secondary);">
                                {{ $service->short_description }}
                            </p>

                            <!-- Feature Bullets -->
                            @if (!empty($service->features))
                                <ul class="space-y-2 mb-6">
                                    @foreach ($service->features as $item)
                                        <li class="flex items-start gap-2.5 text-xs" style="color: var(--text-secondary);">
                                            <svg class="w-4 h-4 shrink-0 mt-0.5" style="color: var(--brand-accent);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="pt-4 border-t flex items-center justify-between" style="border-color: var(--border-subtle);">
                            <a href="#contact" class="text-xs font-semibold flex items-center gap-1.5 transition-colors group-hover:underline"
                               style="color: var(--brand-primary-light);">
                                <span>Ajukan Konsultasi Layanan Ini</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ================= RECENT PROJECTS SHOWCASE ================= -->
        <section id="projects" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                <span class="px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border"
                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    Portfolio Karya
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold" style="color: var(--text-primary);">
                    Recent Projects & Case Studies
                </h2>
                <p class="text-xs sm:text-sm md:text-base px-2" style="color: var(--text-secondary);">
                    Klik <strong>"Lihat Detail"</strong> pada masing-masing proyek untuk mempelajari arsitektur, teknologi, dan deskripsi solusinya.
                </p>
            </div>

            <!-- Project Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($projects as $project)
                    <div class="rounded-3xl theme-card overflow-hidden flex flex-col justify-between group">
                        <div>
                            <!-- Thumbnail / Header -->
                            <div class="h-44 sm:h-48 w-full relative overflow-hidden border-b flex items-center justify-center p-6"
                                 style="background: linear-gradient(135deg, var(--bg-surface-elevated), var(--bg-surface-card)); border-color: var(--border-subtle);">
                                <img 
                                    src="{{ $project->featured_image ?: '/storage/images/logo/logo.png' }}" 
                                    alt="{{ $project->title }}" 
                                    class="max-h-full max-w-full object-contain filter drop-shadow group-hover:scale-105 transition-transform duration-300"
                                    onerror="this.src='/storage/images/logo/logo.png'"
                                >
                                <span class="absolute top-3 sm:top-4 left-3 sm:left-4 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border"
                                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                                    {{ $project->category }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="p-5 sm:p-6">
                                <div class="flex items-center justify-between text-xs mb-2" style="color: var(--text-muted);">
                                    <span class="truncate max-w-[60%]">{{ $project->client ?? 'Klien Korporasi' }}</span>
                                    <span class="shrink-0">{{ $project->completion_date }}</span>
                                </div>

                                <h3 class="text-base sm:text-lg font-bold mb-2 group-hover:text-teal-400 transition-colors leading-snug" style="color: var(--text-primary);">
                                    {{ $project->title }}
                                </h3>

                                <p class="text-xs leading-relaxed line-clamp-3 mb-4" style="color: var(--text-secondary);">
                                    {{ $project->short_description }}
                                </p>

                                <!-- Tech Stack Badges -->
                                @if (!empty($project->tech_stack))
                                    <div class="flex flex-wrap gap-1.5 mb-2">
                                        @foreach (array_slice($project->tech_stack, 0, 4) as $stack)
                                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-mono border"
                                                  style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-muted);">
                                                {{ $stack }}
                                            </span>
                                        @endforeach
                                        @if (count($project->tech_stack) > 4)
                                            <span class="px-2 py-0.5 rounded-lg text-[10px] font-mono" style="color: var(--brand-accent);">
                                                +{{ count($project->tech_stack) - 4 }} lagi
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Action -->
                        <div class="p-5 sm:p-6 pt-0">
                            <button 
                                onclick="Livewire.dispatch('open-project-modal', { id: {{ $project->id }} })"
                                class="w-full py-2.5 sm:py-3 px-4 rounded-xl text-xs font-bold btn-brand-primary flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <span>Lihat Detail Proyek</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ================= GALLERY SECTION ================= -->
        <!-- <section id="gallery" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-14 space-y-3">
                <span class="px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border"
                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    Dokumentasi & Aktivitas
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold" style="color: var(--text-primary);">
                    Galeri AnsaApp
                </h2>
                <p class="text-xs sm:text-sm md:text-base px-2" style="color: var(--text-secondary);">
                    Sorotan proses perancangan, sesi konsultasi, pengujian sistem, dan kultur kolaborasi rekayasa software kami.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                @foreach ($galleries as $gallery)
                    <div class="rounded-3xl theme-card overflow-hidden group relative">
                        <div class="h-52 sm:h-60 w-full relative overflow-hidden flex items-center justify-center p-6 sm:p-8"
                             style="background: linear-gradient(135deg, var(--bg-surface-elevated), var(--bg-surface-card));">
                            <img 
                                src="{{ $gallery->image_url ?: '/storage/images/logo/logo.png' }}" 
                                alt="{{ $gallery->title }}" 
                                class="max-h-full max-w-full object-contain filter drop-shadow group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='/storage/images/logo/logo.png'"
                            >
                            <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/30 to-transparent opacity-80 group-hover:opacity-95 transition-opacity"></div>
                            
                            <div class="absolute bottom-4 left-4 right-4 text-white">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border mb-1.5 inline-block"
                                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                                    {{ $gallery->category }}
                                </span>
                                <h4 class="text-xs sm:text-sm font-bold line-clamp-1 text-white">{{ $gallery->title }}</h4>
                                @if ($gallery->description)
                                    <p class="text-[11px] text-slate-300 line-clamp-2 mt-1">{{ $gallery->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section> -->

        <!-- ================= TEAM & CV SECTION ================= -->
        <section id="team" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 space-y-3">
                <span class="px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border"
                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    Tim Ahli & Engineering
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold" style="color: var(--text-primary);">
                    Tim Profesional AnsaApp
                </h2>
                <p class="text-xs sm:text-sm md:text-base px-2" style="color: var(--text-secondary);">
                    Klik <strong>"Lihat Detail CV"</strong> untuk melihat riwayat karier, sertifikasi, keahlian teknis, dan portofolio keahlian setiap anggota.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                @foreach ($team as $member)
                    <div class="rounded-3xl theme-card p-6 flex flex-col justify-between group">
                        <div>
                            <!-- Photo & Role -->
                            <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl mx-auto mb-4 sm:mb-5 p-2 border flex items-center justify-center overflow-hidden"
                                 style="background: linear-gradient(135deg, var(--bg-surface-elevated), var(--bg-surface-card)); border-color: var(--border-subtle);">
                                <img 
                                    src="{{ $member->photo ?: '/storage/images/logo/logo.png' }}" 
                                    alt="{{ $member->name }}" 
                                    class="w-full h-full object-contain filter drop-shadow group-hover:scale-105 transition-transform"
                                    onerror="this.src='/storage/images/logo/logo.png'"
                                >
                            </div>

                            <div class="text-center mb-3 sm:mb-4">
                                <h3 class="text-base sm:text-lg font-bold" style="color: var(--text-primary);">
                                    {{ $member->name }}
                                </h3>
                                <p class="text-xs font-semibold mt-0.5" style="color: var(--brand-primary-light);">
                                    {{ $member->role }}
                                </p>
                            </div>

                            <p class="text-xs leading-relaxed text-center line-clamp-3 mb-4 sm:mb-5" style="color: var(--text-secondary);">
                                {{ $member->bio }}
                            </p>

                            <!-- Mini Skills Badges -->
                            @if (!empty($member->skills))
                                <div class="flex flex-wrap justify-center gap-1.5 mb-5 sm:mb-6">
                                    @foreach (array_slice($member->skills, 0, 3) as $s)
                                        <span class="px-2 py-0.5 rounded-lg text-[10px] font-mono border"
                                              style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-muted);">
                                            {{ $s['name'] }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- CV Detail Button -->
                        <div>
                            <button 
                                onclick="Livewire.dispatch('open-team-cv-modal', { id: {{ $member->id }} })"
                                class="w-full py-2.5 sm:py-3 px-4 rounded-xl text-xs font-bold btn-brand-primary flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <span>Lihat Detail CV</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- ================= CONTACT & CONSULTATION ================= -->
        <section id="contact" class="py-16 sm:py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto w-full">
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16 space-y-3">
                <span class="px-3.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border"
                      style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);">
                    Hubungi Kami
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold" style="color: var(--text-primary);">
                    Kontak Admin & Konsultasi Gratis
                </h2>
                <p class="text-xs sm:text-sm md:text-base px-2" style="color: var(--text-secondary);">
                    Diskusikan kebutuhan aplikasi atau arsitektur TI bisnis Anda. Kami siap memberikan masukan teknis dan estimasi transparan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8 items-start">
                
                <!-- Left: Contact Details Cards -->
                <div class="lg:col-span-5 space-y-4">
                    
                    <!-- WhatsApp Admin -->
                    <div class="p-5 sm:p-6 rounded-3xl theme-card flex items-start gap-4">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center font-bold text-white shrink-0"
                             style="background: linear-gradient(135deg, #10b981, #059669);">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold truncate" style="color: var(--text-primary);">WhatsApp Hotline Admin</h4>
                            <p class="text-xs mt-0.5 sm:mt-1" style="color: var(--text-secondary);">Respons cepat untuk tanya jawab teknis & jadwal demo.</p>
                            <a href="https://wa.me/{{ $settings['company_whatsapp'] ?? '6281234567890' }}?text=Halo%20Admin%20AnsaApp,%20saya%20ingin%20berkonsultasi%20layanan%20IT." 
                               target="_blank"
                               class="inline-flex items-center gap-1.5 text-xs font-bold mt-2" style="color: var(--brand-accent);">
                                <span>{{ $settings['company_phone'] ?? '+62 812-3456-7890' }}</span>
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Email Official -->
                    <div class="p-5 sm:p-6 rounded-3xl theme-card flex items-start gap-4">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center font-bold text-white shrink-0"
                             style="background: linear-gradient(135deg, var(--brand-primary), var(--brand-primary-light));">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold truncate" style="color: var(--text-primary);">Email Korespondensi</h4>
                            <p class="text-xs mt-0.5 sm:mt-1" style="color: var(--text-secondary);">Kirim RFP (Request for Proposal) atau dokumen kerja sama.</p>
                            <a href="mailto:{{ $settings['company_email'] ?? 'admin@ansaapp.my.id' }}" 
                               class="inline-block text-xs font-bold mt-2 truncate max-w-full" style="color: var(--brand-primary-light);">
                                {{ $settings['company_email'] ?? 'admin@ansaapp.my.id' }}
                            </a>
                        </div>
                    </div>

                    <!-- Office Location -->
                    <div class="p-5 sm:p-6 rounded-3xl theme-card flex items-start gap-4">
                        <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl flex items-center justify-center font-bold text-white shrink-0"
                             style="background: linear-gradient(135deg, #0284c7, #0369a1);">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold truncate" style="color: var(--text-primary);">Lokasi</h4>
                            <p class="text-xs mt-0.5 sm:mt-1 leading-relaxed" style="color: var(--text-secondary);">
                                {{ $settings['company_address'] ?? 'Gedung Menara Cyber Lt. 8, Jl. Kuningan Barat No. 26, Jakarta Selatan' }}
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Right: Interactive Livewire Contact Form -->
                <div class="lg:col-span-7 p-6 sm:p-8 rounded-3xl theme-card">
                    <h3 class="text-lg sm:text-xl font-bold mb-1.5" style="color: var(--text-primary);">Kirim Pesan Langsung</h3>
                    <p class="text-xs mb-6" style="color: var(--text-secondary);">
                        Isi form di bawah ini dan kami akan segera menganalisis kebutuhan Anda.
                    </p>

                    <livewire:contact-form />
                </div>

            </div>
        </section>

        <!-- ================= FOOTER ================= -->
        <footer class="border-t py-10 sm:py-12 px-4 sm:px-6 lg:px-8 mt-12 sm:mt-16 transition-colors"
                style="background-color: var(--bg-surface); border-color: var(--border-subtle);">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6 text-xs text-center md:text-left"
                 style="color: var(--text-muted);">
                
                <div class="flex items-center gap-3">
                    <img 
                        src="/storage/images/logo/logo.png" 
                        alt="AnsaApp" 
                        class="h-8 w-auto object-contain filter drop-shadow"
                        onerror="this.src='/storage/images/logo/logo.png'"
                    >
                    <div>
                        <span class="font-extrabold text-sm tracking-tight" style="color: var(--text-primary);">ANSAAPP</span>
                        <p class="text-[11px]">{{ $settings['company_tagline'] ?? 'IT System Development • Consulting • Solutions' }}</p>
                    </div>
                </div>

                <div class="flex flex-wrap items-center justify-center gap-4 sm:gap-6">
                    <a href="#services" class="hover:text-white transition-colors">Layanan</a>
                    <a href="#projects" class="hover:text-white transition-colors">Recent Projects</a>
                    <!-- <a href="#gallery" class="hover:text-white transition-colors">Galeri</a> -->
                    <a href="#team" class="hover:text-white transition-colors">Tim & CV</a>
                    <a href="#contact" class="hover:text-white transition-colors">Kontak</a>
                    <!-- <a href="{{ route('admin.dashboard') }}" class="font-semibold underline hover:text-white transition-colors">Panel Admin</a> -->
                </div>

                <p>&copy; {{ date('Y') }} {{ $settings['company_name'] ?? 'AnsaApp' }}. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <!-- Modals & Livewire Components -->
    <livewire:project-modal />
    <livewire:team-cv-modal />
    {{-- <livewire:ai-chat /> --}}

    @livewireScripts

    <!-- Theme Switcher Helper Script -->
    <script>
        function setTheme(theme) {
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('ansa_theme', theme);
        }
    </script>
</body>
</html>
