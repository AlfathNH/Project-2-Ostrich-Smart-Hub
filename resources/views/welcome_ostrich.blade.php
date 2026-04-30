<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ostrich Mini Zoo Subang — Wisata Edukasi Satwa</title>
    <meta name="description" content="Wisata edukasi satwa pertama dan terlengkap di Subang. Kunjungi Ostrich Mini Zoo Subang sekarang!">

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

        /* ===== HERO ===== */
        .hero-bg {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 40%, #0f0a00 100%);
            position: relative;
            overflow: hidden;
        }
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 60% at 20% 50%, rgba(255,215,0,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(255,215,0,0.05) 0%, transparent 60%);
        }
        .hero-glow {
            position: absolute;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(255,215,0,0.12) 0%, transparent 70%);
            border-radius: 50%;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        /* ===== GOLD TEXT GRADIENT ===== */
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== CTA BUTTON ===== */
        .cta-btn {
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a;
            font-weight: 800;
            padding: 16px 40px;
            border-radius: 50px;
            font-size: 16px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 0 30px rgba(255,215,0,0.35), 0 4px 20px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
        }
        .cta-btn:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 0 50px rgba(255,215,0,0.55), 0 8px 30px rgba(0,0,0,0.4);
        }
        .cta-btn::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent, rgba(255,255,255,0.18), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }
        .cta-btn:hover::after { opacity: 1; }

        /* ===== NAVBAR ===== */
        .glass-navbar {
            background: rgba(10,10,10,0.7);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,215,0,0.12);
        }

        /* ===== PRICE CARD ===== */
        .price-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,215,0,0.25);
            backdrop-filter: blur(8px);
        }

        /* ===== SECTION CARDS ===== */
        .info-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.04), rgba(255,255,255,0.01));
            border: 1px solid rgba(255,255,255,0.08);
            transition: all 0.3s ease;
        }
        .info-card:hover {
            border-color: rgba(255,215,0,0.3);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        /* ===== ANIMAL HIGHLIGHT CARD ===== */
        .animal-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .animal-card:hover {
            background: rgba(255,215,0,0.05);
            border-color: rgba(255,215,0,0.25);
            transform: translateY(-5px);
        }

        /* ===== MODAL ===== */
        #login-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        #login-modal.active { display: flex; }
        .modal-backdrop {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.75);
            backdrop-filter: blur(8px);
        }
        .modal-card {
            position: relative;
            z-index: 1;
            background: linear-gradient(145deg, #1a1a1a, #111);
            border: 1px solid rgba(255,215,0,0.25);
            border-radius: 24px;
            padding: 40px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6);
        }
        .form-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 12px;
            color: white;
            padding: 12px 16px;
            width: 100%;
            font-size: 14px;
            transition: border-color 0.25s;
            outline: none;
        }
        .form-input:focus { border-color: #FFD700; }
        .form-input::placeholder { color: rgba(255,255,255,0.3); }

        /* ===== SCROLL REVEAL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s ease;
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: rgba(255,215,0,0.3); border-radius: 3px; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-white">

    {{-- ============================================================ --}}
    {{-- NAVBAR                                                         --}}
    {{-- ============================================================ --}}
    <nav class="glass-navbar fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Ostrich Mini Zoo"
                     class="w-9 h-9 object-contain"
                     style="filter: drop-shadow(0 0 6px rgba(255,215,0,0.45))">
                <div>
                    <div class="text-white font-bold text-sm leading-tight tracking-wide">OSTRICH MINI ZOO</div>
                    <div class="text-gold text-[10px] font-medium tracking-widest">SUBANG · EST. 2020</div>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-6 text-sm">
                <a href="#about" class="text-white/60 hover:text-gold transition-colors">Tentang</a>
                <a href="#gallery" class="text-white/60 hover:text-gold transition-colors">Galeri</a>
                <a href="#location" class="text-white/60 hover:text-gold transition-colors">Lokasi</a>

                @if(session()->has('role'))
                    {{-- ===== LOGGED IN: show name + role shortcut + logout ===== --}}
                    <div class="flex items-center gap-3">
                        {{-- User chip --}}
                        <div class="flex items-center gap-2 bg-white/8 border border-white/12 rounded-full px-3 py-1.5">
                            <div class="w-5 h-5 rounded-full bg-gradient-to-br from-gold to-yellow-600 flex items-center justify-center text-[9px] font-black text-charcoal">
                                {{ strtoupper(substr(session('name', 'U'), 0, 1)) }}
                            </div>
                            <span class="text-white text-xs font-semibold max-w-[90px] truncate">{{ session('name', 'Pengguna') }}</span>
                        </div>

                        {{-- Riwayat Tiket (untuk Pengunjung) --}}
                        @if(session('role') === 'Pengunjung')
                            <a href="{{ route('ticket.history') }}"
                               class="flex items-center gap-1.5 text-white/60 hover:text-gold text-xs font-semibold transition-colors">
                                <i class="fa-solid fa-clock-rotate-left text-[11px]"></i>
                                <span class="hidden lg:inline">Riwayat</span>
                            </a>
                        @endif

                        {{-- Dashboard shortcut based on role --}}
                        @if(session('role') == 'Admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="bg-gold text-charcoal text-xs font-bold px-3 py-1.5 rounded-full hover:bg-yellow-300 transition-all">
                                <i class="fa-solid fa-shield-halved mr-1"></i>Admin
                            </a>
                        @elseif(session('role') == 'Manager')
                            <a href="{{ route('manager.dashboard') }}"
                               class="bg-gold text-charcoal text-xs font-bold px-3 py-1.5 rounded-full hover:bg-yellow-300 transition-all">
                                <i class="fa-solid fa-chart-line mr-1"></i>Manager
                            </a>
                        @elseif(session('role') == 'Zookeeper')
                            <a href="{{ route('zookeeper.dashboard') }}"
                               class="bg-gold text-charcoal text-xs font-bold px-3 py-1.5 rounded-full hover:bg-yellow-300 transition-all">
                                <i class="fa-solid fa-paw mr-1"></i>Keeper
                            </a>
                        @endif

                        {{-- Logout --}}
                        <a href="{{ route('logout') }}"
                           class="flex items-center gap-1.5 text-red-400 hover:text-red-300 text-xs font-semibold transition-colors px-2 py-1.5 rounded-lg hover:bg-red-900/20">
                            <i class="fa-solid fa-right-from-bracket text-[11px]"></i>
                            <span class="hidden lg:inline">Keluar</span>
                        </a>
                    </div>
                @else
                    {{-- ===== GUEST: show login button ===== --}}
                    <a href="{{ route('login') }}"
                       class="bg-white/10 text-white text-xs font-semibold px-4 py-2 rounded-full hover:bg-white/20 transition-all border border-white/15">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i>Login
                    </a>
                @endif
            </div>

            {{-- Mobile menu button --}}
            <button class="md:hidden text-white/70 hover:text-gold" onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        {{-- Mobile Dropdown Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10 px-6 py-3 space-y-1 bg-black/90">
            <a href="#about" class="block text-white/60 py-1.5 text-sm">Tentang</a>
            <a href="#gallery" class="block text-white/60 py-1.5 text-sm">Galeri</a>
            <a href="#location" class="block text-white/60 py-1.5 text-sm">Lokasi</a>
            @if(session()->has('role'))
                <div class="pt-2 mt-2 border-t border-white/10">
                    <p class="text-white/30 text-xs mb-1">Login sebagai</p>
                    <p class="text-white font-semibold text-sm mb-2">{{ session('name', 'Pengguna') }}</p>
                    <a href="{{ route('logout') }}" class="block text-red-400 py-1.5 text-sm font-semibold">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>Keluar
                    </a>
                </div>
            @else
                <div class="pt-2 mt-2 border-t border-white/10">
                    <a href="{{ route('login') }}" class="block text-gold py-1.5 text-sm font-semibold">
                        <i class="fa-solid fa-right-to-bracket mr-1"></i>Login / Daftar
                    </a>
                </div>
            @endif
        </div>
    </nav>

    {{-- ============================================================ --}}
    {{-- HERO SECTION                                                    --}}
    {{-- ============================================================ --}}
    <section class="hero-bg min-h-screen flex flex-col items-center justify-center text-center px-6 pt-20 pb-16">
        <div class="hero-glow"></div>
        <div class="relative z-10 max-w-4xl mx-auto">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-gold/10 border border-gold/25 text-gold text-xs font-semibold px-4 py-2 rounded-full mb-8 animate__animated animate__fadeInDown">
                <i class="fa-solid fa-star text-gold text-[10px]"></i>
                Wisata Edukasi Satwa #1 di Subang
            </div>

            {{-- Headline --}}
            <h1 class="text-5xl md:text-7xl font-black leading-tight mb-6 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                <span class="text-white">OSTRICH</span><br>
                <span class="gold-gradient-text">MINI ZOO</span>
            </h1>
            <p class="text-white/60 text-lg md:text-xl max-w-2xl mx-auto mb-10 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                Temukan keajaiban satwa di satu tempat. Pengalaman wisata edukasi yang tak terlupakan
                bersama keluarga tercinta di jantung Kota Subang.
            </p>

            {{-- Price Card --}}
            <div class="price-card inline-flex flex-col items-center rounded-2xl px-8 py-5 mb-10 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                <div class="text-white/50 text-xs font-medium uppercase tracking-widest mb-1">Harga Tiket Masuk</div>
                <div class="text-3xl font-black text-white">
                    Rp <span class="gold-gradient-text">{{ number_format($hargaTiket, 0, ',', '.') }}</span>
                </div>
                <div class="text-white/40 text-xs mt-1">per orang · Berlaku semua hari</div>
            </div>

            {{-- CTA --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                @if(session()->has('role'))
                    {{-- User is logged in → go straight to booking --}}
                    <a href="/checkout" class="cta-btn inline-flex items-center">
                        <i class="fa-solid fa-ticket mr-2"></i> Pesan Tiket Sekarang
                    </a>
                @else
                    {{-- Guest → open login modal --}}
                    <button class="cta-btn" id="cta-pesan-tiket" onclick="openLoginModal()">
                        <i class="fa-solid fa-ticket mr-2"></i> Pesan Tiket Sekarang
                    </button>
                @endif
                <a href="#about" class="flex items-center gap-2 text-white/60 hover:text-white text-sm font-medium transition-colors px-6 py-4">
                    Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-down text-xs animate-bounce"></i>
                </a>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/20 text-xs">
            <span>scroll</span>
            <div class="w-px h-10 bg-gradient-to-b from-white/20 to-transparent"></div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- ABOUT SECTION                                                   --}}
    {{-- ============================================================ --}}
    <section id="about" class="py-24 px-6 bg-[#0d0d0d]">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <div class="text-gold text-xs font-bold tracking-widest uppercase mb-3">Tentang Kami</div>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-4">Apa itu <span class="gold-gradient-text">Ostrich Hub?</span></h2>
                <p class="text-white/50 max-w-2xl mx-auto">Platform pengelolaan cerdas untuk Ostrich Mini Zoo yang mengintegrasikan manajemen satwa, tiket, dan operasional dalam satu ekosistem digital.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="info-card rounded-2xl p-6 reveal">
                    <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-paw text-gold text-lg"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Wisata Satwa</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Berinteraksi langsung dengan berbagai spesies satwa eksotis dalam lingkungan yang aman dan edukatif.</p>
                </div>
                <div class="info-card rounded-2xl p-6 reveal" style="transition-delay: 0.1s">
                    <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-graduation-cap text-gold text-lg"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Edukasi</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Program edukasi terstruktur untuk sekolah dan keluarga tentang konservasi dan ekosistem satwa liar.</p>
                </div>
                <div class="info-card rounded-2xl p-6 reveal" style="transition-delay: 0.2s">
                    <div class="w-12 h-12 rounded-xl bg-gold/10 border border-gold/20 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-shield-halved text-gold text-lg"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Konservasi</h3>
                    <p class="text-white/50 text-sm leading-relaxed">Berkomitmen pada pelestarian satwa melalui program breeding dan perawatan profesional bersertifikat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- ANIMAL GALLERY SECTION                                          --}}
    {{-- ============================================================ --}}
    <section id="gallery" class="py-24 px-6 bg-[#0a0a0a]">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <div class="text-gold text-xs font-bold tracking-widest uppercase mb-3">Satwa Kami</div>
                <h2 class="text-3xl md:text-5xl font-black text-white mb-4">Kenali <span class="gold-gradient-text">Penghuni Zoo</span></h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                @php
                $animalData = [
                    ['img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Struthio_Diversity.jpg/960px-Struthio_Diversity.jpg', 'name' => 'Burung Unta', 'latin' => 'Struthio camelus', 'status' => 'Andalan Utama'],
                    ['img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Gracie-rhs2005.jpg/960px-Gracie-rhs2005.jpg', 'name' => 'Kuda Poni', 'latin' => 'Equus caballus', 'status' => 'Favorit Anak'],
                    ['img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Oryctolagus_cuniculus_Rcdo.jpg/960px-Oryctolagus_cuniculus_Rcdo.jpg', 'name' => 'Kelinci Hias', 'latin' => 'Oryctolagus cuniculus', 'status' => 'Lucu & Jinak'],
                    ['img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Peacock_Plumage.jpg/960px-Peacock_Plumage.jpg', 'name' => 'Burung Merak', 'latin' => 'Pavo cristatus', 'status' => 'Eksotis'],
                ];
                @endphp
                @foreach($animalData as $a)
                <div class="animal-card overflow-hidden text-center reveal group flex flex-col h-full bg-[#111]">
                    <div class="relative overflow-hidden w-full h-40">
                        <img src="{{ $a['img'] }}" alt="{{ $a['name'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#111] via-[#111]/30 to-transparent"></div>
                    </div>
                    <div class="px-5 pb-5 -mt-6 relative z-10 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="text-white font-bold text-base mb-0.5">{{ $a['name'] }}</div>
                            <div class="text-white/40 text-[11px] italic mb-4 tracking-widest">{{ $a['latin'] }}</div>
                        </div>
                        <div>
                            <span class="inline-block bg-gold/10 text-gold text-[10px] font-semibold px-3 py-1.5 rounded-full border border-gold/20 shadow-sm">{{ $a['status'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- LOCATION SECTION                                                --}}
    {{-- ============================================================ --}}
    <section id="location" class="py-24 px-6 bg-[#0d0d0d]">
        <div class="max-w-4xl mx-auto text-center reveal">
            <div class="text-gold text-xs font-bold tracking-widest uppercase mb-3">Lokasi</div>
            <h2 class="text-3xl md:text-4xl font-black text-white mb-6">Temukan Kami di <span class="gold-gradient-text">Subang</span></h2>
            <div class="info-card rounded-2xl p-8 flex flex-col md:flex-row items-center gap-8 text-left">
                <div class="flex-1">
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-location-dot text-gold"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold mb-1">Alamat</div>
                            <div class="text-white/50 text-sm">Jl. Raya Subang, Kabupaten Subang<br>Jawa Barat, Indonesia</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-clock text-gold"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold mb-1">Jam Operasional</div>
                            <div class="text-white/50 text-sm">Senin – Minggu · 09.30 – 17.00 WIB</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-gold/10 flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-phone text-gold"></i>
                        </div>
                        <div>
                            <div class="text-white font-bold mb-1">Kontak</div>
                            <div class="text-white/50 text-sm">+62 821-xxxx-xxxx</div>
                        </div>
                    </div>
                </div>
                <div class="flex-1 w-full flex justify-center">
                    <div class="relative w-full h-full min-h-[220px] rounded-xl overflow-hidden border border-white/10 group">
                        {{-- Real embedded map with pointer-events disabled so we can click the overlay --}}
                        <iframe class="absolute inset-0 w-full h-full pointer-events-none opacity-60 group-hover:opacity-80 transition-opacity duration-300" 
                                style="filter: invert(90%) hue-rotate(180deg);"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242784!2d107.573116!3d-6.556771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b88f349ba75%3A0xe54d6a6a3b680718!2sSubang%2C%20Subang%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid" 
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors duration-300"></div>
                        
                        {{-- Clickable Overlay --}}
                        <a href="https://maps.google.com/?q=Ostrich+Mini+Zoo+Subang+Jawa+Barat" target="_blank" 
                           class="absolute inset-0 flex flex-col items-center justify-center z-10 text-decoration-none">
                            <i class="fa-solid fa-location-dot text-gold text-4xl mb-3 drop-shadow-[0_0_15px_rgba(255,215,0,0.8)] animate-bounce"></i>
                            <div class="bg-gold text-charcoal font-bold text-xs px-5 py-2.5 rounded-full shadow-2xl flex items-center gap-2 group-hover:-translate-y-1 transition-transform duration-300">
                                Buka di Google Maps <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================ --}}
    {{-- FOOTER                                                          --}}
    {{-- ============================================================ --}}
    <footer class="bg-[#080808] border-t border-white/5 py-10 px-6 text-center">
        <div class="flex items-center justify-center gap-3 mb-4">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Ostrich Mini Zoo"
                     class="w-8 h-8 object-contain"
                     style="filter: drop-shadow(0 0 5px rgba(255,215,0,0.4))">
            <span class="text-white font-bold">OSTRICH MINI ZOO</span>
        </div>
        <p class="text-white/25 text-xs">&copy; 2026 Phaeton Inc. All rights reserved. Ostrich Mini Zoo Subang.</p>
    </footer>

    {{-- ============================================================ --}}
    {{-- LOGIN / REGISTER MODAL                                          --}}
    {{-- ============================================================ --}}
    <div id="login-modal">
        <div class="modal-backdrop" onclick="closeLoginModal()"></div>
        <div class="modal-card animate__animated animate__zoomIn animate__faster">

            {{-- Modal Tabs --}}
            <div class="flex gap-2 mb-6 bg-white/5 rounded-xl p-1">
                <button id="tab-login" onclick="switchTab('login')"
                        class="flex-1 py-2 text-sm font-semibold rounded-lg text-white bg-gold/20 border border-gold/30 transition-all">
                    Login
                </button>
                <button id="tab-register" onclick="switchTab('register')"
                        class="flex-1 py-2 text-sm font-semibold rounded-lg text-white/50 transition-all hover:text-white">
                    Daftar Baru
                </button>
            </div>

            {{-- Modal Header --}}
            <div class="text-center mb-6">
                    <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                         alt="Ostrich Mini Zoo Logo"
                         class="w-14 h-14 object-contain mx-auto"
                         style="filter: drop-shadow(0 0 10px rgba(255,215,0,0.5))">
                <h3 id="modal-title" class="text-xl font-black text-white">Selamat Datang Kembali!</h3>
                <p id="modal-subtitle" class="text-white/40 text-xs mt-1">Login untuk melanjutkan pemesanan tiket</p>
            </div>

            {{-- LOGIN FORM --}}
            {{-- action uses url() helper for robustness across subdirectory installs --}}
            <form id="form-login" action="{{ url('/login') }}" method="POST" class="space-y-4">
                @csrf
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="text" name="login_id" class="form-input" style="padding-left: 34px"
                           placeholder="Email atau ID" required autocomplete="username">
                </div>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="password" name="password" id="modal-password" class="form-input" style="padding-left: 34px; padding-right: 40px"
                           placeholder="Password" required autocomplete="current-password">
                    <button type="button" onclick="toggleModalPw()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white/30 hover:text-white/60 transition-colors">
                        <i class="fa-solid fa-eye text-xs" id="modal-eye-icon"></i>
                    </button>
                </div>
                <button type="submit" id="modal-login-btn"
                        class="w-full py-3 rounded-xl font-bold text-charcoal text-sm transition-all flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 15px rgba(255,215,0,0.3);">
                    <i class="fa-solid fa-right-to-bracket"></i> MASUK
                </button>
            </form>

            {{-- REGISTER FORM --}}
            <form id="form-register" action="{{ url('/register') }}" method="POST" class="space-y-4 hidden">
                @csrf
                <div class="relative">
                    <i class="fa-solid fa-user absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="text" name="name" class="form-input" style="padding-left: 34px"
                           placeholder="Nama Lengkap" required autocomplete="name">
                </div>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="email" name="email" class="form-input" style="padding-left: 34px"
                           placeholder="Email Aktif" required autocomplete="email">
                </div>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="password" name="password" id="reg-password" class="form-input"
                           style="padding-left: 34px; padding-right: 40px"
                           placeholder="Password (min. 6 karakter)" required autocomplete="new-password">
                    <button type="button" onclick="togglePw('reg-password','reg-eye1')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white/30 hover:text-white/60 transition-colors">
                        <i class="fa-solid fa-eye text-xs" id="reg-eye1"></i>
                    </button>
                </div>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute left-3 top-1/2 -translate-y-1/2 text-white/30 text-xs"></i>
                    <input type="password" name="password_confirmation" id="reg-password-confirm" class="form-input"
                           style="padding-left: 34px; padding-right: 40px"
                           placeholder="Konfirmasi Password" required autocomplete="new-password">
                    <button type="button" onclick="togglePw('reg-password-confirm','reg-eye2')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white/30 hover:text-white/60 transition-colors">
                        <i class="fa-solid fa-eye text-xs" id="reg-eye2"></i>
                    </button>
                </div>
                <button type="submit"
                        class="w-full py-3 rounded-xl font-bold text-charcoal text-sm transition-all flex items-center justify-center gap-2"
                        style="background: linear-gradient(135deg, #FFD700, #f0c800); box-shadow: 0 4px 15px rgba(255,215,0,0.3);">
                    <i class="fa-solid fa-user-plus"></i> DAFTAR AKUN
                </button>
            </form>

            <button onclick="closeLoginModal()"
                    class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center text-white/40 hover:text-white hover:bg-white/10 rounded-lg transition-all">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>

    <script>
        // ===== SESSION FLAG (rendered server-side by Laravel) =====
        // This is the single source of truth — JS never overrides this.
        window.isLoggedIn = @json(session()->has('role'));
        // ===== MODAL =====
        function openLoginModal() {
            // Safety guard: if Laravel session says user is logged in,
            // never open the modal — redirect to booking instead.
            if (window.isLoggedIn) {
                window.location.href = '/checkout';
                return;
            }
            const modal = document.getElementById('login-modal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            // Auto-focus first input for better UX
            setTimeout(() => {
                const firstInput = modal.querySelector('input:not([type=hidden])');
                if (firstInput) firstInput.focus();
            }, 150);
        }

        function closeLoginModal() {
            const modal = document.getElementById('login-modal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        function switchTab(tab) {
            const formLogin = document.getElementById('form-login');
            const formReg   = document.getElementById('form-register');
            const tabLogin  = document.getElementById('tab-login');
            const tabReg    = document.getElementById('tab-register');
            const title     = document.getElementById('modal-title');
            const subtitle  = document.getElementById('modal-subtitle');

            if (tab === 'login') {
                formLogin.classList.remove('hidden');
                formReg.classList.add('hidden');
                tabLogin.style.cssText = 'background:rgba(255,215,0,0.18);border:1px solid rgba(255,215,0,0.3);color:#fff;';
                tabReg.style.cssText   = 'background:transparent;border:none;color:rgba(255,255,255,0.5);';
                title.textContent    = 'Selamat Datang Kembali!';
                subtitle.textContent = 'Login untuk melanjutkan pemesanan tiket';
            } else {
                formReg.classList.remove('hidden');
                formLogin.classList.add('hidden');
                tabReg.style.cssText   = 'background:rgba(255,215,0,0.18);border:1px solid rgba(255,215,0,0.3);color:#fff;';
                tabLogin.style.cssText = 'background:transparent;border:none;color:rgba(255,255,255,0.5);';
                title.textContent    = 'Buat Akun Pengunjung';
                subtitle.textContent = 'Daftar gratis untuk pesan tiket online';
            }
        }

        // ===== PASSWORD TOGGLE (shared: login + register fields) =====
        // Login field uses dedicated modal-password/modal-eye-icon IDs
        function toggleModalPw() { togglePw('modal-password', 'modal-eye-icon'); }

        function togglePw(fieldId, iconId) {
            const f = document.getElementById(fieldId);
            const i = document.getElementById(iconId);
            if (!f || !i) return;
            if (f.type === 'password') { f.type = 'text';     i.classList.replace('fa-eye','fa-eye-slash'); }
            else                       { f.type = 'password'; i.classList.replace('fa-eye-slash','fa-eye'); }
        }

        // ===== LOADING STATE ON MODAL SUBMIT =====
        document.getElementById('form-login').addEventListener('submit', function() {
            const btn = document.getElementById('modal-login-btn');
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btn.disabled  = true;
        });

        // Close modal on ESC or backdrop click
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeLoginModal(); });

        // ===== SCROLL REVEAL =====
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>
