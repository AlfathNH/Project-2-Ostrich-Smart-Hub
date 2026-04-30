<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Tiket Saya — Ostrich Smart Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { charcoal: '#1a1a1a', gold: '#FFD700' },
                    fontFamily: { inter: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #0a0a0a; min-height: 100vh; }
        .glass-navbar {
            background: rgba(10,10,10,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,215,0,0.12);
        }
        .ticket-card {
            background: rgba(255,255,255,0.025);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .ticket-card:hover {
            border-color: rgba(255,215,0,0.2);
            background: rgba(255,215,0,0.03);
            transform: translateY(-2px);
        }
        .ticket-card::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #FFD700, #c9a800);
            border-radius: 4px 0 0 4px;
        }
        .chip { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; }
        .chip-confirmed { background: rgba(16,185,129,0.12); color: #34d399; border: 1px solid rgba(16,185,129,0.2); }
        .chip-pending   { background: rgba(251,191,36,0.12); color: #fbbf24; border: 1px solid rgba(251,191,36,0.2); }
        .chip-qris     { background: rgba(245,158,11,0.1); color: #fbbf24; border: 1px solid rgba(245,158,11,0.2); }
        .chip-transfer { background: rgba(59,130,246,0.1); color: #60a5fa; border: 1px solid rgba(59,130,246,0.2); }
        .chip-ewallet  { background: rgba(168,85,247,0.1); color: #c084fc; border: 1px solid rgba(168,85,247,0.2); }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .stat-mini {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 16px 20px;
        }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="glass-navbar fixed top-0 left-0 right-0 z-50">
        <div class="max-w-5xl mx-auto px-5 py-3 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Logo" class="w-8 h-8 object-contain"
                     style="filter: drop-shadow(0 0 6px rgba(255,215,0,0.45))">
                <div>
                    <div class="text-white font-bold text-sm leading-tight">OSTRICH MINI ZOO</div>
                    <div class="text-gold text-[10px] tracking-widest">SUBANG</div>
                </div>
            </a>
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-2 bg-white/8 border border-white/12 rounded-full px-3 py-1.5">
                    <div class="w-5 h-5 rounded-full bg-gradient-to-br from-gold to-yellow-600 flex items-center justify-center text-[9px] font-black text-charcoal">
                        {{ strtoupper(substr(session('name', 'U'), 0, 1)) }}
                    </div>
                    <span class="text-white text-xs font-semibold max-w-[90px] truncate">{{ session('name', 'Pengunjung') }}</span>
                </div>
                <a href="{{ route('ticket.checkout') }}"
                   class="hidden sm:inline-flex items-center gap-1.5 bg-gold text-charcoal text-xs font-bold px-3 py-1.5 rounded-full hover:bg-yellow-300 transition-all">
                    <i class="fa-solid fa-ticket text-[10px]"></i> Beli Tiket
                </a>
                <a href="{{ route('logout') }}"
                   class="text-red-400 hover:text-red-300 text-xs font-semibold transition-colors px-2 py-1.5 rounded-lg hover:bg-red-900/20 flex items-center gap-1.5">
                    <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                    <span class="hidden sm:inline">Keluar</span>
                </a>
            </div>
        </div>
    </nav>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="max-w-5xl mx-auto px-5 pt-24 pb-16">

        {{-- Page Header --}}
        <div class="mb-8 animate__animated animate__fadeInDown">
            <div class="inline-flex items-center gap-2 bg-gold/10 border border-gold/20 text-gold text-xs font-semibold px-4 py-1.5 rounded-full mb-4">
                <i class="fa-solid fa-ticket text-[10px]"></i> Riwayat Pembelian
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">
                Tiket <span class="gold-gradient-text">Saya</span>
            </h1>
            <p class="text-white/40">Seluruh riwayat pembelian tiket Ostrich Mini Zoo Anda.</p>
        </div>

        {{-- ===== STATS MINI ===== --}}
        @php
            $totalOrders = $orders->count();
            $totalTiket  = $orders->sum('jumlah_tiket');
            $totalBayar  = $orders->sum('total_harga');
        @endphp
        <div class="grid grid-cols-3 gap-4 mb-8 animate__animated animate__fadeInUp">
            <div class="stat-mini text-center">
                <div class="text-2xl font-black text-white">{{ $totalOrders }}</div>
                <div class="text-white/40 text-xs mt-1">Total Transaksi</div>
            </div>
            <div class="stat-mini text-center">
                <div class="text-2xl font-black text-white">{{ $totalTiket }}</div>
                <div class="text-white/40 text-xs mt-1">Total Tiket</div>
            </div>
            <div class="stat-mini text-center">
                <div class="text-xl font-black gold-gradient-text">Rp {{ number_format($totalBayar, 0, ',', '.') }}</div>
                <div class="text-white/40 text-xs mt-1">Total Pembayaran</div>
            </div>
        </div>

        {{-- ===== TRANSACTION LIST ===== --}}
        @forelse($orders as $order)
        <div class="ticket-card p-5 mb-4 animate__animated animate__fadeInUp">
            <div class="pl-3">
                {{-- Top row --}}
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <div class="text-white font-bold text-base">
                            {{ $order->jumlah_tiket }} Tiket Masuk
                        </div>
                        <div class="text-white/40 text-xs mt-0.5">
                            <i class="fa-solid fa-calendar-days mr-1"></i>
                            Order: {{ $order->tanggal_order->locale('id')->isoFormat('D MMMM YYYY') }}
                        </div>
                    </div>
                    <div class="flex items-center gap-2 flex-shrink-0">
                        <span class="chip chip-{{ $order->status === 'confirmed' ? 'confirmed' : 'pending' }}">
                            <i class="fa-solid {{ $order->status === 'confirmed' ? 'fa-circle-check' : 'fa-clock' }} text-[9px]"></i>
                            {{ $order->status === 'confirmed' ? 'Terkonfirmasi' : 'Pending' }}
                        </span>
                    </div>
                </div>

                {{-- Details grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="bg-white/5 rounded-xl px-3 py-2.5">
                        <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Tanggal Kunjungan</div>
                        <div class="text-white font-semibold text-sm">
                            {{ $order->tanggal_kunjungan->locale('id')->isoFormat('D MMM YYYY') }}
                        </div>
                    </div>
                    <div class="bg-white/5 rounded-xl px-3 py-2.5">
                        <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Jumlah</div>
                        <div class="text-white font-semibold text-sm">{{ $order->jumlah_tiket }} tiket</div>
                    </div>
                    <div class="bg-white/5 rounded-xl px-3 py-2.5">
                        <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Harga/Tiket</div>
                        <div class="text-white font-semibold text-sm">Rp {{ number_format($order->harga_satuan, 0, ',', '.') }}</div>
                    </div>
                    <div class="bg-gold/8 border border-gold/15 rounded-xl px-3 py-2.5">
                        <div class="text-gold/60 text-[10px] uppercase tracking-widest mb-1">Total Bayar</div>
                        <div class="text-gold font-black text-sm">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between mt-3 pt-3 border-t border-white/6">
                    <div class="flex items-center gap-2">
                        <span class="chip chip-{{ $order->metode_bayar }}">
                            <i class="fa-solid fa-credit-card text-[9px]"></i>
                            {{ strtoupper($order->metode_bayar) }}
                        </span>
                        @if($order->catatan)
                        <span class="text-white/30 text-xs italic">{{ Str::limit($order->catatan, 40) }}</span>
                        @endif
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-white/30 text-[10px] font-mono uppercase tracking-widest">{{ $order->kode_booking }}</span>
                        <a href="{{ route('ticket.pdf', $order->id) }}" class="flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-wider text-charcoal bg-gold hover:bg-yellow-300 px-3 py-1.5 rounded-lg transition-colors">
                            <i class="fa-solid fa-file-pdf"></i> Unduh E-Ticket
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20 animate__animated animate__fadeIn">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6"
                 style="background: rgba(255,215,0,0.06); border: 1px solid rgba(255,215,0,0.12)">
                <i class="fa-solid fa-ticket text-gold text-3xl opacity-50"></i>
            </div>
            <h3 class="text-white font-bold text-xl mb-2">Belum Ada Tiket</h3>
            <p class="text-white/40 text-sm mb-6">Anda belum pernah membeli tiket. Yuk rencanakan kunjungan pertama Anda!</p>
            <a href="{{ route('ticket.checkout') }}"
               class="inline-flex items-center gap-2 font-bold text-charcoal px-6 py-3 rounded-full text-sm"
               style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 20px rgba(255,215,0,0.3)">
                <i class="fa-solid fa-ticket"></i> Beli Tiket Sekarang
            </a>
        </div>
        @endforelse

        {{-- CTA Bottom --}}
        @if($orders->count() > 0)
        <div class="mt-6 text-center">
            <a href="{{ route('ticket.checkout') }}"
               class="inline-flex items-center gap-2 font-bold text-charcoal px-6 py-3 rounded-full text-sm"
               style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 20px rgba(255,215,0,0.25)">
                <i class="fa-solid fa-plus"></i> Pesan Tiket Lagi
            </a>
        </div>
        @endif
    </main>

</body>
</html>
