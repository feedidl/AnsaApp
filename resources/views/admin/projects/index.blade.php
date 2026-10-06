@extends('admin.layout')

@section('title', 'Kelola Projects')
@section('page_title', 'Kelola Recent Projects')

@section('content')
<div class="space-y-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-white">Daftar Project Portofolio</h2>
            <p class="text-xs text-slate-400">Kelola karya, deskripsi aplikasi, tech stack, dan studi kasus</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity">
            + Tambah Project Baru
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-800/60 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Thumbnail</th>
                        <th class="px-6 py-4 font-semibold">Judul Project</th>
                        <th class="px-6 py-4 font-semibold">Kategori</th>
                        <th class="px-6 py-4 font-semibold">Klien / Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Featured</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($projects as $project)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ $project->featured_image ?: '/storage/images/logo/logo.png' }}" 
                                     alt="{{ $project->title }}" 
                                     class="h-10 w-16 object-contain rounded-lg bg-slate-800 border border-slate-700 p-1">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-sm">{{ $project->title }}</div>
                                <div class="text-[11px] text-slate-400 line-clamp-1 max-w-xs">{{ $project->short_description }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full bg-slate-800 text-[11px] text-teal-300 font-medium">
                                    {{ $project->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                <div>{{ $project->client ?? '-' }}</div>
                                <div class="text-[10px] text-slate-500">{{ $project->completion_date ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">
                                @if ($project->is_featured)
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-950 text-emerald-300 border border-emerald-800 text-[10px] font-semibold">Featured</span>
                                @else
                                    <span class="text-slate-500 text-[11px]">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 grid grid-rows-2 gap-1">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 text-teal-400 hover:text-white border border-slate-700 text-xs font-semibold">
                                    Edit
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-950/40 text-rose-400 hover:text-white border border-rose-800/40 text-xs font-semibold cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                Belum ada project portofolio. Silakan klik "Tambah Project Baru".
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($projects->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $projects->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
