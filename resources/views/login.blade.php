<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Ostrich Smart Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: radial-gradient(ellipse at 30% 50%, rgba(255,215,0,0.05) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 20%, rgba(255,215,0,0.04) 0%, transparent 60%),
                        #0a0a0a;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .glass-card {
            background: rgba(20, 20, 20, 0.85);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 215, 0, 0.18);
            border-radius: 24px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,215,0,0.05) inset;
        }
        .form-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: white;
            padding: 13px 16px;
            width: 100%;
            font-size: 14px;
            transition: border-color 0.25s, background 0.25s;
            outline: none;
        }
        .form-input:focus {
            border-color: #FFD700;
            background: rgba(255,215,0,0.04);
        }
        .form-input::placeholder { color: rgba(255,255,255,0.28); }
        .form-label { color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; margin-bottom: 6px; display: block; }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .login-btn {
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a;
            font-weight: 800;
            padding: 14px;
            border-radius: 14px;
            font-size: 14px;
            width: 100%;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(255,215,0,0.3);
            border: none;
            cursor: pointer;
        }
        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(255,215,0,0.45);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #111; }
        ::-webkit-scrollbar-thumb { background: rgba(255,215,0,0.3); border-radius: 3px; }
    </style>
</head>
<body>

    {{-- BG grid decoration --}}
    <div style="position:fixed;inset:0;background-image:linear-gradient(rgba(255,215,0,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,215,0,0.025) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;z-index:0;"></div>

    <div class="relative z-10 w-full px-4">
        <div class="glass-card max-w-md mx-auto p-8 md:p-10 animate__animated animate__slideInDown animate__faster">

            {{-- Logo & Title --}}
            <div class="text-center mb-8">
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Ostrich Mini Zoo Logo"
                     class="w-16 h-16 object-contain mx-auto mb-4"
                     style="filter: drop-shadow(0 0 20px rgba(255,215,0,0.5))">
                <h1 class="text-3xl font-black mb-1">
                    <span class="text-white">Selamat </span><span class="gold-gradient-text">Datang!</span>
                </h1>
                <p class="text-white/40 text-sm">Masuk ke portal Ostrich Smart Hub</p>
            </div>

            {{-- Error --}}
            @if(session('error'))
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                {{ session('error') }}
            </div>
            @endif

            {{-- Form --}}
            <form action="/login" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="form-label"><i class="fa-solid fa-user mr-1.5 text-gold/60"></i>Email atau Username</label>
                    <input type="text" name="login_id" class="form-input" placeholder="Email atau username Anda" value="{{ old('login_id') }}" required autocomplete="username">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="form-label mb-0"><i class="fa-solid fa-lock mr-1.5 text-gold/60"></i>Password</label>
                        <a href="{{ route('forgot.password') }}"
                           style="font-size:12px; color:rgba(255,215,0,0.8); text-decoration:none; font-weight:600; display:flex; align-items:center; gap:4px;"
                           onmouseover="this.style.color='#FFD700'"
                           onmouseout="this.style.color='rgba(255,215,0,0.8)'">
                            <i class="fa-solid fa-key" style="font-size:10px"></i> Lupa password?
                        </a>
                    </div>
                    <div style="position:relative">
                        <input type="password" name="password" id="password-field" class="form-input" placeholder="••••••••" required style="padding-right:44px">
                        <button type="button" onclick="togglePw()" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,0.35);cursor:pointer;padding:0">
                            <i class="fa-solid fa-eye" id="eye-icon"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="login-btn">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>MASUK
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-6">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-white/25 text-xs">atau</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            {{-- Register Link --}}
            <div class="text-center">
                <p class="text-white/40 text-sm mb-3">Pengunjung baru di Ostrich Hub?</p>
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 border border-white/15 text-white/70 hover:text-white hover:border-gold/40 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:bg-gold/5">
                    <i class="fa-solid fa-user-plus text-gold/80"></i>Daftar Akun Pengunjung
                </a>
            </div>

            {{-- Back to home --}}
            <div class="text-center mt-4">
                <a href="{{ route('welcome') }}" class="text-white/25 hover:text-white/60 text-xs flex items-center justify-center gap-1 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePw() {
            const f = document.getElementById('password-field');
            const i = document.getElementById('eye-icon');
            if (f.type === 'password') { f.type = 'text'; i.classList.replace('fa-eye','fa-eye-slash'); }
            else { f.type = 'password'; i.classList.replace('fa-eye-slash','fa-eye'); }
        }
    </script>
</body>
</html>
