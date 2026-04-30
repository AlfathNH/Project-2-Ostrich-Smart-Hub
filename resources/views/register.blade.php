<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Ostrich Smart Hub</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * { font-family: 'Inter', sans-serif; }
        body {
            background: radial-gradient(ellipse at 70% 50%, rgba(255,215,0,0.06) 0%, transparent 60%),
                        radial-gradient(ellipse at 20% 80%, rgba(255,215,0,0.04) 0%, transparent 60%),
                        #0a0a0a;
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center; padding: 24px 16px;
        }
        .glass-card {
            background: rgba(20, 20, 20, 0.85);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 215, 0, 0.18);
            border-radius: 24px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6);
        }
        .form-input {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: white;
            padding: 12px 16px;
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
        .register-btn {
            background: linear-gradient(135deg, #FFD700, #f0c800);
            color: #1a1a1a; font-weight: 800;
            padding: 14px; border-radius: 14px; font-size: 14px;
            width: 100%; letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(255,215,0,0.3);
            border: none; cursor: pointer;
        }
        .register-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(255,215,0,0.45); }
        /* ===== EYE TOGGLE ===== */
        .pw-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; padding: 0; cursor: pointer;
            color: rgba(255,255,255,0.3); transition: color 0.2s;
            line-height: 1;
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
                <img src="https://i.ibb.co.com/S76fhmsV/617996203-17859231630592966-4201802536455717090-n-removebg-preview.png"
                     alt="Ostrich Mini Zoo Logo"
                     class="w-14 h-14 object-contain mx-auto mb-4"
                     style="filter: drop-shadow(0 0 16px rgba(255,215,0,0.5))">
                <h1 class="text-2xl font-black">
                    <span class="text-white">Registrasi </span><span class="gold-gradient-text">Pengunjung</span>
                </h1>
                <p class="text-white/40 text-sm mt-1">Buat akun untuk pesan tiket online!</p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
            <div class="mb-5 flex items-start gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400 mt-0.5"></i>
                <span>{{ $errors->first() }}</span>
            </div>
            @endif

            {{-- Form --}}
            <form action="/register" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="form-label"><i class="fa-solid fa-user mr-1.5 text-gold/60"></i>Nama Lengkap</label>
                    <input type="text" name="name" class="form-input" placeholder="Nama Anda" value="{{ old('name') }}" required>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-at mr-1.5 text-gold/60"></i>Username <span class="text-white/30 font-normal normal-case">(untuk login)</span></label>
                    <input type="text" name="username" class="form-input" placeholder="contoh: budi_zoo" value="{{ old('username') }}" required autocomplete="username">
                    <p class="text-white/30 text-[11px] mt-1.5"><i class="fa-solid fa-circle-info mr-1"></i>Hanya huruf, angka, titik, dan underscore. Dipakai untuk login selain email.</p>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-envelope mr-1.5 text-gold/60"></i>Email Aktif</label>
                    <input type="email" name="email" class="form-input" placeholder="email@contoh.com" value="{{ old('email') }}" required>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-lock mr-1.5 text-gold/60"></i>Password</label>
                    <div style="position:relative">
                        <input type="password" name="password" id="pw1" class="form-input" style="padding-right:44px"
                               placeholder="Minimal 6 karakter" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('pw1','eye1')" title="Tampilkan/sembunyikan">
                            <i class="fa-solid fa-eye" id="eye1"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="form-label"><i class="fa-solid fa-lock mr-1.5 text-gold/60"></i>Konfirmasi Password</label>
                    <div style="position:relative">
                        <input type="password" name="password_confirmation" id="pw2" class="form-input" style="padding-right:44px"
                               placeholder="Ulangi password" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('pw2','eye2')" title="Tampilkan/sembunyikan">
                            <i class="fa-solid fa-eye" id="eye2"></i>
                        </button>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 pt-1">
                    <input type="checkbox" id="terms" required
                           class="mt-0.5 w-4 h-4 rounded accent-yellow-400 flex-shrink-0">
                    <label for="terms" class="text-white/40 text-xs leading-relaxed cursor-pointer">
                        Saya menyetujui <span class="text-gold/70">Syarat & Ketentuan</span> serta
                        <span class="text-gold/70">Kebijakan Privasi</span> Ostrich Smart Hub.
                    </label>
                </div>

                <button type="submit" class="register-btn mt-2">
                    <i class="fa-solid fa-user-plus mr-2"></i>BUAT AKUN GRATIS
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-3 my-5">
                <div class="flex-1 h-px bg-white/10"></div>
                <span class="text-white/25 text-xs">sudah punya akun?</span>
                <div class="flex-1 h-px bg-white/10"></div>
            </div>

            <div class="text-center">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center gap-2 border border-white/15 text-white/70 hover:text-white hover:border-gold/40 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:bg-gold/5">
                    <i class="fa-solid fa-right-to-bracket text-gold/80"></i>Login di sini
                </a>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('welcome') }}" class="text-white/25 hover:text-white/60 text-xs flex items-center justify-center gap-1 transition-colors">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePw(fieldId, iconId) {
            const f = document.getElementById(fieldId);
            const i = document.getElementById(iconId);
            if (f.type === 'password') {
                f.type = 'text';
                i.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                f.type = 'password';
                i.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>
