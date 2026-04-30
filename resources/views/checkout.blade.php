<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Tiket — Ostrich Smart Hub</title>
    <meta name="description" content="Pesan tiket masuk Ostrich Mini Zoo Subang secara online. Cepat, mudah, aman.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { charcoal: '#1a1a1a', gold: '#FFD700', ivory: '#f8f9fa' },
                    fontFamily: { inter: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ===== BACKGROUND ===== */
        body {
            background:
                radial-gradient(ellipse 70% 50% at 15% 30%, rgba(255,215,0,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 85% 70%, rgba(255,215,0,0.04) 0%, transparent 60%),
                #090909;
            min-height: 100vh;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background-image:
                linear-gradient(rgba(255,215,0,0.018) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,215,0,0.018) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none; z-index: 0;
        }

        /* ===== NAVBAR ===== */
        .glass-navbar {
            background: rgba(9,9,9,0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,215,0,0.1);
        }

        /* ===== CARDS ===== */
        .glass-card {
            background: rgba(18,18,18,0.85);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 24px;
        }
        .glass-card-gold {
            background: linear-gradient(145deg, rgba(255,215,0,0.07), rgba(255,215,0,0.02));
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255,215,0,0.2);
            border-radius: 24px;
        }

        /* ===== GOLD TEXT ===== */
        .gold-text {
            background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== FORM INPUT ===== */
        .form-input {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            color: white;
            padding: 14px 16px;
            font-size: 14px;
            width: 100%; outline: none;
            transition: border-color 0.25s, background 0.25s;
        }
        .form-input:focus {
            border-color: #FFD700;
            background: rgba(255,215,0,0.04);
        }
        .form-input::placeholder { color: rgba(255,255,255,0.28); }

        /* ===== READ-ONLY DATE FIELD ===== */
        .date-readonly {
            background: rgba(255,215,0,0.04);
            border: 1px solid rgba(255,215,0,0.2);
            border-radius: 14px;
            color: rgba(255,255,255,0.85);
            padding: 14px 16px;
            font-size: 14px; font-weight: 600;
            width: 100%;
            cursor: not-allowed;
            user-select: none;
        }

        /* ===== QUANTITY BUTTONS ===== */
        .qty-btn {
            width: 48px; height: 48px;
            border-radius: 14px;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex; align-items: center; justify-content: center;
            user-select: none; flex-shrink: 0;
        }
        .qty-btn:hover {
            background: rgba(255,215,0,0.15);
            border-color: rgba(255,215,0,0.4);
            color: #FFD700;
            transform: scale(1.08);
        }
        .qty-btn:active { transform: scale(0.95); }

        /* ===== PAYMENT CARDS ===== */
        .payment-card {
            background: rgba(255,255,255,0.03);
            border: 2px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 16px 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            display: flex; align-items: center; gap: 10px;
            position: relative;
        }
        .payment-card:hover {
            border-color: rgba(255,215,0,0.35);
            background: rgba(255,215,0,0.05);
            transform: translateY(-2px);
        }
        .payment-card.selected {
            border-color: #FFD700;
            background: rgba(255,215,0,0.08);
            box-shadow: 0 0 22px rgba(255,215,0,0.13);
        }
        .payment-card .pay-icon {
            filter: grayscale(1) brightness(0.45);
            transition: filter 0.25s;
            font-size: 26px;
        }
        .payment-card:hover .pay-icon,
        .payment-card.selected .pay-icon { filter: grayscale(0) brightness(1); }
        .payment-card .check-dot {
            position: absolute; top: 9px; right: 9px;
            width: 18px; height: 18px; border-radius: 50%;
            border: 2px solid rgba(255,255,255,0.15);
            display: flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .payment-card.selected .check-dot {
            background: #FFD700; border-color: #FFD700;
        }
        .payment-card.selected .check-dot::after {
            content: '✓'; font-size: 10px; font-weight: 900; color: #1a1a1a;
        }

        /* ===== CTA BUTTON (Shimmer) ===== */
        .cta-pay-btn {
            position: relative; overflow: hidden;
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a;
            font-weight: 900; font-size: 15px;
            letter-spacing: 0.4px;
            padding: 18px 32px;
            border-radius: 16px; border: none;
            width: 100%; cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 6px 30px rgba(255,215,0,0.35);
        }
        .cta-pay-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 42px rgba(255,215,0,0.52);
        }
        .cta-pay-btn:active { transform: translateY(0); }
        .cta-pay-btn::before {
            content: '';
            position: absolute; top: 0; left: -110%;
            width: 55%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.38), transparent);
            animation: shimmerSweep 2.4s infinite;
        }
        @keyframes shimmerSweep {
            0%   { left: -110%; }
            100% { left: 165%;  }
        }
        .cta-pay-btn.loading {
            pointer-events: none;
            background: linear-gradient(135deg, #c9a800, #b89600);
        }
        .cta-pay-btn.loading::before { display: none; }

        /* ===== SUMMARY ROW ===== */
        .summary-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .summary-row:last-child { border-bottom: none; }

        /* ===== STEP BADGE ===== */
        .step-badge {
            width: 28px; height: 28px; border-radius: 50%;
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a; font-size: 11px; font-weight: 900;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        @keyframes pulseRing {
            0%   { box-shadow: 0 0 0 0   rgba(255,215,0,0.4); }
            70%  { box-shadow: 0 0 0 8px rgba(255,215,0,0);   }
            100% { box-shadow: 0 0 0 0   rgba(255,215,0,0);   }
        }
        .step-active { animation: pulseRing 2s infinite; }

        /* ===== QRIS MODAL ===== */
        #qris-modal {
            display: none;
            position: fixed; inset: 0; z-index: 100;
            align-items: center; justify-content: center;
        }
        #qris-modal.active { display: flex; }

        .modal-backdrop {
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.78);
            backdrop-filter: blur(10px);
        }

        .modal-card {
            position: relative; z-index: 1;
            background: linear-gradient(160deg, rgba(25,22,10,0.98), rgba(15,14,8,0.98));
            border: 1px solid rgba(255,215,0,0.3);
            border-radius: 28px;
            padding: 36px 32px;
            width: 92%; max-width: 420px;
            box-shadow:
                0 40px 80px rgba(0,0,0,0.7),
                0 0 0 1px rgba(255,215,0,0.06) inset,
                0 0 60px rgba(255,215,0,0.07);
            text-align: center;
        }

        /* QR frame glow */
        .qr-frame {
            background: white;
            border-radius: 20px;
            padding: 16px;
            display: inline-block;
            box-shadow:
                0 0 0 1px rgba(255,215,0,0.35),
                0 0 30px rgba(255,215,0,0.18),
                0 8px 40px rgba(0,0,0,0.5);
            position: relative;
        }
        /* Corner accent lines */
        .qr-frame::before, .qr-frame::after {
            content: '';
            position: absolute;
            width: 22px; height: 22px;
            border-color: #FFD700; border-style: solid;
        }
        .qr-frame::before {
            top: -2px; left: -2px;
            border-width: 3px 0 0 3px;
            border-radius: 6px 0 0 0;
        }
        .qr-frame::after {
            bottom: -2px; right: -2px;
            border-width: 0 3px 3px 0;
            border-radius: 0 0 6px 0;
        }

        /* Extra corner markers via wrapper pseudo */
        .qr-wrapper {
            position: relative; display: inline-block;
        }
        .qr-corner-tr, .qr-corner-bl {
            position: absolute;
            width: 22px; height: 22px;
            border-color: #FFD700; border-style: solid;
        }
        .qr-corner-tr { top: -2px; right: -2px; border-width: 3px 3px 0 0; border-radius: 0 6px 0 0; }
        .qr-corner-bl { bottom: -2px; left: -2px; border-width: 0 0 3px 3px; border-radius: 0 0 0 6px; }

        /* Scanning beam animation on QR */
        @keyframes scanBeam {
            0%   { top: 16px; opacity: 0.6; }
            50%  { opacity: 0.9; }
            100% { top: calc(100% - 22px); opacity: 0.6; }
        }
        .scan-beam {
            position: absolute; left: 16px; right: 16px; height: 2px;
            background: linear-gradient(90deg, transparent, #FFD700, transparent);
            animation: scanBeam 2s ease-in-out infinite alternate;
            pointer-events: none; border-radius: 2px;
            box-shadow: 0 0 8px rgba(255,215,0,0.8);
        }

        /* "Done" button */
        .modal-done-btn {
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a;
            font-weight: 900; font-size: 14px;
            padding: 14px 32px;
            border-radius: 14px; border: none;
            cursor: pointer; width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 4px 20px rgba(255,215,0,0.3);
        }
        .modal-done-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255,215,0,0.48);
        }

        /* ===== SPINNER OVERLAY ===== */
        #spinner-overlay {
            display: none;
            position: fixed; inset: 0; z-index: 90;
            background: rgba(0,0,0,0.65);
            backdrop-filter: blur(6px);
            align-items: center; justify-content: center;
            flex-direction: column; gap: 20px;
        }
        #spinner-overlay.active { display: flex; }

        @keyframes spinRing {
            to { transform: rotate(360deg); }
        }
        .spin-ring {
            width: 64px; height: 64px;
            border: 4px solid rgba(255,215,0,0.15);
            border-top-color: #FFD700;
            border-radius: 50%;
            animation: spinRing 0.9s linear infinite;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: rgba(255,215,0,0.25); border-radius: 3px; }
    </style>
