<?php

use Livewire\Component;

new class extends Component
{
    public int $count = 0;

    public function increment(): void
    {
        $this->count++;
    }

    public function decrement(): void
    {
        $this->count--;
    }
};
?>

<div class="flex flex-col items-center justify-center p-6 bg-slate-900/60 backdrop-blur-md border border-slate-800 rounded-2xl shadow-xl max-w-sm mx-auto text-white">
    <div class="inline-flex items-center gap-2 px-3 py-1 text-xs font-semibold tracking-wide text-cyan-400 uppercase bg-cyan-950/50 rounded-full border border-cyan-800/60 mb-4">
        <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
        Livewire 4 + Tailwind v4
    </div>
    
    <h3 class="text-lg font-semibold text-slate-200 mb-2">Interactive Counter</h3>
    <p class="text-sm text-slate-400 text-center mb-6">Komponen Livewire interaktif siap pakai dengan Tailwind CSS.</p>

    <div class="flex items-center gap-6 mb-4">
        <button 
            wire:click="decrement"
            class="w-12 h-12 flex items-center justify-center text-xl font-bold bg-slate-800 hover:bg-slate-700 active:scale-95 transition-all rounded-xl text-slate-200 border border-slate-700 hover:border-slate-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 cursor-pointer"
        >
            -
        </button>
        <span class="text-4xl font-extrabold tracking-tight min-w-[3rem] text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-indigo-400">
            {{ $count }}
        </span>
        <button 
            wire:click="increment"
            class="w-12 h-12 flex items-center justify-center text-xl font-bold bg-slate-800 hover:bg-slate-700 active:scale-95 transition-all rounded-xl text-slate-200 border border-slate-700 hover:border-slate-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 cursor-pointer"
        >
            +
        </button>
    </div>
</div>