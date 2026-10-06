@extends('admin.layout')

@section('title', $project->exists ? 'Edit Project' : 'Tambah Project Baru')
@section('page_title', $project->exists ? 'Edit Project: ' . $project->title : 'Tambah Project Portofolio Baru')

@section('content')
<div class="max-w-4xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8">

    <form 
        action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="space-y-6"
    >
        @csrf
        @if ($project->exists)
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Title -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Judul Project <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    value="{{ old('title', $project->title) }}" 
                    required
                    placeholder="e.g. Ansa ERP Cloud Enterprise"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <!-- Category -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Kategori Sistem <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="category" 
                    value="{{ old('category', $project->category ?? 'Enterprise System') }}" 
                    required
                    placeholder="e.g. Enterprise System, Mobile & Web App, Fintech"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Client -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Nama Klien / Perusahaan
                </label>
                <input 
                    type="text" 
                    name="client" 
                    value="{{ old('client', $project->client) }}" 
                    placeholder="e.g. PT Global Logistik Nusantara"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <!-- Completion Date -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Waktu / Tanggal Selesai
                </label>
                <input 
                    type="text" 
                    name="completion_date" 
                    value="{{ old('completion_date', $project->completion_date) }}" 
                    placeholder="e.g. Agustus 2026"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Foto / Thumbnail Project (Maks 3MB)
            </label>
            <div class="flex items-center gap-4">
                @if ($project->featured_image)
                    <img src="{{ $project->featured_image }}" alt="Thumbnail" class="h-16 w-24 object-contain rounded-xl bg-slate-800 border border-slate-700 p-1">
                @endif
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-500/20 file:text-teal-300 hover:file:bg-teal-500/30 cursor-pointer"
                >
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Demo URL -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Live Demo Link
                </label>
                <input 
                    type="url" 
                    name="demo_url" 
                    value="{{ old('demo_url', $project->demo_url) }}" 
                    placeholder="https://demo.ansaapp.com/proyek"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <!-- GitHub URL -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    GitHub / Repository URL
                </label>
                <input 
                    type="url" 
                    name="github_url" 
                    value="{{ old('github_url', $project->github_url) }}" 
                    placeholder="https://github.com/ansaapp/proyek"
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>
        </div>

        <!-- Tech Stack -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Tech Stack (Pisahkan dengan koma)
            </label>
            <input 
                type="text" 
                name="tech_stack" 
                value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : '') }}" 
                placeholder="Laravel 12, Livewire 4, Tailwind CSS v4, PostgreSQL, Docker"
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400 font-mono"
            >
        </div>

        <!-- Short Description -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Deskripsi Singkat (Ringkasan di Kartu) <span class="text-rose-500">*</span>
            </label>
            <textarea 
                name="short_description" 
                rows="2" 
                required
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Ringkasan 1-2 kalimat tentang fungsi sistem..."
            >{{ old('short_description', $project->short_description) }}</textarea>
        </div>

        <!-- Full Description -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Deskripsi Lengkap (Tampil di Modal Detail Aplikasi)
            </label>
            <textarea 
                name="full_description" 
                rows="4" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Penjelasan mendalam tentang arsitektur, latar belakang solusi, tantangan, dan performa aplikasi..."
            >{{ old('full_description', $project->full_description) }}</textarea>
        </div>

        <!-- Features Checklist -->
        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Fitur Utama (Satu baris untuk setiap fitur)
            </label>
            <textarea 
                name="features" 
                rows="4" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Real-time Multi-Warehouse Stock Tracking&#10;Otomatisasi Jurnal Keuangan&#10;Export Dokumen PDF Dinamis"
            >{{ old('features', is_array($project->features) ? implode("\n", $project->features) : '') }}</textarea>
        </div>

        <!-- Options: Featured & Order -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Urutan Tampil (Order)
                </label>
                <input 
                    type="number" 
                    name="order" 
                    value="{{ old('order', $project->order ?? 0) }}" 
                    class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                >
            </div>

            <div class="flex items-center pt-6">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input 
                        type="checkbox" 
                        name="is_featured" 
                        value="1" 
                        {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                        class="rounded bg-slate-800 border-slate-700 text-teal-500 focus:ring-0 h-4 w-4"
                    >
                    <span class="text-sm font-semibold text-white">Tandai Sebagai Featured Project</span>
                </label>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.projects.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-700 text-xs text-slate-400 hover:text-white">
                Batal
            </a>
            <button 
                type="submit" 
                class="px-6 py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity cursor-pointer shadow-lg shadow-teal-500/20"
            >
                {{ $project->exists ? 'Simpan Perubahan Project' : 'Tambahkan Project' }}
            </button>
        </div>
    </form>

</div>
@endsection
