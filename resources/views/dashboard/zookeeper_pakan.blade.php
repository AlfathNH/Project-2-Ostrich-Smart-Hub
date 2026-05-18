@extends('layouts.app')

@section('title', 'Kelola Pakan — Ostrich Smart Hub')
@section('page-title', 'Kelola Pakan')
@section('page-subtitle', 'Jadwal & pemberian pakan harian satwa')

@push('styles')
<style>
/* Dark theme untuk semua input/select di halaman ini */
.zk-input {
    background: rgba(20, 22, 35, 0.9);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    color: #fff;
    padding: 7px 12px;
    font-size: 12px;
    font-family: inherit;
    outline: none;
    width: 100%;
    transition: border-color 0.2s;
    appearance: none;
    -webkit-appearance: none;
}
.zk-input:focus { border-color: rgba(59,130,246,0.5); }
.zk-input::placeholder { color: rgba(255,255,255,0.28); }
.zk-input option {
    background: #141622;
    color: #fff;
    padding: 6px 12px;
}
.zk-input:disabled, .zk-input[readonly] {
    color: rgba(255,255,255,0.4);
    background: rgba(255,255,255,0.04);
}
/* Custom chevron untuk select */
.zk-select-wrap {
    position: relative;
}
.zk-select-wrap::after {
    content: '';
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    width: 0; height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid rgba(255,255,255,0.4);
    pointer-events: none;
}
.zk-select-wrap select { padding-right: 28px; }
</style>
@endpush

@section('content')

