@extends('admin.layout')

@section('title', 'Pengaturan Website')
@section('page_title', 'Pengaturan Profil Perusahaan & Kontak')

@section('content')
<div class="max-w-4xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8">

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf

        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-sm font-bold text-white">Identitas & Profil Platform</h3>
            <p class="text-xs text-slate-400">Informasi utama yang ditampilkan pada website publik</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Nama Perusahaan / Platform
                </label>
                <input 
                    type="text" 
                    name="company_name" 
                    value="{{ old('company_name', $settings['company_name'] ?? 'AnsaApp') }}" 
                    required
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Tagline
                </label>
                <input 
                    type="text" 
                    name="company_tagline" 
                    value="{{ old('company_tagline', $settings['company_tagline'] ?? 'IT System Development • Consulting • Solutions') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Deskripsi Perusahaan (Tentang AnsaApp)
            </label>
            <textarea 
                name="company_description" 
                rows="3" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
            >{{ old('company_description', $settings['company_description'] ?? '') }}</textarea>
        </div>

        <div class="border-b border-slate-800 pb-4 pt-4">
            <h3 class="text-sm font-bold text-white">Kontak Resmi & Alamat Kantor</h3>
            <p class="text-xs text-slate-400">Digunakan pada tombol kontak dan integrasi pesan WhatsApp</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    No. WhatsApp (Format 628xxx)
                </label>
                <input 
                    type="text" 
                    name="company_whatsapp" 
                    value="{{ old('company_whatsapp', $settings['company_whatsapp'] ?? '6281234567890') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm font-mono focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    No. Telepon Tampilan
                </label>
                <input 
                    type="text" 
                    name="company_phone" 
                    value="{{ old('company_phone', $settings['company_phone'] ?? '+62 812-3456-7890') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Email Resmi
                </label>
                <input 
                    type="email" 
                    name="company_email" 
                    value="{{ old('company_email', $settings['company_email'] ?? 'contact@ansaapp.com') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Alamat Fisik Kantor
            </label>
            <input 
                type="text" 
                name="company_address" 
                value="{{ old('company_address', $settings['company_address'] ?? '') }}" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
            >
        </div>

        <div class="border-b border-slate-800 pb-4 pt-4">
            <h3 class="text-sm font-bold text-white">Media Sosial</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Instagram URL
                </label>
                <input 
                    type="url" 
                    name="social_instagram" 
                    value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    LinkedIn URL
                </label>
                <input 
                    type="url" 
                    name="social_linkedin" 
                    value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    GitHub URL
                </label>
                <input 
                    type="url" 
                    name="social_github" 
                    value="{{ old('social_github', $settings['social_github'] ?? '') }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <div class="pt-6 border-t border-slate-800 flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity cursor-pointer shadow-lg shadow-teal-500/20"
            >
                Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>

</div>
@endsection
