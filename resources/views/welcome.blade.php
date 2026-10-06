<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'AnsaApp') }} - Laravel + Tailwind CSS + Livewire</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

        <!-- Vite & Tailwind CSS -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-slate-950 text-slate-100 font-sans antialiased min-h-screen selection:bg-cyan-500 selection:text-white flex flex-col justify-between relative overflow-x-hidden">
        <!-- Background Glow Accents -->
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute -top-40 -left-40 w-96 h-96 bg-red-500/15 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 -right-40 w-96 h-96 bg-cyan-500/15 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-40 left-1/3 w-96 h-96 bg-indigo-500/15 rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 flex flex-col min-h-screen">
            <!-- Header Navbar -->
            <header class="border-b border-slate-800/80 bg-slate-950/70 backdrop-blur-xl sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-red-600 via-rose-500 to-amber-500 flex items-center justify-center shadow-lg shadow-red-500/20">
                            <span class="text-white font-extrabold text-lg">A</span>
                        </div>
                        <span class="text-lg font-bold tracking-tight text-white">Ansa<span class="text-cyan-400">App</span></span>
                    </div>

                    <div class="flex items-center gap-3 text-xs">
                        <span class="px-2.5 py-1 rounded-md bg-slate-800/80 border border-slate-700/60 text-slate-300 font-mono">
                            Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                        </span>
                        <span class="px-2.5 py-1 rounded-md bg-slate-800/80 border border-slate-700/60 text-slate-300 font-mono">
                            PHP v{{ PHP_VERSION }}
                        </span>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <main class="flex-1 flex flex-col items-center justify-center px-6 py-12">
                <div class="max-w-4xl w-full text-center space-y-6 mb-12">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-slate-900 border border-slate-800 text-xs font-medium text-slate-300 shadow-inner">
                        <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        Project Siap Digunakan
                    </div>

                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-white leading-tight">
                        Laravel + 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-sky-400">Tailwind CSS</span> + 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-rose-400">Livewire</span>
                    </h1>

                    <p class="text-slate-400 text-base sm:text-lg max-w-2xl mx-auto leading-relaxed">
                        Inisialisasi berhasil dengan versi paling baru. Stack full-stack reaktif modern untuk web app berkinerja tinggi.
                    </p>
                </div>

                <!-- Livewire Interactive Component Demo -->
                <div class="w-full max-w-md mb-16">
                    <livewire:counter />
                </div>

                <!-- Features Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl w-full">
                    <!-- Laravel Card -->
                    <div class="p-6 rounded-2xl bg-slate-900/40 border border-slate-800/80 hover:border-red-500/40 transition-colors group">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 text-red-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-105 transition-transform">
                            L
                        </div>
                        <h2 class="text-base font-semibold text-white mb-1">Laravel 12</h2>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Framework PHP mutakhir dengan routing modern, Eloquent ORM, dan arsitektur yang tangguh.
                        </p>
                    </div>

                    <!-- Tailwind Card -->
                    <div class="p-6 rounded-2xl bg-slate-900/40 border border-slate-800/80 hover:border-cyan-500/40 transition-colors group">
                        <div class="w-10 h-10 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-105 transition-transform">
                            T
                        </div>
                        <h2 class="text-base font-semibold text-white mb-1">Tailwind CSS v4</h2>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Mesin styling generasi baru dengan `@tailwindcss/vite`, kompilasi instan tanpa konfigurasi rumit.
                        </p>
                    </div>

                    <!-- Livewire Card -->
                    <div class="p-6 rounded-2xl bg-slate-900/40 border border-slate-800/80 hover:border-pink-500/40 transition-colors group">
                        <div class="w-10 h-10 rounded-xl bg-pink-500/10 text-pink-400 flex items-center justify-center font-bold text-lg mb-4 group-hover:scale-105 transition-transform">
                            ⚡
                        </div>
                        <h2 class="text-base font-semibold text-white mb-1">Livewire 4</h2>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Komponen UI reaktif full-stack langsung dari Blade tanpa perlu menulis JavaScript kompleks.
                        </p>
                    </div>
                </div>
            </main>

            <!-- Footer -->
            <footer class="border-t border-slate-900 py-6 text-center text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} AnsaApp. Dibuat dengan Laravel, Tailwind CSS, dan Livewire.</p>
            </footer>
        </div>

        @livewireScripts
    </body>
</html>