{{-- ===== STATS HARIAN ===== --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2);">
        <div class="w-9 h-9 rounded-xl bg-gold/15 flex items-center justify-center mb-3">
            <i class="fa-solid fa-paw text-gold text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">{{ $animals->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Total Satwa</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: linear-gradient(135deg, rgba(16,185,129,0.08), rgba(16,185,129,0.02)); border-color: rgba(16,185,129,0.2); animation-delay:0.1s">
        <div class="w-9 h-9 rounded-xl bg-emerald-500/15 flex items-center justify-center mb-3">
            <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-emerald-300">{{ $totalSudah }}</div>
        <div class="text-white/40 text-xs mt-0.5">Sudah Diberi</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.15s">
        <div class="w-9 h-9 rounded-xl bg-orange-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-hourglass-half text-orange-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-orange-300">{{ $totalBelum }}</div>
        <div class="text-white/40 text-xs mt-0.5">Belum Diberi</div>
    </div>
    <div class="stat-card rounded-2xl p-4 border animate__animated animate__fadeInUp"
         style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.07); animation-delay:0.2s">
        <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center mb-3">
            <i class="fa-solid fa-warehouse text-blue-400 text-sm"></i>
        </div>
        <div class="text-2xl font-black text-white">{{ $stokGudang->count() }}</div>
        <div class="text-white/40 text-xs mt-0.5">Jenis Stok Tersedia</div>
    </div>
</div>

{{-- Progress bar harian --}}
@if($animals->count() > 0)
<div class="mb-6 rounded-2xl border p-4 animate__animated animate__fadeInUp" style="background:rgba(15,15,15,0.85); border-color:rgba(255,255,255,0.07); animation-delay:0.2s">
    <div class="flex items-center justify-between mb-2">
        <span class="text-white/50 text-xs font-semibold">Progress Pemberian Pakan Hari Ini</span>
        <span class="text-white/70 text-xs font-bold">{{ $totalSudah }}/{{ $animals->count() }} satwa</span>
    </div>
    <div class="w-full h-2.5 rounded-full" style="background:rgba(255,255,255,0.08)">
        @php $pct = $animals->count() > 0 ? round(($totalSudah / $animals->count()) * 100) : 0; @endphp
        <div class="h-2.5 rounded-full transition-all duration-700"
             style="width: {{ $pct }}%; background: linear-gradient(90deg, #10b981, #34d399)">
        </div>
    </div>
    <div class="mt-1 text-right text-xs text-emerald-400/60 font-bold">{{ $pct }}%</div>
</div>
@endif

{{-- ===== DAFTAR SATWA ===== --}}
<div class="rounded-2xl border overflow-hidden animate__animated animate__fadeInUp" style="background:rgba(15,15,15,0.85); border-color:rgba(255,255,255,0.07); animation-delay:0.25s">
    <div class="flex items-center justify-between px-5 py-4 border-b" style="border-color:rgba(255,255,255,0.07)">
        <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-blue-500/10 flex items-center justify-center">
                <i class="fa-solid fa-bowl-food text-blue-400"></i>
            </div>
            <div>
                <h3 class="text-white font-bold text-sm">Jadwal Pemberian Pakan</h3>
                <p class="text-white/30 text-xs">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }} · Reset otomatis setiap hari</p>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-[11px] font-bold px-3 py-1.5 rounded-full">
            <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse inline-block"></span>
            Hari Ini
        </div>
    </div>

    <div class="p-4 space-y-3">
        @forelse($animals as $animal)
        @php
            $sudah = isset($statusHariIni[$animal->id]) && $statusHariIni[$animal->id];
        @endphp
        <div class="rounded-xl border p-4 transition-all {{ $sudah ? 'border-emerald-500/30' : 'border-white/6 hover:border-blue-500/25' }}"
             style="background: {{ $sudah ? 'rgba(16,185,129,0.05)' : 'rgba(255,255,255,0.02)' }}">
            <div class="flex items-start justify-between gap-3">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0 border
                        {{ $sudah ? 'bg-emerald-500/15 border-emerald-500/25' : 'bg-gold/10 border-gold/15' }}">
                        <i class="fa-solid fa-paw text-sm {{ $sudah ? 'text-emerald-400' : 'text-gold' }}"></i>
                    </div>
                    <div class="min-w-0">
                        <div class="text-white font-bold text-sm uppercase tracking-wide truncate">{{ $animal->name }}</div>
                        <div class="text-white/40 text-xs mt-0.5">{{ $animal->amount }} Ekor</div>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-1.5 flex-shrink-0">
                    @if($sudah)
                        <span class="inline-flex items-center gap-1.5 bg-emerald-500/15 text-emerald-400 text-[11px] font-bold px-3 py-1 rounded-full border border-emerald-500/25 whitespace-nowrap">
                            <i class="fa-solid fa-circle-check text-[10px]"></i> Sudah Diberi
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-orange-500/10 text-orange-400 text-[11px] font-bold px-3 py-1 rounded-full border border-orange-500/20 whitespace-nowrap">
                            <i class="fa-regular fa-clock text-[9px]"></i> Belum Diberi
                        </span>
                    @endif
                    <span class="flex items-center gap-1 text-emerald-400/60 text-[10px]">
                        <i class="fa-regular fa-clock text-[9px]"></i> 07:00
                    </span>
                    <span class="flex items-center gap-1 text-orange-400/60 text-[10px]">
                        <i class="fa-regular fa-clock text-[9px]"></i> 16:00
                    </span>
                </div>
            </div>

            {{-- Rincian pakan --}}
            <div class="mt-3 pt-3 border-t flex items-start gap-2" style="border-color: rgba(255,255,255,0.06)">
                <i class="fa-solid fa-leaf text-green-400/60 text-xs mt-0.5 flex-shrink-0"></i>
                <p class="text-white/50 text-xs leading-relaxed">{{ $animal->feeding_detail ?? 'Belum ada rincian pakan.' }}</p>
            </div>

            {{-- Tombol tandai / form --}}
            @if($sudah)
                <div class="mt-3 w-full text-xs font-semibold text-emerald-400 bg-emerald-500/8 border border-emerald-500/20 py-2.5 rounded-xl text-center">
                    <i class="fa-solid fa-circle-check mr-1.5"></i>Sudah Diberi Pakan Hari Ini ✓
                </div>
            @else
                {{-- Trigger form --}}
                <button onclick="toggleForm({{ $animal->id }})"
                        class="mt-3 w-full text-xs font-semibold text-white/40 hover:text-blue-400 border border-white/8 hover:border-blue-500/30 hover:bg-blue-500/5 py-2.5 rounded-xl transition-all"
                        id="btn-{{ $animal->id }}">
                    <i class="fa-regular fa-circle-check mr-1.5"></i>Tandai Sudah Diberi Pakan
                </button>

                {{-- Inline form (tersembunyi) --}}
                <div id="form-{{ $animal->id }}" class="hidden mt-3">
                    <form action="{{ route('zookeeper.tandai', $animal->id) }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-white/40 text-[10px] font-bold uppercase tracking-wider mb-1">Pilih Pakan dari Stok</label>
                                <div class="zk-select-wrap">
                                    <select name="nama_pakan" id="select-pakan-{{ $animal->id }}" required
                                            onchange="updateSatuan({{ $animal->id }})"
                                            class="zk-input">
                                        <option value="" style="background:#141622">-- Pilih pakan --</option>
                                        @foreach($stokGudang as $stok)
                                        <option value="{{ $stok->nama_pakan }}"
                                                data-satuan="{{ $stok->satuan }}"
                                                data-stok="{{ $stok->total_jumlah }}"
                                                style="background:#141622">
                                            {{ $stok->nama_pakan }} ({{ $stok->total_jumlah % 1 == 0 ? (int)$stok->total_jumlah : $stok->total_jumlah }} {{ $stok->satuan }} tersisa)
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-white/40 text-[10px] font-bold uppercase tracking-wider mb-1">Jumlah Digunakan</label>
                                <div class="flex gap-1">
                                    <input type="number" name="jumlah" id="jumlah-{{ $animal->id }}" required
                                           min="0.01" step="0.5" placeholder="0"
                                           class="zk-input" style="flex:1">
                                    <input type="text" name="satuan" id="satuan-{{ $animal->id }}" readonly
                                           placeholder="sat"
                                           class="zk-input" style="width:56px; text-align:center">
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-white/40 text-[10px] font-bold uppercase tracking-wider mb-1">Catatan (opsional)</label>
                            <input type="text" name="catatan" placeholder="Kondisi nafsu makan, dll..."
                                   class="zk-input">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                    class="flex-1 text-xs font-bold text-white py-2.5 rounded-xl transition-all"
                                    style="background:linear-gradient(135deg,#10b981,#059669); box-shadow:0 4px 12px rgba(16,185,129,0.25)">
                                <i class="fa-solid fa-check mr-1.5"></i>Konfirmasi & Simpan
                            </button>
                            <button type="button" onclick="toggleForm({{ $animal->id }})"
                                    class="text-xs font-semibold text-white/40 hover:text-white bg-white/5 hover:bg-white/8 border border-white/10 px-4 py-2.5 rounded-xl transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            @endif
        </div>
        @empty
        <div class="text-center py-16">
            <i class="fa-solid fa-bowl-food text-white/10 text-5xl mb-3"></i>
            <p class="text-white/30 text-sm">Belum ada data satwa.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
