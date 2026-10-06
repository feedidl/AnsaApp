<?php

use App\Mail\ContactMessageMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|min:3|max:100')]
    public string $name = '';

    #[Validate('required|email|max:100')]
    public string $email = '';

    #[Validate('nullable|min:8|max:20')]
    public string $phone = '';

    #[Validate('required|min:4|max:150')]
    public string $subject = 'Konsultasi Pengembangan Aplikasi';

    #[Validate('required|min:10|max:2000')]
    public string $message = '';

    public bool $isSuccess = false;

    public function submit(): void
    {
        $this->validate();

        $contact = Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
            'is_read' => false,
        ]);

        $sendTo = config('mail.send_to') ?: env('SEND_TO');

        if (!empty($sendTo)) {
            try {
                Mail::to($sendTo)->send(new ContactMessageMail($contact));
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email kontak: ' . $e->getMessage(), [
                    'contact_id' => $contact->id,
                ]);
            }
        }

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->isSuccess = true;
    }

    public function resetSuccess(): void
    {
        $this->isSuccess = false;
    }
};
?>

<div>
    @if ($isSuccess)
        <div class="p-6 rounded-2xl border text-center space-y-4"
             style="background-color: var(--bg-surface-elevated); border-color: var(--brand-accent);">
            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full mx-auto flex items-center justify-center text-white"
                 style="background: linear-gradient(135deg, var(--brand-accent), var(--brand-primary));">
                <svg class="w-6 h-6 sm:w-7 sm:h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg sm:text-xl font-bold" style="color: var(--text-primary);">Pesan Berhasil Terkirim!</h3>
                <p class="text-xs sm:text-sm mt-1" style="color: var(--text-secondary);">
                    Terima kasih telah menghubungi AnsaApp. Tim konsultan IT kami akan merespons pesan Anda dalam waktu 1x24 jam.
                </p>
            </div>
            <button 
                wire:click="resetSuccess" 
                class="px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold btn-brand-primary cursor-pointer"
            >
                Kirim Pesan Lainnya
            </button>
        </div>
    @else
        <form wire:submit="submit" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: var(--text-muted);">
                        Nama Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        wire:model="name"
                        placeholder="e.g. Budi Santoso"
                        class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-base sm:text-sm focus:outline-none focus:ring-2 transition-all"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                    >
                    @error('name') 
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: var(--text-muted);">
                        Alamat Email <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        wire:model="email"
                        placeholder="e.g. budi@perusahaan.com"
                        class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-base sm:text-sm focus:outline-none focus:ring-2 transition-all"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                    >
                    @error('email') 
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Phone -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: var(--text-muted);">
                        No. Telepon / WhatsApp
                    </label>
                    <input 
                        type="tel" 
                        wire:model="phone"
                        placeholder="e.g. 08123456789"
                        class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-base sm:text-sm focus:outline-none focus:ring-2 transition-all font-mono"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                    >
                    @error('phone') 
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: var(--text-muted);">
                        Topik Kebutuhan <span class="text-rose-500">*</span>
                    </label>
                    <select 
                        wire:model="subject"
                        class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-base sm:text-sm focus:outline-none focus:ring-2 transition-all"
                        style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                    >
                        <option value="Konsultasi Pengembangan Aplikasi">Konsultasi Pengembangan Aplikasi</option>
                        <option value="Konsultasi Arsitektur IT & Solusi">Konsultasi Arsitektur IT & Solusi</option>
                        <option value="Infrastruktur Cloud & DevOps">Infrastruktur Cloud & DevOps</option>
                        <option value="Pengembangan Software Enterprise (ERP/CRM)">Pengembangan Software Enterprise (ERP/CRM)</option>
                        <option value="Lainnya">Kebutuhan Lainnya</option>
                    </select>
                    @error('subject') 
                        <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Message -->
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider mb-1.5" style="color: var(--text-muted);">
                    Deskripsi Kebutuhan Proyek / Pesan <span class="text-rose-500">*</span>
                </label>
                <textarea 
                    rows="4" 
                    wire:model="message"
                    placeholder="Ceritakan gambaran sistem yang ingin dibangun, target waktu, atau kendala IT yang sedang dihadapi..."
                    class="w-full px-3.5 sm:px-4 py-2.5 sm:py-3 rounded-xl border text-base sm:text-sm focus:outline-none focus:ring-2 transition-all leading-relaxed"
                    style="background-color: var(--bg-surface-elevated); border-color: var(--border-subtle); color: var(--text-primary);"
                ></textarea>
                @error('message') 
                    <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> 
                    @enderror
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                wire:loading.attr="disabled"
                class="w-full py-3.5 px-6 rounded-xl font-bold text-xs sm:text-sm btn-brand-primary flex items-center justify-center gap-2 cursor-pointer disabled:opacity-50"
            >
                <span wire:loading.remove>Kirim Pesan & Ajukan Konsultasi</span>
                <span wire:loading class="inline-flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Sedang Mengirim...
                </span>
            </button>
        </form>
    @endif
</div>