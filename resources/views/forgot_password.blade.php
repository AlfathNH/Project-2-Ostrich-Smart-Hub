<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Ostrich Smart Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: radial-gradient(ellipse at 30% 50%, rgba(255,215,0,0.05) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 20%, rgba(59,130,246,0.04) 0%, transparent 60%),
                        #0a0a0a;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center; padding: 24px 16px;
        }
        .glass-card {
            background: rgba(20, 20, 20, 0.9);
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
        .form-input:focus { border-color: #FFD700; background: rgba(255,215,0,0.04); }
        .form-input::placeholder { color: rgba(255,255,255,0.28); }
        .form-label { color: rgba(255,255,255,0.6); font-size: 12px; font-weight: 600; margin-bottom: 6px; display: block; }
        .gold-gradient-text {
            background: linear-gradient(135deg, #FFD700, #FFF176, #c9a800);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        }
        .primary-btn {
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a; font-weight: 800;
            padding: 13px; border-radius: 14px; font-size: 14px;
            width: 100%; letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(255,215,0,0.3);
            border: none; cursor: pointer;
        }
        .primary-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(255,215,0,0.45); }
        .pw-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; padding: 0; cursor: pointer;
            color: rgba(255,255,255,0.3); transition: color 0.2s; line-height: 1;
        }
        .pw-toggle:hover { color: rgba(255,215,0,0.7); }
    </style>
</head>
<body>
    <div style="position:fixed;inset:0;background-image:linear-gradient(rgba(255,215,0,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,215,0,0.025) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;z-index:0;"></div>

    <div class="relative z-10 w-full px-4">
        <div class="glass-card max-w-md mx-auto p-8 md:p-10 animate__animated animate__fadeInUp animate__faster">

            {{-- Header --}}
            <div class="text-center mb-7">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                     style="background: linear-gradient(135deg, rgba(255,215,0,0.15), rgba(255,215,0,0.05)); border: 1px solid rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-key text-gold text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black">
                    <span class="text-white">Lupa </span><span class="gold-gradient-text">Password?</span>
                </h1>
                <p class="text-white/40 text-sm mt-1">
                    @isset($foundUser)
                        Akun ditemukan! Silakan buat password baru.
                    @else
                        Masukkan email atau username akun Anda.
                    @endisset
                </p>
            </div>

            {{-- Error / Info --}}
            @if(session('find_error'))
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                {{ session('find_error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400"></i>
                {{ $errors->first() }}
            </div>
            @endif

            @isset($foundUser)
            {{-- ===== STEP 2: FORM RESET PASSWORD ===== --}}
            <div class="mb-5 flex items-center gap-3 bg-emerald-900/20 border border-emerald-500/25 text-emerald-300 px-4 py-3 rounded-xl text-sm">
                <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                </div>
                <div>
                    <div class="font-semibold">Akun ditemukan!</div>
                    <div class="text-emerald-300/70 text-xs">{{ $foundUser->name }} · {{ $foundUser->email }}</div>
                </div>
            </div>

            <form action="{{ route('forgot.reset') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ $foundUser->id }}">
                <div>
                    <label class="form-label"><i class="fa-solid fa-lock mr-1.5 text-gold/60"></i>Password Baru</label>
                    <div style="position:relative">
                        <input type="password" name="password" id="pw1" class="form-input" style="padding-right:44px"
                               placeholder="Minimal 6 karakter" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('pw1','e1')">
                            <i class="fa-solid fa-eye" id="e1"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-lock mr-1.5 text-gold/60"></i>Konfirmasi Password Baru</label>
                    <div style="position:relative">
                        <input type="password" name="password_confirmation" id="pw2" class="form-input" style="padding-right:44px"
                               placeholder="Ulangi password baru" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('pw2','e2')">
                            <i class="fa-solid fa-eye" id="e2"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="primary-btn mt-2">
                    <i class="fa-solid fa-rotate mr-2"></i>SIMPAN PASSWORD BARU
                </button>
            </form>

            @else
            {{-- ===== STEP 1: CARI AKUN ===== --}}
            <form action="{{ route('forgot.find') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="form-label"><i class="fa-solid fa-user mr-1.5 text-gold/60"></i>Email atau Username</label>
                    <input type="text" name="login_id" class="form-input"
                           placeholder="Masukkan email atau username terdaftar"
                           value="{{ old('login_id') }}" required autocomplete="off">
                    <p class="text-white/30 text-[11px] mt-1.5">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Masukkan email atau username yang digunakan saat mendaftar.
                    </p>
                </div>
                <button type="submit" class="primary-btn">
                    <i class="fa-solid fa-magnifying-glass mr-2"></i>CARI AKUN SAYA
                </button>
            </form>
            @endisset

            {{-- Footer Links --}}
            <div class="flex items-center gap-3 mt-6">
                <div class="flex-1 h-px bg-white/8"></div>
                <span class="text-white/20 text-xs">atau</span>
                <div class="flex-1 h-px bg-white/8"></div>
            </div>
            <div class="text-center mt-4 flex flex-col gap-2">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-2 border border-white/15 text-white/60 hover:text-white hover:border-gold/40 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:bg-gold/5">
                    <i class="fa-solid fa-right-to-bracket text-gold/70"></i>Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePw(fieldId, iconId) {
            const f = document.getElementById(fieldId);
            const i = document.getElementById(iconId);
            if (f.type === 'password') { f.type = 'text'; i.classList.replace('fa-eye','fa-eye-slash'); }
            else { f.type = 'password'; i.classList.replace('fa-eye-slash','fa-eye'); }
        }
    </script>
</body>
</html>
