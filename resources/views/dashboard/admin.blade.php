@extends('layouts.app')

@section('title', 'Admin Panel — Ostrich Smart Hub')
@section('page-title', 'Admin Panel')
@section('page-subtitle', 'Kelola Satwa · Pakan · Medis')

@section('content')

{{-- ===== SUCCESS ALERTS ===== --}}
@if(session('success'))
    <div id="alert-global" class="mb-5 flex items-center gap-3 px-5 py-3.5 rounded-xl border animate__animated animate__fadeInDown"
         style="background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.25)">
        <i class="fa-solid fa-circle-check text-emerald-400"></i>
        <span class="text-emerald-300 text-sm font-medium">{{ session('success') }}</span>
    </div>
@endif
@if(session('success_pakan'))
    <div id="alert-pakan" class="mb-5 flex items-center gap-3 px-5 py-3.5 rounded-xl border animate__animated animate__fadeInDown"
         style="background: rgba(59,130,246,0.08); border-color: rgba(59,130,246,0.25)">
        <i class="fa-solid fa-circle-check text-blue-400"></i>
        <span class="text-blue-300 text-sm font-medium">{{ session('success_pakan') }}</span>
    </div>
@endif
@if(session('success_kesehatan'))
    <div id="alert-kesehatan" class="mb-5 flex items-center gap-3 px-5 py-3.5 rounded-xl border animate__animated animate__fadeInDown"
         style="background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.25)">
        <i class="fa-solid fa-circle-check text-red-400"></i>
        <span class="text-red-300 text-sm font-medium">{{ session('success_kesehatan') }}</span>
    </div>
@endif

