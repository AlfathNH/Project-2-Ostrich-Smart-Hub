@extends('layouts.app')

@section('title', 'Monitoring Hewan — Ostrich Smart Hub')
@section('page-title', 'Monitoring Hewan')
@section('page-subtitle', 'Jadwal Pakan & Monitoring Kesehatan Satwa')

@section('content')

{{-- ===== QUICK STATS ===== --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-7">
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2);">
        <div class="w-9 h-9 rounded-xl bg-gold/15 flex items-center justify-center mb-3">
            <i class="fa-solid fa-paw text-gold text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Spesies</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.1s">
        <div class="w-9 h-9 rounded-xl bg-emerald-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-heart-pulse text-emerald-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Kondisi Sehat</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.15s">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-bowl-food text-blue-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">2x</div>
        <div class="text-white/40 text-xs mt-0.5">Jadwal / Hari</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.2s">
        <div class="w-9 h-9 rounded-xl bg-orange-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-triangle-exclamation text-orange-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">0</div>
        <div class="text-white/40 text-xs mt-0.5">Perlu Perhatian</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    {{-- ===== FEEDING SCHEDULE ===== --}}
    <div class="animate__animated animate__fadeInUp" style="animation-delay:0.25s">
        <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.07)">
            {{-- Header --}}
            <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color: rgba(255,255,255,0.07)">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center">
                        <i class="fa-solid fa-bowl-food text-blue-400"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-sm">Jadwal Pemberian Pakan</h3>
                        <p class="text-white/30 text-xs">Update & pantau rincian pakan harian</p>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[11px] font-bold px-3 py-1.5 rounded-full">
                    <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse inline-block"></span>
                    Hari Ini
                </div>
            </div>

            {{-- Feeding Cards --}}
            <div class="p-4 space-y-3 max-h-[420px] overflow-y-auto">
                @forelse($animals as $animal)
                <div class="rounded-xl border p-4 transition-all hover:border-blue-500/30 active:scale-[0.99]"
                     style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.06)">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex items-center gap-3 flex-1 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-gold/10 border border-gold/15 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-paw text-gold text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <div class="text-white font-bold text-sm uppercase tracking-wide truncate">{{ $animal->name }}</div>
                                <div class="text-white/40 text-xs mt-0.5">{{ $animal->amount }} Ekor</div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5 flex-shrink-0">
                            <span class="flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 text-[11px] font-bold px-2.5 py-1 rounded-full border border-emerald-500/20 whitespace-nowrap">
                                <i class="fa-regular fa-clock text-[9px]"></i> 07:00
                            </span>
                            <span class="flex items-center gap-1.5 bg-orange-500/10 text-orange-400 text-[11px] font-bold px-2.5 py-1 rounded-full border border-orange-500/20 whitespace-nowrap">
                                <i class="fa-regular fa-clock text-[9px]"></i> 16:00
                            </span>
                        </div>
                    </div>
                    <div class="mt-3 pt-3 border-t flex items-start gap-2" style="border-color: rgba(255,255,255,0.06)">
                        <i class="fa-solid fa-leaf text-green-400/60 text-xs mt-0.5 flex-shrink-0"></i>
                        <p class="text-white/50 text-xs leading-relaxed">{{ $animal->feeding_detail ?? 'Belum ada rincian pakan.' }}</p>
                    </div>
                    {{-- Mark as Done button (mobile-large tap target) --}}
                    <button onclick="this.classList.toggle('done-state')"
                            class="mt-3 w-full text-xs font-semibold text-white/40 hover:text-emerald-400 border border-white/8 hover:border-emerald-500/30 hover:bg-emerald-500/5 py-2.5 rounded-xl transition-all">
                        <i class="fa-regular fa-circle-check mr-1.5"></i>Tandai Sudah Diberi Pakan
                    </button>
                </div>
                @empty
                <div class="text-center py-12">
                    <i class="fa-solid fa-bowl-food text-white/10 text-5xl mb-3"></i>
                    <p class="text-white/30 text-sm">Belum ada data satwa.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ===== MEDICAL LOGS ===== --}}
    <div class="animate__animated animate__fadeInUp" style="animation-delay:0.35s">
        <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.07)">
            {{-- Header --}}
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
            </div>

            {{-- Medical Status Cards --}}
            <div class="p-4 space-y-3 max-h-[420px] overflow-y-auto">
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
                                <div class="text-white/35 text-xs">{{ $animal->amount }} Ekor</div>
                            </div>
                        </div>
                        <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 text-xs font-bold px-3 py-1.5 rounded-full border border-emerald-500/20 whitespace-nowrap">
                            <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                            {{ $animal->health_status ?? 'Sehat' }}
                        </span>
                    </div>
                    {{-- Log Note --}}
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
                </div>
                @empty
                <div class="text-center py-12">
                    <i class="fa-solid fa-kit-medical text-white/10 text-5xl mb-3"></i>
                    <p class="text-white/30 text-sm">Belum ada data medis.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
