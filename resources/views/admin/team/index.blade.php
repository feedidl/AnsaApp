@extends('admin.layout')

@section('title', 'Kelola Tim & CV')
@section('page_title', 'Kelola Anggota Tim & Data CV')

@section('content')
<div class="space-y-6">

    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-white">Daftar Anggota Tim & CV</h2>
            <p class="text-xs text-slate-400">Kelola profil, riwayat karier, sertifikasi pendidikan, dan keahlian teknis</p>
        </div>
        <a href="{{ route('admin.team.create') }}" class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-teal-500 to-cyan-500 hover:opacity-90 transition-opacity">
            + Tambah Anggota Tim
        </a>
    </div>

    <div class="bg-slate-900 border border-slate-800 rounded-3xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-800/60 text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Foto</th>
                        <th class="px-6 py-4 font-semibold">Nama & Jabatan</th>
                        <th class="px-6 py-4 font-semibold">Kontak & Sosial</th>
                        <th class="px-6 py-4 font-semibold">Skills & Riwayat</th>
                        <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($team as $member)
                        <tr class="hover:bg-slate-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <img src="{{ $member->photo ?: '/storage/images/logo/logo.png' }}" 
                                     alt="{{ $member->name }}" 
                                     class="h-11 w-11 object-contain rounded-xl bg-slate-800 border border-slate-700 p-1">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-white text-sm">{{ $member->name }}</div>
                                <div class="text-[11px] text-teal-400">{{ $member->role }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                <div>{{ $member->email ?? '-' }}</div>
                                <div class="text-[10px] text-emerald-400 font-mono">WA: {{ $member->whatsapp ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-400">
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-0.5 rounded-md bg-slate-800 text-[10px] text-slate-300">
                                        {{ is_array($member->skills) ? count($member->skills) : 0 }} Skills
                                    </span>
                                    <span class="px-2 py-0.5 rounded-md bg-slate-800 text-[10px] text-slate-300">
                                        {{ is_array($member->experiences) ? count($member->experiences) : 0 }} Pengalaman
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.team.edit', $member) }}" class="px-3 py-1.5 rounded-lg bg-slate-800 text-teal-400 hover:text-white border border-slate-700 text-xs font-semibold">
                                    Edit & CV
                                </a>
                                <form action="{{ route('admin.team.destroy', $member) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus anggota tim ini?')">
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
                                Belum ada anggota tim.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
