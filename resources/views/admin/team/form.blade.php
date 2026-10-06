@extends('admin.layout')

@section('title', $member->exists ? 'Edit Anggota Tim & CV' : 'Tambah Anggota Tim')
@section('page_title', $member->exists ? 'Edit Tim & CV: ' . $member->name : 'Tambah Anggota Tim Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8">

    <form 
        action="{{ $member->exists ? route('admin.team.update', $member) : route('admin.team.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @if ($member->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Nama Lengkap & Gelar <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $member->name) }}" 
                    required
                    placeholder="e.g. Iqdal Ansa, S.Kom"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <!-- Role -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Jabatan / Role Spesialisasi <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="role" 
                    value="{{ old('role', $member->role) }}" 
                    required
                    placeholder="e.g. Founder & Principal Solutions Architect"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <!-- Photo -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Foto Profil (Maks 3MB)
            </label>
            <div class="flex items-center gap-4">
                @if ($member->photo)
                    <img src="{{ $member->photo }}" alt="Foto" class="h-16 w-16 object-contain rounded-xl bg-slate-800 border border-slate-700 p-1">
                @endif
                <input 
                    type="file" 
                    name="photo" 
                    accept="image/*"
                    class="text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-500/20 file:text-teal-300 hover:file:bg-teal-500/30 cursor-pointer"
                >
            </div>
        </div>

        <!-- Contacts Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Email Kontak
                </label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $member->email) }}" 
                    placeholder="nama@ansaapp.com"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    No. WhatsApp (Format 628xxx)
                </label>
                <input 
                    type="text" 
                    name="whatsapp" 
                    value="{{ old('whatsapp', $member->whatsapp) }}" 
                    placeholder="6281234567890"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400 font-mono"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    LinkedIn URL
                </label>
                <input 
                    type="url" 
                    name="linkedin" 
                    value="{{ old('linkedin', $member->linkedin) }}" 
                    placeholder="https://linkedin.com/in/username"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    GitHub URL
                </label>
                <input 
                    type="url" 
                    name="github" 
                    value="{{ old('github', $member->github) }}" 
                    placeholder="https://github.com/username"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <!-- Bio / Professional Summary -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Ringkasan Profesional / Bio (CV Summary)
            </label>
            <textarea 
                name="bio" 
                rows="3" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Penjelasan ringkas mengenai reputasi, spesialisasi, dan pengalaman..."
            >{{ old('bio', $member->bio) }}</textarea>
        </div>

        <!-- Technical Skills -->
        @php
            $skillsString = '';
            if (is_array($member->skills)) {
                $skillsString = implode(', ', array_map(function($s) {
                    return ($s['name'] ?? '') . ':' . ($s['level'] ?? 90);
                }, $member->skills));
            }
        @endphp
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Keahlian Teknis / Skills (Format: <code>Skill:Persen</code>, pisahkan dengan koma)
            </label>
            <input 
                type="text" 
                name="skills_raw" 
                value="{{ old('skills_raw', $skillsString) }}" 
                placeholder="Laravel:98, Architecture:95, Docker:90, Vue:92"
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400 font-mono"
            >
            <p class="text-[11px] text-slate-500 mt-1">Contoh: <code>Laravel Framework:98, AWS Cloud:92, DevOps:88</code></p>
        </div>

        <!-- Work Experiences JSON -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Riwayat Pengalaman Kerja (Format JSON)
            </label>
            <textarea 
                name="experiences_raw" 
                rows="5" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs font-mono focus:outline-none focus:border-teal-400"
                placeholder='[{"period":"2022 - Sekarang","role":"Lead Architect","company":"AnsaApp","desc":"Memimpin arsitektur sistem enterprise."}]'
            >{{ old('experiences_raw', !empty($member->experiences) ? json_encode($member->experiences, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
        </div>

        <!-- Educations JSON -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Riwayat Pendidikan & Sertifikasi (Format JSON)
            </label>
            <textarea 
                name="educations_raw" 
                rows="4" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs font-mono focus:outline-none focus:border-teal-400"
                placeholder='[{"year":"2015 - 2019","degree":"S.Kom Teknik Informatika","institution":"Universitas Indonesia","desc":"Cum Laude"}]'
            >{{ old('educations_raw', !empty($member->educations) ? json_encode($member->educations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Urutan Tampil (Order)
            </label>
            <input 
                type="number" 
                name="order" 
                value="{{ old('order', $member->order ?? 0) }}" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
            >
        </div>

        <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.team.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-700 text-xs text-slate-400 hover:text-white">
                Batal
            </a>
            <button 
                type="submit" 
                class="px-6 py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity cursor-pointer shadow-lg shadow-teal-500/20"
            >
                {{ $member->exists ? 'Simpan Perubahan CV Tim' : 'Tambahkan Anggota Tim' }}
            </button>
        </div>
    </form>

</div>
@endsection
