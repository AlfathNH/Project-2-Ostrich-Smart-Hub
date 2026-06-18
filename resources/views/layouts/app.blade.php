<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ostrich Smart Hub')</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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
                    fontFamily: {
                        inter: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        * { font-family: 'Inter', sans-serif; }

        /* ===== SIDEBAR GLASSMORPHISM ===== */
        #sidebar {
            background: rgba(15, 15, 15, 0.82);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 215, 0, 0.15);
            transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: width, transform;
        }
        #sidebar.collapsed { width: 72px !important; }
        #sidebar.collapsed .sidebar-label { opacity: 0; width: 0; overflow: hidden; white-space: nowrap; }
        #sidebar.collapsed .sidebar-logo-text { display: none; }
        #sidebar.collapsed .role-badge { display: none; }

        /* ===== NAV ITEMS ===== */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 16px;
            border-radius: 12px;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            transition: all 0.22s ease;
            position: relative;
            overflow: hidden;
        }
        .nav-item:hover {
            background: rgba(255, 215, 0, 0.12);
            color: #FFD700;
            transform: translateX(3px);
        }
        .nav-item.active {
            background: linear-gradient(135deg, rgba(255,215,0,0.18), rgba(255,215,0,0.08));
            color: #FFD700;
            border-left: 3px solid #FFD700;
        }
        .nav-item .icon { font-size: 17px; min-width: 24px; text-align: center; flex-shrink: 0; }
        .nav-section-title {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,215,0,0.45);
            padding: 6px 16px 4px;
            margin-top: 8px;
        }

        /* ===== RIPPLE EFFECT ===== */
        .ripple-btn { position: relative; overflow: hidden; }
        .ripple-btn::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            width: 0; height: 0;
            background: rgba(255,255,255,0.35);
            transform: translate(-50%, -50%);
            transition: width 0.5s, height 0.5s, opacity 0.5s;
            opacity: 0;
        }
        .ripple-btn:active::after {
            width: 200px; height: 200px;
            opacity: 0;
        }

        /* ===== TOP NAVBAR ===== */
        #top-navbar {
            background: rgba(15, 15, 15, 0.7);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 215, 0, 0.12);
        }

        /* ===== MAIN CONTENT ===== */
        #main-content {
            transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: rgba(255,215,0,0.3); border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(255,215,0,0.6); }

        /* ===== GOLD BADGE ===== */
        .role-badge {
            display: inline-block;
            background: linear-gradient(135deg, #FFD700, #c9a800);
            color: #1a1a1a;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* ===== MOBILE OVERLAY ===== */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 30;
        }
        #sidebar-overlay.active { display: block; }

        /* ===== CARD HOVER ===== */
        .stat-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }

        /* ===== MOBILE: BOTTOM NAV ===== */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); width: 280px !important; background: rgba(15,15,15,0.95); backdrop-filter: blur(20px); z-index: 60; }
            #sidebar.mobile-open { transform: translateX(0); }
            #main-content { margin-left: 0 !important; }
            #top-navbar { padding-left: 1rem !important; }
        }

        /* ===== PAGE ENTRY ANIMATION ===== */
        .page-enter {
            animation: pageEnter 0.45s ease forwards;
        }
        @keyframes pageEnter {
            from { opacity: 0; transform: translateY(18px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-[#0f0f0f] text-white min-h-screen flex flex-col">

    {{-- ===== MOBILE OVERLAY ===== --}}
    <div id="sidebar-overlay" onclick="closeMobileSidebar()"></div>

    <div class="flex flex-1 relative">

        {{-- ============================================================ --}}
        {{-- SIDEBAR                                                        --}}
        {{-- ============================================================ --}}
        <aside id="sidebar" class="fixed top-0 left-0 h-full z-40 flex flex-col overflow-hidden"
               style="width: 260px; min-height: 100vh;">

            {{-- Sidebar Header --}}
            <div class="flex items-center gap-3 px-4 py-5 border-b border-white/10">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Ostrich Mini Zoo Logo"
                     class="w-9 h-9 object-contain flex-shrink-0"
                     style="filter: drop-shadow(0 0 6px rgba(255, 215, 0, 0.4))">
                <div class="sidebar-logo-text flex-1 overflow-hidden">
                    <div class="text-white font-bold text-sm leading-tight">OSTRICH</div>
                    <div class="text-gold text-xs font-medium tracking-widest">SMART HUB</div>
                </div>
                <button onclick="toggleSidebar()" id="toggle-btn"
                        class="text-white/50 hover:text-gold transition-colors ml-auto flex-shrink-0 p-1 rounded-lg hover:bg-white/10">
                    <i class="fa-solid fa-chevron-left text-xs" id="toggle-icon"></i>
                </button>
            </div>

            {{-- User Info --}}
            <div class="px-4 py-3 border-b border-white/5">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gold to-yellow-600 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-user text-charcoal text-xs"></i>
                    </div>
                    <div class="sidebar-label flex flex-col overflow-hidden">
                        <span class="text-white text-xs font-semibold truncate">
                            {{ session('name', 'Pengguna') }}
                        </span>
                        <span class="role-badge mt-0.5">
                            @if(session('role') == 'Admin') Admin
                            @elseif(session('role') == 'Manager') Manager
                            @elseif(session('role') == 'Zookeeper') Zookeeper
                            @else Visitor
                            @endif
                        </span>
                    </div>
                </div>
            </div>

            {{-- ===== NAV LINKS ===== --}}
            <nav class="flex-1 overflow-y-auto px-3 py-3 space-y-0.5">

                {{-- VISITOR MENU --}}
                @if(!session('role') || session('role') == 'Visitor')
                    <div class="nav-section-title">Navigasi</div>
                    <a href="{{ route('welcome') }}" class="nav-item {{ request()->routeIs('welcome') ? 'active' : '' }}">
                        <i class="fa-solid fa-house icon"></i>
                        <span class="sidebar-label">Beranda</span>
                    </a>
                    <a href="{{ route('welcome') }}#about" class="nav-item">
                        <i class="fa-solid fa-circle-info icon"></i>
                        <span class="sidebar-label">Tentang Ostrich</span>
                    </a>
                    <a href="{{ route('welcome') }}#gallery" class="nav-item">
                        <i class="fa-solid fa-images icon"></i>
                        <span class="sidebar-label">Galeri Satwa</span>
                    </a>
                    @if(session('user_id'))
                        <a href="#" class="nav-item">
                            <i class="fa-solid fa-ticket icon"></i>
                            <span class="sidebar-label">Pesan Tiket</span>
                        </a>
                        <a href="#" class="nav-item">
                            <i class="fa-solid fa-receipt icon"></i>
                            <span class="sidebar-label">Pesanan Saya</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-item opacity-60">
                            <i class="fa-solid fa-lock icon"></i>
                            <span class="sidebar-label">Pesan Tiket <span class="text-xs ml-1">(Login dulu)</span></span>
                        </a>
                    @endif
                @endif

                {{-- ADMIN MENU --}}
                @if(session('role') == 'Admin')
                    <div class="nav-section-title">Admin Panel</div>
                    <a href="{{ route('admin.dashboard', ['tab' => 'overview']) }}" class="nav-item {{ request()->routeIs('admin.dashboard') && (request('tab') == 'overview' || !request()->has('tab')) ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-pie icon"></i>
                        <span class="sidebar-label">Ringkasan</span>
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'satwa']) }}" class="nav-item {{ request()->routeIs('admin.dashboard') && request('tab') == 'satwa' ? 'active' : '' }}">
                        <i class="fa-solid fa-database icon"></i>
                        <span class="sidebar-label">Kelola Satwa</span>
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'pakan']) }}" class="nav-item {{ request()->routeIs('admin.dashboard') && request('tab') == 'pakan' ? 'active' : '' }}">
                        <i class="fa-solid fa-wheat-awn icon"></i>
                        <span class="sidebar-label">Kelola Pakan</span>
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'kesehatan']) }}" class="nav-item {{ request()->routeIs('admin.dashboard') && request('tab') == 'kesehatan' ? 'active' : '' }}">
                        <i class="fa-solid fa-kit-medical icon"></i>
                        <span class="sidebar-label">Kelola Medis Satwa</span>
                    </a>
                    <a href="{{ route('admin.dashboard', ['tab' => 'tiket']) }}" class="nav-item {{ request()->routeIs('admin.dashboard') && request('tab') == 'tiket' ? 'active' : '' }}">
                        <i class="fa-solid fa-ticket icon"></i>
                        <span class="sidebar-label">Riwayat Tiket</span>
                    </a>
                    <a href="{{ route('settings.index') }}" class="nav-item {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                        <i class="fa-solid fa-tags icon"></i>
                        <span class="sidebar-label">Kelola Harga</span>
                    </a>

                    <div class="nav-section-title">Akses Cepat</div>
                    <a href="{{ route('admin.animal.create') }}" class="nav-item">
                        <i class="fa-solid fa-plus-circle icon"></i>
                        <span class="sidebar-label">Tambah Satwa</span>
                    </a>
                    <a href="{{ route('welcome') }}" class="nav-item">
                        <i class="fa-solid fa-eye icon"></i>
                        <span class="sidebar-label">Lihat Web Publik</span>
                    </a>
                @endif

                {{-- MANAGER MENU --}}
                @if(session('role') == 'Manager')
                    <div class="nav-section-title">Manager Hub</div>
                    <a href="{{ route('manager.dashboard', ['tab' => 'overview']) }}" class="nav-item {{ request()->routeIs('manager.dashboard') && (request('tab') == 'overview' || !request()->has('tab')) ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line icon"></i>
                        <span class="sidebar-label">Monitoring Pendapatan</span>
                    </a>
                    <a href="{{ route('manager.dashboard', ['tab' => 'staff']) }}" class="nav-item {{ request()->routeIs('manager.dashboard') && request('tab') == 'staff' ? 'active' : '' }}">
                        <i class="fa-solid fa-users-viewfinder icon"></i>
                        <span class="sidebar-label">Kelola Staff</span>
                    </a>
                    <a href="{{ route('manager.dashboard', ['tab' => 'tiket']) }}" class="nav-item {{ request()->routeIs('manager.dashboard') && request('tab') == 'tiket' ? 'active' : '' }}">
                        <i class="fa-solid fa-ticket icon"></i>
                        <span class="sidebar-label">Riwayat Tiket</span>
                    </a>
                    <a href="{{ route('manager.laporan') }}" class="nav-item {{ request()->routeIs('manager.laporan') ? 'active' : '' }}">
                        <i class="fa-solid fa-print icon"></i>
                        <span class="sidebar-label">Pusat Cetak Laporan</span>
                    </a>
                @endif

                {{-- ZOOKEEPER MENU --}}
                @if(session('role') == 'Zookeeper')
                    <div class="nav-section-title">Monitoring Hewan</div>
                    <a href="{{ route('zookeeper.pakan') }}" class="nav-item {{ request()->routeIs('zookeeper.pakan') ? 'active' : '' }}">
                        <i class="fa-solid fa-bowl-food icon"></i>
                        <span class="sidebar-label">Kelola Pakan</span>
                    </a>
                    <a href="{{ route('zookeeper.medis') }}" class="nav-item {{ request()->routeIs('zookeeper.medis') ? 'active' : '' }}">
                        <i class="fa-solid fa-kit-medical icon"></i>
                        <span class="sidebar-label">Log Medis</span>
                    </a>
                @endif

            </nav>

            {{-- Sidebar Footer --}}
            <div class="px-3 py-3 border-t border-white/10">
                <a href="{{ route('logout') }}" class="nav-item text-red-400 hover:text-red-300 hover:bg-red-900/20">
                    <i class="fa-solid fa-right-from-bracket icon"></i>
                    <span class="sidebar-label">Keluar</span>
                </a>
            </div>
        </aside>

        {{-- ============================================================ --}}
        {{-- PAGE CONTENT                                                    --}}
        {{-- ============================================================ --}}
        <div id="main-content" class="flex-1 flex flex-col min-h-screen" style="margin-left: 260px;">

            {{-- Top Navbar --}}
            <header id="top-navbar" class="sticky top-0 z-20 flex items-center justify-between px-6 py-3 pl-6">
                {{-- Hamburger (mobile) --}}
                <button onclick="toggleMobileSidebar()" class="md:hidden text-white/70 hover:text-gold mr-3">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>

                {{-- Page Title --}}
                <div>
                    <h1 class="text-sm font-semibold text-white/90">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-xs text-white/40">@yield('page-subtitle', 'Ostrich Smart Hub')</p>
                </div>

                {{-- Right actions --}}
                <div class="flex items-center gap-3 ml-auto">
                    <div class="hidden sm:flex items-center gap-2 text-xs text-white/50">
                        <i class="fa-regular fa-clock text-gold"></i>
                        <span id="live-clock"></span>
                    </div>
                    <div class="w-px h-5 bg-white/10 hidden sm:block"></div>
                    <a href="{{ route('logout') }}"
                       class="flex items-center gap-2 text-xs text-red-400 hover:text-red-300 transition-colors px-3 py-1.5 rounded-lg hover:bg-red-900/20">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="hidden sm:inline">Logout</span>
                    </a>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mx-6 mt-4 flex items-center gap-3 bg-emerald-900/40 border border-emerald-500/30 text-emerald-300 px-4 py-3 rounded-xl animate__animated animate__fadeInDown"
                     id="flash-success">
                    <i class="fa-solid fa-circle-check text-emerald-400"></i>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-emerald-400/60 hover:text-emerald-300">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="mx-6 mt-4 flex items-center gap-3 bg-red-900/40 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl animate__animated animate__fadeInDown">
                    <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-400/60 hover:text-red-300">
                        <i class="fa-solid fa-xmark text-xs"></i>
                    </button>
                </div>
            @endif

            {{-- Main Content Area --}}
            <main class="flex-1 p-6 page-enter">
                @yield('content')
            </main>

            {{-- Footer --}}
            <footer class="text-center text-xs text-white/20 py-4 border-t border-white/5">
                &copy; 2026 Phaeton Inc. &mdash; Ostrich Mini Zoo Subang
            </footer>
        </div>
    </div>


    {{-- SCRIPTS                                                         --}}
    {{-- ============================================================ --}}
    <script>
        // ===== LIVE CLOCK =====
        function updateClock() {
            const now = new Date();
            const el = document.getElementById('live-clock');
            if (el) {
                el.textContent = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            }
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ===== SIDEBAR TOGGLE (DESKTOP) =====
        let collapsed = false;
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const icon = document.getElementById('toggle-icon');
            collapsed = !collapsed;
            if (collapsed) {
                sidebar.classList.add('collapsed');
                sidebar.style.width = '72px';
                mainContent.style.marginLeft = '72px';
                icon.style.transform = 'rotate(180deg)';
            } else {
                sidebar.classList.remove('collapsed');
                sidebar.style.width = '260px';
                mainContent.style.marginLeft = '260px';
                icon.style.transform = 'rotate(0deg)';
            }
        }

        // ===== MOBILE SIDEBAR =====
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.add('mobile-open');
            overlay.classList.add('active');
        }
        function closeMobileSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        }

        // ===== RIPPLE EFFECT =====
        document.querySelectorAll('.ripple-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                const rect = btn.getBoundingClientRect();
                const ripple = document.createElement('span');
                ripple.style.cssText = `
                    position:absolute; border-radius:50%;
                    background:rgba(255,255,255,0.3);
                    width:0; height:0;
                    left:${e.clientX - rect.left}px;
                    top:${e.clientY - rect.top}px;
                    transform:translate(-50%,-50%);
                    animation:rippleAnim 0.6s linear;
                    pointer-events:none;
                `;
                btn.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        // Auto-dismiss flash after 4s
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) flash.style.opacity = '0', setTimeout(() => flash.remove(), 500);
        }, 4000);
    </script>

    <style>
        @keyframes rippleAnim {
            from { width: 0; height: 0; opacity: 0.6; }
            to   { width: 200px; height: 200px; opacity: 0; }
        }

        /* ===== CUSTOM CONFIRM MODAL ===== */
        #confirm-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.65);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s ease;
        }
        #confirm-modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }
        #confirm-modal {
            background: linear-gradient(145deg, rgba(25, 25, 25, 0.98), rgba(18, 18, 18, 0.98));
            border: 1px solid rgba(255, 215, 0, 0.15);
            border-radius: 20px;
            padding: 32px 28px 24px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255,255,255,0.04);
            transform: scale(0.92) translateY(16px);
            transition: transform 0.28s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.25s ease;
            opacity: 0;
        }
        #confirm-modal-overlay.active #confirm-modal {
            transform: scale(1) translateY(0);
            opacity: 1;
        }
        .confirm-modal-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 22px;
            color: #f87171;
        }
        .confirm-modal-title {
            font-size: 17px;
            font-weight: 700;
            color: #fff;
            text-align: center;
            margin-bottom: 8px;
        }
        .confirm-modal-message {
            font-size: 13px;
            color: rgba(255,255,255,0.45);
            text-align: center;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .confirm-modal-message strong {
            color: rgba(255, 215, 0, 0.85);
            font-weight: 600;
        }
        .confirm-modal-actions {
            display: flex;
            gap: 10px;
        }
        .confirm-modal-btn-cancel {
            flex: 1;
            padding: 11px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255,255,255,0.12);
            background: rgba(255,255,255,0.05);
            color: rgba(255,255,255,0.65);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
        }
        .confirm-modal-btn-cancel:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-color: rgba(255,255,255,0.25);
        }
        .confirm-modal-btn-confirm {
            flex: 1;
            padding: 11px 16px;
            border-radius: 12px;
            border: none;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: inherit;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.35);
        }
        .confirm-modal-btn-confirm:hover {
            background: linear-gradient(135deg, #f87171, #ef4444);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.5);
            transform: translateY(-1px);
        }
        .confirm-modal-btn-confirm:active {
            transform: translateY(0);
        }
    </style>

    @stack('scripts')

    {{-- ===== STRUKTUR HTML MODAL KONFIRMASI HAPUS KUSTOM ===== --}}
    {{-- Fitur ini digunakan secara global untuk mengganti window.confirm bawaan browser saat menghapus data --}}
    <div id="confirm-modal-overlay">
        <div id="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirm-modal-title">
            <div class="confirm-modal-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="confirm-modal-title" id="confirm-modal-title">Konfirmasi Hapus</div>
            <div class="confirm-modal-message" id="confirm-modal-message">
                Yakin ingin menghapus data ini?<br>
                <span style="font-size:11px; color:rgba(255,255,255,0.3)">Tindakan ini tidak dapat dibatalkan.</span>
            </div>
            <div class="confirm-modal-actions">
                {{-- Tombol Batal (Tidak) --}}
                <button class="confirm-modal-btn-cancel" id="confirm-modal-cancel" onclick="closeConfirmModal()">
                    <i class="fa-solid fa-xmark" style="margin-right:6px"></i> Tidak
                </button>
                {{-- Tombol Konfirmasi (Ya, Hapus) --}}
                <button class="confirm-modal-btn-confirm" id="confirm-modal-ok">
                    <i class="fa-solid fa-trash" style="margin-right:6px"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        // ===== LOGIKA JAVASCRIPT GLOBAL UNTUK MODAL KONFIRMASI KUSTOM =====
        // Menyimpan fungsi callback sementara saat konfirmasi disetujui
        let _confirmCallback = null;

        // Menampilkan modal konfirmasi dengan pesan khusus dan menjalankan callback jika tombol "Ya" diklik
        function showConfirmModal(message, onConfirm, btnLabel, btnIcon) {
            const overlay  = document.getElementById('confirm-modal-overlay');
            const msgEl    = document.getElementById('confirm-modal-message');
            const okBtn    = document.getElementById('confirm-modal-ok');

            msgEl.innerHTML = message +
                '<br><span style="font-size:11px;color:rgba(255,255,255,0.3)">Tindakan ini tidak dapat dibatalkan.</span>';

            _confirmCallback = onConfirm;

            // Kloning tombol OK untuk membersihkan event listener lama agar tidak menumpuk
            const newOk = okBtn.cloneNode(true);
            okBtn.parentNode.replaceChild(newOk, okBtn);
            // Gunakan label & ikon yang dikirim, atau default ke "Ya, Hapus"
            const label = btnLabel || 'Ya, Hapus';
            const icon  = btnIcon  || 'fa-trash';
            newOk.innerHTML = `<i class="fa-solid ${icon}" style="margin-right:6px"></i> ${label}`;
            newOk.addEventListener('click', function () {
                const callback = _confirmCallback;
                closeConfirmModal();
                if (typeof callback === 'function') callback();
            });

            // Aktifkan modal overlay dan kunci scroll body agar tidak bergeser di belakang modal
            overlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Menutup modal konfirmasi dan mengembalikan scroll body seperti semula
        function closeConfirmModal() {
            const overlay = document.getElementById('confirm-modal-overlay');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
            _confirmCallback = null;
        }

        // Menutup modal secara otomatis jika pengguna mengklik area backdrop di luar kartu modal
        document.getElementById('confirm-modal-overlay').addEventListener('click', function(e) {
            if (e.target === this) closeConfirmModal();
        });

        // Menutup modal secara otomatis jika pengguna menekan tombol Escape (ESC) pada keyboard
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeConfirmModal();
        });

        /**
         * Menghentikan submit form standar untuk memunculkan modal konfirmasi hapus data kustom.
         * Cara pakai pada form: <form onsubmit="return confirmDelete(event, this, 'Nama Satwa')">
         */
        function confirmDelete(event, form, dataName) {
            event.preventDefault();
            const msg = dataName
                ? 'Yakin ingin menghapus data <strong>' + dataName + '</strong>?'
                : 'Yakin ingin menghapus data ini?';
            showConfirmModal(msg, function () {
                form.submit();
            });
            return false;
        }

        /**
         * Menghentikan link navigasi standar untuk memunculkan modal konfirmasi aksi kustom.
         * Cara pakai pada link: <a href="..." onclick="return confirmAction(event, this, 'Judul', 'Pesan Aksi')">
         */
        function confirmAction(event, link, title, message, btnLabel, btnIcon) {
            event.preventDefault();
            const titleEl = document.getElementById('confirm-modal-title');
            if (titleEl) titleEl.textContent = title || 'Konfirmasi';

            showConfirmModal(
                message || 'Yakin ingin melanjutkan tindakan ini?',
                function () {
                    window.location.href = link.href;
                    // Reset kembali judul modal ke standar setelah selesai
                    if (titleEl) titleEl.textContent = 'Konfirmasi Hapus';
                },
                btnLabel || 'Ya, Lanjutkan',
                btnIcon  || 'fa-check'
            );
            return false;
        }

        /**
         * Menampilkan modal konfirmasi lalu men-submit sebuah <form> (untuk POST request).
         * Cara pakai: onclick="confirmFormAction(event, 'id-form', 'Judul', 'Pesan', 'Ya, Konfirmasi')"
         */
        function confirmFormAction(event, formId, title, message, btnLabel, btnIcon) {
            event.preventDefault();
            const titleEl = document.getElementById('confirm-modal-title');
            if (titleEl) titleEl.textContent = title || 'Konfirmasi';

            showConfirmModal(
                message || 'Yakin ingin melanjutkan tindakan ini?',
                function () {
                    const form = document.getElementById(formId);
                    if (form) form.submit();
                    if (titleEl) titleEl.textContent = 'Konfirmasi Hapus';
                },
                btnLabel || 'Ya, Lanjutkan',
                btnIcon  || 'fa-check'
            );
        }
    </script>
</body>
</html>

