@extends('layouts.app')

@section('title', 'Monitoring Pendapatan — Ostrich Smart Hub')
@section('page-title', 'Monitoring Pendapatan')
@section('page-subtitle', 'Monitoring Operasional & Kinerja Tim')

@section('content')

{{-- ===== SUCCESS / ERROR ALERTS ===== --}}
@if(session('success_staff'))
<div id="alert-staff" class="mb-5 flex items-center gap-3 px-5 py-3.5 rounded-xl border animate__animated animate__fadeInDown"
     style="background: rgba(16,185,129,0.08); border-color: rgba(16,185,129,0.25)">
    <i class="fa-solid fa-circle-check text-emerald-400"></i>
    <span class="text-emerald-300 text-sm font-medium">{{ session('success_staff') }}</span>
</div>
@endif
@if(session('error_staff'))
<div id="alert-err" class="mb-5 flex items-center gap-3 px-5 py-3.5 rounded-xl border animate__animated animate__fadeInDown"
     style="background: rgba(239,68,68,0.08); border-color: rgba(239,68,68,0.25)">
    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
    <span class="text-red-300 text-sm font-medium">{{ session('error_staff') }}</span>
</div>
@endif

{{-- ====================================================== --}}
{{-- TAB 0: OVERVIEW PENDAPATAN                             --}}
{{-- ====================================================== --}}
<div id="tab-overview" class="animate__animated animate__fadeIn">
{{-- ===== KPI STAT CARDS ===== --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

    {{-- Total Satwa --}}
    <div class="stat-card rounded-2xl p-5 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2);">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-gold/15 flex items-center justify-center">
                <i class="fa-solid fa-paw text-gold"></i>
            </div>
            <span class="text-xs font-bold text-gold/70 uppercase tracking-widest">Populasi</span>
        </div>
        <div class="text-4xl font-black text-white mb-1" id="counter-satwa" data-target="{{ $totalSatwa }}">0</div>
        <div class="text-white/40 text-xs">Total Ekor Satwa Seluruhnya</div>
        <div class="mt-3 h-1 rounded-full bg-white/10">
            <div class="h-full rounded-full bg-gold/60" style="width: 72%"></div>
        </div>
    </div>

    {{-- Staf Aktif --}}
    <div class="stat-card rounded-2xl p-5 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.1s">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-500/10 flex items-center justify-center">
                <i class="fa-solid fa-users text-emerald-400"></i>
            </div>
            <span class="text-xs font-bold text-emerald-400/70 uppercase tracking-widest">SDM</span>
        </div>
        <div class="text-4xl font-black text-white mb-1" id="counter-staf" data-target="{{ $stafAktif }}">0</div>
        <div class="text-white/40 text-xs">Pegawai Aktif Bertugas</div>
        <div class="mt-3 flex items-center gap-2 text-xs text-emerald-400/70">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse inline-block"></span>
            Semua dalam kondisi aktif
        </div>
    </div>

    {{-- Tiket Hari Ini --}}
    <div class="stat-card rounded-2xl p-5 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.2s">
        <div class="flex items-center justify-between mb-4">
            <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center">
                <i class="fa-solid fa-ticket text-blue-400"></i>
            </div>
            <span class="text-xs font-bold text-blue-400/70 uppercase tracking-widest">Tiket</span>
        </div>
        <div class="text-4xl font-black text-white mb-1">{{ $recentOrders->count() }}</div>
        <div class="text-white/40 text-xs">Total Order Tercatat</div>
        <div class="mt-3 flex items-center gap-1.5 text-xs text-blue-400/70">
            <i class="fa-solid fa-arrow-trend-up text-[10px]"></i>
            Rp {{ number_format($recentOrders->sum('total_harga'), 0, ',', '.') }} total pemasukan
        </div>
    </div>
</div>

{{-- ===== VISUAL SUMMARY / EXTENDED OVERVIEW ===== --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate__animated animate__fadeInUp" style="animation-delay:0.3s">
    
    {{-- Main Activity (Left 2 cols) --}}
    <div class="lg:col-span-2 rounded-2xl border p-6 flex flex-col" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex items-center justify-between mb-5">
            <h3 class="text-white font-bold text-sm flex items-center gap-2">
                <i class="fa-solid fa-chart-area text-gold"></i>
                Ringkasan Transaksi Terakhir
            </h3>
        </div>
        
        <div class="space-y-3 flex-1">
            @forelse($recentOrders->take(4) as $order)
                <div class="flex items-center justify-between p-3 rounded-xl bg-white/5 border border-white/5 hover:bg-white/10 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-500/10 flex items-center justify-center text-blue-400">
                            <i class="fa-solid fa-ticket"></i>
                        </div>
                        <div>
                            <div class="text-white font-semibold text-sm">{{ $order->nama_pemesan }}</div>
                            <div class="text-white/40 text-[10px]"><span class="text-gold font-mono">{{ $order->kode_booking }}</span> &bull; {{ \Carbon\Carbon::parse($order->tanggal_order)->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-emerald-400 font-bold text-sm">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                        <div class="text-white/30 text-[10px]">{{ $order->jumlah_tiket }} Tiket</div>
                    </div>
                </div>
            @empty
                <div class="h-full flex flex-col items-center justify-center text-center text-white/30 py-8">
                    <i class="fa-solid fa-box-open text-3xl mb-2 opacity-50"></i>
                    <p class="text-xs">Belum ada transaksi tiket saat ini</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Info Cards (Right col) --}}
    <div class="space-y-6">
        <div class="rounded-2xl border p-6" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
            <h3 class="text-white font-bold text-sm flex items-center gap-2 mb-4">
                <i class="fa-solid fa-bullseye text-emerald-400"></i>
                Indikator Penjualan
            </h3>
            @php $target = 10000000; $sum = $recentOrders->sum('total_harga'); $pct = min(($sum / max($target, 1)) * 100, 100); @endphp
            <div class="text-3xl font-black text-white mb-1">
                {{ number_format($pct, 1) }}%
            </div>
            <div class="text-white/40 text-xs mb-3">Tercapai dari target Rp {{ number_format($target, 0, ',', '.') }}</div>
            <div class="h-2 rounded-full bg-white/10 overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-300" 
                     style="width: {{ $pct }}%"></div>
            </div>
        </div>

        <div class="rounded-2xl border p-6" style="background:rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
            <h3 class="text-white font-bold text-sm flex items-center gap-2 mb-4">
                <i class="fa-solid fa-users text-blue-400"></i>
                Komposisi Tim
            </h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-white/60 text-xs inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-blue-400"></span>Zookeeper</span>
                    <span class="text-white font-bold text-xs">{{ $staffs->where('role', 'Zookeeper')->count() }} Orang</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-white/60 text-xs inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-amber-400"></span>Manager</span>
                    <span class="text-white font-bold text-xs">{{ $staffs->where('role', 'Manager')->count() }} Orang</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-white/60 text-xs inline-flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-rose-400"></span>Admin</span>
                    <span class="text-white font-bold text-xs">{{ $staffs->where('role', 'Admin')->count() }} Orang</span>
                </div>
            </div>
            <a href="?tab=staff" class="block text-center text-[11px] font-bold mt-5 py-2.5 rounded-lg bg-white/5 hover:bg-white/10 text-white/70 transition-colors uppercase tracking-wider">
                Kelola Detail Tim
            </a>
        </div>
    </div>
</div>
</div>{{-- end tab-overview --}}

{{-- ===== TAB NAVIGATION DIHAPUS (Pindah ke Sidebar) ===== --}}

{{-- ====================================================== --}}
{{-- TAB 1: KELOLA STAFF                                    --}}
{{-- ====================================================== --}}
<div id="tab-staff" class="animate__animated animate__fadeIn">
<div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

    {{-- ===== FORM BUAT AKUN STAFF ===== --}}
    <div class="lg:col-span-2 animate__animated animate__fadeInUp" style="animation-delay:0.25s">
        <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.85); border-color: rgba(255,215,0,0.2)">
            <div class="px-6 py-4 border-b flex items-center gap-3" style="border-color:rgba(255,215,0,0.15); background:rgba(255,215,0,0.04)">
                <div class="w-9 h-9 rounded-xl bg-gold/15 flex items-center justify-center">
                    <i class="fa-solid fa-user-plus text-gold"></i>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm">Buat Akun Staff Baru</h3>
                    <p class="text-white/30 text-xs">Admin, Manager, atau Zookeeper</p>
                </div>
            </div>
            <form action="{{ route('manager.staff.store') }}" method="POST" class="p-5 space-y-4" id="staff-form">
                @csrf
                @if($errors->any())
                <div class="flex items-start gap-2 bg-red-900/20 border border-red-500/20 text-red-300 px-4 py-3 rounded-xl text-xs">
                    <i class="fa-solid fa-circle-exclamation text-red-400 mt-0.5 flex-shrink-0"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
                @endif
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           placeholder="Nama staff..." class="mgr-input w-full">
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Username <span class="text-white/30 normal-case font-normal">(untuk login)</span></label>
                    <input type="text" name="username" required value="{{ old('username') }}"
                           placeholder="username_staff" class="mgr-input w-full" autocomplete="off">
                </div>
                <div>
                    <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Password</label>
                    <input type="password" name="password" required
                           placeholder="Min. 6 karakter" class="mgr-input w-full" autocomplete="new-password">
                </div>
                <div class="grid grid-cols-1 gap-3">
                    <div>
                        <label class="block text-white/50 text-xs font-semibold mb-1.5 uppercase tracking-wider">Role</label>
                        <select name="role" required class="mgr-input w-full">
                            <option value="">Pilih role...</option>
                            <option value="Admin" {{ old('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                            <option value="Manager" {{ old('role') === 'Manager' ? 'selected' : '' }}>Manager</option>
                            <option value="Zookeeper" {{ old('role') === 'Zookeeper' ? 'selected' : '' }}>Zookeeper</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                        class="ripple-btn w-full flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-bold"
                        style="background:linear-gradient(135deg,#FFD700,#f0c800); color:#1a1a1a; box-shadow:0 4px 15px rgba(255,215,0,0.3)">
                    <i class="fa-solid fa-user-plus"></i> Buat Akun Staff
                </button>
            </form>
        </div>
    </div>

    {{-- ===== TABEL STAFF ===== --}}
    <div class="lg:col-span-3 animate__animated animate__fadeInUp" style="animation-delay:0.3s">
        <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.8); border-color: rgba(255,255,255,0.07)">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-5 py-4 border-b" style="border-color: rgba(255,255,255,0.07)">
                <div>
                    <h3 class="text-white font-bold text-sm flex items-center gap-2">
                        <i class="fa-solid fa-users-viewfinder text-gold text-xs"></i>
                        Daftar Seluruh Staff
                    </h3>
                    <p class="text-white/30 text-xs mt-0.5">{{ $staffs->count() }} akun terdaftar · {{ $stafAktif }} aktif</p>
                </div>
                <div class="relative w-full sm:w-48">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="text" id="search-staff" oninput="filterStaff()"
                           placeholder="Cari pegawai..."
                           class="w-full text-xs text-white placeholder-white/30 bg-white/5 border rounded-xl pl-8 pr-3 py-2 outline-none focus:border-gold/50 transition-colors"
                           style="border-color: rgba(255,255,255,0.1)">
                </div>
            </div>
            <table class="w-full" id="staff-table">
                <thead>
                    <tr style="background: rgba(255,215,0,0.03); border-bottom: 1px solid rgba(255,255,255,0.05)">
                        <th class="px-5 py-3 text-left text-xs font-bold text-white/35 uppercase tracking-widest">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white/35 uppercase tracking-widest">Role</th>
                        <th class="px-4 py-3 text-left text-xs font-bold text-white/35 uppercase tracking-widest hidden sm:table-cell">Username</th>
                        <th class="px-4 py-3 text-center text-xs font-bold text-white/35 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody id="staff-tbody">
                    @foreach($staffs as $staff)
                    <tr class="staff-row border-b hover:bg-white/3 transition-colors" style="border-color: rgba(255,255,255,0.04)">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-bold text-charcoal flex-shrink-0"
                                     style="background: linear-gradient(135deg, #FFD700, #c9a800)">
                                    {{ strtoupper(substr($staff->name, 0, 1)) }}
                                </div>
                                <span class="text-white text-sm font-semibold staff-name">{{ $staff->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3.5">
                            @php
                                $roleColor = match($staff->role) {
                                    'Manager'   => 'background:rgba(255,215,0,0.1);color:#FFD700;border-color:rgba(255,215,0,0.2)',
                                    'Admin'     => 'background:rgba(59,130,246,0.1);color:#60a5fa;border-color:rgba(59,130,246,0.2)',
                                    'Zookeeper' => 'background:rgba(16,185,129,0.1);color:#34d399;border-color:rgba(16,185,129,0.2)',
                                    default     => 'background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.5);border-color:rgba(255,255,255,0.1)',
                                };
                            @endphp
                            <span class="inline-flex items-center text-xs font-bold px-2.5 py-1 rounded-lg border" style="{{ $roleColor }}">
                                {{ $staff->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3.5 text-white/40 text-xs hidden sm:table-cell font-mono">
                            {{ $staff->username }}
                        </td>
                        <td class="px-4 py-3.5 text-center">
                            <form action="{{ route('manager.staff.destroy', $staff->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus akun {{ addslashes($staff->name) }}? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="ripple-btn text-red-400/70 hover:text-red-400 transition-colors bg-red-500/8 hover:bg-red-500/15 px-3 py-1.5 rounded-lg text-xs font-semibold border border-red-500/15 flex items-center gap-1.5 mx-auto">
                                    <i class="fa-solid fa-trash text-[10px]"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>{{-- end tab-staff --}}

{{-- ====================================================== --}}
{{-- TAB 2: RIWAYAT TIKET                                   --}}
{{-- ====================================================== --}}
<div id="tab-tiket" class="hidden animate__animated animate__fadeIn">
    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.8); border-color: rgba(255,255,255,0.07)">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
            <div>
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fa-solid fa-ticket text-gold text-xs"></i>
                    Riwayat Pembelian Tiket
                </h3>
                <p class="text-white/30 text-xs mt-0.5">{{ $recentOrders->count() }} transaksi · Rp {{ number_format($recentOrders->sum('total_harga'), 0, ',', '.') }} total</p>
            </div>
            <div class="relative w-full sm:w-52">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                <input type="text" id="search-order-mgr" oninput="filterOrderMgr()"
                       placeholder="Cari nama pemesan..."
                       class="w-full text-xs text-white placeholder-white/30 bg-white/5 border rounded-xl pl-8 pr-3 py-2 outline-none focus:border-gold/50 transition-colors"
                       style="border-color: rgba(255,255,255,0.1)">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs" id="order-table-mgr">
                <thead>
                    <tr style="background:rgba(255,215,0,0.04); border-bottom:1px solid rgba(255,255,255,0.06)">
                        <th class="px-4 py-3 text-left text-white/35 font-bold uppercase tracking-wider">#</th>
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
                    @forelse($recentOrders as $i => $o)
                    <tr class="order-row border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-4 py-3 text-white/30">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-white/50 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($o->tanggal_order)->locale('id')->isoFormat('D MMM YY') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-white font-semibold order-name">{{ $o->nama_pemesan }}</span>
                            <div class="text-white/30 text-[10px]">{{ $o->phone }}</div>
                        </td>
                        <td class="px-4 py-3 text-white/40">{{ $o->phone }}</td>
                        <td class="px-4 py-3 text-center font-bold text-white">{{ $o->jumlah_tiket }}</td>
                        <td class="px-4 py-3 text-right font-bold" style="color:#4ade80">Rp {{ number_format($o->total_harga, 0, ',', '.') }}</td>
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
</div>{{-- end tab-tiket --}}

{{-- ===== PRINT CTA ===== --}}
<div class="mt-6 animate__animated animate__fadeInUp" style="animation-delay:0.5s">
    <div class="rounded-2xl border p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.05), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.18)">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-print text-gold"></i>
            </div>
            <div>
                <div class="text-white font-semibold text-sm">Pusat Cetak Laporan</div>
                <div class="text-white/40 text-xs mt-0.5">Ekspor laporan bulanan dalam format PDF atau Excel</div>
            </div>
        </div>
        <a href="{{ route('manager.laporan') }}"
                class="ripple-btn flex items-center gap-2 text-xs font-bold text-charcoal px-5 py-2.5 rounded-xl whitespace-nowrap"
                style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 15px rgba(255,215,0,0.25)">
            <i class="fa-solid fa-print"></i> Cetak Laporan Bulanan
        </a>
    </div>
</div>

{{-- ====================================================== --}}
{{-- TAB 2: RIWAYAT TIKET (MANAJER)                         --}}
{{-- ====================================================== --}}
<div id="tab-tiket" class="animate__animated animate__fadeIn hidden">
    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.8); border-color:rgba(255,255,255,0.07)">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
            <div>
                <h3 class="text-white font-bold text-sm flex items-center gap-2">
                    <i class="fa-solid fa-ticket text-gold text-xs"></i>
                    Riwayat Pembelian Tiket
                </h3>
                <p class="text-white/30 text-xs mt-0.5">{{ $orders->count() }} transaksi tercatat · Gunakan untuk melihat tiket secara live</p>
            </div>
            <div class="relative w-full sm:w-52">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                <input type="text" id="search-order-mgr" oninput="filterOrderMgr()"
                       placeholder="Cari nama pemesan..."
                       class="w-full text-xs text-white placeholder-white/30 bg-white/5 border rounded-xl pl-8 pr-3 py-2 outline-none focus:border-gold/50 transition-colors"
                       style="border-color: rgba(255,255,255,0.1)">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-xs" id="order-table-mgr">
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
                    <tr class="order-row border-b hover:bg-white/[0.02] transition-colors" style="border-color:rgba(255,255,255,0.04)">
                        <td class="px-4 py-3 text-white/30">{{ $i + 1 }}</td>
                        <td class="px-4 py-3 text-gold font-mono text-[11px] font-bold tracking-wide">{{ $o->kode_booking }}</td>
                        <td class="px-4 py-3 text-white/50 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($o->tanggal_order)->locale('id')->isoFormat('D MMM YY') }}
                        </td>
                        <td class="px-4 py-3">
                            <span class="text-white font-semibold order-name">{{ $o->nama_pemesan }}</span>
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
                    <tr><td colspan="10" class="text-center py-12 text-white/25 italic">Belum ada transaksi tiket.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@push('styles')
<style>
.mgr-tab-btn {
    color: rgba(255,255,255,0.45);
    background: transparent;
    border: none;
    cursor: pointer;
}
.mgr-tab-btn:hover { color: rgba(255,255,255,0.75); background: rgba(255,255,255,0.05); }
.mgr-tab-btn.active-tab {
    color: #1a1a1a;
    background: linear-gradient(135deg, #FFD700, #f0c800);
    box-shadow: 0 4px 12px rgba(255,215,0,0.3);
}
#tab-btn-tiket.active-tab { background: linear-gradient(135deg,#3b82f6,#2563eb); color:#fff; box-shadow:0 4px 12px rgba(59,130,246,0.3); }
.mgr-input {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 8px 12px;
    color: #fff;
    font-size: 12px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s;
}
.mgr-input:focus { border-color: rgba(255,215,0,0.4); }
.mgr-input::placeholder { color: rgba(255,255,255,0.25); }
.mgr-input option { background: #1a1a2e; color: #fff; }
</style>
@endpush

@push('scripts')
<script>
// ===== ANIMATED COUNTERS =====
function animateCounter(el) {
    const target = parseInt(el.dataset.target) || 0;
    const duration = 1200;
    const step = target / (duration / 16);
    let current = 0;
    const timer = setInterval(() => {
        current += step;
        if (current >= target) { current = target; clearInterval(timer); }
        el.textContent = Math.round(current);
    }, 16);
}
document.querySelectorAll('[data-target]').forEach(el => animateCounter(el));

// ===== TAB SWITCHING =====
const mgrTabs = ['overview', 'staff', 'tiket'];
function switchMgrTab(name) {
    mgrTabs.forEach(t => {
        const tabEl = document.getElementById('tab-' + t);
        if(tabEl) tabEl.classList.add('hidden');
    });
    const targetTab = document.getElementById('tab-' + name);
    if(targetTab) targetTab.classList.remove('hidden');
    history.replaceState(null, '', window.location.pathname + '?tab=' + name);
}
// Auto-switch on load
(function() {
    const params = new URLSearchParams(window.location.search);
    const tab = params.get('tab') || 'overview';
    if (mgrTabs.includes(tab)) switchMgrTab(tab);
    @if(session('success_staff') || $errors->any()) switchMgrTab('staff'); @endif
})();

// ===== STAFF SEARCH =====
function filterStaff() {
    const q = document.getElementById('search-staff').value.toLowerCase();
    document.querySelectorAll('.staff-row').forEach(row => {
        const name = row.querySelector('.staff-name')?.textContent.toLowerCase() || '';
        row.style.display = name.includes(q) ? '' : 'none';
    });
}

// ===== ORDER SEARCH (Manager) =====
function filterOrderMgr() {
    const q = document.getElementById('search-order-mgr').value.toLowerCase();
    document.querySelectorAll('.order-row').forEach(row => {
        const name = row.querySelector('.order-name')?.textContent.toLowerCase() || '';
        row.style.display = name.includes(q) ? '' : 'none';
    });
}

// Auto-dismiss alerts
setTimeout(() => {
    ['alert-staff','alert-err'].forEach(id => {
        const el = document.getElementById(id);
        if (el) { el.style.transition='opacity 0.4s'; el.style.opacity='0'; setTimeout(()=>el.remove(), 400); }
    });
}, 4000);
</script>
@endpush