{{-- ====================================================== --}}
{{-- TAB 0: OVERVIEW ADMIN                                  --}}
{{-- ====================================================== --}}
<div id="tab-overview" class="tab-content animate__animated animate__fadeIn">
{{-- ===== KPI STATS ===== --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="stat-card rounded-2xl p-5 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2);">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(255,215,0,0.15)">
                <i class="fa-solid fa-paw text-gold"></i>
            </div>
            <span class="text-xs font-semibold text-gold/70 uppercase tracking-widest">Satwa</span>
        </div>
        <div class="text-3xl font-black text-white">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-1">Total Spesies</div>
    </div>

    <div class="stat-card rounded-2xl p-5 border border-white/8 animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); animation-delay:0.1s">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-blue-500/10">
                <i class="fa-solid fa-wheat-awn text-blue-400"></i>
            </div>
            <span class="text-xs font-semibold text-blue-400/70 uppercase tracking-widest">Pakan</span>
        </div>
        <div class="text-3xl font-black text-white">{{ $pakans->count() }}</div>
        <div class="text-white/40 text-xs mt-1">Pembelian Tercatat</div>
    </div>

    <div class="stat-card rounded-2xl p-5 border border-white/8 animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); animation-delay:0.15s">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-red-500/10">
                <i class="fa-solid fa-kit-medical text-red-400"></i>
            </div>
            <span class="text-xs font-semibold text-red-400/70 uppercase tracking-widest">Kesehatan</span>
        </div>
        <div class="text-3xl font-black text-white">{{ $kesehatans->count() }}</div>
        <div class="text-white/40 text-xs mt-1">Penanganan Tercatat</div>
    </div>

    <div class="stat-card rounded-2xl p-5 border animate__animated animate__fadeInUp flex flex-col justify-between"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.25); animation-delay:0.2s">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(255,215,0,0.18)">
                <i class="fa-solid fa-tags text-gold"></i>
            </div>
            <span class="text-xs font-semibold text-gold/70 uppercase tracking-widest">Tiket</span>
        </div>
        <a href="{{ route('settings.index') }}"
           class="ripple-btn inline-flex w-full items-center justify-center gap-1.5 text-xs font-bold text-charcoal px-4 py-2 rounded-xl"
           style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 12px rgba(255,215,0,0.25);">
            <i class="fa-solid fa-pen-to-square text-[10px]"></i> Kelola Harga
        </a>
    </div>
</div>

{{-- ===== VISUAL SUMMARY / RECENT ACTIVITY ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 animate__animated animate__fadeInUp" style="animation-delay:0.3s">
    
    {{-- Log Pakan Terakhir --}}
    <div class="rounded-2xl border p-6 flex flex-col" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <i class="fa-solid fa-wheat-awn text-blue-400"></i>
                Restock Pakan Terakhir
            </h3>
            <a href="?tab=pakan" class="text-blue-400/60 hover:text-blue-400 text-[10px] font-bold uppercase tracking-wider transition-colors bg-blue-500/10 px-3 py-1.5 rounded-lg">Semua</a>
        </div>
        <div class="space-y-3 flex-1">
            @forelse($pakans->take(4) as $p)
                <div class="flex items-center justify-between p-3.5 rounded-xl bg-blue-500/5 border border-blue-500/10 hover:bg-blue-500/10 transition-colors">
                    <div class="flex items-center gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 text-xs">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div>
                            <div class="text-white font-semibold text-sm leading-tight">{{ $p->nama_pakan }}</div>
                            <div class="text-white/40 text-[10px] mt-0.5">{{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->isoFormat('D MMM YYYY') }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-emerald-400 font-bold text-sm">{{ $p->jumlah }} <span class="text-xs">{{ $p->satuan }}</span></div>
                        <div class="text-white/30 text-[10px] mt-0.5">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</div>
                    </div>
                </div>
            @empty
                <div class="h-full flex flex-col items-center justify-center text-center text-white/30 py-6">
                    <i class="fa-solid fa-folder-open text-2xl mb-2 opacity-50"></i>
                    <p class="text-[11px]">Belum ada data pakan masuk.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Log Medis Terakhir --}}
    <div class="rounded-2xl border p-6 flex flex-col" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <i class="fa-solid fa-notes-medical text-red-400"></i>
                Penanganan Medis Terakhir
            </h3>
            <a href="?tab=kesehatan" class="text-red-400/60 hover:text-red-400 text-[10px] font-bold uppercase tracking-wider transition-colors bg-red-500/10 px-3 py-1.5 rounded-lg">Semua</a>
        </div>
        <div class="space-y-3 flex-1">
            @forelse($kesehatans->take(4) as $k)
                <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-red-500/5 border border-red-500/10 hover:bg-red-500/10 transition-colors">
                    <div class="mt-0.5 w-8 h-8 rounded-full bg-red-500/20 flex items-center justify-center text-red-400 text-xs flex-shrink-0">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-white font-bold text-sm truncate">{{ $k->nama_hewan }}</span>
                            <span class="text-white/40 text-[10px] bg-white/5 px-2 py-0.5 rounded-md whitespace-nowrap">{{ \Carbon\Carbon::parse($k->tanggal)->diffForHumans() }}</span>
                        </div>
                        <div class="text-red-300 text-xs mb-1 line-clamp-1">{{ $k->jenis_penanganan }}</div>
                        <div class="text-white/30 text-[10px] flex items-center gap-1.5">
                            <i class="fa-solid fa-user-md"></i> {{ $k->nama_dokter ?? 'Ditangani secara internal' }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="h-full flex flex-col items-center justify-center text-center text-white/30 py-6">
                    <i class="fa-solid fa-heart-pulse text-2xl mb-2 opacity-50"></i>
                    <p class="text-[11px]">Belum ada catatan aktivitas medis.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
</div>{{-- end tab-overview --}}

{{-- ===== TAB NAVIGATION DIHAPUS (Pindah ke Sidebar) ===== --}}

{{-- ====================================================== --}}
{{-- TAB 1: DATABASE SATWA                                  --}}
{{-- ====================================================== --}}
<div id="tab-satwa" class="tab-content animate__animated animate__fadeIn">
    <div class="rounded-2xl border overflow-hidden relative mb-5 h-36" style="border-color:rgba(255,255,255,0.07)">
        {{-- Banner Image from Unsplash --}}
        <img src="https://images.unsplash.com/photo-1534567153574-2b12153a87f0?q=80&w=1200&auto=format&fit=crop" class="absolute inset-0 w-full h-full object-cover opacity-35" alt="Ostrich Banner">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1a1a1a] via-[#1a1a1a]/80 to-transparent"></div>
        <div class="absolute inset-0 px-6 py-4 flex flex-col justify-center">
            <h2 class="text-white font-bold text-lg flex items-center gap-2 relative z-10">
                <i class="fa-solid fa-database text-gold"></i> Kelola Satwa
            </h2>
            <p class="text-white/50 text-xs mt-1 relative z-10 max-w-sm">
                Lihat daftar semua hewan di Ostrich Mini Zoo. Anda dapat memperbarui data, jumlah, dan kondisi satwa untuk keperluan operasional.
            </p>
        </div>
    </div>

    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
            <div class="text-white/70 font-semibold text-sm">Daftar Penghuni Zoo</div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <div class="relative flex-1 sm:w-56">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="text" id="search-animal" oninput="filterAnimal()"
                           placeholder="Cari satwa..."
                           class="w-full text-sm text-white placeholder-white/30 bg-white/5 border rounded-xl pl-9 pr-4 py-2.5 outline-none focus:border-gold/50 transition-colors"
                           style="border-color:rgba(255,255,255,0.1)">
                </div>
                <a href="{{ route('admin.animal.create') }}"
                   class="ripple-btn inline-flex items-center gap-1.5 text-xs font-bold text-charcoal px-3 py-2.5 rounded-xl whitespace-nowrap flex-shrink-0"
                   style="background:linear-gradient(135deg,#FFD700,#f0c800); box-shadow:0 4px 12px rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-plus"></i> Tambah
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" id="animal-table">
                <thead>
                    <tr class="text-left" style="background:rgba(255,215,0,0.04); border-bottom:1px solid rgba(255,255,255,0.06)">
                        <th class="px-6 py-3 text-xs font-bold text-white/40 uppercase tracking-widest">#</th>
                        <th class="px-4 py-3 text-xs font-bold text-white/40 uppercase tracking-widest">Nama Hewan</th>
                        <th class="px-4 py-3 text-xs font-bold text-white/40 uppercase tracking-widest">Jumlah</th>
                        <th class="px-4 py-3 text-xs font-bold text-white/40 uppercase tracking-widest">Rincian Pakan</th>
                        <th class="px-4 py-3 text-xs font-bold text-white/40 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-3 text-xs font-bold text-white/40 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="animal-tbody">
                    @forelse($animals as $i => $animal)
                    <tr class="animal-row border-b transition-colors hover:bg-white/[0.03]{{ $i >= 10 ? ' extra-row hidden' : '' }}"
                        style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-6 py-4 text-white/30 text-sm">{{ $i + 1 }}</td>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 overflow-hidden border border-white/10" style="background:rgba(255,215,0,0.1)">
                                    <i class="fa-solid fa-paw text-gold"></i>
                                </div>
                                <span class="text-white font-semibold text-sm uppercase tracking-wide animal-name">{{ $animal->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-white/8 text-white/80 text-xs font-semibold px-3 py-1.5 rounded-lg border border-white/10">
                                <i class="fa-solid fa-layer-group text-gold/60 text-[10px]"></i>
                                {{ $animal->amount }} Ekor
                            </span>
                        </td>
                        <td class="px-4 py-4 text-white/45 text-xs max-w-xs">{{ Str::limit($animal->feeding_detail, 55) }}</td>
                        <td class="px-4 py-4">
                            <span class="inline-flex items-center gap-1.5 bg-emerald-500/10 text-emerald-400 text-xs font-semibold px-3 py-1.5 rounded-full border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 bg-emerald-400 rounded-full animate-pulse"></span>
                                {{ $animal->health_status ?? 'Sehat' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <form action="{{ route('admin.animal.destroy', $animal->id) }}" method="POST"
                                      onsubmit="return confirm('Hapus data {{ addslashes($animal->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="ripple-btn flex items-center gap-1.5 text-xs font-semibold text-red-400 bg-red-500/10 hover:bg-red-500/20 px-3 py-1.5 rounded-lg border border-red-500/20 transition-all">
                                        <i class="fa-solid fa-trash text-[10px]"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center py-16">
                        <p class="text-white/30 text-sm">Belum ada data satwa.</p>
                        <a href="{{ route('admin.animal.create') }}" class="text-gold text-sm font-semibold hover:text-yellow-300 mt-2 inline-block">+ Tambah satwa pertama</a>
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 flex items-center justify-between gap-3 border-t" style="border-color:rgba(255,255,255,0.06)">
            <span class="text-white/30 text-xs">
                Menampilkan <span id="visible-count">{{ min(10, $animals->count()) }}</span> dari {{ $animals->count() }} spesies
            </span>
            @if($animals->count() > 10)
            <button id="show-more-btn" onclick="toggleMoreRows()"
                    class="inline-flex items-center gap-2 text-xs font-bold px-4 py-2 rounded-xl border transition-all"
                    style="color:#FFD700; border-color:rgba(255,215,0,0.3); background:rgba(255,215,0,0.06)">
                <i class="fa-solid fa-chevron-down text-[10px]" id="show-more-icon"></i>
                <span id="show-more-label">Lihat {{ $animals->count() - 10 }} Satwa Lainnya</span>
            </button>
            @endif
        </div>
    </div>
</div>

{{-- ====================================================== --}}
{{-- TAB 2: MANAJEMEN PAKAN                                 --}}
{{-- ====================================================== --}}
<div id="tab-pakan" class="tab-content hidden animate__animated animate__fadeIn">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- FORM INPUT PAKAN --}}
        <div class="lg:col-span-2">
            <div class="rounded-2xl border overflow-hidden sticky top-6" style="background:rgba(15,15,15,0.85); border-color:rgba(59,130,246,0.2)">
                <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color:rgba(59,130,246,0.15); background:rgba(59,130,246,0.05)">
                    <div class="w-9 h-9 rounded-xl bg-blue-500/15 flex items-center justify-center">
                        <i class="fa-solid fa-plus text-blue-400"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-sm">Input Pembelian Pakan</h3>
                        <p class="text-white/30 text-xs">Berdasarkan laporan stok dari Zookeeper</p>
                    </div>
                </div>
                <form action="{{ route('admin.pakan.store') }}" method="POST" class="p-5 space-y-4" id="pakan-form">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Tanggal</label>
                            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                                   class="admin-input w-full">
                        </div>
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Dilaporkan Oleh</label>
                            <input type="text" name="pelapor" placeholder="Nama Zookeeper"
                                   class="admin-input w-full">
                        </div>
                    </div>
                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Nama Pakan / Bahan</label>
                        <input type="text" name="nama_pakan" required placeholder="Contoh: Pisang Kepok, Wortel, Pellet..."
                               class="admin-input w-full">
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Jumlah</label>
                            <input type="number" name="jumlah" required min="0.1" step="0.5" placeholder="0"
                                   class="admin-input w-full" id="pakan-jumlah" oninput="hitungTotalPakan()">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Satuan</label>
                            <select name="satuan" class="admin-input w-full">
                                <option value="kg">kg</option>
                                <option value="ikat">ikat</option>
                                <option value="buah">buah</option>
                                <option value="liter">liter</option>
                                <option value="sak">sak</option>
                                <option value="ekor">ekor</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Harga/Satuan</label>
                            <input type="number" name="harga_satuan" required min="0" placeholder="0"
                                   class="admin-input w-full" id="pakan-harga" oninput="hitungTotalPakan()">
                        </div>
                    </div>

                    {{-- Total preview --}}
                    <div class="flex items-center justify-between px-4 py-3 rounded-xl border" style="background:rgba(59,130,246,0.06); border-color:rgba(59,130,246,0.2)">
                        <span class="text-white/40 text-xs">Total Pembelian</span>
                        <span class="text-blue-300 font-bold text-sm" id="pakan-total-preview">Rp 0</span>
                    </div>

                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Keterangan (Opsional)</label>
                        <textarea name="keterangan" rows="2" placeholder="Alasan pembelian, kondisi stok saat dilaporkan..."
                                  class="admin-input w-full resize-none"></textarea>
                    </div>
                    <button type="submit"
                            class="ripple-btn w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-bold text-charcoal transition-all"
                            style="background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; box-shadow:0 4px 15px rgba(59,130,246,0.3)">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Pembelian Pakan
                    </button>
                </form>
            </div>
        </div>

        {{-- TABEL RIWAYAT PAKAN --}}
        <div class="lg:col-span-3">
            <div class="rounded-2xl border overflow-hidden" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
                <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
                    <div>
                        <h3 class="text-white font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-blue-400 text-xs"></i>
                            Riwayat Pembelian Pakan
                        </h3>
                        <p class="text-white/30 text-xs mt-0.5">{{ $pakans->count() }} entri tercatat</p>
                    </div>
                    <span class="text-blue-300 font-bold text-sm">
                        Rp {{ number_format($pakans->sum('total_harga'), 0, ',', '.') }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr style="background:rgba(59,130,246,0.05); border-bottom:1px solid rgba(255,255,255,0.06)">
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Nama Pakan</th>
                                <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Qty</th>
                                <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Total</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Pelapor</th>
                                <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pakans as $p)
                            <tr class="border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                                <td class="px-4 py-3 text-white/50 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($p->tanggal)->locale('id')->isoFormat('D MMM YY') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-white font-semibold">{{ $p->nama_pakan }}</span>
                                    @if($p->keterangan)
                                    <p class="text-white/30 text-[10px] mt-0.5 truncate max-w-[140px]">{{ $p->keterangan }}</p>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-white/60">
                                    {{ $p->jumlah }} {{ $p->satuan }}
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-blue-300 whitespace-nowrap">
                                    Rp {{ number_format($p->total_harga, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-white/40">{{ $p->pelapor ?? '—' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('admin.pakan.destroy', $p->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus data pakan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400/70 hover:text-red-400 transition-colors">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-12 text-white/25 italic">
                                Belum ada data pembelian pakan.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================================================== --}}
{{-- TAB 3: MANAJEMEN KESEHATAN                             --}}
{{-- ====================================================== --}}
<div id="tab-kesehatan" class="tab-content hidden animate__animated animate__fadeIn">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

        {{-- FORM INPUT KESEHATAN --}}
        <div class="lg:col-span-2">
            <div class="rounded-2xl border overflow-hidden sticky top-6" style="background:rgba(15,15,15,0.85); border-color:rgba(239,68,68,0.2)">
                <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color:rgba(239,68,68,0.15); background:rgba(239,68,68,0.05)">
                    <div class="w-9 h-9 rounded-xl bg-red-500/15 flex items-center justify-center">
                        <i class="fa-solid fa-syringe text-red-400"></i>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-sm">Input Penanganan Kesehatan</h3>
                        <p class="text-white/30 text-xs">Catat biaya penanganan medis hewan</p>
                    </div>
                </div>
                <form action="{{ route('admin.kesehatan.store') }}" method="POST" class="p-5 space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Tanggal</label>
                            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                                   class="admin-input w-full">
                        </div>
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Hewan</label>
                            <select name="animal_id" required class="admin-input w-full">
                                <option value="">Pilih hewan...</option>
                                @foreach($animals as $animal)
                                <option value="{{ $animal->id }}">{{ $animal->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Jenis Penanganan</label>
                        <select name="jenis_penanganan" required class="admin-input w-full">
                            <option value="">Pilih jenis...</option>
                            <option value="Pemeriksaan Rutin">Pemeriksaan Rutin</option>
                            <option value="Vaksinasi">Vaksinasi</option>
                            <option value="Pengobatan">Pengobatan</option>
                            <option value="Operasi">Operasi</option>
                            <option value="Vitamin & Suplemen">Vitamin & Suplemen</option>
                            <option value="Karantina">Karantina</option>
                            <option value="Perawatan Luka">Perawatan Luka</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Biaya (Rp)</label>
                            <input type="number" name="biaya" required min="0" placeholder="0"
                                   class="admin-input w-full">
                        </div>
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Nama Dokter/drh</label>
                            <input type="text" name="nama_dokter" placeholder="drh. ..."
                                   class="admin-input w-full">
                        </div>
                    </div>
                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Keterangan / Kondisi Hewan</label>
                        <textarea name="keterangan" rows="3" placeholder="Kondisi hewan, gejala yang dilaporkan zookeeper, tindakan yang dilakukan..."
                                  class="admin-input w-full resize-none"></textarea>
                    </div>
                    <button type="submit"
                            class="ripple-btn w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-bold transition-all"
                            style="background:linear-gradient(135deg,#ef4444,#dc2626); color:#fff; box-shadow:0 4px 15px rgba(239,68,68,0.3)">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Data Kesehatan
                    </button>
                </form>
            </div>
        </div>

        {{-- TABEL RIWAYAT KESEHATAN --}}
        <div class="lg:col-span-3">
            <div class="rounded-2xl border overflow-hidden" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
                <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
                    <div>
                        <h3 class="text-white font-bold text-sm flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left text-red-400 text-xs"></i>
                            Riwayat Penanganan Kesehatan
                        </h3>
                        <p class="text-white/30 text-xs mt-0.5">{{ $kesehatans->count() }} penanganan tercatat</p>
                    </div>
                    <span class="text-red-300 font-bold text-sm">
                        Rp {{ number_format($kesehatans->sum('biaya'), 0, ',', '.') }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr style="background:rgba(239,68,68,0.05); border-bottom:1px solid rgba(255,255,255,0.06)">
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Hewan</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Jenis</th>
                                <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Biaya</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Dokter</th>
                                <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kesehatans as $k)
                            <tr class="border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                                <td class="px-4 py-3 text-white/50 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($k->tanggal)->locale('id')->isoFormat('D MMM YY') }}
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center gap-1.5 text-white/80 font-semibold">
                                        <i class="fa-solid fa-paw text-gold text-[10px]"></i>
                                        {{ $k->nama_hewan }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold bg-red-500/10 text-red-300 border border-red-500/20">
                                        {{ $k->jenis_penanganan }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-red-300 whitespace-nowrap">
                                    Rp {{ number_format($k->biaya, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-3 text-white/40 text-[11px]">{{ $k->nama_dokter ?? '—' }}</td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ route('admin.kesehatan.destroy', $k->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus data penanganan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400/70 hover:text-red-400 transition-colors">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-12 text-white/25 italic">
                                Belum ada data penanganan kesehatan.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ====================================================== --}}
{{-- TAB 4: RIWAYAT TIKET (KONFIRMASI)                      --}}
{{-- ====================================================== --}}
<div id="tab-tiket" class="tab-content hidden animate__animated animate__fadeIn">
    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
            <div>
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fa-solid fa-ticket text-gold text-xs"></i>
                    Riwayat Pembelian Tiket
                </h3>
                <p class="text-white/30 text-xs mt-0.5">{{ $orders->count() }} transaksi tercatat · Gunakan untuk konfirmasi tiket pelanggan</p>
            </div>
            <div class="relative w-full sm:w-52">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                <input type="text" id="search-order-admin" oninput="filterOrderAdmin()"
                       placeholder="Cari nama pemesan..."
                       class="w-full text-xs text-white placeholder-white/30 bg-white/5 border rounded-xl pl-8 pr-3 py-2 outline-none focus:border-gold/50 transition-colors"
                       style="border-color: rgba(255,255,255,0.1)">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs" id="order-table-admin">
                <thead>
                    <tr style="background:rgba(255,215,0,0.04); border-bottom:1px solid rgba(255,255,255,0.06)">
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Kode Booking</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Tgl Order</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Nama Pemesan</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">No. HP</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Tiket</th>
                        <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Total</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Metode</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Kunjungan</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $i => $o)
                    <tr class="order-admin-row border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-4 py-3 text-white/30">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-gold font-mono text-[11px] font-bold tracking-wide">{{ $o->kode_booking }}</td>
                        <td class="px-4 py-3 text-white/50 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($o->tanggal_order)->locale('id')->isoFormat('D MMM YY') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-white font-semibold order-admin-name">{{ $o->nama_pemesan }}</span>
                        </td>
                        <td class="px-4 py-3 text-white/40">{{ $o->phone }}</td>
                        <td class="px-4 py-3 text-center font-bold text-white">{{ $o->jumlah_tiket }}</td>
                        <td class="px-4 py-3 text-right font-bold text-emerald-400">Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-2 py-0.5 rounded-full text-[10px] font-bold
                                {{ $o->metode_bayar === 'qris' ? 'bg-yellow-500/10 text-yellow-300 border border-yellow-500/20' :
                                  ($o->metode_bayar === 'transfer' ? 'bg-blue-500/10 text-blue-300 border border-blue-500/20' :
                                   'bg-purple-500/10 text-purple-300 border border-purple-500/20') }}">
                                {{ strtoupper($o->metode_bayar) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-white/50 text-center whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($o->tanggal_kunjungan)->locale('id')->isoFormat('D MMM YY') }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold
                                {{ $o->status === 'confirmed' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-yellow-500/10 text-yellow-400 border border-yellow-500/20' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $o->status === 'confirmed' ? 'bg-emerald-400' : 'bg-yellow-400' }} inline-block"></span>
                                {{ $o->status === 'confirmed' ? 'Confirmed' : 'Pending' }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="text-center py-12 text-white/25 italic">Belum ada transaksi tiket.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Tab styles */
.tab-btn {
    color: rgba(255,255,255,0.45);
    background: transparent;
    border: none;
    cursor: pointer;
}
.tab-btn:hover { color: rgba(255,255,255,0.75); background: rgba(255,255,255,0.05); }
.tab-btn.active-tab {
    color: #1a1a1a;
    background: linear-gradient(135deg, #FFD700, #f0c800);
    box-shadow: 0 4px 12px rgba(255,215,0,0.3);
}
#tab-btn-pakan.active-tab    { background: linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; box-shadow:0 4px 12px rgba(59,130,246,0.3); }
#tab-btn-kesehatan.active-tab { background: linear-gradient(135deg,#ef4444,#dc2626); color:#fff; box-shadow:0 4px 12px rgba(239,68,68,0.3); }
#tab-btn-tiket.active-tab     { background: linear-gradient(135deg,#6366f1,#4f46e5); color:#fff; box-shadow:0 4px 12px rgba(99,102,241,0.3); }

/* Form inputs */
.admin-input {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 8px 12px;
    color: #fff;
    font-size: 12px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s;
    width: 100%;
}
.admin-input:focus { border-color: rgba(255,215,0,0.4); }
.admin-input::placeholder { color: rgba(255,255,255,0.25); }
.admin-input option { background: #1a1a2e; color: #fff; }
</style>
@endpush

@push('scripts')
<script>
// ===== TAB SWITCHING =====
const tabs = ['overview', 'satwa', 'pakan', 'kesehatan', 'tiket'];

function switchTab(name) {
    tabs.forEach(t => {
        const tabEl = document.getElementById('tab-' + t);
        if(tabEl) tabEl.classList.add('hidden');
    });
    const el = document.getElementById('tab-' + name);
    if(el) {
        el.classList.remove('hidden');
        el.classList.add('animate__fadeIn');
    }
    // Update URL hash
    history.replaceState(null, '', window.location.pathname + '?tab=' + name);
}

// Auto-switch tab based on URL param or session success
(function() {
    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab') || 'overview';
    if (tabs.includes(tab)) {
        switchTab(tab);
    }
    @if(session('success_pakan'))   switchTab('pakan');     @endif
    @if(session('success_kesehatan')) switchTab('kesehatan'); @endif
})();

// ===== PAKAN TOTAL PREVIEW =====
function hitungTotalPakan() {
    const jml   = parseFloat(document.getElementById('pakan-jumlah').value) || 0;
    const harga = parseInt(document.getElementById('pakan-harga').value)    || 0;
    const total = jml * harga;
    document.getElementById('pakan-total-preview').textContent =
        'Rp ' + total.toLocaleString('id-ID');
}

// ===== SATWA SEARCH =====
function filterAnimal() {
    const q = document.getElementById('search-animal').value.toLowerCase().trim();
    const rows = document.querySelectorAll('.animal-row');
    let vis = 0;
    rows.forEach(row => {
        const name = row.querySelector('.animal-name')?.textContent.toLowerCase() || '';
        const match = name.includes(q);
        row.style.display = (q === '') ? (row.classList.contains('extra-row') && !expanded ? 'none' : '') : (match ? '' : 'none');
        if (row.style.display !== 'none') vis++;
    });
    const c = document.getElementById('visible-count');
    if (c) c.textContent = vis;
}

// ===== SHOW MORE SATWA =====
let expanded = false;
function toggleMoreRows() {
    expanded = !expanded;
    const extras = document.querySelectorAll('.extra-row');
    const total = document.querySelectorAll('.animal-row').length;
    extras.forEach(row => {
        if (expanded) { row.classList.remove('hidden'); row.style.opacity='0'; requestAnimationFrame(()=>{row.style.transition='opacity 0.3s'; row.style.opacity='1';}); }
        else           { row.classList.add('hidden'); row.style.opacity=''; }
    });
    document.getElementById('show-more-label').textContent = expanded ? 'Tampilkan Lebih Sedikit' : 'Lihat ' + extras.length + ' Satwa Lainnya';
    document.getElementById('show-more-icon').className = expanded ? 'fa-solid fa-chevron-up text-[10px]' : 'fa-solid fa-chevron-down text-[10px]';
    document.getElementById('visible-count').textContent = expanded ? total : total - extras.length;
    document.getElementById('show-more-btn').style.background = expanded ? 'rgba(255,215,0,0.12)' : 'rgba(255,215,0,0.06)';
}

// Auto-dismiss alerts
setTimeout(() => {
    ['alert-global','alert-pakan','alert-kesehatan'].forEach(id => {
        const el = document.getElementById(id);
        if (el) { el.style.transition='opacity 0.4s'; el.style.opacity='0'; setTimeout(()=>el.remove(), 400); }
    });
}, 4000);

// ===== ORDER SEARCH (Admin) =====
function filterOrderAdmin() {
    const q = document.getElementById('search-order-admin').value.toLowerCase();
    document.querySelectorAll('.order-admin-row').forEach(row => {
        const name = row.querySelector('.order-admin-name')?.textContent.toLowerCase() || '';
        row.style.display = name.includes(q) ? '' : 'none';
    });
}

</script>
@endpush
