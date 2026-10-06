@extends('admin.layout')

@section('title', $service->exists ? 'Edit Layanan' : 'Tambah Layanan Baru')
@section('page_title', $service->exists ? 'Edit Layanan: ' . $service->title : 'Tambah Layanan Baru')

@section('content')
<div class="max-w-3xl mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-8">

    <form 
        action="{{ $service->exists ? route('admin.services.update', $service) : route('admin.services.store') }}" 
        method="POST" 
        class="space-y-6"
    >
        @csrf
        @if ($service->exists)
            @method('PUT')
        @endif

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Nama Layanan <span class="text-rose-500">*</span>
            </label>
            <input 
                type="text" 
                name="title" 
                value="{{ old('title', $service->title) }}" 
                required
                placeholder="e.g. Development Aplikasi Web & Mobile"
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
            >
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Deskripsi Singkat <span class="text-rose-500">*</span>
            </label>
            <textarea 
                name="short_description" 
                rows="3" 
                required
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Jelaskan ringkasan cakupan layanan ini..."
            >{{ old('short_description', $service->short_description) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Fitur / Poin Utama (Satu baris untuk setiap poin fitur)
            </label>
            <textarea 
                name="features" 
                rows="5" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
                placeholder="Aplikasi Web Enterprise & Portal Bisnis&#10;Mobile Apps Multi-platform&#10;Integrasi REST API & Microservices"
            >{{ old('features', is_array($service->features) ? implode("\n", $service->features) : '') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                Urutan Tampil (Order)
            </label>
            <input 
                type="number" 
                name="order" 
                value="{{ old('order', $service->order ?? 0) }}" 
                class="w-full px-4 py-3 rounded-xl bg-slate-800 border border-slate-700 text-white text-sm focus:outline-none focus:border-teal-400"
            >
        </div>

        <div class="pt-6 border-t border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.services.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-700 text-xs text-slate-400 hover:text-white">
                Batal
            </a>
            <button 
                type="submit" 
                class="px-6 py-3 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity cursor-pointer shadow-lg shadow-teal-500/20"
            >
                {{ $service->exists ? 'Simpan Perubahan Layanan' : 'Tambahkan Layanan' }}
            </button>
        </div>
    </form>

</div>
@endsection
