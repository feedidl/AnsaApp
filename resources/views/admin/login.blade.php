<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Panel Admin - AnsaApp</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex items-center justify-center p-6 antialiased font-sans relative overflow-hidden">

    <!-- Glow background -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-teal-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md p-8 rounded-3xl bg-slate-900/80 border border-slate-800 shadow-2xl backdrop-blur-xl relative z-10">
        
        <div class="text-center mb-8">
            <div class="h-14 w-14 mx-auto p-2 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center mb-4 shadow-lg">
                <img src="/storage/images/logo/logo.png" alt="AnsaApp" class="h-10 w-auto object-contain">
            </div>
            <h1 class="text-2xl font-extrabold text-white">AnsaPanel Admin</h1>
            <p class="text-xs text-slate-400 mt-1">Masuk untuk mengelola portofolio, layanan, proyek, & pesan</p>
        </div>

        @if ($errors->any())
            <div class="p-4 mb-6 rounded-xl bg-rose-950/60 border border-rose-500/40 text-rose-300 text-xs">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Alamat Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    placeholder="email anda"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400 transition-colors"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    value=""
                    required 
                    placeholder="••••••••"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400 transition-colors"
                >
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-slate-400">
                    <input type="checkbox" name="remember" class="rounded bg-slate-800 border-slate-700 text-teal-500 focus:ring-0">
                    <span>Ingat saya di perangkat ini</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full py-3.5 px-6 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-400 hover:to-cyan-400 transition-all shadow-lg shadow-teal-500/20 cursor-pointer"
            >
                Masuk ke Panel
            </button>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-800 text-center">
            <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-teal-400 transition-colors">
                &larr; Kembali ke Website Utama
            </a>
        </div>
    </div>

</body>
</html>
