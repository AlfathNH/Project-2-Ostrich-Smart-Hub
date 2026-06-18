<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Bukti Pembayaran — Ostrich Smart Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        charcoal: '#1a1a1a',
                        gold: '#FFD700',
                        ivory: '#f8f9fa',
                        'gold-dark': '#c9a800',
                        'glass-bg': 'rgba(26, 26, 26, 0.75)',
                    },
                    fontFamily: { inter: ['Inter','sans-serif'] }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: radial-gradient(ellipse 70% 50% at 15% 30%, rgba(255,215,0,0.06) 0%, transparent 60%), #0f0f0f;
            min-height: 100vh;
        }
        body::before {
            content: ''; position: fixed; inset: 0;
            background-image: linear-gradient(rgba(255,215,0,0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(255,215,0,0.015) 1px, transparent 1px);
            background-size: 60px 60px; pointer-events: none; z-index: 0;
        }
        .glass-card { background: rgba(26,26,26,0.9); backdrop-filter: blur(24px); border: 1px solid rgba(255,255,255,0.07); border-radius: 24px; }
        .gold-text { background: linear-gradient(135deg,#FFD700,#FFF176,#c9a800); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; }
        .glass-navbar { background: rgba(15,15,15,0.85); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(255,215,0,0.1); }

        /* Drop zone */
        .drop-zone {
            border: 2px dashed rgba(255,215,0,0.25);
            border-radius: 20px;
            background: rgba(255,215,0,0.02);
            transition: all 0.3s ease;
            cursor: pointer;
            min-height: 200px;
            display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 12px;
        }
        .drop-zone:hover, .drop-zone.drag-over {
            border-color: rgba(255,215,0,0.6);
            background: rgba(255,215,0,0.06);
            transform: scale(1.01);
        }
        .drop-zone.has-file { border-color: rgba(16,185,129,0.5); background: rgba(16,185,129,0.04); }

        /* Status badge */
        .status-pending  { background: rgba(251,191,36,0.12); color: #fbbf24; border: 1px solid rgba(251,191,36,0.3); }
        .status-confirmed { background: rgba(16,185,129,0.12); color: #34d399; border: 1px solid rgba(16,185,129,0.3); }
        .status-rejected { background: rgba(239,68,68,0.12); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }

        /* Steps */
        .step { display: flex; align-items: flex-start; gap: 16px; }
        .step-dot { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 12px; flex-shrink: 0; }
        .step-done { background: rgba(16,185,129,0.2); border: 1px solid rgba(16,185,129,0.4); color: #34d399; }
        .step-active { background: linear-gradient(135deg,#FFD700,#f0c800); color: #1a1a1a; box-shadow: 0 0 16px rgba(255,215,0,0.3); }
        .step-inactive { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.3); }
        .step-line { width: 2px; height: 32px; background: rgba(255,255,255,0.07); margin-left: 15px; }

        /* Submit button */
        .btn-upload {
            background: linear-gradient(135deg,#FFD700,#f0c800); color: #1a1a1a;
            font-weight: 900; font-size: 15px; padding: 16px 32px;
            border-radius: 16px; border: none; width: 100%; cursor: pointer;
            transition: all 0.3s ease; box-shadow: 0 6px 24px rgba(255,215,0,0.35);
            position: relative; overflow: hidden;
        }
        .btn-upload:hover { transform: translateY(-2px); box-shadow: 0 12px 36px rgba(255,215,0,0.5); }
        .btn-upload:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        .btn-upload::before {
            content: ''; position: absolute; top: 0; left: -110%; width: 55%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
            animation: shimmer 2.4s infinite;
        }
        @keyframes shimmer { 0% { left: -110%; } 100% { left: 165%; } }

        #preview-img { max-height: 220px; border-radius: 12px; object-fit: contain; display: none; }
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-thumb { background: rgba(255,215,0,0.25); border-radius: 3px; }
    </style>
</head>
<body class="text-white">

    {{-- NAVBAR --}}
    <nav class="glass-navbar fixed top-0 left-0 right-0 z-50">
        <div class="max-w-5xl mx-auto px-5 py-3 flex items-center justify-between">
            <a href="{{ route('welcome') }}" class="flex items-center gap-3">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Logo" class="w-8 h-8 object-contain" style="filter:drop-shadow(0 0 6px rgba(255,215,0,0.45))">
                <div>
                    <div class="text-white font-bold text-xs leading-tight">OSTRICH MINI ZOO</div>
                    <div class="text-[10px] font-medium tracking-widest" style="color:#FFD700">SUBANG · EST. 2020</div>
                </div>
            </a>
            <div class="flex items-center gap-3">
                <a href="{{ route('ticket.history') }}" class="text-white/50 hover:text-gold text-xs flex items-center gap-1.5 transition-colors">
                    <i class="fa-solid fa-clock-rotate-left text-[11px]"></i> Riwayat Tiket
                </a>
                <a href="{{ route('logout') }}" class="text-red-400/70 hover:text-red-400 text-xs flex items-center gap-1 transition-colors">
                    <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="relative z-10 max-w-5xl mx-auto px-4 pt-24 pb-16">

        {{-- HEADER --}}
        <div class="text-center mb-10 animate__animated animate__fadeInDown">
            <div class="inline-flex items-center gap-2 text-xs font-semibold px-4 py-1.5 rounded-full mb-4"
                 style="background:rgba(255,215,0,0.08); border:1px solid rgba(255,215,0,0.22); color:#FFD700">
                <i class="fa-solid fa-upload text-[10px]"></i> Upload Bukti Pembayaran
            </div>
            <h1 class="text-3xl md:text-4xl font-black text-white mb-2">
                Konfirmasi <span class="gold-text">Pembayaran</span>
            </h1>
            <p class="text-white/40 text-sm">Upload foto/screenshot bukti transfer untuk dikonfirmasi admin</p>
        </div>

        {{-- FLASH MESSAGES --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-emerald-900/40 border border-emerald-500/30 text-emerald-300 px-5 py-4 rounded-2xl animate__animated animate__fadeInDown">
            <i class="fa-solid fa-circle-check text-emerald-400 text-lg"></i>
            <span class="text-sm font-medium">{{ session('success') }}</span>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 flex items-center gap-3 bg-red-900/40 border border-red-500/30 text-red-300 px-5 py-4 rounded-2xl animate__animated animate__fadeInDown">
            <i class="fa-solid fa-circle-exclamation text-red-400 text-lg"></i>
            <span class="text-sm font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- LEFT: Form Upload --}}
            <div class="lg:col-span-3 space-y-5 animate__animated animate__fadeInUp">

                {{-- Status Pesanan --}}
                <div class="glass-card p-6">
                    <h2 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-receipt text-gold text-xs"></i> Detail Pesanan
                    </h2>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-white/4 rounded-xl px-4 py-3">
                            <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Kode Booking</div>
                            <div class="text-gold font-black text-sm font-mono">{{ $order->kode_booking }}</div>
                        </div>
                        <div class="bg-white/4 rounded-xl px-4 py-3">
                            <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Status</div>
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold
                                {{ $order->status === 'confirmed' ? 'status-confirmed' : ($order->status === 'rejected' ? 'status-rejected' : 'status-pending') }}">
                                <span class="w-1.5 h-1.5 rounded-full inline-block
                                    {{ $order->status === 'confirmed' ? 'bg-emerald-400' : ($order->status === 'rejected' ? 'bg-red-400' : 'bg-yellow-400') }}"></span>
                                {{ $order->status === 'confirmed' ? 'Dikonfirmasi' : ($order->status === 'rejected' ? 'Ditolak' : 'Menunggu') }}
                            </span>
                        </div>
                        <div class="bg-white/4 rounded-xl px-4 py-3">
                            <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Nama Pemesan</div>
                            <div class="text-white font-semibold text-sm">{{ $order->nama_pemesan }}</div>
                        </div>
                        <div class="bg-white/4 rounded-xl px-4 py-3">
                            <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Tanggal Kunjungan</div>
                            <div class="text-white font-semibold text-sm">
                                {{ $order->tanggal_kunjungan->locale('id')->isoFormat('D MMM YYYY') }}
                            </div>
                        </div>
                        <div class="bg-white/4 rounded-xl px-4 py-3">
                            <div class="text-white/35 text-[10px] uppercase tracking-widest mb-1">Jumlah Tiket</div>
                            <div class="text-white font-semibold text-sm">{{ $order->jumlah_tiket }} tiket</div>
                        </div>
                        <div class="rounded-xl px-4 py-3" style="background:rgba(255,215,0,0.07); border:1px solid rgba(255,215,0,0.2)">
                            <div class="text-gold/60 text-[10px] uppercase tracking-widest mb-1">Total Bayar</div>
                            <div class="text-gold font-black text-sm">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                {{-- Upload Form --}}
                @if($order->status === 'pending')
                <div class="glass-card p-6">
                    <h2 class="text-white font-bold text-sm mb-1 flex items-center gap-2">
                        <i class="fa-solid fa-cloud-arrow-up text-gold text-xs"></i> Upload Bukti Transfer
                    </h2>
                    <p class="text-white/35 text-xs mb-5">Format JPG, PNG, atau WEBP. Maks 5 MB.</p>

                    <form id="upload-form" action="{{ route('order.upload.bukti', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Drop Zone --}}
                        <div class="drop-zone" id="drop-zone" onclick="document.getElementById('bukti-file').click()">
                            <div id="drop-placeholder" class="text-center">
                                <i class="fa-solid fa-image text-gold/40 text-4xl mb-3 block"></i>
                                <div class="text-white/50 font-semibold text-sm">Klik atau drag & drop foto bukti transfer</div>
                                <div class="text-white/25 text-xs mt-1">Tangkapan layar transfer / foto struk ATM</div>
                            </div>
                            <img id="preview-img" src="" alt="Preview">
                            <div id="file-name-label" class="text-emerald-400 text-xs font-semibold hidden"></div>
                        </div>
                        <input type="file" id="bukti-file" name="bukti_transfer" accept="image/*" class="hidden" required>

                        @error('bukti_transfer')
                        <div class="mt-2 text-red-400 text-xs">{{ $message }}</div>
                        @enderror

                        <button type="submit" class="btn-upload mt-5" id="btn-submit" disabled>
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-paper-plane text-sm"></i> Kirim Bukti Pembayaran
                            </span>
                        </button>
                    </form>
                </div>
                @elseif($order->status === 'confirmed')
                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background:rgba(16,185,129,0.15); border:1px solid rgba(16,185,129,0.3)">
                        <i class="fa-solid fa-circle-check text-emerald-400 text-3xl"></i>
                    </div>
                    <h3 class="text-white font-black text-xl mb-1">Pembayaran Dikonfirmasi!</h3>
                    <p class="text-white/40 text-sm mb-5">Admin telah memverifikasi bukti pembayaran Anda.</p>
                    <a href="{{ route('ticket.history') }}"
                       class="inline-flex items-center gap-2 font-bold text-charcoal px-6 py-3 rounded-full text-sm"
                       style="background:linear-gradient(135deg,#FFD700,#f0c800); box-shadow:0 4px 20px rgba(255,215,0,0.3)">
                        <i class="fa-solid fa-ticket"></i> Lihat E-Ticket
                    </a>
                </div>
                @elseif($order->status === 'rejected')
                <div class="glass-card p-6 text-center">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4" style="background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3)">
                        <i class="fa-solid fa-circle-xmark text-red-400 text-3xl"></i>
                    </div>
                    <h3 class="text-white font-black text-xl mb-1">Pembayaran Ditolak</h3>
                    <p class="text-white/40 text-sm mb-5">Bukti tidak valid. Silakan hubungi admin atau pesan ulang.</p>
                    <a href="{{ route('ticket.checkout') }}"
                       class="inline-flex items-center gap-2 font-bold text-white px-6 py-3 rounded-full text-sm"
                       style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.12)">
                        <i class="fa-solid fa-redo"></i> Pesan Ulang
                    </a>
                </div>
                @endif

                {{-- Bukti yang sudah diupload --}}
                @if($order->bukti_transfer)
                <div class="glass-card p-6">
                    <h3 class="text-white font-bold text-sm mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-image text-gold/70 text-xs"></i> Bukti yang Diupload
                    </h3>
                    <img src="{{ asset('storage/' . $order->bukti_transfer) }}"
                         alt="Bukti Transfer"
                         class="w-full rounded-2xl object-contain max-h-80 border"
                         style="border-color:rgba(255,255,255,0.08)">
                </div>
                @endif
            </div>

            {{-- RIGHT: Steps & Info --}}
            <div class="lg:col-span-2 animate__animated animate__fadeInUp" style="animation-delay:0.15s">
                <div class="lg:sticky lg:top-24 space-y-5">

                    {{-- Steps Panel --}}
                    <div class="glass-card p-6">
                        <h2 class="text-white font-bold text-sm mb-5 flex items-center gap-2">
                            <i class="fa-solid fa-list-check text-gold text-xs"></i> Langkah Pembayaran
                        </h2>

                        <div class="space-y-1">
                            {{-- Step 1 --}}
                            <div class="step">
                                <div class="step-dot step-done"><i class="fa-solid fa-check text-[10px]"></i></div>
                                <div class="pt-1">
                                    <div class="text-white font-semibold text-sm">Pesan Tiket</div>
                                    <div class="text-white/35 text-xs">Data pesanan berhasil dibuat</div>
                                </div>
                            </div>
                            <div class="step-line"></div>

                            {{-- Step 2 --}}
                            <div class="step">
                                <div class="step-dot {{ $order->status === 'pending' ? 'step-active' : 'step-done' }}">
                                    @if($order->status === 'pending')
                                        2
                                    @else
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    @endif
                                </div>
                                <div class="pt-1">
                                    <div class="text-white font-semibold text-sm">Transfer & Upload Bukti</div>
                                    <div class="text-white/35 text-xs">
                                        @if($order->bukti_transfer)
                                            Bukti sudah diupload
                                        @else
                                            Upload foto bukti transfer
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="step-line"></div>

                            {{-- Step 3 --}}
                            <div class="step">
                                <div class="step-dot {{ $order->status === 'confirmed' ? 'step-done' : ($order->status === 'rejected' ? 'step-dot' : 'step-inactive') }}"
                                     style="{{ $order->status === 'rejected' ? 'background:rgba(239,68,68,0.15); border:1px solid rgba(239,68,68,0.3); color:#f87171' : '' }}">
                                    @if($order->status === 'confirmed')
                                        <i class="fa-solid fa-check text-[10px]"></i>
                                    @elseif($order->status === 'rejected')
                                        <i class="fa-solid fa-xmark text-[10px]"></i>
                                    @else
                                        3
                                    @endif
                                </div>
                                <div class="pt-1">
                                    <div class="text-white font-semibold text-sm">Konfirmasi Admin</div>
                                    <div class="text-white/35 text-xs">
                                        @if($order->status === 'confirmed')
                                            Pembayaran dikonfirmasi ✓
                                        @elseif($order->status === 'rejected')
                                            Pembayaran ditolak
                                        @else
                                            Admin sedang memverifikasi
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="step-line"></div>

                            {{-- Step 4 --}}
                            <div class="step">
                                <div class="step-dot {{ $order->status === 'confirmed' ? 'step-active' : 'step-inactive' }}">
                                    @if($order->status === 'confirmed') <i class="fa-solid fa-ticket text-[10px]"></i>
                                    @else 4 @endif
                                </div>
                                <div class="pt-1">
                                    <div class="text-white font-semibold text-sm">Tiket Aktif</div>
                                    <div class="text-white/35 text-xs">E-ticket siap digunakan</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Card --}}
                    <div class="glass-card p-5">
                        <h3 class="text-white font-bold text-sm mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-qrcode text-gold/60 text-xs"></i> Informasi Pembayaran QRIS
                        </h3>
                        {{-- QRIS Image --}}
                        <div class="flex justify-center mb-4">
                            <div class="bg-white rounded-2xl p-3 shadow-lg" style="box-shadow: 0 0 20px rgba(255,215,0,0.15);">
                                <img src="{{ asset('images/qris_ostrich.png') }}"
                                     alt="QRIS OSTRIC MINI ZOO"
                                     class="w-36 h-36 object-contain rounded-xl">
                            </div>
                        </div>
                        <div class="text-center mb-4">
                            <div class="text-white font-bold text-sm">OSTRIC MINI ZOO</div>
                            <div class="text-white/40 text-[11px] font-mono mt-0.5">NMID: ID1025456460167</div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2 border-b" style="border-color:rgba(255,255,255,0.05)">
                                <span class="text-white/40 text-xs">Metode Bayar</span>
                                <span class="text-white font-semibold text-xs">QRIS (Semua E-Wallet)</span>
                            </div>
                            <div class="flex items-center justify-between py-2 border-b" style="border-color:rgba(255,255,255,0.05)">
                                <span class="text-white/40 text-xs">Merchant</span>
                                <span class="text-white font-semibold text-xs">Ostric Mini Zoo</span>
                            </div>
                            <div class="flex items-center justify-between py-2">
                                <span class="text-white/40 text-xs">Total Transfer</span>
                                <span class="text-gold font-black text-sm">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="mt-4 flex items-start gap-2 p-3 rounded-xl" style="background:rgba(251,191,36,0.07); border:1px solid rgba(251,191,36,0.15)">
                            <i class="fa-solid fa-triangle-exclamation text-yellow-400/70 text-xs mt-0.5 flex-shrink-0"></i>
                            <p class="text-yellow-200/60 text-[11px] leading-relaxed">Scan QRIS di atas dengan aplikasi e-wallet atau mobile banking, lalu pastikan nominal <strong class="text-yellow-300">tepat</strong> sesuai tagihan.</p>
                        </div>
                    </div>

                    {{-- Contact --}}
                    <div class="glass-card p-5 text-center">
                        <i class="fa-brands fa-telegram text-blue-400 text-2xl mb-2 block"></i>
                        <div class="text-white/50 text-xs">Butuh bantuan? Hubungi kami</div>
                        <a href="https://wa.me/6281234567890" target="_blank"
                           class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-white bg-green-600/20 border border-green-600/30 px-4 py-2 rounded-full hover:bg-green-600/30 transition-all">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ===== FITUR DRAG & DROP SERTA VALIDASI UPLOAD BUKTI TRANSFER =====

        // Mengambil elemen-elemen DOM yang diperlukan untuk fungsionalitas drag & drop
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('bukti-file');
        const previewImg = document.getElementById('preview-img');
        const placeholder = document.getElementById('drop-placeholder');
        const fileNameLabel = document.getElementById('file-name-label');
        const btnSubmit = document.getElementById('btn-submit');

        // Fungsi utama untuk memproses berkas gambar yang dipilih atau ditarik (dragged)
        function handleFile(file) {
            // Validasi jenis berkas: harus berupa gambar
            if (!file || !file.type.startsWith('image/')) {
                alert('File harus berupa gambar (JPG/PNG/WEBP).');
                return;
            }
            // Validasi ukuran berkas: maksimal 5 MB
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran file maksimal 5 MB.');
                return;
            }
            // Menggunakan FileReader untuk membaca konten berkas secara asinkron
            const reader = new FileReader();
            reader.onload = e => {
                // Tampilkan pratinjau gambar, sembunyikan placeholder instruksi
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
                
                // Beri label nama file sukses dan aktifkan tombol submit
                fileNameLabel.textContent = '✓ ' + file.name;
                fileNameLabel.classList.remove('hidden');
                dropZone.classList.add('has-file');
                if(btnSubmit) btnSubmit.disabled = false;
            };
            reader.readAsDataURL(file);
        }

        // Listener perubahan input file manual (saat box diklik dan memilih file dari Explorer)
        if (fileInput) {
            fileInput.addEventListener('change', e => handleFile(e.target.files[0]));
        }

        // Listener event drag-and-drop di area drop zone
        if (dropZone) {
            // Saat file diseret di atas area drop-zone
            dropZone.addEventListener('dragover', e => { 
                e.preventDefault(); 
                dropZone.classList.add('drag-over'); 
            });

            // Saat file batal diseret / keluar dari area drop-zone
            dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));

            // Saat file dilepas (dropped) di area drop-zone
            dropZone.addEventListener('drop', e => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                const dt = e.dataTransfer;
                if (dt.files.length) {
                    const file = dt.files[0];
                    // Masukkan file yang ditarik ke dalam elemen input form asli agar terkirim saat submit
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput.files = dataTransfer.files;
                    handleFile(file);
                }
            });
        }
    </script>
</body>
</html>
