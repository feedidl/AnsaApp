@extends('admin.layout')

@section('page_title', 'Profil & Keamanan Akun')

@section('content')
<div class="space-y-6 max-w-5xl">
    
    <!-- Header Banner -->
    <div class="p-6 rounded-2xl bg-gradient-to-r from-slate-900 via-slate-800 to-teal-950/40 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-teal-400 to-cyan-600 flex items-center justify-center text-slate-950 font-extrabold text-xl shadow-lg shadow-teal-500/20 shrink-0">
                {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-white">{{ $user->name }}</h2>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-xs text-teal-400 font-mono">{{ $user->email }}</span>
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-teal-500/10 text-teal-300 border border-teal-500/30 font-semibold uppercase tracking-wider">
                        Administrator
                    </span>
                </div>
            </div>
        </div>
        <div class="text-xs text-slate-400">
            Terdaftar sejak: <span class="text-slate-200 font-medium">{{ $user->created_at ? $user->created_at->format('d M Y') : 'N/A' }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Card 1: Edit Informasi Profil -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col justify-between">
            <div>
                <div class="flex items-center gap-3 pb-4 mb-5 border-b border-slate-800">
                    <div class="w-9 h-9 rounded-xl bg-teal-500/10 border border-teal-500/30 flex items-center justify-center text-teal-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Informasi Profil</h3>
                        <p class="text-[11px] text-slate-400">Perbarui nama lengkap dan alamat email akun admin Anda.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.update') }}" class="space-y-4" id="form-profile">
                    @csrf
                    @method('PUT')

                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-rose-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $user->name) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all"
                            placeholder="e.g. Administrator AnsaApp"
                        >
                        @error('name')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Alamat Email <span class="text-rose-400">*</span>
                        </label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email', $user->email) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500 transition-all font-mono"
                            placeholder="admin@ansaapp.my.id"
                        >
                        @error('email')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-teal-500 hover:bg-teal-400 text-slate-950 font-bold text-xs tracking-wide transition-all shadow-md shadow-teal-500/20 flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span>Simpan Perubahan Profil</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Card 2: Ganti Password -->
        <div class="p-6 rounded-2xl bg-slate-900 border border-slate-800 flex flex-col justify-between"
             x-data="{ showCurrent: false, showNew: false, showConfirm: false }">
            <div>
                <div class="flex items-center gap-3 pb-4 mb-5 border-b border-slate-800">
                    <div class="w-9 h-9 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Ganti Password</h3>
                        <p class="text-[11px] text-slate-400">Gunakan kombinasi password yang kuat untuk menjaga keamanan akun.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.profile.password') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Password Saat Ini <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                :type="showCurrent ? 'text' : 'password'" 
                                id="current_password" 
                                name="current_password" 
                                required
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all"
                                placeholder="Masukkan password yang aktif saat ini"
                            >
                            <button 
                                type="button" 
                                @click="showCurrent = !showCurrent" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-200 cursor-pointer"
                                tabindex="-1"
                            >
                                <svg x-show="!showCurrent" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showCurrent" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Password Baru <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                :type="showNew ? 'text' : 'password'" 
                                id="password" 
                                name="password" 
                                required
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all"
                                placeholder="Minimal 8 karakter"
                            >
                            <button 
                                type="button" 
                                @click="showNew = !showNew" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-200 cursor-pointer"
                                tabindex="-1"
                            >
                                <svg x-show="!showNew" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showNew" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1.5">
                            Ulangi Password Baru <span class="text-rose-400">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                :type="showConfirm ? 'text' : 'password'" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                                class="w-full pl-3.5 pr-10 py-2.5 rounded-xl bg-slate-800/80 border border-slate-700 text-white text-sm focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all"
                                placeholder="Ketik ulang password baru"
                            >
                            <button 
                                type="button" 
                                @click="showConfirm = !showConfirm" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-200 cursor-pointer"
                                tabindex="-1"
                            >
                                <svg x-show="!showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg x-show="showConfirm" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs tracking-wide transition-all shadow-md shadow-amber-500/20 flex items-center justify-center gap-2 cursor-pointer"
                        >
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <span>Perbarui Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Security Tips Card -->
    <div class="p-5 rounded-2xl bg-slate-900/60 border border-slate-800 flex items-start gap-3.5 text-xs text-slate-400">
        <svg class="w-5 h-5 text-teal-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div class="space-y-1">
            <p class="font-semibold text-slate-200">Tips Keamanan Akun:</p>
            <p>Pastikan password terdiri dari minimal 8 karakter dengan perpaduan huruf besar, huruf kecil, angka, dan simbol. Jangan berikan akses akun Anda kepada pihak yang tidak berwenang.</p>
        </div>
    </div>

</div>
@endsection
