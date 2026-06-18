<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <title>Ostrich Mini Zoo Subang — Wisata Edukasi Satwa</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="Wisata edukasi satwa pertama dan terlengkap di Subang. Kunjungi Ostrich Mini Zoo sekarang! Tiket terjangkau, hewan eksotis, pengalaman tak terlupakan." />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Quicksand:wght@600;700&display=swap" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Zoofari Libraries -->
    <link href="{{ asset('zoofari/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('zoofari/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('zoofari/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Zoofari Bootstrap & Style -->
    <link href="{{ asset('zoofari/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('zoofari/css/style.css') }}" rel="stylesheet" />

    <style>
        :root { --primary: #FFD700; --dark: #111111; --light: #F3F4F5; }

        /* ===== GLOBAL ===== */
        body { background: #0a0a0a; }

        /* ===== CUSTOM OSTRICH OVERRIDES ===== */
        .ostrich-topbar {
            background: #111111;
            color: rgba(255,255,255,0.6);
            font-size: 13px;
            padding: 8px 0;
            border-bottom: 1px solid rgba(255,215,0,0.2);
        }
        .ostrich-topbar .text-primary { color: #FFD700 !important; }

        /* ===== NAVBAR — hitam gelap ===== */
        .navbar.sticky-top { background: #111111 !important; border-bottom: 1px solid rgba(255,215,0,0.15) !important; }
        .navbar-brand h1 { font-family: 'Quicksand', sans-serif; color: #FFD700; }
        .navbar .navbar-nav .nav-link { color: rgba(255,255,255,0.75) !important; }
        .navbar .navbar-nav .nav-link:hover, .navbar .navbar-nav .nav-link.active { color: #FFD700 !important; }
        .navbar-toggler { border-color: rgba(255,215,0,0.4) !important; }
        .navbar-toggler-icon { filter: invert(1); }
        .dropdown-menu { background: #1a1a1a !important; border-color: rgba(255,215,0,0.15) !important; }
        .dropdown-item { color: rgba(255,255,255,0.75) !important; }
        .dropdown-item:hover { background: rgba(255,215,0,0.1) !important; color: #FFD700 !important; }

        /* Hero / Header bg dengan gambar burung unta */
        .header-bg {
            background: linear-gradient(rgba(0,0,0,.65), rgba(0,0,0,.65)),
                        url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Struthio_Diversity.jpg/1280px-Struthio_Diversity.jpg') center center no-repeat;
            background-size: cover;
        }

        /* Carousel images override dengan gambar zoo nyata */
        .owl-carousel-ostrich-1 {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Struthio_Diversity.jpg/960px-Struthio_Diversity.jpg') center/cover;
            height: 500px;
        }
        .owl-carousel-ostrich-2 {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Peacock_Plumage.jpg/960px-Peacock_Plumage.jpg') center/cover;
            height: 500px;
        }
        .owl-carousel-ostrich-3 {
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Oryctolagus_cuniculus_Rcdo.jpg/960px-Oryctolagus_cuniculus_Rcdo.jpg') center/cover;
            height: 500px;
        }

        /* ===== TICKET BADGE DI HERO ===== */
        .ticket-badge {
            display: inline-flex; align-items: center; gap: 12px;
            background: rgba(255,215,0,0.08);
            border: 2px solid rgba(255,215,0,0.5);
            border-radius: 12px;
            padding: 14px 24px;
            margin-top: 20px;
        }
        .ticket-badge .price { font-size: 2rem; font-weight: 700; color: #FFD700; }
        .ticket-badge .label { font-size: 12px; color: rgba(255,255,255,0.6); line-height: 1.3; }

        /* ===== STATS ===== */
        .stat-icon { font-size: 2.5rem; color: #FFD700; margin-bottom: 12px; }

        /* ===== AUTH BUTTON ===== */
        .btn-auth {
            background: linear-gradient(135deg, #FFD700, #c9a800);
            color: #111111 !important;
            border-radius: 50px;
            padding: 8px 22px;
            font-weight: 700;
            font-size: 14px;
            border: none;
            transition: all .3s;
        }
        .btn-auth:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(255,215,0,.4); color: #111 !important; }
        .user-chip {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(255,215,0,0.1); border: 1px solid rgba(255,215,0,0.25);
            border-radius: 50px;
            padding: 6px 14px; font-size: 13px; font-weight: 600; color: #FFD700;
        }
        .user-avatar {
            width: 26px; height: 26px; border-radius: 50%;
            background: linear-gradient(135deg, #FFD700, #c9a800);
            color: #111; font-size: 11px; font-weight: 900;
            display: flex; align-items: center; justify-content: center;
        }

        /* Visiting hours table customization */
        .visiting-hours .list-group-item { font-weight: 500; }

        /* ===== ABOUT ===== */
        .img-border::before { border-color: #FFD700; }
        .bg-light { background: #141414 !important; }
        .container-xxl { background: transparent; }

        /* Facts background with Ostrich bg */
        .facts {
            background: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,.75)),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Struthio_Diversity.jpg/1280px-Struthio_Diversity.jpg') center/cover no-repeat;
        }
        .visiting-hours {
            background: linear-gradient(rgba(0,0,0,.75), rgba(0,0,0,.75)),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Peacock_Plumage.jpg/960px-Peacock_Plumage.jpg') center/cover no-repeat;
        }
        .footer {
            background: linear-gradient(rgba(0,0,0,.85), rgba(0,0,0,.85)),
                url('https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Peacock_Plumage.jpg/960px-Peacock_Plumage.jpg') center/cover no-repeat;
        }

        /* ===== ANIMAL GALLERY ===== */
        .animal-item .animal-text { background: linear-gradient(to top, rgba(255,180,0,.8), transparent); }

        /* ===== TICKET TIER CARDS ===== */
        .ticket-tier {
            background: #1a1a1a;
            border: 2px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 32px;
            text-align: center;
            transition: all .3s;
            height: 100%;
        }
        .ticket-tier:hover { border-color: #FFD700; transform: translateY(-6px); box-shadow: 0 20px 50px rgba(255,215,0,.2); }
        .ticket-tier.featured { border-color: #FFD700; background: linear-gradient(145deg, #1f1900, #1a1a1a); }
        .ticket-tier .tier-price { font-size: 2.5rem; font-weight: 800; color: #FFD700; }
        .ticket-tier .tier-label { font-size: 12px; color: rgba(255,255,255,0.4); margin-bottom: 16px; }
        .ticket-tier h4 { color: #fff !important; }
        .ticket-tier ul { list-style: none; padding: 0; margin: 20px 0; text-align: left; }
        .ticket-tier ul li { padding: 6px 0; color: rgba(255,255,255,0.65); font-size: 14px; }
        .ticket-tier ul li i { color: #FFD700; margin-right: 8px; }

        /* ===== TESTIMONIAL ===== */
        .testimonial-text { background: #1a1a1a !important; }
        .owl-item.center .testimonial-text { background: #1f1900 !important; border: 1px solid rgba(255,215,0,.4); }
        .testimonial-text * { color: rgba(255,255,255,0.75) !important; }
        .testimonial-text h5 { color: #FFD700 !important; }
        .stars { color: #FFD700; font-size: 14px; }

        /* ===== FAQ ===== */
        .accordion-item { background: #1a1a1a !important; border-color: rgba(255,215,0,0.15) !important; }
        .accordion-button { background: #1a1a1a !important; color: rgba(255,255,255,0.85) !important; }
        .accordion-button:not(.collapsed) { background: #1f1900 !important; color: #FFD700 !important; }
        .accordion-button::after { filter: invert(1) sepia(1) saturate(3) hue-rotate(5deg); }
        .accordion-button:focus { box-shadow: 0 0 0 .25rem rgba(255,215,0,.2); }
        .accordion-body { background: #1a1a1a !important; color: rgba(255,255,255,0.6) !important; }

        /* ===== CTA SECTION ===== */
        .cta-book-section {
            background: linear-gradient(135deg, #1a1200 0%, #111 50%, #1a1200 100%);
            border-top: 2px solid rgba(255,215,0,0.25);
            border-bottom: 2px solid rgba(255,215,0,0.25);
            color: white; padding: 80px 0; text-align: center;
        }
        .cta-book-section h2 { color: #FFD700 !important; }
        .cta-book-section p { color: rgba(255,255,255,0.65) !important; }

        /* ===== MAP ===== */
        .map-wrapper { border-radius: 16px; overflow: hidden; border: 3px solid rgba(255,215,0,0.25); }
        #kontak .fw-bold, #kontak h4 { color: #fff !important; }
        #kontak .text-muted { color: rgba(255,255,255,0.55) !important; }

        /* ===== BACK TO TOP ===== */
        .back-to-top { background: linear-gradient(135deg,#FFD700,#c9a800) !important; border-color:transparent !important; }
        .back-to-top i { color: #111 !important; }

        /* ===== BOOTSTRAP / GLOBAL OVERRIDES ===== */
        .text-primary { color: #FFD700 !important; }
        .text-success { color: #FFD700 !important; }
        .btn-primary { background: linear-gradient(135deg,#FFD700,#c9a800) !important; border-color:#FFD700 !important; color:#111 !important; font-weight:700; }
        .btn-primary:hover { background: linear-gradient(135deg,#ffe033,#dbb800) !important; box-shadow:0 8px 20px rgba(255,215,0,.4); color:#111 !important; }
        .btn-success { background: linear-gradient(135deg,#FFD700,#c9a800) !important; border-color:#FFD700 !important; color:#111 !important; font-weight:700; }
        .btn-success:hover { background: linear-gradient(135deg,#ffe033,#dbb800) !important; }
        .btn-outline-success { border-color:#FFD700 !important; color:#FFD700 !important; }
        .btn-outline-success:hover { background:#FFD700 !important; color:#111 !important; }
        .btn-outline-secondary { border-color:rgba(255,215,0,.3) !important; color:#FFD700 !important; }
        .btn-warning { background:rgba(255,215,0,.12) !important; color:#FFD700 !important; border-color:rgba(255,215,0,.3) !important; }
        .btn-info { background:rgba(255,255,255,.08) !important; color:#fff !important; border-color:rgba(255,255,255,.2) !important; }
        .btn-outline-danger { border-color:rgba(255,80,80,.4) !important; color:#ff6b6b !important; }
        .badge { background:rgba(255,215,0,.12) !important; color:#FFD700 !important; border:1px solid rgba(255,215,0,.3) !important; }
        .display-4, .display-5, .display-6 { color: #ffffff; }
        .spinner-border { border-color:#FFD700 !important; border-right-color:transparent !important; }
        #spinner { background:#111 !important; }

        /* Footer */
        .footer h5 { color: #FFD700 !important; }
        .footer p, .footer small { color: rgba(255,255,255,0.5) !important; }
        .footer .btn-link { color: rgba(255,255,255,0.55) !important; }
        .footer .btn-link:hover { color: #FFD700 !important; }
        .footer .btn-social { border-color:rgba(255,215,0,.3) !important; color:rgba(255,255,255,.6) !important; }
        .footer .btn-social:hover { color:#FFD700 !important; border-color:#FFD700 !important; }
        .footer .copyright { border-color:rgba(255,215,0,.12) !important; color:rgba(255,255,255,.3) !important; }
        .footer .copyright a { color:rgba(255,255,255,.4) !important; }
        .footer .copyright a:hover { color:#FFD700 !important; }

        @media (max-width: 767px) {
            .ticket-badge .price { font-size: 1.5rem; }
            .owl-carousel-ostrich-1,
            .owl-carousel-ostrich-2,
            .owl-carousel-ostrich-3 { height: 280px; }
        }
    </style>
</head>
<body>
    <!-- Spinner -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-success" style="width:3rem;height:3rem" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <!-- ===== TOPBAR ===== -->
    <div class="ostrich-topbar d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center me-4">
                        <i class="fa fa-map-marker-alt me-2" style="color:#2EB872"></i>
                        <small>Jl. Raya Subang, Kabupaten Subang, Jawa Barat</small>
                    </div>
                    <div class="d-inline-flex align-items-center">
                        <i class="far fa-clock me-2" style="color:#2EB872"></i>
                        <small>Senin – Minggu · 09.30 – 17.00 WIB</small>
                    </div>
                </div>
                <div class="col-lg-5 text-end">
                    <div class="d-inline-flex align-items-center me-4">
                        <i class="fa fa-phone-alt me-2" style="color:#2EB872"></i>
                        <small>+62 895-4030-06874</small>
                    </div>
                    <div class="d-inline-flex align-items-center gap-1">
                        <a class="btn btn-sm-square bg-dark text-white me-1" style="border-radius:4px;" href="https://www.instagram.com/ostrich.minizoo?igsh=MXNxbWdoNHgxMGtvbA==" target="_blank"><i class="fab fa-instagram" style="color:#2EB872"></i></a>
                        <a class="btn btn-sm-square bg-dark text-white me-1" style="border-radius:4px;" href="https://vt.tiktok.com/ZS9jSpYrtX6D4-zZQMK/?poisharing=Ostrich-Mini-Zoo-%7C-Kebun-Binatang-Mini-Subang" target="_blank"><i class="fab fa-tiktok" style="color:#2EB872"></i></a>
                        <a class="btn btn-sm-square bg-dark text-white" style="border-radius:4px;" href="https://wa.me/0895403006874" target="_blank"><i class="fab fa-whatsapp" style="color:#2EB872"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== NAVBAR ===== -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top py-lg-0 px-4 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
        <a href="{{ route('welcome') }}" class="navbar-brand p-0">
            <img class="img-fluid me-2" src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                 alt="Ostrich Mini Zoo" style="max-height:44px; filter:drop-shadow(0 0 4px rgba(46,184,114,.4))">
            <h1 class="m-0 d-none d-sm-inline" style="font-size:1.2rem">OSTRICH MINI ZOO</h1>
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse py-4 py-lg-0" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="#home" class="nav-item nav-link active">Beranda</a>
                <a href="#about" class="nav-item nav-link">Tentang</a>
                <a href="#animals" class="nav-item nav-link">Satwa</a>
                <a href="#visiting" class="nav-item nav-link">Jam Kunjungan</a>
                <a href="#tiket" class="nav-item nav-link">Harga Tiket</a>
                <a href="#kontak" class="nav-item nav-link">Kontak</a>

                @if(session()->has('role'))
                    {{-- User Chip --}}
                    <div class="nav-item d-flex align-items-center ms-2 gap-2">
                        <div class="user-chip">
                            <div class="user-avatar">{{ strtoupper(substr(session('name','U'),0,1)) }}</div>
                            <span class="d-none d-md-inline">{{ session('name','Pengguna') }}</span>
                        </div>
                        @if(session('role') === 'Pengunjung')
                            <a href="{{ route('ticket.history') }}" class="btn btn-sm btn-outline-secondary" style="border-radius:50px;font-size:12px">
                                <i class="fa fa-history me-1"></i>Riwayat
                            </a>
                        @endif
                        @if(session('role') == 'Admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-warning" style="border-radius:50px;font-size:12px">
                                <i class="fa fa-shield-alt me-1"></i>Admin
                            </a>
                        @elseif(session('role') == 'Manager')
                            <a href="{{ route('manager.dashboard') }}" class="btn btn-sm btn-info text-white" style="border-radius:50px;font-size:12px">
                                <i class="fa fa-chart-bar me-1"></i>Manager
                            </a>
                        @elseif(session('role') == 'Zookeeper')
                            <a href="{{ route('zookeeper.dashboard') }}" class="btn btn-sm btn-success" style="border-radius:50px;font-size:12px">
                                <i class="fa fa-paw me-1"></i>Keeper
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger" style="border-radius:50px;font-size:12px">
                            <i class="fa fa-sign-out-alt me-1"></i>Keluar
                        </a>
                    </div>
                @else
                    <div class="nav-item d-flex align-items-center ms-3 gap-2">
                        <a href="{{ route('login') }}" class="btn-auth">
                            <i class="fa fa-sign-in-alt me-1"></i>Login
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- ===== HEADER / HERO ===== -->
    <div id="home" class="container-fluid bg-dark p-0 mb-5">
        <div class="row g-0 flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-0 wow fadeIn" data-wow-delay="0.1s">
                <div class="header-bg h-100 d-flex flex-column justify-content-center p-5">
                    <p class="text-success fw-bold text-uppercase tracking-wider mb-2" style="letter-spacing:3px;font-size:13px">
                        <i class="fa fa-star me-1"></i> Wisata Edukasi Satwa #1 di Subang
                    </p>
                    <h1 class="display-4 text-light mb-3 fw-bold" style="font-family:'Quicksand',sans-serif;line-height:1.2">
                        Nikmati Petualangan Seru Bersama Keluarga di <span style="color:#2EB872">Ostrich Mini Zoo</span>
                    </h1>
                    <p class="text-white-50 mb-4">
                        Temukan keajaiban satwa eksotis di satu tempat. Pengalaman wisata edukasi yang tak terlupakan di jantung Kota Subang, Jawa Barat.
                    </p>

                    <!-- Harga Tiket Badge -->
                    <div class="ticket-badge mb-4">
                        <div>
                            <div class="label">Tiket Masuk Mulai</div>
                            <div class="price">Rp {{ number_format($hargaTiket, 0, ',', '.') }}</div>
                            <div class="label">per orang · Berlaku semua hari</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        @if(session()->has('role'))
                            <a href="/checkout" class="btn btn-primary py-sm-3 px-4 px-sm-5" style="background:#2EB872;border-color:#2EB872;border-radius:50px;font-weight:700">
                                <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary py-sm-3 px-4 px-sm-5" style="background:#2EB872;border-color:#2EB872;border-radius:50px;font-weight:700">
                                <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                            </a>
                        @endif
                        <a href="#about" class="btn btn-outline-light py-sm-3 px-4" style="border-radius:50px">
                            <i class="fa fa-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <div class="owl-carousel-ostrich-1"></div>
                    </div>
                    <div class="owl-carousel-item">
                        <div class="owl-carousel-ostrich-2"></div>
                    </div>
                    <div class="owl-carousel-item">
                        <div class="owl-carousel-ostrich-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ABOUT ===== -->
    <div id="about" class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p><span class="text-primary me-2">#</span>Selamat Datang di Ostrich Mini Zoo</p>
                    <h1 class="display-5 mb-4">
                        Mengapa Anda Harus Mengunjungi
                        <span class="text-primary">Ostrich Mini Zoo</span>?
                    </h1>
                    <p class="mb-4">
                        Ostrich Mini Zoo Subang adalah destinasi wisata edukasi yang menghadirkan pengalaman berinteraksi langsung dengan berbagai satwa eksotis dalam lingkungan yang aman, bersih, dan menyenangkan. Kami berkomitmen pada pelestarian satwa dan edukasi bagi seluruh kalangan.
                    </p>
                    <h5 class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>Satwa Eksotis & Langka</h5>
                    <h5 class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>Lingkungan Alami & Terawat</h5>
                    <h5 class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>Program Edukasi untuk Sekolah</h5>
                    <h5 class="mb-3"><i class="far fa-check-circle text-primary me-3"></i>Tiket Online Cepat & Mudah</h5>
                    <h5 class="mb-4"><i class="far fa-check-circle text-primary me-3"></i>Area Foto Instagramable</h5>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="#tiket" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                        <i class="fa fa-ticket-alt me-2"></i>Lihat Harga Tiket
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="img-border">
                        <img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Struthio_Diversity.jpg/960px-Struthio_Diversity.jpg" alt="Ostrich Mini Zoo Subang" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FACTS (STATS) ===== -->
    <div class="container-xxl facts my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-4 text-center">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-feather-alt stat-icon"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">25</h1>
                    <p class="text-white mb-0">Spesies Satwa</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-smile stat-icon"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">8</h1>
                    <p class="text-white mb-0">Fasilitas & Layanan</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-star stat-icon"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">4</h1>
                    <p class="text-white mb-0">Rating Bintang</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-calendar-check stat-icon"></i>
                    <h1 class="text-white mb-2" data-toggle="counter-up">2025</h1>
                    <p class="text-white mb-0">Berdiri Sejak</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== SERVICES / FASILITAS ===== -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <p><span class="text-primary me-2">#</span>Fasilitas Kami</p>
                    <h1 class="display-5 mb-0">Layanan Spesial untuk Pengunjung <span class="text-primary">Ostrich Mini Zoo</span></h1>
                </div>
                <div class="col-lg-6">
                    <div style="background:#2EB872" class="h-100 d-flex align-items-center py-4 px-4 px-sm-5">
                        <i class="fa fa-3x fa-phone-alt text-white"></i>
                        <div class="ms-4">
                            <p class="text-white mb-0">Hubungi kami untuk informasi</p>
                            <h2 class="text-white mb-0">+62 895-4030-06874</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-5 gx-4">
                @php
                $services = [
                    ['icon' => 'fa-camera', 'title' => 'Spot Foto Instagramable', 'desc' => 'Abadikan momen berharga bersama satwa eksotis di spot foto terbaik yang sudah kami siapkan.'],
                    ['icon' => 'fa-chalkboard-teacher', 'title' => 'Edukasi Satwa', 'desc' => 'Program edukasi menarik untuk pelajar dan keluarga tentang konservasi dan ekosistem satwa.'],
                    ['icon' => 'fa-ticket-alt', 'title' => 'Tiket Online', 'desc' => 'Pesan tiket online kapan saja dan di mana saja. Proses cepat, aman, dan langsung dapat e-tiket PDF.'],
                    ['icon' => 'fa-utensils', 'title' => 'Area Kuliner', 'desc' => 'Tersedia area makan dengan berbagai pilihan makanan dan minuman untuk mengisi energi saat berwisata.'],
                    ['icon' => 'fa-parking', 'title' => 'Parkir Luas', 'desc' => 'Area parkir yang luas dan aman untuk kendaraan roda dua maupun roda empat.'],
                    ['icon' => 'fa-wheelchair', 'title' => 'Ramah Disabilitas', 'desc' => 'Akses khusus tersedia untuk pengunjung berkebutuhan khusus. Semua bisa menikmati wisata bersama.'],
                    ['icon' => 'fa-shield-alt', 'title' => 'Keamanan Terjamin', 'desc' => 'Petugas keamanan berpengalaman siaga 24 jam untuk kenyamanan dan keselamatan seluruh pengunjung.'],
                    ['icon' => 'fa-hand-holding-heart', 'title' => 'Feeding Time', 'desc' => 'Pengalaman unik memberi makan langsung kepada satwa yang jinak dan ramah di waktu-waktu tertentu.'],
                ];
                @endphp
                @foreach($services as $i => $svc)
                <div class="col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="{{ ($i * 0.15) }}s">
                    <div class="text-center">
                        <div class="mb-3">
                            <i class="fa {{ $svc['icon'] }} fa-3x" style="color:#2EB872"></i>
                        </div>
                        <h5 class="mb-3">{{ $svc['title'] }}</h5>
                        <span class="text-muted" style="font-size:14px">{{ $svc['desc'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ===== ANIMAL GALLERY ===== -->
    <div id="animals" class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <p><span class="text-primary me-2">#</span>Penghuni Zoo Kami</p>
                    <h1 class="display-5 mb-0">Kenali Satwa <span class="text-primary">Eksotis</span> di Ostrich Mini Zoo</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    @if(session()->has('role'))
                        <a class="btn btn-primary py-3 px-5" href="/checkout" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket
                        </a>
                    @else
                        <a class="btn btn-primary py-3 px-5" href="{{ route('login') }}" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket
                        </a>
                    @endif
                </div>
            </div>

            @php
            $animals = [
                ['img' => asset('images/burung_unta.jpg'),   'name' => 'Burung Unta',   'latin' => 'Struthio camelus',         'size' => 'md'],
                ['img' => asset('images/burung_merak.jpg'),  'name' => 'Burung Merak',  'latin' => 'Pavo cristatus',           'size' => 'lg'],
                ['img' => asset('images/iguana_hijau.jpg'),  'name' => 'Iguana Hijau', 'latin' => 'Iguana iguana',           'size' => 'lg'],
                ['img' => asset('images/kelinci_hias.jpg'),  'name' => 'Kelinci Hias', 'latin' => 'Oryctolagus cuniculus', 'size' => 'md'],
                ['img' => asset('images/kuda.jpg'),          'name' => 'Kuda',          'latin' => 'Equus caballus',           'size' => 'md'],
                ['img' => asset('images/kambing_etawa.jpg'), 'name' => 'Kambing Etawa', 'latin' => 'Capra aegagrus hircus',   'size' => 'lg'],
            ];
            @endphp

            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="row g-4">
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[0]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[0]['img'] }}" alt="{{ $animals[0]['name'] }}" style="height:220px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[0]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[0]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[1]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[1]['img'] }}" alt="{{ $animals[1]['name'] }}" style="height:300px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[1]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[1]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="row g-4">
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[2]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[2]['img'] }}" alt="{{ $animals[2]['name'] }}" style="height:300px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[2]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[2]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[3]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[3]['img'] }}" alt="{{ $animals[3]['name'] }}" style="height:220px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[3]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[3]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-4">
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[4]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[4]['img'] }}" alt="{{ $animals[4]['name'] }}" style="height:220px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[4]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[4]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a class="animal-item" href="{{ $animals[5]['img'] }}" data-lightbox="animal">
                                <div class="position-relative">
                                    <img class="img-fluid" src="{{ $animals[5]['img'] }}" alt="{{ $animals[5]['name'] }}" style="height:300px;width:100%;object-fit:cover">
                                    <div class="animal-text p-4">
                                        <p class="text-white small text-uppercase mb-0">Satwa</p>
                                        <h5 class="text-white mb-0">{{ $animals[5]['name'] }}</h5>
                                        <small class="text-white-50 fst-italic">{{ $animals[5]['latin'] }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== VISITING HOURS ===== -->
    <div id="visiting" class="container-xxl visiting-hours my-5 py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-6 text-white mb-5"><i class="fa fa-clock me-3"></i>Jam Kunjungan</h1>
                    <ul class="list-group list-group-flush">
                        @php
                        $jadwal = [
                            ['hari' => 'Senin',   'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Selasa',  'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Rabu',    'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Kamis',   'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Jumat',   'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Sabtu',   'jam' => '09.30 – 17.00 WIB'],
                            ['hari' => 'Minggu',  'jam' => '09.30 – 17.00 WIB'],
                        ];
                        @endphp
                        @foreach($jadwal as $j)
                        <li class="list-group-item">
                            <span>{{ $j['hari'] }}</span>
                            <span style="color:#2EB872;font-weight:600">{{ $j['jam'] }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 text-light wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-6 text-white mb-5"><i class="fa fa-info-circle me-3"></i>Info Kontak</h1>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><i class="fa fa-map-marker-alt me-2" style="color:#2EB872"></i>Alamat</td>
                                <td>Jl. Raya Subang, Kabupaten Subang, Jawa Barat</td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-phone me-2" style="color:#2EB872"></i>Telepon</td>
                                <td>+62 895-4030-06874</td>
                            </tr>
                            <tr>
                                <td><i class="fab fa-whatsapp me-2" style="color:#2EB872"></i>WhatsApp</td>
                                <td>
                                    <a href="https://wa.me/0895403006874" class="text-light text-decoration-underline" target="_blank">
                                        Chat via WhatsApp
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fab fa-instagram me-2" style="color:#2EB872"></i>Instagram</td>
                                <td>@ostrichminizooid</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- CTA Button -->
                    <div class="mt-4">
                        @if(session()->has('role'))
                            <a href="/checkout" class="btn btn-primary btn-lg" style="background:#2EB872;border-color:#2EB872;border-radius:50px">
                                <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Online
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-lg" style="background:#2EB872;border-color:#2EB872;border-radius:50px">
                                <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Online
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== HARGA TIKET (Membership section repurposed) ===== -->
    <div id="tiket" class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mb-5 align-items-end wow fadeInUp" data-wow-delay="0.1s">
                <div class="col-lg-6">
                    <p><span class="text-primary me-2">#</span>Harga Tiket</p>
                    <h1 class="display-5 mb-0">Pilih Paket Kunjungan <span class="text-primary">Terbaik untuk Anda</span></h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <p class="text-muted mb-0">Semua tiket sudah termasuk akses penuh ke seluruh area Ostrich Mini Zoo</p>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="ticket-tier">
                        <div class="mb-3"><i class="fa fa-sun fa-2x" style="color:#2EB872"></i></div>
                        <h4 class="fw-bold mb-1">Hari Biasa</h4>
                        <p class="text-muted small">Senin – Jumat</p>
                        <div class="tier-price">Rp {{ number_format($hargaBiasa, 0, ',', '.') }}</div>
                        <div class="tier-label">per orang</div>

                        @if(session()->has('role'))
                            <a href="/checkout" class="btn btn-outline-success w-100" style="border-radius:50px">Pesan Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-success w-100" style="border-radius:50px">Pesan Sekarang</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="ticket-tier featured">
                        <div class="mb-3">
                            <span class="badge mb-2" style="background:#2EB872;border-radius:50px;padding:6px 14px">TERPOPULER</span>
                            <br><i class="fa fa-star fa-2x" style="color:#2EB872"></i>
                        </div>
                        <h4 class="fw-bold mb-1">Akhir Pekan</h4>
                        <p class="text-muted small">Sabtu & Minggu</p>
                        <div class="tier-price">Rp {{ number_format($hargaLibur, 0, ',', '.') }}</div>
                        <div class="tier-label">per orang</div>

                        @if(session()->has('role'))
                            <a href="/checkout" class="btn btn-success w-100" style="border-radius:50px;background:#2EB872;border-color:#2EB872">Pesan Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-success w-100" style="border-radius:50px;background:#2EB872;border-color:#2EB872">Pesan Sekarang</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="ticket-tier">
                        <div class="mb-3"><i class="fa fa-calendar-alt fa-2x" style="color:#2EB872"></i></div>
                        <h4 class="fw-bold mb-1">Hari Besar / Event</h4>
                        <p class="text-muted small">Libur Nasional & Event Khusus</p>
                        <div class="tier-price">Rp {{ number_format($hargaBesar, 0, ',', '.') }}</div>
                        <div class="tier-label">per orang</div>

                        @if(session()->has('role'))
                            <a href="/checkout" class="btn btn-outline-success w-100" style="border-radius:50px">Pesan Sekarang</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-success w-100" style="border-radius:50px">Pesan Sekarang</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ULASAN PENGUNJUNG ===== -->
    <div class="container-xxl py-5 bg-light">
        <div class="container">
            <h1 class="display-5 text-center mb-2 wow fadeInUp" data-wow-delay="0.1s">Kata Pengunjung Kami</h1>
            <p class="text-center text-muted mb-5 wow fadeInUp" data-wow-delay="0.2s">Ribuan pengunjung sudah merasakan pengalaman seru di Ostrich Mini Zoo</p>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                @php
                $reviews = [
                    ['name' => 'Rina Susanti', 'role' => 'Ibu Rumah Tangga', 'text' => 'Sangat menyenangkan! Anak-anak saya langsung jatuh cinta dengan burung untanya. Pelayanan ramah, area bersih, dan harga tiket sangat terjangkau. Pasti akan kembali lagi!', 'stars' => 5],
                    ['name' => 'Budi Santoso', 'role' => 'Guru SD', 'text' => 'Kami bawa murid untuk studi wisata dan hasilnya sangat memuaskan. Edukasi satwa yang dikemas menyenangkan. Pemandu yang sabar dan informatif. Highly recommended!', 'stars' => 5],
                    ['name' => 'Dewi Lestari', 'role' => 'Content Creator', 'text' => 'Spot fotonya keren banget! Terutama area iguana dan burung merak. QR code ticketing-nya juga praktis, tidak perlu antri lama. Experience yang tidak terlupakan!', 'stars' => 5],
                ];
                @endphp
                @foreach($reviews as $r)
                <div class="testimonial-item text-center">
                    <div class="d-flex align-items-center justify-content-center mb-3">
                        <div style="width:70px;height:70px;border-radius:50%;background:linear-gradient(135deg,#2EB872,#26a065);display:flex;align-items:center;justify-content:center;font-size:1.8rem;color:white;font-weight:700;border:3px solid #2EB872">
                            {{ strtoupper(substr($r['name'],0,1)) }}
                        </div>
                    </div>
                    <div class="testimonial-text rounded text-center p-4">
                        <div class="stars mb-2">
                            @for($s=0;$s<$r['stars'];$s++)<i class="fa fa-star"></i>@endfor
                        </div>
                        <p>{{ $r['text'] }}</p>
                        <h5 class="mb-1">{{ $r['name'] }}</h5>
                        <span class="fst-italic text-muted">{{ $r['role'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ===== FAQ ===== -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <p><span class="text-primary me-2">#</span>FAQ</p>
                    <h1 class="display-5 mb-4">Pertanyaan yang Sering Ditanyakan</h1>
                    <p class="text-muted">Temukan jawaban dari pertanyaan umum seputar kunjungan ke Ostrich Mini Zoo Subang.</p>
                    @if(session()->has('role'))
                        <a href="/checkout" class="btn btn-primary py-3 px-5 mt-3" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary py-3 px-5 mt-3" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                        </a>
                    @endif
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="accordion" id="faqAccordion">
                        @php
                        $faqs = [
                            ['q' => 'Apakah tiket bisa dibeli di tempat?', 'a' => 'Ya, tiket tersedia di loket masuk. Namun untuk kemudahan dan menghindari antrian, kami sangat menyarankan pembelian tiket online melalui website ini.'],
                            ['q' => 'Berapa usia anak yang gratis masuk?', 'a' => 'Anak di bawah 3 tahun masuk gratis. Anak usia 3 tahun ke atas dikenakan harga tiket normal seperti pengunjung dewasa.'],
                            ['q' => 'Apakah ada fasilitas musholla dan toilet?', 'a' => 'Ya, tersedia musholla dan toilet yang bersih di beberapa titik area zoo. Kami menjaga kebersihan fasilitas untuk kenyamanan pengunjung.'],
                            ['q' => 'Bisakah saya memberi makan satwa?', 'a' => 'Ya! Ada sesi feeding time khusus di waktu-waktu tertentu. Makanan hewan tersedia di area zoo. Jangan beri makanan sembarangan dari luar ya!'],
                            ['q' => 'Bagaimana cara mendapatkan tiket setelah pesan online?', 'a' => 'Setelah pembayaran, e-tiket dalam format PDF akan langsung bisa diunduh. Tunjukkan e-tiket ke petugas saat masuk, tidak perlu cetak.'],
                        ];
                        @endphp
                        @foreach($faqs as $i => $faq)
                        <div class="accordion-item border mb-2" style="border-radius:10px;overflow:hidden">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }} fw-semibold" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}">
                                    {{ $faq['q'] }}
                                </button>
                            </h2>
                            <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body text-muted">{{ $faq['a'] }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== PETA LOKASI ===== -->
    <div id="kontak" class="container-xxl py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <p><span class="text-primary me-2">#</span>Lokasi Kami</p>
                <h1 class="display-5">Temukan Kami di <span class="text-primary">Subang, Jawa Barat</span></h1>
            </div>
            <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <h4 class="fw-bold mb-4">Informasi Lokasi</h4>
                    <div class="d-flex gap-3 mb-3">
                        <div style="width:44px;height:44px;border-radius:12px;background:#f0fdf7;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fa fa-map-marker-alt" style="color:#2EB872"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Alamat</div>
                            <div class="text-muted">Jl. Raya Subang, Kabupaten Subang, Jawa Barat, Indonesia</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-3">
                        <div style="width:44px;height:44px;border-radius:12px;background:#f0fdf7;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fa fa-clock" style="color:#2EB872"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Jam Operasional</div>
                            <div class="text-muted">Senin – Jumat: 09.30 – 17.00 WIB<br>Sabtu – Minggu: 09.30 – 17.00 WIB</div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 mb-4">
                        <div style="width:44px;height:44px;border-radius:12px;background:#f0fdf7;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="fa fa-phone" style="color:#2EB872"></i>
                        </div>
                        <div>
                            <div class="fw-bold">Kontak</div>
                            <div class="text-muted">+62 895-4030-06874</div>
                        </div>
                    </div>
                    <a href="https://maps.google.com/?q=Ostrich+Mini+Zoo+Subang+Jawa+Barat" target="_blank"
                       class="btn btn-primary py-3 px-5" style="border-radius:50px;background:#2EB872;border-color:#2EB872">
                        <i class="fa fa-directions me-2"></i>Buka di Google Maps
                    </a>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="map-wrapper" style="height:360px;position:relative">
                        <iframe class="w-100 h-100"
                                style="filter:grayscale(10%)"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.6091242784!2d107.573116!3d-6.556771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693b88f349ba75%3A0xe54d6a6a3b680718!2sSubang%2C%20Subang%20Regency%2C%20West%20Java!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== CTA PESAN TIKET ===== -->
    <div class="cta-book-section wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <i class="fa fa-ticket-alt fa-3x mb-4 d-block"></i>
                    <h2 class="display-5 fw-bold mb-3">Siap Berpetualang Bersama Kami?</h2>
                    <p class="mb-5 opacity-75">Pesan tiket sekarang dan nikmati pengalaman wisata satwa yang tak terlupakan bersama keluarga tercinta di Ostrich Mini Zoo Subang!</p>
                    @if(session()->has('role'))
                        <a href="/checkout" class="btn btn-light btn-lg px-5 py-3" style="border-radius:50px;color:#2EB872;font-weight:700">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 py-3" style="border-radius:50px;color:#2EB872;font-weight:700">
                            <i class="fa fa-ticket-alt me-2"></i>Pesan Tiket Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ===== FOOTER ===== -->
    <div class="container-fluid footer bg-dark text-light mt-0 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                             alt="Logo" style="height:40px;filter:drop-shadow(0 0 6px rgba(46,184,114,.5))">
                        <h5 class="text-light mb-0">OSTRICH MINI ZOO</h5>
                    </div>
                    <p class="text-muted small mb-3">Destinasi wisata edukasi satwa terlengkap di Subang, Jawa Barat. Pengalaman seru bersama keluarga!</p>
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/ostrich.minizoo?igsh=MXNxbWdoNHgxMGtvbA==" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://vt.tiktok.com/ZS9jSpYrtX6D4-zZQMK/?poisharing=Ostrich-Mini-Zoo-%7C-Kebun-Binatang-Mini-Subang" target="_blank"><i class="fab fa-tiktok"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://wa.me/0895403006874" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Navigasi Cepat</h5>
                    <a href="#about" class="btn btn-link">Tentang Kami</a>
                    <a href="#animals" class="btn btn-link">Galeri Satwa</a>
                    <a href="#visiting" class="btn btn-link">Jam Kunjungan</a>
                    <a href="#tiket" class="btn btn-link">Harga Tiket</a>
                    <a href="#kontak" class="btn btn-link">Lokasi & Kontak</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Jam Operasional</h5>
                    <p class="mb-2"><i class="fa fa-check me-2" style="color:#2EB872"></i>Senin – Jumat: 09.30–17.00</p>
                    <p class="mb-2"><i class="fa fa-check me-2" style="color:#2EB872"></i>Sabtu – Minggu: 08.00–18.00</p>
                    <p class="mb-0 text-muted small mt-3">* Tutup pada hari-hari tertentu. Cek media sosial kami untuk informasi terkini.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Kontak Kami</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-2" style="color:#2EB872"></i>Jl. Raya Subang, Kab. Subang</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-2" style="color:#2EB872"></i>+62 895-4030-06874</p>
                    <p class="mb-3"><i class="fab fa-whatsapp me-2" style="color:#2EB872"></i>Chat via WhatsApp</p>
                    @if(session()->has('role'))
                        <a href="/checkout" class="btn btn-sm" style="background:#2EB872;color:white;border-radius:50px">
                            <i class="fa fa-ticket-alt me-1"></i>Pesan Tiket
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-sm" style="background:#2EB872;color:white;border-radius:50px">
                            <i class="fa fa-ticket-alt me-1"></i>Pesan Tiket
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; 2026 <a href="#">Phaeton Inc.</a> · Ostrich Mini Zoo Subang. All Rights Reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <a href="#" class="me-3">Kebijakan Privasi</a>
                        <a href="#">Syarat & Ketentuan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top" style="background:#2EB872;border-color:#2EB872">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- ===== SCRIPTS ===== -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- WOW.js -->
    <script src="{{ asset('zoofari/lib/wow/wow.min.js') }}"></script>
    <!-- OwlCarousel -->
    <script src="{{ asset('zoofari/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Lightbox -->
    <script src="{{ asset('zoofari/lib/lightbox/js/lightbox.min.js') }}"></script>
    <!-- CounterUp -->
    <script src="{{ asset('zoofari/lib/counterup/counterup.min.js') }}"></script>
    <!-- jQuery Waypoints (required by counterUp) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <!-- Zoofari Main JS -->
    <script src="{{ asset('zoofari/js/main.js') }}"></script>

    <script>
        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    </script>
</body>
</html>
