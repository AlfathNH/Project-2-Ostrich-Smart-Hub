@extends('layouts.app')

@section('title', 'Log Medis — Ostrich Smart Hub')
@section('page-title', 'Log Medis')
@section('page-subtitle', 'Monitoring kesehatan semua penghuni zoo')

@section('content')

{{-- ===== QUICK STATS ===== --}}
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2);">
        <div class="w-9 h-9 rounded-xl bg-gold/15 flex items-center justify-center mb-3">
            <i class="fa-solid fa-paw text-gold text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Total Spesies</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border-color: rgba(16,185,129,0.2); animation-delay:0.1s">
        <div class="w-9 h-9 rounded-xl bg-emerald-500/15 flex items-center justify-center mb-3">
            <i class="fa-solid fa-heart-pulse text-emerald-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-emerald-300">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Kondisi Sehat</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.15s">
        <div class="w-9 h-9 rounded-xl bg-orange-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-triangle-exclamation text-orange-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">0</div>
        <div class="text-white/40 text-xs mt-0.5">Perlu Perhatian</div>
    </div>
</div>

{{-- ===== LOG KESEHATAN ===== --}}
<div class="rounded-2xl border overflow-hidden animate__animated animate__fadeInUp" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.07); animation-delay:0.2s">
    <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: rgba(255,255,255,0.07)">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-red-500/10 flex items-center justify-center">
                <i class="fa-solid fa-kit-medical text-red-400"></i>
            </div>
            <div>
                <h3 class="text-white font-bold text-sm">Log Kesehatan Medis</h3>
                <p class="text-white/30 text-xs">Status kesehatan semua penghuni zoo</p>
            </div>
        </div>
        <span class="text-white/30 text-xs">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMM YYYY') }}</span>
    </div>

    <div class="p-4 space-y-3">
        @forelse($animals as $animal)
        <div class="rounded-xl border p-4 transition-all hover:border-emerald-500/20"
             style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.06)">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gold/8 border border-gold/12 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-paw text-gold text-xs"></i>
                    </div>
                    <div>
                        <div class="text-white font-bold text-sm uppercase">{{ $animal->name }}</div>
                        <div class="text-white/35 text-xs">
                            {{ $animal->amount }} Ekor
                            @if($animal->kode_satwa)
                                &bull; <span class="font-mono text-gold/60">{{ $animal->kode_satwa }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <span class="inline-flex items-center gap-1.5 text-xs font-bold px-3 py-1.5 rounded-full border {{ $animal->health_badge_class }} whitespace-nowrap">
                    <span class="w-1.5 h-1.5 {{ $animal->health_dot_class }} rounded-full animate-pulse"></span>
                    {{ $animal->health_status ?? 'Sehat' }}
                </span>
            </div>

            {{-- Log note --}}
            <div class="mt-2.5 grid grid-cols-3 gap-2 text-center">
                <div class="rounded-lg py-1.5" style="background: rgba(255,255,255,0.04)">
                    <div class="text-white/25 text-[10px]">Bobot</div>
                    <div class="text-white text-xs font-semibold">—</div>
                </div>
                <div class="rounded-lg py-1.5" style="background: rgba(255,255,255,0.04)">
                    <div class="text-white/25 text-[10px]">Suhu</div>
                    <div class="text-white text-xs font-semibold">37°C</div>
                </div>
                <div class="rounded-lg py-1.5" style="background: rgba(255,255,255,0.04)">
                    <div class="text-white/25 text-[10px]">Cek Terakhir</div>
                    <div class="text-white text-xs font-semibold">Hari Ini</div>
                </div>
            </div>

            {{-- Feeding detail --}}
            @if($animal->feeding_detail)
            <div class="mt-2.5 pt-2.5 border-t flex items-start gap-2" style="border-color: rgba(255,255,255,0.05)">
                <i class="fa-solid fa-leaf text-green-400/50 text-xs mt-0.5 flex-shrink-0"></i>
                <p class="text-white/35 text-[11px] leading-relaxed">{{ $animal->feeding_detail }}</p>
            </div>
            @endif
        </div>
        @empty
        <div class="text-center py-16">
            <i class="fa-solid fa-kit-medical text-white/10 text-5xl mb-3"></i>
            <p class="text-white/30 text-sm">Belum ada data satwa.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection
