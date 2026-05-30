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
                    <tr class="animal-row border-b transition-colors hover:bg-white/[0.03]"
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
                            {{-- [BARU] POIN 6: Badge warna DINAMIS berdasarkan nilai health_status --}}
                            <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1.5 rounded-full border {{ $animal->health_badge_class }}">
                                <span class="w-1.5 h-1.5 {{ $animal->health_dot_class }} rounded-full animate-pulse"></span>
                                {{ $animal->health_status ?? 'Sehat' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Tombol Edit --}}
                                <button type="button"
                                    onclick="openEditAnimal({{ $animal->id }}, '{{ addslashes($animal->name) }}', {{ $animal->amount }}, '{{ addslashes($animal->feeding_detail) }}', '{{ addslashes($animal->health_status ?? 'Sehat') }}')"
                                    class="ripple-btn flex items-center gap-1.5 text-xs font-semibold text-blue-400 bg-blue-500/10 hover:bg-blue-500/20 px-3 py-1.5 rounded-lg border border-blue-500/20 transition-all">
                                    <i class="fa-solid fa-pen-to-square text-[10px]"></i> Edit
                                </button>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.animal.destroy', $animal->id) }}" method="POST"
                                      onsubmit="return confirmDelete(event, this, '{{ addslashes($animal->name) }}')">
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
                Menampilkan {{ $animals->firstItem() }}–{{ $animals->lastItem() }} dari {{ $animals->total() }} spesies
            </span>
            <div class="flex items-center gap-1">
                @if($animals->onFirstPage())
                    <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-left text-[10px]"></i></span>
                @else
                    <a href="{{ $animals->appends(request()->except('page_animal'))->previousPageUrl() }}&tab=satwa" class="pagination-btn"><i class="fa-solid fa-chevron-left text-[10px]"></i></a>
                @endif

                @foreach($animals->getUrlRange(max(1, $animals->currentPage()-2), min($animals->lastPage(), $animals->currentPage()+2)) as $page => $url)
                    @if($page == $animals->currentPage())
                        <span class="pagination-btn pagination-active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}&tab=satwa" class="pagination-btn">{{ $page }}</a>
                    @endif
                @endforeach

                @if($animals->hasMorePages())
                    <a href="{{ $animals->appends(request()->except('page_animal'))->nextPageUrl() }}&tab=satwa" class="pagination-btn"><i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                @else
                    <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ====================================================== --}}
{{-- TAB 2: MANAJEMEN PAKAN                                 --}}
{{-- ====================================================== --}}
<div id="tab-pakan" class="tab-content hidden animate__animated animate__fadeIn">

    {{-- ===== STOK GUDANG RINGKASAN ===== --}}
    <div class="rounded-2xl border overflow-hidden mb-6" style="background:rgba(15,15,15,0.85); border-color:rgba(59,130,246,0.25)">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-4 border-b" style="border-color:rgba(59,130,246,0.15); background:rgba(59,130,246,0.05)">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-blue-500/15 flex items-center justify-center">
                    <i class="fa-solid fa-warehouse text-blue-400"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm">Stok Gudang Pakan</h3>
                    <p class="text-white/30 text-xs">Total akumulasi seluruh pembelian per jenis pakan</p>
                </div>
            </div>
            <div class="relative w-full sm:w-52">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                <input type="text" id="search-gudang" oninput="filterGudang()"
                       placeholder="Cari nama pakan..."
                       class="w-full text-xs text-white placeholder-white/30 bg-white/5 border rounded-xl pl-8 pr-3 py-2 outline-none focus:border-blue-400/50 transition-colors"
                       style="border-color: rgba(255,255,255,0.1)">
            </div>
        </div>

        {{-- KPI Ringkas --}}
        <div class="grid grid-cols-3 gap-px" style="background:rgba(255,255,255,0.04)">
            <div class="bg-[#0f0f0f] px-5 py-3 text-center">
                <div class="text-lg font-black text-blue-300">{{ $stokGudang->count() }}</div>
                <div class="text-white/35 text-[10px] uppercase tracking-widest">Jenis Pakan</div>
            </div>
            <div class="bg-[#0f0f0f] px-5 py-3 text-center">
                <div class="text-lg font-black text-emerald-300">{{ $pakans->count() }}</div>
                <div class="text-white/35 text-[10px] uppercase tracking-widest">Total Transaksi</div>
            </div>
            <div class="bg-[#0f0f0f] px-5 py-3 text-center">
                <div class="text-lg font-black text-gold">Rp {{ number_format($stokGudang->sum('total_pengeluaran'), 0, ',', '.') }}</div>
                <div class="text-white/35 text-[10px] uppercase tracking-widest">Total Pengeluaran</div>
            </div>
        </div>

        {{-- Tabel Stok --}}
        <div class="overflow-x-auto">
            <table class="w-full text-xs" id="gudang-table">
                <thead>
                    <tr style="background:rgba(59,130,246,0.06); border-bottom:1px solid rgba(255,255,255,0.06)">
                        <th class="px-5 py-3 text-left text-white/35 font-bold uppercase tracking-wider">#</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Nama Pakan</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Satuan</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Total Stok</th>
                        <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Rata-rata Harga/Sat</th>
                        <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Total Pengeluaran</th>
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Terakhir Beli</th>
                    </tr>
                </thead>
                <tbody id="gudang-tbody">
                    @forelse($stokGudang as $i => $stok)
                    <tr class="gudang-row border-b hover:bg-blue-500/[0.03] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-5 py-3 text-white/30">{{ $i + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-blue-500/15 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-solid fa-box text-blue-400 text-[10px]"></i>
                                </div>
                                <span class="text-white font-semibold gudang-nama">{{ $stok->nama_pakan }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-block px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-white/8 text-white/60 border border-white/10">
                                {{ $stok->satuan }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-emerald-300 font-black text-sm">
                                {{ $stok->total_jumlah % 1 == 0 ? (int)$stok->total_jumlah : $stok->total_jumlah }}
                            </span>
                            <span class="text-white/40 text-[10px] ml-1">{{ $stok->satuan }}</span>
                        </td>
                        <td class="px-4 py-3 text-right text-white/55">
                            Rp {{ number_format($stok->rata_harga, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-right font-bold text-blue-300">
                            Rp {{ number_format($stok->total_pengeluaran, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-white/40 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($stok->terakhir_beli)->locale('id')->isoFormat('D MMM YYYY') }}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-10 text-white/25 italic">Belum ada data stok pakan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

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
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Tanggal <span class="text-red-400 font-bold">*</span>
                            </label>
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
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                            Nama Pakan / Bahan <span class="text-red-400 font-bold">*</span>
                        </label>
                        <input type="text" name="nama_pakan" required placeholder="Contoh: Pisang Kepok, Wortel, Pellet..."
                               class="admin-input w-full">
                    </div>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Jumlah <span class="text-red-400 font-bold">*</span>
                            </label>
                            {{-- [BARU] POIN 3: Input integer (type=number, min=1, step=1) --}}
                            <input type="number" name="jumlah" required min="1" step="1" placeholder="0"
                                   class="admin-input w-full" id="pakan-jumlah" oninput="hitungTotalPakan()">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Satuan <span class="text-red-400 font-bold">*</span>
                            </label>
                            <select name="satuan" class="admin-input w-full" id="pakan-satuan" onchange="updateJumlahStep()">
                                <option value="kg">kg</option>
                                <option value="ikat">ikat</option>
                                <option value="buah">buah</option>
                                <option value="liter">liter</option>
                                <option value="sak">sak</option>
                                <option value="ekor">ekor</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Harga/Satuan <span class="text-red-400 font-bold">*</span>
                            </label>
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
                        <p class="text-white/30 text-xs mt-0.5">{{ $pakans->total() }} entri tercatat</p>
                    </div>
                    <span class="text-blue-300 font-bold text-sm">
                        Rp {{ number_format($totalPakan, 0, ',', '.') }}
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
                                          onsubmit="return confirmDelete(event, this, 'pakan ini')">
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
                {{-- Pagination Pakan --}}
                @if($pakans->hasPages())
                <div class="px-4 py-3 flex items-center justify-between gap-3 border-t" style="border-color:rgba(255,255,255,0.06)">
                    <span class="text-white/30 text-xs">Menampilkan {{ $pakans->firstItem() }}&ndash;{{ $pakans->lastItem() }} dari {{ $pakans->total() }} entri</span>
                    <div class="flex items-center gap-1">
                        @if($pakans->onFirstPage())
                            <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-left text-[10px]"></i></span>
                        @else
                            <a href="{{ $pakans->appends(request()->except('page_pakan'))->previousPageUrl() }}&tab=pakan" class="pagination-btn"><i class="fa-solid fa-chevron-left text-[10px]"></i></a>
                        @endif
                        @foreach($pakans->getUrlRange(max(1, $pakans->currentPage()-2), min($pakans->lastPage(), $pakans->currentPage()+2)) as $page => $url)
                            @if($page == $pakans->currentPage())
                                <span class="pagination-btn pagination-active-blue">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}&tab=pakan" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endforeach
                        @if($pakans->hasMorePages())
                            <a href="{{ $pakans->appends(request()->except('page_pakan'))->nextPageUrl() }}&tab=pakan" class="pagination-btn"><i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                        @else
                            <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                        @endif
                    </div>
                </div>
                @endif
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
                <form action="{{ route('admin.kesehatan.store') }}" method="POST" class="p-5 space-y-4" id="form-kesehatan">
                    @csrf
                    {{-- Baris error jika validasi gagal --}}
                    @if(session('error_kesehatan'))
                    <div class="px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/25 text-red-300 text-xs flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation"></i> {{ session('error_kesehatan') }}
                    </div>
                    @endif
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Tanggal <span class="text-red-400 font-bold">*</span>
                            </label>
                            <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}"
                                   class="admin-input w-full">
                        </div>
                        <div>
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Hewan <span class="text-red-400 font-bold">*</span>
                            </label>
                            <select name="animal_id" required class="admin-input w-full" id="kesehatan-animal-select"
                                    onchange="updateKesehatanInfo()">
                                <option value="">Pilih hewan...</option>
                                @foreach($animals as $animal)
                                <option value="{{ $animal->id }}"
                                        data-amount="{{ $animal->amount }}"
                                        data-kode="{{ $animal->kode_satwa ?? strtoupper(substr(preg_replace('/\s+/', '', $animal->name), 0, 4)) }}"
                                        data-name="{{ $animal->name }}">
                                    {{ $animal->name }} ({{ $animal->amount }} ekor)
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- [BARU] Jumlah Ekor Sakit + Preview Individu --}}
                    <div id="jumlah-sakit-section">
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                            Jumlah Ekor Sakit / Ditangani <span class="text-red-400 font-bold">*</span>
                            <span id="max-ekor-label" class="normal-case font-normal text-white/25 ml-1"></span>
                        </label>
                        <div class="flex gap-2 items-center">
                            <input type="number" name="jumlah_sakit" id="kesehatan-jumlah-sakit" required
                                   min="1" step="1" placeholder="0"
                                   class="admin-input flex-1" oninput="updateKodePreview()">
                            <div id="jumlah-bar" class="flex-1 h-7 rounded-lg overflow-hidden hidden" style="background:rgba(255,255,255,0.05)">
                                <div id="jumlah-fill" class="h-full rounded-lg transition-all duration-300"
                                     style="width:0%; background:linear-gradient(90deg,#ef4444,#f97316)"></div>
                            </div>
                        </div>
                        {{-- Preview kode individu --}}
                        <div id="kode-preview" class="hidden mt-2 px-3 py-2 rounded-lg border"
                             style="background:rgba(239,68,68,0.05); border-color:rgba(239,68,68,0.2)">
                            <div class="text-white/30 text-[10px] mb-1 uppercase tracking-wider">Kode individu yang ditandai:</div>
                            <div id="kode-preview-text" class="text-red-300 text-xs font-mono"></div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                            Jenis Penanganan <span class="text-red-400 font-bold">*</span>
                        </label>
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
                            <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">
                                Biaya (Rp) <span class="text-red-400 font-bold">*</span>
                            </label>
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
                        <p class="text-white/30 text-xs mt-0.5">{{ $kesehatans->total() }} penanganan tercatat</p>
                    </div>
                    <span class="text-red-300 font-bold text-sm">
                        Rp {{ number_format($totalKesehatan, 0, ',', '.') }}
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr style="background:rgba(239,68,68,0.05); border-bottom:1px solid rgba(255,255,255,0.06)">
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Hewan</th>
                                {{-- [BARU] Kolom ekor sakit + kode individu --}}
                                <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Ekor Sakit</th>
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
                                {{-- [BARU] Tampilkan jumlah sakit + kode individu --}}
                                <td class="px-4 py-3">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="inline-flex items-center gap-1 text-[10px] font-bold text-red-300">
                                            <i class="fa-solid fa-circle-exclamation text-[9px]"></i>
                                            {{ $k->jumlah_sakit ?? 1 }} ekor
                                        </span>
                                        @if($k->kode_sakit)
                                        <span class="text-[9px] text-white/30 font-mono leading-tight">{{ $k->kode_sakit }}</span>
                                        @endif
                                    </div>
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
                                          onsubmit="return confirmDelete(event, this, 'penanganan ini')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-400/70 hover:text-red-400 transition-colors">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7" class="text-center py-12 text-white/25 italic">
                                Belum ada data penanganan kesehatan.
                            </td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- Pagination Kesehatan --}}
                @if($kesehatans->hasPages())
                <div class="px-4 py-3 flex items-center justify-between gap-3 border-t" style="border-color:rgba(255,255,255,0.06)">
                    <span class="text-white/30 text-xs">Menampilkan {{ $kesehatans->firstItem() }}&ndash;{{ $kesehatans->lastItem() }} dari {{ $kesehatans->total() }} penanganan</span>
                    <div class="flex items-center gap-1">
                        @if($kesehatans->onFirstPage())
                            <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-left text-[10px]"></i></span>
                        @else
                            <a href="{{ $kesehatans->appends(request()->except('page_kesehatan'))->previousPageUrl() }}&tab=kesehatan" class="pagination-btn"><i class="fa-solid fa-chevron-left text-[10px]"></i></a>
                        @endif
                        @foreach($kesehatans->getUrlRange(max(1, $kesehatans->currentPage()-2), min($kesehatans->lastPage(), $kesehatans->currentPage()+2)) as $page => $url)
                            @if($page == $kesehatans->currentPage())
                                <span class="pagination-btn pagination-active-red">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}&tab=kesehatan" class="pagination-btn">{{ $page }}</a>
                            @endif
                        @endforeach
                        @if($kesehatans->hasMorePages())
                            <a href="{{ $kesehatans->appends(request()->except('page_kesehatan'))->nextPageUrl() }}&tab=kesehatan" class="pagination-btn"><i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                        @else
                            <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                        @endif
                    </div>
                </div>
                @endif
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
                <p class="text-white/30 text-xs mt-0.5">
                    {{-- [BARU] POIN 1: Label dalam Bahasa Indonesia penuh --}}
                    {{ $orders->total() }} transaksi ·
                    <span class="text-yellow-400">{{ $orderPendingCount }} menunggu</span> ·
                    <span class="text-emerald-400">{{ $orderConfirmedCount }} terkonfirmasi</span>
                </p>
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
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">Nama Pemesan</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Tiket</th>
                        <th class="px-4 py-3 text-right text-white/35 font-bold uppercase tracking-wider">Total</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Kunjungan</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Bukti</th>
                        <th class="px-4 py-3 text-center text-white/35 font-bold uppercase tracking-wider">Status / Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $i => $o)
                    <tr class="order-admin-row border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-4 py-3 text-white/30">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-gold font-mono text-[11px] font-bold tracking-wide">{{ $o->kode_booking }}</td>
                        <td class="px-4 py-3">
                            <span class="text-white font-semibold order-admin-name">{{ $o->nama_pemesan }}</span>
                            <div class="text-white/35 text-[10px]">{{ $o->phone }}</div>
                        </td>
                        <td class="px-4 py-3 text-center font-bold text-white">{{ $o->jumlah_tiket }}</td>
                        <td class="px-4 py-3 text-right font-bold text-emerald-400">Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-white/50 text-center whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($o->tanggal_kunjungan)->locale('id')->isoFormat('D MMM YY') }}
                        </td>
                        {{-- Thumbnail Bukti Transfer --}}
                        <td class="px-4 py-3 text-center">
                            @if($o->bukti_transfer)
                            <a href="{{ asset('storage/' . $o->bukti_transfer) }}" target="_blank"
                               class="group inline-block relative">
                                <img src="{{ asset('storage/' . $o->bukti_transfer) }}"
                                     alt="Bukti"
                                     class="w-10 h-10 object-cover rounded-lg border border-white/10 group-hover:border-gold/50 transition-all">
                                <div class="absolute inset-0 bg-black/50 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <i class="fa-solid fa-expand text-white text-[10px]"></i>
                                </div>
                            </a>
                            @else
                            <span class="text-white/20 text-[10px] italic">—</span>
                            @endif
                        </td>
                        {{-- Status + Approve/Reject --}}
                        <td class="px-4 py-3 text-center">
                            @if($o->status === 'confirmed')
                            {{-- [BARU] POIN 1: Label Indonesia "Terkonfirmasi" --}}
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 inline-block"></span> Terkonfirmasi
                            </span>
                            @elseif($o->status === 'rejected')
                            {{-- [BARU] POIN 1: Label Indonesia "Ditolak" --}}
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-bold bg-red-500/10 text-red-400 border border-red-500/20">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-400 inline-block"></span> Ditolak
                            </span>
                            @else
                            <div class="flex items-center gap-1.5 justify-center">
                                @if($o->bukti_transfer)
                                {{-- [BARU] POIN 1: Tombol ACC & Tolak tetap teks aksi, status jadi "Menunggu" --}}
                                <a href="{{ route('order.approve', $o->id) }}"
                                   onclick="return confirmAction(event, this, 'Konfirmasi Pembayaran', 'Konfirmasi pembayaran dari <strong>{{ addslashes($o->nama_pemesan) }}</strong>?', 'Ya, Konfirmasi')"
                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-500/15 text-emerald-400 border border-emerald-500/25 hover:bg-emerald-500/30 transition-all">
                                    <i class="fa-solid fa-check"></i> Konfirmasi
                                </a>
                                <a href="{{ route('order.reject', $o->id) }}"
                                   onclick="return confirmAction(event, this, 'Tolak Pembayaran', 'Yakin ingin menolak pembayaran dari <strong>{{ addslashes($o->nama_pemesan) }}</strong>?', 'Ya, Tolak')"
                                   class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-red-500/15 text-red-400 border border-red-500/25 hover:bg-red-500/30 transition-all">
                                    <i class="fa-solid fa-xmark"></i> Tolak
                                </a>
                                @else
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[10px] font-bold bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse inline-block"></span> Menunggu
                                </span>
                                @endif
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-12 text-white/25 italic">Belum ada transaksi tiket.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination Tiket --}}
        @if($orders->hasPages())
        <div class="px-5 py-4 flex items-center justify-between gap-3 border-t" style="border-color:rgba(255,255,255,0.06)">
            <span class="text-white/30 text-xs">Menampilkan {{ $orders->firstItem() }}&ndash;{{ $orders->lastItem() }} dari {{ $orders->total() }} transaksi</span>
            <div class="flex items-center gap-1">
                @if($orders->onFirstPage())
                    <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-left text-[10px]"></i></span>
                @else
                    <a href="{{ $orders->appends(request()->except('page_tiket'))->previousPageUrl() }}&tab=tiket" class="pagination-btn"><i class="fa-solid fa-chevron-left text-[10px]"></i></a>
                @endif
                @foreach($orders->getUrlRange(max(1, $orders->currentPage()-2), min($orders->lastPage(), $orders->currentPage()+2)) as $page => $url)
                    @if($page == $orders->currentPage())
                        <span class="pagination-btn pagination-active-purple">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}&tab=tiket" class="pagination-btn">{{ $page }}</a>
                    @endif
                @endforeach
                @if($orders->hasMorePages())
                    <a href="{{ $orders->appends(request()->except('page_tiket'))->nextPageUrl() }}&tab=tiket" class="pagination-btn"><i class="fa-solid fa-chevron-right text-[10px]"></i></a>
                @else
                    <span class="pagination-btn pagination-disabled"><i class="fa-solid fa-chevron-right text-[10px]"></i></span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>


{{-- ===================================================== --}}
{{-- MODAL: EDIT SATWA                                     --}}
{{-- ===================================================== --}}
<div id="modal-edit-animal"
     class="fixed inset-0 z-[9999] flex items-center justify-center hidden"
     onclick="if(event.target===this) closeEditAnimal()">
    {{-- Backdrop --}}
    <div class="absolute inset-0" style="background:rgba(0,0,0,0.7); backdrop-filter:blur(8px)"></div>

    {{-- Modal Card --}}
    <div id="modal-edit-card"
         class="relative w-full max-w-lg mx-4 rounded-2xl border overflow-hidden"
         style="background:linear-gradient(145deg,#141414,#0f0f0f); border-color:rgba(59,130,246,0.25); box-shadow:0 25px 60px rgba(0,0,0,0.6), 0 0 0 1px rgba(59,130,246,0.1); transform:scale(0.9); opacity:0; transition:all 0.25s cubic-bezier(0.34,1.56,0.64,1)">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-5 border-b"
             style="border-color:rgba(59,130,246,0.15); background:rgba(59,130,246,0.05)">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                     style="background:rgba(59,130,246,0.15); border:1px solid rgba(59,130,246,0.25)">
                    <i class="fa-solid fa-pen-to-square text-blue-400"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm">Edit Data Satwa</h3>
                    <p id="edit-animal-subtitle" class="text-white/40 text-xs mt-0.5">Perbarui informasi satwa</p>
                </div>
            </div>
            <button onclick="closeEditAnimal()"
                    class="w-8 h-8 rounded-lg flex items-center justify-center text-white/40 hover:text-white hover:bg-white/10 transition-all">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        {{-- Form --}}
        <form id="edit-animal-form" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            {{-- Nama & Jumlah (side by side) --}}
            <div class="grid grid-cols-3 gap-4">
                <div class="col-span-2">
                    <label class="block text-xs font-semibold text-white/50 mb-2 uppercase tracking-wider">
                        <i class="fa-solid fa-paw mr-1.5 text-blue-400/70"></i>Nama Satwa
                    </label>
                    <input type="text" id="edit-animal-name" name="name" required
                           class="w-full text-white text-sm font-semibold bg-white/5 border rounded-xl px-4 py-3 outline-none transition-all"
                           style="border-color:rgba(255,255,255,0.1)"
                           onfocus="this.style.borderColor='rgba(59,130,246,0.5)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-white/50 mb-2 uppercase tracking-wider">
                        <i class="fa-solid fa-layer-group mr-1.5 text-gold/60"></i>Jumlah
                    </label>
                    <input type="number" id="edit-animal-amount" name="amount" required min="0"
                           class="w-full text-white text-sm font-bold bg-white/5 border rounded-xl px-4 py-3 outline-none transition-all text-center"
                           style="border-color:rgba(255,255,255,0.1)"
                           onfocus="this.style.borderColor='rgba(255,215,0,0.5)'"
                           onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                </div>
            </div>

            {{-- Status Kesehatan --}}
            <div>
                <label class="block text-xs font-semibold text-white/50 mb-2 uppercase tracking-wider">
                    <i class="fa-solid fa-heart-pulse mr-1.5 text-emerald-400/70"></i>Status Kesehatan
                </label>
                <div class="flex gap-2 flex-wrap">
                    @foreach(['Sehat', 'Sakit', 'Karantina', 'Pemulihan'] as $status)
                    <label class="status-option cursor-pointer">
                        <input type="radio" name="health_status" value="{{ $status }}"
                               id="status-{{ Str::slug($status) }}" class="sr-only">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-semibold border transition-all
                            @if($status === 'Sehat') status-sehat
                            @elseif($status === 'Sakit') status-sakit
                            @elseif($status === 'Karantina') status-karantina
                            @else status-pemulihan @endif">
                            <span class="w-1.5 h-1.5 rounded-full status-dot"></span>
                            {{ $status }}
                        </span>
                    </label>
                    @endforeach
                </div>
                {{-- Hidden fallback --}}
                <input type="hidden" id="edit-health-hidden" name="health_status_fallback">
            </div>

            {{-- Detail Pakan --}}
            <div>
                <label class="block text-xs font-semibold text-white/50 mb-2 uppercase tracking-wider">
                    <i class="fa-solid fa-seedling mr-1.5 text-lime-400/70"></i>Rincian Pakan
                </label>
                <textarea id="edit-animal-feeding" name="feeding_detail" required rows="3"
                          class="w-full text-white text-sm bg-white/5 border rounded-xl px-4 py-3 outline-none transition-all resize-none"
                          style="border-color:rgba(255,255,255,0.1); line-height:1.6"
                          onfocus="this.style.borderColor='rgba(59,130,246,0.5)'"
                          onblur="this.style.borderColor='rgba(255,255,255,0.1)'"></textarea>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-1">
                <button type="button" onclick="closeEditAnimal()"
                        class="flex-1 py-3 rounded-xl text-sm font-semibold text-white/60 hover:text-white border transition-all hover:bg-white/5"
                        style="border-color:rgba(255,255,255,0.12)">
                    Batal
                </button>
                <button type="submit"
                        class="flex-[2] py-3 rounded-xl text-sm font-bold flex items-center justify-center gap-2 transition-all"
                        style="background:linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; box-shadow:0 4px 16px rgba(59,130,246,0.35)">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan
                </button>
            </div>
        </form>
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

/* ===== PAGINATION BUTTONS ===== */
.pagination-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 32px;
    height: 32px;
    padding: 0 8px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.5);
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    text-decoration: none;
    transition: all 0.18s ease;
    cursor: pointer;
}
.pagination-btn:hover {
    background: rgba(255,255,255,0.1);
    color: #fff;
    border-color: rgba(255,255,255,0.2);
}
.pagination-disabled {
    opacity: 0.3;
    cursor: not-allowed;
    pointer-events: none;
}
.pagination-active {
    background: linear-gradient(135deg, rgba(255,215,0,0.25), rgba(255,215,0,0.12));
    color: #FFD700;
    border-color: rgba(255,215,0,0.4);
}
.pagination-active-blue {
    background: linear-gradient(135deg, rgba(59,130,246,0.25), rgba(59,130,246,0.12));
    color: #60a5fa;
    border-color: rgba(59,130,246,0.4);
}
.pagination-active-red {
    background: linear-gradient(135deg, rgba(239,68,68,0.25), rgba(239,68,68,0.12));
    color: #f87171;
    border-color: rgba(239,68,68,0.4);
}
.pagination-active-purple {
    background: linear-gradient(135deg, rgba(99,102,241,0.25), rgba(99,102,241,0.12));
    color: #a5b4fc;
    border-color: rgba(99,102,241,0.4);
}

/* ===== EDIT ANIMAL MODAL STATUS BADGES ===== */
.status-sehat  { color:#34d399; border-color:rgba(52,211,153,0.25); background:rgba(52,211,153,0.08); }
.status-sakit  { color:#f87171; border-color:rgba(248,113,113,0.25); background:rgba(248,113,113,0.08); }
.status-karantina { color:#fbbf24; border-color:rgba(251,191,36,0.25); background:rgba(251,191,36,0.08); }
.status-pemulihan { color:#60a5fa; border-color:rgba(96,165,250,0.25); background:rgba(96,165,250,0.08); }

.status-option input:checked + span.status-sehat   { background:rgba(52,211,153,0.2);  box-shadow:0 0 0 2px rgba(52,211,153,0.4);  }
.status-option input:checked + span.status-sakit   { background:rgba(248,113,113,0.2); box-shadow:0 0 0 2px rgba(248,113,113,0.4); }
.status-option input:checked + span.status-karantina { background:rgba(251,191,36,0.2); box-shadow:0 0 0 2px rgba(251,191,36,0.4); }
.status-option input:checked + span.status-pemulihan { background:rgba(96,165,250,0.2); box-shadow:0 0 0 2px rgba(96,165,250,0.4); }

.status-dot { background: currentColor; }
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

// ===== PAKAN SATUAN → STEP DINAMIS =====
// Satuan bulat (ikat, buah, sak, ekor) → hanya angka bulat
// Satuan desimal (kg, liter) → boleh koma
function updateJumlahStep() {
    const satuanEl = document.getElementById('pakan-satuan');
    const jumlahEl = document.getElementById('pakan-jumlah');
    if (!satuanEl || !jumlahEl) return;

    const satuanBulat = ['ikat', 'buah', 'sak', 'ekor'];
    const isBulat = satuanBulat.includes(satuanEl.value);

    if (isBulat) {
        jumlahEl.step  = '1';
        jumlahEl.min   = '1';
        // Bulatkan nilai yang sudah ada ke integer
        if (jumlahEl.value) {
            jumlahEl.value = Math.max(1, Math.round(parseFloat(jumlahEl.value) || 1));
        }
    } else {
        jumlahEl.step  = '0.5';
        jumlahEl.min   = '0.1';
    }
    hitungTotalPakan();
}

// Jalankan saat halaman pertama load
document.addEventListener('DOMContentLoaded', function() {
    updateJumlahStep();
});

// ===== PAKAN TOTAL PREVIEW =====
function hitungTotalPakan() {
    const jml   = parseFloat(document.getElementById('pakan-jumlah').value) || 0;
    const harga = parseInt(document.getElementById('pakan-harga').value)    || 0;
    const total = jml * harga;
    document.getElementById('pakan-total-preview').textContent =
        'Rp ' + total.toLocaleString('id-ID');
}

// ===== SATWA SEARCH (works with pagination, searches visible page) =====
function filterAnimal() {
    const q = document.getElementById('search-animal').value.toLowerCase().trim();
    document.querySelectorAll('.animal-row').forEach(row => {
        const name = row.querySelector('.animal-name')?.textContent.toLowerCase() || '';
        row.style.display = (q === '' || name.includes(q)) ? '' : 'none';
    });
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

// ===== GUDANG SEARCH =====
function filterGudang() {
    const q = document.getElementById('search-gudang').value.toLowerCase().trim();
    document.querySelectorAll('.gudang-row').forEach(row => {
        const nama = row.querySelector('.gudang-nama')?.textContent.toLowerCase() || '';
        row.style.display = nama.includes(q) ? '' : 'none';
    });
}
// ===== [BARU] FORM KESEHATAN: Update info ekor & preview kode individu =====
function updateKesehatanInfo() {
    const select    = document.getElementById('kesehatan-animal-select');
    const opt       = select.options[select.selectedIndex];
    const maxEkor   = parseInt(opt?.dataset?.amount) || 0;
    const maxLabel  = document.getElementById('max-ekor-label');
    const jumlahInput = document.getElementById('kesehatan-jumlah-sakit');
    const bar       = document.getElementById('jumlah-bar');

    if (maxEkor > 0) {
        maxLabel.textContent = '(maks. ' + maxEkor + ' ekor)';
        jumlahInput.max = maxEkor;
        bar.classList.remove('hidden');
    } else {
        maxLabel.textContent = '';
        bar.classList.add('hidden');
    }
    jumlahInput.value = '';
    document.getElementById('kode-preview').classList.add('hidden');
    document.getElementById('jumlah-fill').style.width = '0%';
}

function updateKodePreview() {
    const select    = document.getElementById('kesehatan-animal-select');
    const opt       = select.options[select.selectedIndex];
    const maxEkor   = parseInt(opt?.dataset?.amount) || 0;
    const kodeRaw   = opt?.dataset?.kode || 'SATWA';
    const prefix    = kodeRaw.replace(/-\d+$/, '');
    const jumlah    = parseInt(document.getElementById('kesehatan-jumlah-sakit').value) || 0;
    const previewEl = document.getElementById('kode-preview');
    const previewTxt= document.getElementById('kode-preview-text');
    const fillEl    = document.getElementById('jumlah-fill');

    if (maxEkor > 0) {
        const pct = Math.min(100, (jumlah / maxEkor) * 100);
        fillEl.style.width = pct + '%';
        // Ubah warna bar sesuai proporsi
        fillEl.style.background = pct >= 100
            ? 'linear-gradient(90deg,#dc2626,#991b1b)'
            : pct >= 50
                ? 'linear-gradient(90deg,#ef4444,#f97316)'
                : 'linear-gradient(90deg,#f97316,#fbbf24)';
    }

    if (jumlah <= 0 || !opt?.value) {
        previewEl.classList.add('hidden');
        return;
    }

    previewEl.classList.remove('hidden');
    if (jumlah >= maxEkor) {
        previewTxt.textContent = 'Semua (' + maxEkor + ' ekor)';
    } else {
        const kodes = [];
        for (let i = 1; i <= Math.min(jumlah, 8); i++) {
            kodes.push(prefix + '-' + String(i).padStart(3, '0'));
        }
        if (jumlah > 8) kodes.push('... (+' + (jumlah - 8) + ' lainnya)');
        previewTxt.textContent = kodes.join(', ');
    }
}

</script>
@endpush

@push('scripts')
<script>
// ===== EDIT ANIMAL MODAL =====
function openEditAnimal(id, name, amount, feedingDetail, healthStatus) {
    // Set action URL
    document.getElementById('edit-animal-form').action = '/admin/animal/' + id;

    // Fill form fields
    document.getElementById('edit-animal-name').value    = name;
    document.getElementById('edit-animal-amount').value  = amount;
    document.getElementById('edit-animal-feeding').value = feedingDetail;
    document.getElementById('edit-animal-subtitle').textContent = 'Mengedit: ' + name;

    // Select health status radio
    const radios = document.querySelectorAll('input[name="health_status"]');
    radios.forEach(r => {
        r.checked = (r.value === healthStatus);
    });
    // Fallback jika tidak cocok ke pilihan yang ada
    if (![...radios].some(r => r.checked)) {
        radios[0].checked = true;
    }

    // Show modal with animation
    const modal = document.getElementById('modal-edit-animal');
    const card  = document.getElementById('modal-edit-card');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    requestAnimationFrame(() => {
        card.style.transform = 'scale(1)';
        card.style.opacity   = '1';
    });
}

function closeEditAnimal() {
    const modal = document.getElementById('modal-edit-animal');
    const card  = document.getElementById('modal-edit-card');
    card.style.transform = 'scale(0.9)';
    card.style.opacity   = '0';
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }, 220);
}

// Tutup modal dengan ESC
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeEditAnimal();
});
</script>
@endpush
