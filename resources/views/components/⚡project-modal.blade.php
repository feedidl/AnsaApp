<?php

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    public bool $isOpen = false;
    public ?Project $project = null;

    #[On('open-project-modal')]
    public function openProject(int $id): void
    {
        $this->project = Project::find($id);
        if ($this->project) {
            $this->isOpen = true;
        }
    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->project = null;
    }
};
?>

<div>
    @if ($isOpen && $project)
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
                        title="Tutup Modal"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Header Badges -->
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3 mb-2 sm:mb-3 pr-10">
                        <span 
                            class="px-2.5 sm:px-3 py-1 rounded-full text-[11px] sm:text-xs font-semibold uppercase tracking-wider border"
                            style="background-color: var(--badge-bg); color: var(--badge-text); border-color: var(--badge-border);"
                        >
                            {{ $project->category }}
                        </span>
                        @if ($project->client)
                            <span class="text-xs" style="color: var(--text-muted);">
                                Klien: <strong style="color: var(--text-secondary);">{{ $project->client }}</strong>
                            </span>
                        @endif
                        @if ($project->completion_date)
                            <span class="text-xs" style="color: var(--text-muted);">
                                • Selesai: <strong style="color: var(--text-secondary);">{{ $project->completion_date }}</strong>
                            </span>
                        @endif
                    </div>

                    <h2 class="text-xl sm:text-2xl md:text-3xl font-extrabold mb-4 leading-snug" style="color: var(--text-primary);">
                        {{ $project->title }}
                    </h2>

                    <!-- Project Banner / Visual Preview -->
                    <div class="w-full h-48 sm:h-64 md:h-72 rounded-2xl overflow-hidden mb-6 relative border flex items-center justify-center p-4 sm:p-6"
                         style="background: linear-gradient(135deg, var(--bg-surface-card), var(--bg-surface-elevated)); border-color: var(--border-subtle);">
                        <img 
                            src="{{ $project->featured_image ?: '/storage/images/logo/logo.png' }}" 
                            alt="{{ $project->title }}" 
                            class="max-h-full max-w-full object-contain filter drop-shadow-xl"
                            onerror="this.src='/storage/images/logo/logo.png'"
                        >
                    </div>

                    <!-- Tech Stack Pills -->
                    @if (!empty($project->tech_stack))
                        <div class="mb-5 sm:mb-6">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-2" style="color: var(--text-muted);">
                                Teknologi & Tools yang Digunakan
                            </h4>
                            <div class="flex flex-wrap gap-1.5 sm:gap-2">
                                @foreach ($project->tech_stack as $tech)
                                    <span 
                                        class="px-2.5 sm:px-3 py-1 rounded-xl text-xs font-mono font-medium border"
                                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);"
                                    >
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    <div class="mb-5 sm:mb-6 space-y-2">
                        <h4 class="text-xs font-bold uppercase tracking-wider" style="color: var(--text-muted);">
                            Deskripsi Proyek & Solusi
                        </h4>
                        <p class="text-xs sm:text-sm leading-relaxed" style="color: var(--text-secondary);">
                            {{ $project->full_description ?: $project->short_description }}
                        </p>
                    </div>

                    <!-- Key Features -->
                    @if (!empty($project->features))
                        <div class="mb-6 sm:mb-8">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-2.5 sm:mb-3" style="color: var(--text-muted);">
                                Fitur Utama yang Dihadirkan
                            </h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 sm:gap-2.5">
                                @foreach ($project->features as $feature)
                                    <div class="flex items-start gap-2 text-xs p-2.5 rounded-xl border"
                                         style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-secondary);">
                                        <svg class="w-4 h-4 shrink-0 mt-0.5" style="color: var(--brand-primary-light);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons (Responsive flex-col on very small screens) -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 pt-4 border-t" style="border-color: var(--border-subtle);">
                        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2.5">
                            @if ($project->demo_url)
                                <a 
                                    href="{{ $project->demo_url }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold btn-brand-primary"
                                >
                                    <span>Lihat Live Demo</span>
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                            @endif

                            @if ($project->github_url)
                                <a 
                                    href="{{ $project->github_url }}" 
                                    target="_blank" 
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-medium btn-brand-secondary"
                                >
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                    </svg>
                                    <span>Repository</span>
                                </a>
                            @endif
                        </div>

                        <button 
                            wire:click="closeModal" 
                            class="px-4 py-2 text-xs sm:text-sm rounded-xl transition-colors cursor-pointer text-center"
                            style="color: var(--text-muted);"
                        >
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>