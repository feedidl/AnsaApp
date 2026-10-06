@extends('admin.layout')

@section('title', 'Kelola Galeri')
@section('page_title', 'Kelola Galeri Foto & Dokumentasi')

@section('content')
<div class="space-y-8">

    <!-- Upload New Gallery Item Box -->
    <div class="bg-slate-900 border border-slate-800 rounded-3xl p-6">
        <h3 class="text-sm font-bold text-white mb-1">Tambah Foto ke Galeri</h3>
        <p class="text-xs text-slate-400 mb-5">Unggah foto dokumentasi aktivitas tim, sesi konsultasi, perancangan sistem, atau showcase arsitektur</p>

        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-12 gap-4 items-end">
            @csrf

            <div class="md:col-span-4">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Judul Foto <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="title" 
                    required 
                    placeholder="e.g. Sesi Diskusi Arsitektur Klien"
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs focus:outline-none focus:border-teal-400"
                >
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    Kategori <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    name="category" 
                    required 
                    placeholder="e.g. Konsultasi IT, Team, Workshop"
                    class="w-full px-4 py-2.5 rounded-xl bg-slate-800 border border-slate-700 text-white text-xs focus:outline-none focus:border-teal-400"
                >
            </div>

            <div class="md:col-span-3">
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-400 mb-1.5">
                    File Foto (Maks 4MB) <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="file" 
                    name="image" 
                    accept="image/*"
                    class="w-full text-xs text-slate-400 file:mr-2 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-[11px] file:font-semibold file:bg-teal-500/20 file:text-teal-300 hover:file:bg-teal-500/30 cursor-pointer"
                >
            </div>

            <div class="md:col-span-2">
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity cursor-pointer"
                >
                    Unggah Foto
                </button>
            </div>
        </form>
    </div>

    <!-- Gallery Grid -->
    <div>
        <h3 class="text-sm font-bold text-white mb-4">Koleksi Foto Saat Ini ({{ count($galleries) }})</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($galleries as $gal)
                <div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden group flex flex-col justify-between">
                    <div>
                        <div class="h-44 w-full bg-slate-800/80 p-4 flex items-center justify-center relative overflow-hidden">
                            <img src="{{ $gal->image_url ?: '/storage/images/logo/logo.png' }}" 
                                 alt="{{ $gal->title }}" 
                                 class="max-h-full max-w-full object-contain filter drop-shadow">
                            <span class="absolute top-3 left-3 px-2 py-0.5 rounded-full bg-slate-900/80 border border-slate-700 text-[10px] text-teal-300 font-semibold">
                                {{ $gal->category }}
                            </span>
                        </div>
                        <div class="p-4">
                            <h4 class="text-xs font-bold text-white line-clamp-1">{{ $gal->title }}</h4>
                            @if ($gal->description)
                                <p class="text-[11px] text-slate-400 line-clamp-2 mt-1">{{ $gal->description }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="p-4 pt-0 flex justify-end border-t border-slate-800/60 mt-2">
                        <form action="{{ route('admin.gallery.destroy', $gal) }}" method="POST" onsubmit="return confirm('Hapus foto ini dari galeri?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs text-rose-400 hover:text-rose-300 font-semibold cursor-pointer">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full p-12 text-center text-slate-500 bg-slate-900 border border-slate-800 rounded-3xl">
                    Belum ada foto di galeri. Gunakan form di atas untuk mengunggah foto.
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
