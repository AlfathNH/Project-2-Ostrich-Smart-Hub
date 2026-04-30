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
            #sidebar { transform: translateX(-100%); width: 280px !important; background: rgba(10,10,10,0.95); backdrop-filter: blur(20px); z-index: 60; }
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
                     style="filter: drop-shadow(0 0 6px rgba(255,215,0,0.4))">
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
                    <a href="{{ route('zookeeper.dashboard') }}" class="nav-item {{ request()->routeIs('zookeeper.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-bowl-food icon"></i>
                        <span class="sidebar-label">Kelola Pakan</span>
                    </a>
                    <a href="{{ route('zookeeper.dashboard') }}" class="nav-item">
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
    </style>

    @stack('scripts')
</body>
</html>