</head>
<body class="text-white">

    {{-- ============================================================ --}}
    {{-- LOADING SPINNER OVERLAY (shown for 1.5s after button click)  --}}
    {{-- ============================================================ --}}
    <div id="spinner-overlay">
        <div class="spin-ring"></div>
        <div class="text-white/60 text-sm font-medium animate-pulse">Memproses pesanan Anda...</div>
    </div>

    {{-- ============================================================ --}}
    {{-- QRIS PAYMENT MODAL                                             --}}
    {{-- ============================================================ --}}
    <div id="qris-modal">
        <div class="modal-backdrop"></div>
        <div class="modal-card animate__animated animate__zoomIn animate__faster">

            {{-- Header --}}
            <div class="flex items-center justify-center gap-2 mb-1">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background:rgba(255,215,0,0.12); border:1px solid rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-qrcode text-gold text-sm"></i>
                </div>
            </div>
            <h2 class="text-xl font-black text-white mt-3 mb-1">Scan QRIS untuk Pembayaran</h2>
            <p class="text-white/35 text-xs mb-5">Gunakan aplikasi e-wallet atau mobile banking Anda</p>

            {{-- QR Code --}}
            <div class="qr-wrapper mx-auto mb-5" style="width: fit-content">
                <div class="qr-corner-tr"></div>
                <div class="qr-corner-bl"></div>
                <div class="qr-frame" style="position:relative">
                    {{-- Scanning beam --}}
                    <div class="scan-beam"></div>
                    {{-- Dummy QR via external generator (replace with real QRIS image in production) --}}
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=OSTRICH-MINI-ZOO-QRIS-PAYMENT&format=png&qzone=1&color=1a1a1a"
                         alt="QRIS Payment Code"
                         width="220" height="220"
                         style="border-radius: 8px; display: block;"
                         onerror="this.src='https://chart.googleapis.com/chart?chs=220x220&cht=qr&chl=OSTRICH-MINI-ZOO&choe=UTF-8'">
                </div>
            </div>

            {{-- Amount display --}}
            <div class="mb-3 py-3 px-5 rounded-2xl" style="background:rgba(255,215,0,0.07); border:1px solid rgba(255,215,0,0.18)">
                <div class="text-white/40 text-xs uppercase tracking-widest mb-0.5">Total Tagihan</div>
                <div class="text-2xl font-black gold-text" id="modal-total-display">Rp —</div>
                <div class="text-white/30 text-xs mt-0.5" id="modal-qty-info">— tiket · Kunjungan hari ini</div>
            </div>

            {{-- Instruction --}}
            <p class="text-white/45 text-xs leading-relaxed mb-6 px-2">
                Silakan scan kode di atas dan selesaikan pembayaran sesuai total tagihan.
                QR ini berlaku selama <span class="text-gold font-semibold">5 menit</span>.
            </p>

            {{-- Countdown timer --}}
            <div class="flex items-center justify-center gap-2 mb-5 text-white/40 text-xs">
                <i class="fa-regular fa-clock text-gold/60"></i>
                QR kedaluwarsa dalam: <span id="qr-countdown" class="text-gold font-bold ml-1">05:00</span>
            </div>

            {{-- Done button —> submit form --}}
            <button type="button" onclick="document.getElementById('checkout-form').submit()" class="modal-done-btn block w-full flex items-center justify-center">
                <i class="fa-solid fa-circle-check mr-2"></i>Selesai Bayar
            </button>

            <p class="text-white/20 text-[11px] mt-4">
                Butuh bantuan?
                <a href="{{ route('welcome') }}" class="text-gold/50 hover:text-gold transition-colors underline">Kembali ke Beranda</a>
            </p>
        </div>
    </div>

    {{-- ============================================================ --}}
    {{-- NAVBAR                                                         --}}
    {{-- ============================================================ --}}
    <nav class="glass-navbar fixed top-0 left-0 right-0 z-50">
        <div class="max-w-6xl mx-auto px-5 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ url()->previous() !== url()->current() ? url()->previous() : route('welcome') }}" 
                   class="w-8 h-8 rounded-full bg-white/5 border border-white/10 flex items-center justify-center text-white/60 hover:text-gold hover:bg-gold/10 transition-all mr-1">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                </a>
                <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                    <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                         alt="Ostrich Mini Zoo"
                         class="w-8 h-8 object-contain"
                         style="filter: drop-shadow(0 0 6px rgba(255,215,0,0.45))">
                    <div>
                        <div class="text-white font-bold text-xs leading-tight tracking-wide">OSTRICH MINI ZOO</div>
                        <div class="text-[10px] font-medium tracking-widest" style="color:#FFD700">SUBANG · EST. 2020</div>
                    </div>
                </a>
            </div>
            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-2 text-xs text-white/40">
                    <i class="fa-solid fa-ticket text-gold text-[10px]"></i>
                    <span style="color:#FFD700" class="font-medium">Halaman Pemesanan</span>
                </div>
                <div class="flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-semibold px-3 py-1.5 rounded-full">
                    <i class="fa-solid fa-lock text-[10px]"></i>
                    <span class="hidden sm:inline">Transaksi Aman</span>
                </div>
            </div>
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- MAIN CONTENT                                                    --}}
    {{-- ============================================================ --}}
    <div class="relative z-10 max-w-6xl mx-auto px-4 pt-24 pb-16">

        {{-- Page Heading --}}
        <div class="text-center mb-10 animate__animated animate__fadeInDown">
            <div class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-1.5 rounded-full mb-4"
                 style="background:rgba(255,215,0,0.08); border:1px solid rgba(255,215,0,0.22); color:#FFD700">
                <i class="fa-solid fa-ticket text-[10px]"></i>
                Pemesanan Tiket Masuk
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">
                Pesan Tiket <span class="gold-text">Ostrich Mini Zoo</span>
            </h1>
            <p class="text-white/40 text-sm">Lengkapi informasi di bawah untuk konfirmasi kunjungan Anda</p>
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 bg-emerald-900/40 border border-emerald-500/30 text-emerald-300 px-5 py-4 rounded-2xl animate__animated animate__fadeInDown">
                <i class="fa-solid fa-circle-check text-emerald-400 text-lg flex-shrink-0"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 flex items-center gap-3 bg-red-900/40 border border-red-500/30 text-red-300 px-5 py-4 rounded-2xl animate__animated animate__fadeInDown">
                <i class="fa-solid fa-circle-exclamation text-red-400 text-lg flex-shrink-0"></i>
                <span class="text-sm font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Two-Column Layout --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ============================================================ --}}
            {{-- LEFT: Form Steps (3/5)                                         --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-3 space-y-5 animate__animated animate__fadeInUp">

                {{-- ---- STEP 1: Visitor Info ---- --}}
                <div class="glass-card p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="step-badge step-active">1</div>
                        <div>
                            <h2 class="text-white font-bold text-sm">Informasi Pengunjung</h2>
                            <p class="text-white/35 text-xs">Data pemesan tiket</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        {{-- Name --}}
                        <div>
                            <label class="block text-xs font-semibold text-white/55 mb-2 uppercase tracking-wider">
                                <i class="fa-solid fa-user mr-1.5 text-gold/50"></i>Nama Lengkap
                            </label>
                            <div class="relative">
                                <input type="text" name="nama_pemesan" id="nama-pemesan"
                                       class="form-input pr-10"
                                       placeholder="Masukkan nama lengkap"
                                       value="{{ session('name', '') }}" required>
                                @if(session('name'))
                                    <i class="fa-solid fa-circle-check absolute right-3 top-1/2 -translate-y-1/2 text-emerald-400 text-sm"></i>
                                @endif
                            </div>
                        </div>
                        {{-- Phone --}}
                        <div>
                            <label class="block text-xs font-semibold text-white/55 mb-2 uppercase tracking-wider">
                                <i class="fa-solid fa-phone mr-1.5 text-gold/50"></i>Nomor WhatsApp
                            </label>
                            <div class="relative">
                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-white/35 text-xs font-semibold">+62</div>
                                <input type="tel" name="phone" id="phone"
                                       class="form-input" style="padding-left:48px"
                                       placeholder="812-xxxx-xxxx" required>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ---- STEP 2: Visit Details ---- --}}
                <div class="glass-card p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="step-badge">2</div>
                        <div>
                            <h2 class="text-white font-bold text-sm">Detail Kunjungan</h2>
                            <p class="text-white/35 text-xs">Tanggal & jumlah tiket</p>
                        </div>
                    </div>
                    <div class="space-y-5">

                        {{-- ===== DATE SELECTION ===== --}}
                        <div>
                            <label class="block text-xs font-semibold text-white/55 mb-2 uppercase tracking-wider">
                                <i class="fa-regular fa-calendar mr-1.5 text-gold/50"></i>Tanggal Kunjungan
                            </label>
                            <input type="date" name="display_tanggal" id="tanggal" 
                                   class="form-input w-full cursor-pointer text-white/90 font-semibold"
                                   style="background:rgba(255,215,0,0.04); border-color:rgba(255,215,0,0.2)"
                                   value="{{ $tanggalHariIni }}"
                                   min="{{ $tanggalHariIni }}"
                                   onchange="updatePriceByDate()" required>
                            
                            {{-- Info label --}}
                            <div class="mt-2 flex items-center gap-2 px-1">
                                <i class="fa-solid fa-circle-info text-gold/40 text-xs flex-shrink-0"></i>
                                <p class="text-white/30 text-xs text-left" id="date-info-text">
                                    Berlaku tarif: <span class="text-gold/60 font-semibold uppercase tracking-wider" id="price-tier-badge">Hari Biasa</span>
                                </p>
                            </div>
                        </div>

                        {{-- Quantity Selector --}}
                        <div>
                            <label class="block text-xs font-semibold text-white/55 mb-3 uppercase tracking-wider">
                                <i class="fa-solid fa-users mr-1.5 text-gold/50"></i>Jumlah Tiket
                                <span class="text-white/25 font-normal normal-case ml-1">(maks. 20)</span>
                            </label>
                            <div class="flex items-center gap-5">
                                <button type="button" class="qty-btn" id="btn-minus" onclick="changeQty(-1)">
                                    <i class="fa-solid fa-minus text-sm"></i>
                                </button>
                                <div class="flex-1 text-center">
                                    <div class="text-5xl font-black gold-text leading-none" id="qty-display">1</div>
                                    <div class="text-white/30 text-xs mt-1">orang</div>
                                    <input type="hidden" name="jumlah_tiket" id="jumlah-tiket" value="1">
                                </div>
                                <button type="button" class="qty-btn" id="btn-plus" onclick="changeQty(1)">
                                    <i class="fa-solid fa-plus text-sm"></i>
                                </button>
                            </div>
                            {{-- Dot indicator --}}
                            <div class="mt-4 flex flex-wrap gap-1.5 items-center" id="qty-dots"></div>
                        </div>

                        {{-- Notes --}}
                        <div>
                            <label class="block text-xs font-semibold text-white/55 mb-2 uppercase tracking-wider">
                                <i class="fa-solid fa-note-sticky mr-1.5 text-gold/50"></i>Catatan
                                <span class="text-white/25 font-normal normal-case">(opsional)</span>
                            </label>
                            <textarea name="catatan" id="catatan" rows="2"
                                      class="form-input resize-none"
                                      placeholder="Contoh: rombongan sekolah, butuh kursi roda, dll."></textarea>
                        </div>
                    </div>
                </div>

                {{-- ---- STEP 3: Payment Method ---- --}}
                <div class="glass-card p-6">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="step-badge">3</div>
                        <div>
                            <h2 class="text-white font-bold text-sm">Metode Pembayaran</h2>
                            <p class="text-white/35 text-xs">Ikon berubah warna saat dipilih</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-3">
                        {{-- QRIS --}}
                        <div class="payment-card selected" id="pay-qris" onclick="selectPayment('qris')">
                            <div class="check-dot"></div>
                            <div class="pay-icon text-purple-400"><i class="fa-solid fa-qrcode"></i></div>
                            <div>
                                <div class="text-white font-bold text-sm">QRIS</div>
                                <div class="text-white/35 text-xs">Scan &amp; bayar dengan aplikasi e-Wallet atau Mobile Banking Anda</div>
                            </div>
                        </div>
                    </div>

                    {{-- Payment detail hint --}}
                    <div id="payment-detail" class="mt-4 hidden">
                        <div class="rounded-xl border p-4 text-sm text-white/70"
                             style="background:rgba(255,215,0,0.04); border-color:rgba(255,215,0,0.18)">
                            <div id="payment-detail-content"></div>
                        </div>
                    </div>
                </div>

            </div><!-- / LEFT COL -->

            {{-- ============================================================ --}}
            {{-- RIGHT: Order Summary (2/5)                                      --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-2 animate__animated animate__fadeInUp" style="animation-delay:0.15s">
                <div class="lg:sticky lg:top-24 space-y-5">

                    {{-- Summary Card --}}
                    <div class="glass-card-gold p-6">
                        <h2 class="text-white font-bold text-sm flex items-center gap-2 mb-5">
                            <i class="fa-solid fa-receipt text-gold text-xs"></i>
                            Ringkasan Pesanan
                        </h2>

                        {{-- Zoo info --}}
                        <div class="flex items-center gap-3 mb-5 pb-5 border-b border-white/8">
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                 style="background:linear-gradient(135deg,rgba(255,215,0,0.2),rgba(255,215,0,0.07))">
                                <i class="fa-solid fa-feather text-gold text-lg"></i>
                            </div>
                            <div>
                                <div class="text-white font-bold text-sm">Ostrich Mini Zoo</div>
                                <div class="text-white/40 text-xs">Subang, Jawa Barat</div>
                                <div class="flex items-center gap-0.5 mt-0.5">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fa-solid fa-star text-gold text-[9px]"></i>
                                    @endfor
                                    <span class="text-white/30 text-[10px] ml-1.5">4.9 · 1.2k ulasan</span>
                                </div>
                            </div>
                        </div>

                        {{-- Price rows --}}
                        <div>
                            <div class="summary-row">
                                <span class="text-white/50 text-sm">Harga Satuan</span>
                                <span class="text-white font-semibold text-sm" id="summary-harga-satuan">
                                    Rp {{ number_format($hargaBiasa, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="text-white/50 text-sm">Jumlah Tiket</span>
                                <span class="text-white font-semibold text-sm">
                                    <span id="qty-summary">1</span> orang
                                </span>
                            </div>
                            <div class="summary-row">
                                <span class="text-white/50 text-sm">Tanggal</span>
                                <span class="text-white font-semibold text-xs" id="summary-tanggal">{{ $tanggalHariIni }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="text-white/50 text-sm">Biaya Layanan</span>
                                <span class="text-emerald-400 font-semibold text-sm">Gratis</span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="mt-4 pt-4 border-t border-gold/20">
                            <div class="text-white/40 text-xs uppercase tracking-widest mb-1">Total Bayar</div>
                            <div class="text-3xl font-black gold-text" id="total-display">
                                Rp {{ number_format($hargaBiasa, 0, ',', '.') }}
                            </div>
                            <div class="text-white/20 text-[10px] mt-1">sudah termasuk pajak &amp; biaya admin</div>
                        </div>
                    </div>

                    {{-- ===== CTA (triggers spinner + modal, no page redirect) ===== --}}
                    {{-- Keep @csrf in a form for CSRF token meta tag; actual submit triggered by modal --}}
                    <form id="checkout-form" action="{{ route('ticket.purchase') }}" method="POST">
                        @csrf
                        {{-- Hidden fields --}}
                        <input type="hidden" id="hf-nama"   name="nama_pemesan">
                        <input type="hidden" id="hf-phone"  name="phone">
                        <input type="hidden" id="hf-jumlah" name="jumlah_tiket" value="1">
                        <input type="hidden" id="hf-metode" name="metode_bayar">
                        <input type="hidden" id="hf-catatan" name="catatan">
                        <input type="hidden" id="hf-tanggal" name="tanggal" value="{{ $tanggalHariIni }}">

                        <button type="button" id="btn-pay" class="cta-pay-btn" onclick="handlePayClick()">
                            <span id="btn-pay-text" class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-lock text-sm"></i>
                                Konfirmasi &amp; Bayar Sekarang
                            </span>
                        </button>
                    </form>

                    {{-- Trust badges --}}
                    <div class="grid grid-cols-3 gap-3 text-center">
                        <div class="glass-card p-3" style="border-radius:16px">
                            <i class="fa-solid fa-shield-halved text-emerald-400 mb-1 block text-lg"></i>
                            <div class="text-white/40 text-[10px]">Data Aman</div>
                        </div>
                        <div class="glass-card p-3" style="border-radius:16px">
                            <i class="fa-solid fa-rotate-left text-blue-400 mb-1 block text-lg"></i>
                            <div class="text-white/40 text-[10px]">Refundable</div>
                        </div>
                        <div class="glass-card p-3" style="border-radius:16px">
                            <i class="fa-solid fa-headset text-gold mb-1 block text-lg"></i>
                            <div class="text-white/40 text-[10px]">Support 24/7</div>
                        </div>
                    </div>

                </div>
            </div><!-- / RIGHT COL -->
        </div>
    </div>

    <footer class="relative z-10 text-center py-6 border-t border-white/5 text-white/20 text-xs">
        &copy; 2026 Phaeton Inc. &mdash; Ostrich Mini Zoo Subang
    </footer>

    {{-- ============================================================ --}}
    {{-- JAVASCRIPT                                                      --}}
    {{-- ============================================================ --}}
    <script>
        // ===== CONSTANTS from Laravel =====
        const HARGA_BIASA  = @json($hargaBiasa);
        const HARGA_LIBUR  = @json($hargaLibur);
        const HARGA_BESAR  = @json($hargaBesar);
        const HARI_BESARS  = @json($hariBesars);
        
        let   HARGA_SATUAN = HARGA_BIASA;

        const MAX_TIKET    = 20;
        const MIN_TIKET    = 1;
        let   qtyCount     = 1;
        let   selectedPayment = '';
        let   qrTimer      = null;

        // ===== HELPERS =====
        const fmt = n => 'Rp ' + Number(n).toLocaleString('id-ID');

        // ===== DATE TO PRICE CALCULATION =====
        function updatePriceByDate() {
            const dateStr = document.getElementById('tanggal').value;
            if (!dateStr) return;
            
            const selectedDate = new Date(dateStr);
            const yyyy = selectedDate.getFullYear();
            const mm = String(selectedDate.getMonth() + 1).padStart(2, '0');
            const dd = String(selectedDate.getDate()).padStart(2, '0');
            const formattedDate = `${yyyy}-${mm}-${dd}`;
            
            document.getElementById('hf-tanggal').value = formattedDate;

            let isBesar = HARI_BESARS.includes(formattedDate);
            let isWeekend = (selectedDate.getDay() === 0 || selectedDate.getDay() === 6);
            let badgeText = "Hari Biasa";
            
            if (isBesar) {
                HARGA_SATUAN = HARGA_BESAR;
                badgeText = "Hari Besar (Event/Nasional)";
            } else if (isWeekend) {
                HARGA_SATUAN = HARGA_LIBUR;
                badgeText = "Akhir Pekan";
            } else {
                HARGA_SATUAN = HARGA_BIASA;
            }
            
            document.getElementById('price-tier-badge').textContent = badgeText;
            document.getElementById('summary-harga-satuan').textContent = fmt(HARGA_SATUAN);
            
            // Format nice date for summary
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('summary-tanggal').textContent = selectedDate.toLocaleDateString('id-ID', options);
            
            refreshUI();
        }

        // ===== QUANTITY: + / - =====
        function changeQty(delta) {
            const next = qtyCount + delta;
            if (next < MIN_TIKET || next > MAX_TIKET) return;
            qtyCount = next;
            refreshUI();
        }

        function refreshUI() {
            document.getElementById('qty-display').textContent  = qtyCount;
            document.getElementById('qty-summary').textContent  = qtyCount;
            document.getElementById('jumlah-tiket').value       = qtyCount;
            document.getElementById('hf-jumlah').value          = qtyCount;

            // Dim limit buttons
            document.getElementById('btn-minus').style.opacity = qtyCount <= MIN_TIKET ? '0.3' : '1';
            document.getElementById('btn-plus').style.opacity  = qtyCount >= MAX_TIKET ? '0.3' : '1';

            // ===== REAL-TIME TOTAL: qty × HARGA_SATUAN =====
            const total = qtyCount * HARGA_SATUAN;
            document.getElementById('total-display').textContent = fmt(total);

            // Dot bar (max 10 shown)
            const dotsEl = document.getElementById('qty-dots');
            dotsEl.innerHTML = '';
            for (let i = 0; i < 10; i++) {
                const d = document.createElement('div');
                d.style.cssText = [
                    'width:8px', 'height:8px', 'border-radius:50%', 'flex-shrink:0',
                    'transition:background 0.2s',
                    `background:${i < qtyCount ? '#FFD700' : 'rgba(255,255,255,0.1)'}`
                ].join(';');
                dotsEl.appendChild(d);
            }
            if (qtyCount > 10) {
                const more = document.createElement('span');
                more.textContent = '+' + (qtyCount - 10);
                more.style.cssText = 'color:rgba(255,215,0,0.7);font-size:10px;font-weight:700;align-self:center;margin-left:4px';
                dotsEl.appendChild(more);
            }
        }

        // ===== PAYMENT SELECTION =====
        const paymentHints = {
            qris:     '<i class="fa-solid fa-qrcode text-purple-400 mr-1.5"></i><strong class="text-white">QRIS All-Payment</strong> — QR code ditampilkan langsung setelah konfirmasi.'
        };

        function selectPayment(method) {
            selectedPayment = method;
            document.getElementById('hf-metode').value = method;
            document.getElementById('pay-qris').classList.add('selected');
            
            const box = document.getElementById('payment-detail');
            box.classList.remove('hidden');
            document.getElementById('payment-detail-content').innerHTML = paymentHints[method];
        }

        // ===== CTA CLICK: validate → spinner (1.5s) → QRIS modal =====
        function handlePayClick() {
            const nama  = document.getElementById('nama-pemesan').value.trim();
            const phone = document.getElementById('phone').value.trim();

            // Sync hidden fields
            document.getElementById('hf-nama').value    = nama;
            document.getElementById('hf-phone').value   = phone;
            document.getElementById('hf-catatan').value = document.getElementById('catatan').value;

            // Validation
            if (!nama)            { showAlert('Mohon isi nama lengkap Anda.');     return; }
            if (!phone)           { showAlert('Mohon isi nomor WhatsApp Anda.');   return; }
            if (!selectedPayment) { showAlert('Mohon pilih metode pembayaran.');   return; }

            // ===== 1. Button loading state =====
            const btn = document.getElementById('btn-pay');
            document.getElementById('btn-pay-text').innerHTML =
                '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.classList.add('loading');

            // ===== 2. Spinner overlay (1.5 s) =====
            const spinner = document.getElementById('spinner-overlay');
            spinner.classList.add('active');

            // ===== 3. After 1.5s — hide spinner, show QRIS modal =====
            setTimeout(() => {
                spinner.classList.remove('active');
                openQrisModal();

                // Reset button
                btn.classList.remove('loading');
                document.getElementById('btn-pay-text').innerHTML =
                    '<i class="fa-solid fa-lock text-sm"></i> Konfirmasi &amp; Bayar Sekarang';
            }, 1500);
        }

        // ===== OPEN QRIS MODAL =====
        function openQrisModal() {
            const total = qtyCount * HARGA_SATUAN;

            // Update modal amounts
            document.getElementById('modal-total-display').textContent = fmt(total);
            document.getElementById('modal-qty-info').textContent =
                qtyCount + ' tiket · Kunjungan hari ini';

            // Show modal
            document.getElementById('qris-modal').classList.add('active');
            document.body.style.overflow = 'hidden';

            // Start 5-min countdown
            startCountdown(300);
        }

        // ===== COUNTDOWN TIMER (5 min) =====
        function startCountdown(seconds) {
            if (qrTimer) clearInterval(qrTimer);
            let remaining = seconds;
            const el = document.getElementById('qr-countdown');
            qrTimer = setInterval(() => {
                remaining--;
                const m = String(Math.floor(remaining / 60)).padStart(2, '0');
                const s = String(remaining % 60).padStart(2, '0');
                el.textContent = `${m}:${s}`;
                if (remaining <= 0) {
                    clearInterval(qrTimer);
                    el.textContent = 'Kedaluwarsa';
                    el.style.color = '#ef4444';
                }
            }, 1000);
        }

        // ===== NICE ALERT (inline banner instead of browser alert) =====
        function showAlert(msg) {
            // Remove old alert if any
            const old = document.getElementById('inline-alert');
            if (old) old.remove();
            const div = document.createElement('div');
            div.id = 'inline-alert';
            div.style.cssText = [
                'position:fixed', 'top:80px', 'left:50%', 'transform:translateX(-50%)',
                'z-index:200', 'background:rgba(239,68,68,0.95)', 'color:white',
                'padding:12px 24px', 'border-radius:14px', 'font-size:13px',
                'font-weight:600', 'box-shadow:0 8px 30px rgba(0,0,0,0.4)',
                'backdrop-filter:blur(8px)', 'max-width:90vw', 'text-align:center'
            ].join(';');
            div.innerHTML = '<i class="fa-solid fa-triangle-exclamation mr-2"></i>' + msg;
            document.body.appendChild(div);
            setTimeout(() => div.remove(), 3500);
        }

        // Close modal on ESC
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                document.getElementById('qris-modal').classList.remove('active');
                document.body.style.overflow = '';
                if (qrTimer) clearInterval(qrTimer);
            }
        });

        // ===== INIT =====
        document.addEventListener('DOMContentLoaded', () => {
            updatePriceByDate();
            selectPayment('qris');
            refreshUI();
        });
    </script>

</body>
</html>
