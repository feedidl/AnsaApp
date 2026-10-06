@extends('admin.layout')

@section('title', 'Dashboard')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Projects Card -->
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-400">Total Projects</p>
                <h3 class="text-2xl font-extrabold text-white mt-1">{{ $stats['projects'] }}</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-[11px] text-teal-400 hover:underline mt-2 inline-block">Kelola Projects &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center font-bold">
                P
            </div>
        </div>

        <!-- Services Card -->
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-400">Layanan Aktif</p>
                <h3 class="text-2xl font-extrabold text-white mt-1">{{ $stats['services'] }}</h3>
                <a href="{{ route('admin.services.index') }}" class="text-[11px] text-cyan-400 hover:underline mt-2 inline-block">Kelola Services &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 text-cyan-400 flex items-center justify-center font-bold">
                S
            </div>
        </div>

        <!-- Team Card -->
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-400">Anggota Tim & CV</p>
                <h3 class="text-2xl font-extrabold text-white mt-1">{{ $stats['team'] }}</h3>
                <a href="{{ route('admin.team.index') }}" class="text-[11px] text-indigo-400 hover:underline mt-2 inline-block">Kelola Tim &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center font-bold">
                T
            </div>
        </div>

        <!-- Unread Contacts Card -->
        <div class="p-5 rounded-2xl bg-slate-900 border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold uppercase text-slate-400">Pesan Belum Dibaca</p>
                <h3 class="text-2xl font-extrabold {{ $stats['unread_contacts'] > 0 ? 'text-amber-400' : 'text-white' }} mt-1">
                    {{ $stats['unread_contacts'] }}
                </h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-[11px] text-amber-400 hover:underline mt-2 inline-block">Buka Kotak Masuk &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center font-bold">
                ✉
            </div>
        </div>
    </div>

    <!-- Quick Shortcuts & Recent Projects -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Recent Projects Table -->
        <div class="lg:col-span-7 bg-slate-900 border border-slate-800 rounded-3xl p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-bold text-white">Recent Projects Terakhir</h3>
                <a href="{{ route('admin.projects.create') }}" class="text-xs font-bold text-teal-400 hover:underline">+ Tambah Project</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="border-b border-slate-800 text-slate-400">
                            <th class="pb-3 font-semibold">Judul Project</th>
                            <th class="pb-3 font-semibold">Kategori</th>
                            <th class="pb-3 font-semibold">Klien</th>
                            <th class="pb-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800/60">
                        @forelse ($recent_projects as $p)
                            <tr>
                                <td class="py-3 font-semibold text-white">{{ $p->title }}</td>
                                <td class="py-3 text-slate-300">
                                    <span class="px-2 py-0.5 rounded-full bg-slate-800 text-[10px] text-teal-300">{{ $p->category }}</span>
                                </td>
                                <td class="py-3 text-slate-400">{{ $p->client ?? '-' }}</td>
                                <td class="py-3 text-right">
                                    <a href="{{ route('admin.projects.edit', $p) }}" class="text-teal-400 hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-6 text-center text-slate-500">Belum ada project yang ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Contact Inquiries -->
        <div class="lg:col-span-5 bg-slate-900 border border-slate-800 rounded-3xl p-6">
            <div class="flex items-center justify-between mb-5">
                <h3 class="text-sm font-bold text-white">Pesan Masuk Terbaru</h3>
                <a href="{{ route('admin.contacts.index') }}" class="text-xs text-slate-400 hover:text-white">Lihat Semua</a>
            </div>

            <div class="space-y-3">
                @forelse ($recent_contacts as $c)
                    <div class="p-3.5 rounded-2xl border {{ $c->is_read ? 'bg-slate-800/30 border-slate-800' : 'bg-teal-950/20 border-teal-500/30' }}">
                        <div class="flex items-center justify-between text-xs mb-1">
                            <span class="font-bold text-white">{{ $c->name }}</span>
                            <span class="text-[10px] text-slate-400">{{ $c->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs font-medium text-teal-400">{{ $c->subject }}</p>
                        <p class="text-[11px] text-slate-400 line-clamp-2 mt-1">{{ $c->message }}</p>
                    </div>
                @empty
                    <p class="text-xs text-slate-500 text-center py-6">Belum ada pesan masuk.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