function toggleForm(id) {
    const form = document.getElementById('form-' + id);
    const btn  = document.getElementById('btn-' + id);
    if (form.classList.contains('hidden')) {
        form.classList.remove('hidden');
        form.style.opacity = '0';
        requestAnimationFrame(() => {
            form.style.transition = 'opacity 0.25s';
            form.style.opacity = '1';
        });
        btn.classList.add('hidden');
    } else {
        form.classList.add('hidden');
        btn.classList.remove('hidden');
    }
}

function updateSatuan(animalId) {
    const select = document.getElementById('select-pakan-' + animalId);
    const satuanInput = document.getElementById('satuan-' + animalId);
    const jumlahInput = document.getElementById('jumlah-' + animalId);
    const selected = select.options[select.selectedIndex];

    if (selected && selected.dataset.satuan) {
        satuanInput.value = selected.dataset.satuan;
        // Set step dan min sesuai satuan
        const satuanBulat = ['ikat', 'buah', 'sak', 'ekor'];
        if (satuanBulat.includes(selected.dataset.satuan)) {
            jumlahInput.step = '1';
            jumlahInput.min  = '1';
        } else {
            jumlahInput.step = '0.5';
            jumlahInput.min  = '0.1';
        }
    } else {
        satuanInput.value = '';
    }
}
</script>
@endpush
