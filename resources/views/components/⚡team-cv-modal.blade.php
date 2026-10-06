<?php

use App\Models\TeamMember;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public bool $isOpen = false;
    public ?TeamMember $member = null;

    #[On('open-team-cv-modal')]
    public function openMember(int $id): void
    {
        $this->member = TeamMember::find($id);
        if ($this->member) {
            $this->isOpen = true;
        }
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->member = null;
    }
};
?>

<div>
    @if ($isOpen && $member)
        <div 
            class="fixed inset-0 z-50 overflow-y-auto" 
            role="dialog" 
            aria-modal="true"
            @keydown.escape.window="$wire.closeModal()"
        >
            <!-- Backdrop -->
            <div 
                wire:click="closeModal" 
                class="fixed inset-0 bg-black/85 backdrop-blur-md transition-opacity"
            ></div>

            <!-- Modal Dialog Container -->
            <div class="min-h-screen px-3 sm:px-4 text-center flex items-center justify-center py-6 sm:py-8">
                <div 
                    class="inline-block w-full max-w-3xl p-5 sm:p-8 my-auto text-left align-middle transition-all transform rounded-3xl shadow-2xl relative border max-h-[90vh] overflow-y-auto"
                    style="background-color: var(--bg-surface); border-color: var(--border-subtle); color: var(--text-primary);"
                >
                    <!-- Close Button -->
                    <button 
                        wire:click="closeModal"
                        class="absolute top-4 right-4 sm:top-5 sm:right-5 w-9 h-9 sm:w-10 sm:h-10 rounded-full flex items-center justify-center transition-colors cursor-pointer border"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                        title="Tutup CV"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Top Profile Header (CV Header) -->
                    <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-4 sm:gap-5 pb-5 sm:pb-6 border-b" style="border-color: var(--border-subtle);">
                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 rounded-2xl overflow-hidden shrink-0 border p-2 flex items-center justify-center"
                             style="background: linear-gradient(135deg, var(--bg-surface-card), var(--bg-surface-elevated)); border-color: var(--border-subtle);">
                            <img 
                                src="{{ $member->photo ?: '/storage/images/logo/logo.png' }}" 
                                alt="{{ $member->name }}" 
                                class="w-full h-full object-contain filter drop-shadow-md"
                                onerror="this.src='/storage/images/logo/logo.png'"
                            >
                        </div>
                        <div class="space-y-1 sm:space-y-1.5 flex-1 pr-0 sm:pr-8">
                            <span 
                                class="px-2.5 py-0.5 rounded-full text-[10px] sm:text-xs font-semibold uppercase tracking-wider border inline-block"
                                style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);"
                            >
                                Curriculum Vitae
                            </span>
                            <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold leading-snug" style="color: var(--text-primary);">
                                {{ $member->name }}
                            </h2>
                            <p class="text-xs sm:text-sm font-medium" style="color: var(--brand-primary-light);">
                                {{ $member->role }}
                            </p>
                        </div>
                    </div>

                    <!-- Contact & Social Direct Links -->
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 sm:gap-3 py-3 sm:py-4 border-b text-xs" style="border-color: var(--border-subtle);">
                        @if ($member->email)
                            <a href="mailto:{{ $member->email }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors hover:text-white"
                               style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span>{{ $member->email }}</span>
                            </a>
                        @endif
                        @if ($member->whatsapp)
                            <a href="https://wa.me/{{ $member->whatsapp }}?text=Halo%20{{ urlencode($member->name) }},%20saya%20ingin%20berkonsultasi%20terkait%20solusi%20IT%20AnsaApp." target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors hover:text-white"
                               style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 shrink-0"></span>
                                <span>WhatsApp Direct</span>
                            </a>
                        @endif
                        @if ($member->linkedin)
                            <a href="{{ $member->linkedin }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors hover:text-white"
                               style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                <span>LinkedIn Profile</span>
                            </a>
                        @endif
                        @if ($member->github)
                            <a href="{{ $member->github }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border transition-colors hover:text-white"
                               style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                <span>GitHub</span>
                            </a>
                        @endif
                    </div>

                    <!-- Summary & Bio -->
                    @if ($member->bio)
                        <div class="py-4 sm:py-5">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--text-muted);">
                                Ringkasan Profesional (Professional Summary)
                            </h4>
                            <p class="text-xs sm:text-sm leading-relaxed" style="color: var(--text-secondary);">
                                {{ $member->bio }}
                            </p>
                        </div>
                    @endif

                    <!-- Technical Skills & Competencies -->
                    @if (!empty($member->skills))
                        <div class="py-4 sm:py-5 border-t" style="border-color: var(--border-subtle);">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-3.5 sm:mb-4" style="color: var(--text-muted);">
                                Keahlian Teknis & Kemahiran (Technical Skills)
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-4">
                                @foreach ($member->skills as $skill)
                                    <div>
                                        <div class="flex justify-between items-center text-xs mb-1">
                                            <span class="font-medium" style="color: var(--text-primary);">{{ $skill['name'] }}</span>
                                            <span class="font-mono font-semibold" style="color: var(--brand-primary-light);">{{ $skill['level'] }}%</span>
                                        </div>
                                        <div class="w-full h-2 rounded-full overflow-hidden" style="background-color: var(--bg-surface-elevated);">
                                            <div 
                                                class="h-full rounded-full transition-all duration-1000"
                                                style="width: {{ $skill['level'] }}%; background: linear-gradient(90deg, var(--brand-primary), var(--brand-accent));"
                                            ></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Work Experiences Timeline -->
                    @if (!empty($member->experiences))
                        <div class="py-4 sm:py-5 border-t" style="border-color: var(--border-subtle);">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-3.5 sm:mb-4" style="color: var(--text-muted);">
                                Riwayat Pengalaman Kerja (Career Experience)
                            </h4>
                            <div class="space-y-3.5 sm:space-y-4">
                                @foreach ($member->experiences as $exp)
                                    <div class="flex items-start gap-3 sm:gap-4">
                                        <div class="w-4 h-4 sm:w-5 sm:h-5 rounded-full shrink-0 flex items-center justify-center border mt-1"
                                             style="background-color: var(--bg-surface-elevated); border-color: var(--brand-primary-light);">
                                            <div class="w-1.5 h-1.5 sm:w-2 sm:h-2 rounded-full" style="background-color: var(--brand-primary-light);"></div>
                                        </div>
                                        <div class="flex-1 p-3 sm:p-4 rounded-2xl border"
                                             style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle);">
                                            <div class="flex flex-wrap items-center justify-between gap-1 mb-1">
                                                <h5 class="text-xs sm:text-sm font-bold" style="color: var(--text-primary);">
                                                    {{ $exp['role'] }}
                                                </h5>
                                                <span class="text-[10px] sm:text-xs font-mono px-2 py-0.5 rounded-md border"
                                                      style="background-color: var(--bg-surface-card); border-color: var(--border-subtle); color: var(--brand-primary-light);">
                                                    {{ $exp['period'] }}
                                                </span>
                                            </div>
                                            <p class="text-xs font-semibold mb-1.5" style="color: var(--text-muted);">
                                                {{ $exp['company'] }}
                                            </p>
                                            <p class="text-xs leading-relaxed" style="color: var(--text-secondary);">
                                                {{ $exp['desc'] }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Education & Certifications -->
                    @if (!empty($member->educations))
                        <div class="py-4 sm:py-5 border-t" style="border-color: var(--border-subtle);">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-3.5 sm:mb-4" style="color: var(--text-muted);">
                                Riwayat Pendidikan & Sertifikasi (Education & Credentials)
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach ($member->educations as $edu)
                                    <div class="p-3.5 rounded-2xl border"
                                         style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle);">
                                        <span class="text-xs font-mono font-semibold" style="color: var(--brand-primary-light);">
                                            {{ $edu['year'] }}
                                        </span>
                                        <h5 class="text-xs sm:text-sm font-bold mt-1" style="color: var(--text-primary);">
                                            {{ $edu['degree'] }}
                                        </h5>
                                        <p class="text-xs mt-0.5" style="color: var(--text-muted);">
                                            {{ $edu['institution'] }}
                                        </p>
                                        @if (!empty($edu['desc']))
                                            <p class="text-xs mt-2 leading-relaxed" style="color: var(--text-secondary);">
                                                {{ $edu['desc'] }}
                                            </p>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Bottom Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-4 sm:pt-5 border-t" style="border-color: var(--border-subtle);">
                        @if ($member->whatsapp)
                            <a 
                                href="https://wa.me/{{ $member->whatsapp }}?text=Halo%20{{ urlencode($member->name) }},%20saya%20ingin%20berkonsultasi%20langsung%20dengan%20Anda."
                                target="_blank"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold btn-brand-primary"
                            >
                                <span>Hubungi Langsung via WA</span>
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @endif

                        <button 
                            wire:click="closeModal" 
                            class="px-4 py-2 text-xs sm:text-sm rounded-xl transition-colors cursor-pointer text-center sm:ml-auto"
                            style="color: var(--text-muted);"
                        >
                            Tutup CV
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>