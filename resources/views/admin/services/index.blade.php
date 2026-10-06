@extends('admin.layout')

@section('title', 'Kelola Layanan')
@section('page_title', 'Kelola Layanan (Services)')

@section('content')
<div class="space-y-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-white">Daftar Layanan TI</h2>
            <p class="text-xs text-slate-400">Development aplikasi, konsultasi IT, infrastruktur cloud & integrasi</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity">
            + Tambah Layanan Baru
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-800/60 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Judul Layanan</th>
                        <th class="px-6 py-4 font-semibold">Deskripsi Singkat</th>
                        <th class="px-6 py-4 font-semibold">Fitur / Poin</th>
                        <th class="px-6 py-4 font-semibold">Order</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($services as $service)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-sm">{{ $service->title }}</div>
                                <div class="text-[10px] text-teal-400 font-mono">{{ $service->slug }}</div>
                            </td>
                            <td class="px-6 py-4 max-w-sm">
                                <p class="text-slate-300 line-clamp-2 leading-relaxed">{{ $service->short_description }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded-full bg-slate-800 text-[11px] text-teal-300">
                                    {{ is_array($service->features) ? count($service->features) : 0 }} Fitur
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-slate-400">{{ $service->order }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 text-teal-400 hover:text-white border border-slate-700 text-xs font-semibold">
                                    Edit
                                </a>
                                <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus layanan ini?')">
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
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                                Belum ada layanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
