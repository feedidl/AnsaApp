@extends('admin.layout')

@section('title', 'Pesan Masuk')
@section('page_title', 'Kotak Masuk Kontak & Permohonan Konsultasi')

@section('content')
<div class="space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Daftar Pesan dari Form Kontak</h2>
            <p class="text-xs text-slate-400">Pesan dan penawaran kerja sama yang dikirimkan pengunjung website</p>
        </div>
    </div>

    <div class="space-y-4">
        @forelse ($contacts as $contact)
            <div class="p-6 rounded-3xl border transition-all {{ $contact->is_read ? 'bg-slate-900 border-slate-800' : 'bg-slate-900/90 border-teal-500/50 shadow-lg shadow-teal-500/5' }}">
                <div class="flex flex-wrap items-start justify-between gap-4 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm {{ $contact->is_read ? 'bg-slate-800 text-slate-400' : 'bg-teal-500/20 text-teal-300' }}">
                            {{ strtoupper(substr($contact->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="text-sm font-bold text-white">{{ $contact->name }}</h4>
                                @if (!$contact->is_read)
                                    <span class="px-2 py-0.5 rounded-full bg-teal-950 text-teal-400 text-[10px] font-bold border border-teal-800">
                                        BARU
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center gap-3 text-xs text-slate-400 mt-0.5">
                                <span>{{ $contact->email }}</span>
                                @if ($contact->phone)
                                    <span>• WA: {{ $contact->phone }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="text-right text-xs text-slate-500">
                        {{ $contact->created_at->format('d M Y, H:i') }} ({{ $contact->created_at->diffForHumans() }})
                    </div>
                </div>

                <!-- Subject -->
                <div class="mb-2">
                    <span class="text-xs font-semibold text-teal-400">Topik: {{ $contact->subject }}</span>
                </div>

                <!-- Message Body -->
                <div class="p-4 rounded-2xl bg-slate-800/60 border border-slate-700/60 text-xs text-slate-300 leading-relaxed mb-4 whitespace-pre-line">
                    {{ $contact->message }}
                </div>

                <!-- Actions -->
                <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-800 text-xs">
                    <div class="flex items-center gap-3">
                        <a href="mailto:{{ $contact->email }}?subject=Re:%20{{ urlencode($contact->subject) }}%20-%20AnsaApp" 
                           class="px-3.5 py-1.5 rounded-xl bg-teal-500/10 text-teal-400 hover:bg-teal-500/20 font-semibold border border-teal-500/30">
                            Balas via Email
                        </a>

                        @if ($contact->phone)
                            @php
                                $cleanPhone = preg_replace('/[^0-9]/', '', $contact->phone);
                                if (str_starts_with($cleanPhone, '0')) {
                                    $cleanPhone = '62' . substr($cleanPhone, 1);
                                }
                            @endphp
                            <a href="https://wa.me/{{ $cleanPhone }}?text=Halo%20{{ urlencode($contact->name) }},%20kami%20dari%20tim%20AnsaApp%20menanggapi%20permohonan%20konsultasi%20Anda." 
                               target="_blank"
                               class="px-3.5 py-1.5 rounded-xl bg-emerald-500/10 text-emerald-400 hover:bg-emerald-500/20 font-semibold border border-emerald-500/30">
                                Chat via WhatsApp
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        @if (!$contact->is_read)
                            <form action="{{ route('admin.contacts.read', $contact) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-slate-400 hover:text-white cursor-pointer font-medium">
                                    Tandai Sudah Dibaca
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-rose-400 hover:text-rose-300 cursor-pointer font-medium">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-12 text-center text-slate-500 bg-slate-900 border border-slate-800 rounded-3xl">
                Belum ada pesan yang masuk.
            </div>
        @endforelse

        @if ($contacts->hasPages())
            <div class="pt-4">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
