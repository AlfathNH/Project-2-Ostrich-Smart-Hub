@extends('layouts.app')

@section('title', 'Kelola Harga — Ostrich Smart Hub')
@section('page-title', 'Kelola Harga Tiket')
@section('page-subtitle', 'Kelola harga tiket masuk Ostrich Mini Zoo')

@section('content')

<div class="max-w-2xl mx-auto animate__animated animate__fadeInUp">

    {{-- Current Price Banner --}}
    <div class="rounded-2xl border mb-6 p-5 flex items-center justify-between"
         style="background: linear-gradient(135deg, rgba(255,215,0,0.08), rgba(255,215,0,0.02)); border-color: rgba(255,215,0,0.2)">
        <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-gold/15 flex items-center justify-center">
                <i class="fa-solid fa-tags text-gold text-lg"></i>
            </div>
            <div>
                <div class="text-white/50 text-xs font-medium uppercase tracking-widest">Harga Dasar (Biasa)</div>
                <div class="text-2xl font-black mt-0.5"
                     style="background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                    Rp {{ number_format($hargaBiasa ?? 25000, 0, ',', '.') }}
                </div>
            </div>
        </div>
        <div class="text-right hidden sm:block">
            <div class="text-white/25 text-xs">Weekend: Rp {{ number_format($hargaLibur ?? 30000, 0, ',', '.') }}</div>
            <div class="text-white/25 text-xs">Hari Besar: Rp {{ number_format($hargaBesar ?? 35000, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Form Card: Kelola Harga --}}
    <div class="rounded-2xl border overflow-hidden mb-8" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.08)">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 px-6 py-4 border-b" style="border-color: rgba(255,255,255,0.07); background: rgba(255,215,0,0.03)">
            <div class="w-9 h-9 rounded-xl bg-gold/10 flex items-center justify-center">
                <i class="fa-solid fa-pen-to-square text-gold text-sm"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-sm">Perbarui Tarif Tiket Masuk</h2>
                <p class="text-white/35 text-xs">Atur harga berdasarkan hari</p>
            </div>
        </div>

        {{-- Form --}}
        <div class="p-6 md:p-8">
            <form action="{{ route('settings.update') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Harga Biasa --}}
                    <div>
                        <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                            <i class="fa-solid fa-calendar-day mr-1.5 text-blue-400"></i>Hari Biasa
                        </label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 text-sm font-semibold">Rp</div>
                            <input type="number" name="harga_biasa"
                                   class="w-full text-white text-lg font-bold bg-white/5 border rounded-xl pl-12 pr-4 py-4 outline-none focus:border-gold/60 transition-colors"
                                   style="border-color: rgba(255,255,255,0.1)"
                                   value="{{ $hargaBiasa ?? 25000 }}"
                                   min="0" step="1000" required>
                        </div>
                    </div>

                    {{-- Harga Libur (Weekend) --}}
                    <div>
                        <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                            <i class="fa-solid fa-champagne-glasses mr-1.5 text-emerald-400"></i>Akhir Pekan
                        </label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 text-sm font-semibold">Rp</div>
                            <input type="number" name="harga_libur"
                                   class="w-full text-white text-lg font-bold bg-white/5 border rounded-xl pl-12 pr-4 py-4 outline-none focus:border-gold/60 transition-colors"
                                   style="border-color: rgba(255,255,255,0.1)"
                                   value="{{ $hargaLibur ?? 30000 }}"
                                   min="0" step="1000" required>
                        </div>
                    </div>

                    {{-- Harga Hari Besar --}}
                    <div>
                        <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                            <i class="fa-solid fa-star mr-1.5 text-gold/80"></i>Hari Besar (Event)
                        </label>
                        <div class="relative">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/40 text-sm font-semibold">Rp</div>
                            <input type="number" name="harga_besar"
                                   class="w-full text-white text-lg font-bold bg-white/5 border rounded-xl pl-12 pr-4 py-4 outline-none focus:border-gold/60 transition-colors"
                                   style="border-color: rgba(255,255,255,0.1)"
                                   value="{{ $hargaBesar ?? 35000 }}"
                                   min="0" step="1000" required>
                        </div>
                    </div>
                </div>

                {{-- Divider --}}
                <div class="h-px bg-white/8"></div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="ripple-btn flex-1 flex items-center justify-center gap-2 font-bold text-sm text-charcoal py-3 rounded-xl transition-all"
                            style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 20px rgba(255,215,0,0.3)">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Perubahan Harga
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                       class="sm:w-36 flex items-center justify-center font-semibold text-sm text-white/60 hover:text-white py-3 px-4 rounded-xl border transition-all hover:bg-white/5"
                       style="border-color: rgba(255,255,255,0.12)">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>


    {{-- Form Card: Hari Besar --}}
    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.08)">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 px-6 py-4 border-b" style="border-color: rgba(255,255,255,0.07); background: rgba(255,215,0,0.03)">
            <div class="w-9 h-9 rounded-xl bg-gold/10 flex items-center justify-center">
                <i class="fa-regular fa-calendar-star text-gold text-sm"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-sm">Pengaturan Hari Besar / Libur Nasional</h2>
                <p class="text-white/35 text-xs">Tambahkan tanggal yang akan dikenakan harga tiket "Hari Besar"</p>
            </div>
        </div>

        <div class="p-6 md:p-8">
            {{-- Flash Messages Hari Besar --}}
            @if(session('success_hari_besar'))
                <div class="mb-5 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm">
                    <i class="fa-solid fa-check-circle mr-2"></i>{{ session('success_hari_besar') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-5 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('hari-besar.store') }}" method="POST" class="mb-8 flex flex-col md:flex-row gap-4 items-end">
                @csrf
                <div class="flex-1 w-full">
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">Tanggal Mulai</label>
                    <input type="date" name="tanggal" class="w-full text-white text-sm bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/60 transition-colors" style="border-color: rgba(255,255,255,0.1)" required>
                </div>
                <div class="flex-1 w-full">
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">Tanggal Selesai <span class="text-white/30 truncate" style="font-size:10px">(opsional)</span></label>
                    <input type="date" name="tanggal_selesai" class="w-full text-white text-sm bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/60 transition-colors" style="border-color: rgba(255,255,255,0.1)">
                </div>
                <div class="flex-[1.5] w-full">
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">Keterangan</label>
                    <input type="text" name="keterangan" placeholder="Contoh: Liburan Sekolah" class="w-full text-white text-sm bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/60 transition-colors" style="border-color: rgba(255,255,255,0.1)" required>
                </div>
                <button type="submit" class="w-full md:w-auto flex items-center justify-center gap-2 font-bold text-sm bg-white/10 hover:bg-gold hover:text-charcoal text-white py-3 px-6 rounded-xl transition-all border border-white/10 hover:border-gold">
                    <i class="fa-solid fa-plus"></i> Tambah
                </button>
            </form>

            {{-- Table --}}
            @if($hariBesars->count() > 0)
                <div class="overflow-x-auto rounded-xl border" style="border-color: rgba(255,255,255,0.1)">
                    <table class="w-full text-left text-sm text-white/70">
                        <thead class="text-xs uppercase bg-white/5 text-white/50">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Keterangan</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($hariBesars as $hb)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-white">
                                        {{ \Carbon\Carbon::parse($hb->tanggal)->locale('id')->isoFormat('D MMM YYYY') }}
                                        @if($hb->tanggal_selesai && $hb->tanggal !== $hb->tanggal_selesai)
                                            <span class="text-white/40 font-normal">s.d</span> {{ \Carbon\Carbon::parse($hb->tanggal_selesai)->locale('id')->isoFormat('D MMM YYYY') }}
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ $hb->keterangan }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <form action="{{ route('hari-besar.destroy', $hb->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tanggal ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center p-6 border border-dashed rounded-xl" style="border-color: rgba(255,255,255,0.1)">
                    <i class="fa-regular fa-calendar-xmark text-white/20 text-3xl mb-3"></i>
                    <p class="text-white/40 text-sm">Belum ada data hari besar.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Danger Zone --}}
    <div class="mt-5 rounded-xl border p-4 flex items-center gap-3"
         style="background: rgba(239,68,68,0.04); border-color: rgba(239,68,68,0.15)">
        <i class="fa-solid fa-triangle-exclamation text-red-400/70 text-sm flex-shrink-0"></i>
        <p class="text-white/30 text-xs leading-relaxed">
            Perubahan harga atau Hari Besar tiket akan segera terlihat oleh semua pengunjung.
            Pastikan nilai sudah benar sebelum menyimpannya.
        </p>
    </div>
</div>

@endsection
