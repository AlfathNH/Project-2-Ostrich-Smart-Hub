@extends('layouts.app')

@section('title', 'Tambah Satwa — Ostrich Smart Hub')
@section('page-title', 'Tambah Satwa Baru')
@section('page-subtitle', 'Input biodata penghuni zoo baru')

@section('content')

<div class="max-w-2xl mx-auto animate__animated animate__fadeInUp">

    {{-- Back Button --}}
    <a href="{{ route('admin.dashboard') }}"
       class="inline-flex items-center gap-2 text-white/40 hover:text-white text-sm mb-6 transition-colors">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        Kembali ke Dashboard
    </a>

    {{-- Form Card --}}
    <div class="rounded-2xl border overflow-hidden" style="background: rgba(15,15,15,0.85); border-color: rgba(255,255,255,0.08)">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 px-6 py-4 border-b" style="border-color: rgba(255,255,255,0.07); background: rgba(255,215,0,0.04)">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background: rgba(255,215,0,0.12)">
                <i class="fa-solid fa-paw text-gold"></i>
            </div>
            <div>
                <h2 class="text-white font-bold text-sm">Biodata Satwa Baru</h2>
                <p class="text-white/35 text-xs">Lengkapi semua informasi berikut</p>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-6 md:p-8">
            <form action="{{ route('admin.animal.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                        <i class="fa-solid fa-tag mr-1.5 text-gold/50"></i>Nama Hewan
                    </label>
                    <input type="text" name="name"
                           class="w-full text-sm text-white placeholder-white/25 bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/50 transition-colors"
                           style="border-color: rgba(255,255,255,0.1)"
                           placeholder="Contoh: Burung Unta, Kuda Mini..." required>
                </div>

                {{-- Amount --}}
                <div>
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                        <i class="fa-solid fa-layer-group mr-1.5 text-gold/50"></i>Jumlah (Ekor)
                    </label>
                    <input type="number" name="amount" min="1"
                           class="w-full text-sm text-white placeholder-white/25 bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/50 transition-colors"
                           style="border-color: rgba(255,255,255,0.1)"
                           placeholder="Masukkan jumlah ekor..." required>
                    <p class="text-white/25 text-xs mt-1.5 ml-1">Jumlah individu spesies yang ada di zoo saat ini</p>
                </div>

                {{-- Feeding Detail --}}
                <div>
                    <label class="block text-xs font-semibold text-white/60 mb-2 uppercase tracking-wider">
                        <i class="fa-solid fa-bowl-food mr-1.5 text-gold/50"></i>Rincian Pakan
                    </label>
                    <textarea name="feeding_detail" rows="4"
                              class="w-full text-sm text-white placeholder-white/25 bg-white/5 border rounded-xl px-4 py-3 outline-none focus:border-gold/50 transition-colors resize-none"
                              style="border-color: rgba(255,255,255,0.1)"
                              placeholder="Contoh: Sayur 2kg, Pur 1kg, Air minum 5L — 2x sehari" required></textarea>
                </div>

                {{-- Divider --}}
                <div class="h-px bg-white/8"></div>

                {{-- Actions --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-1">
                    <button type="submit"
                            class="ripple-btn flex-1 flex items-center justify-center gap-2 font-bold text-sm text-charcoal py-3 rounded-xl transition-all"
                            style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 20px rgba(255,215,0,0.3)">
                        <i class="fa-solid fa-floppy-disk"></i>
                        Simpan Data Satwa
                    </button>
                    <a href="{{ route('admin.dashboard') }}"
                       class="sm:w-36 flex items-center justify-center gap-2 font-semibold text-sm text-white/60 hover:text-white py-3 px-4 rounded-xl border transition-all hover:bg-white/5"
                       style="border-color: rgba(255,255,255,0.12)">
                        <i class="fa-solid fa-xmark text-xs"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    {{-- Info note --}}
    <div class="mt-4 flex items-center gap-2 text-white/25 text-xs px-1">
        <i class="fa-solid fa-circle-info text-gold/40"></i>
        Data satwa yang disimpan akan langsung tampil di database dan halaman zookeeper.
    </div>
</div>

@endsection
