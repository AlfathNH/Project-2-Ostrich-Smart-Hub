<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Ostrich Smart Hub</title>
    <meta name="description" content="Reset password akun Ostrich Smart Hub dengan kode OTP yang dikirim ke email kamu.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- //--ini adalah untuk n8n-- -->
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <div style="position:fixed;inset:0;background-image:linear-gradient(rgba(255,215,0,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(255,215,0,0.025) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;z-index:0;"></div>

    <div class="relative z-10 w-full px-4">
        <div class="glass-card max-w-md mx-auto p-8 md:p-10 animate__animated animate__fadeInUp animate__faster">

            {{-- Step Indicator --}}
            <div class="step-indicator">
                <div class="step-dot active"></div>
                <div class="step-dot"></div>
                <div class="step-dot"></div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-7">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                     style="background: linear-gradient(135deg, rgba(255,215,0,0.15), rgba(255,215,0,0.05)); border: 1px solid rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-envelope-circle-check text-yellow-400 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black">
                    <span class="text-white">Lupa </span><span class="gold-gradient-text">Password?</span>
                </h1>
                <p class="text-white/40 text-sm mt-1">
                    Masukkan email kamu dan kami akan mengirimkan kode OTP.
                </p>
            </div>

            {{-- Notifikasi Error --}}
            @if(session('error'))
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400 flex-shrink-0"></i>
                {{ session('error') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400 flex-shrink-0"></i>
                {{ $errors->first() }}
            </div>
            @endif

            {{-- ===== STEP 1: Form Kirim OTP ===== --}}
            {{-- //---test n8n--- Form ini akan memicu pengiriman OTP melalui webhook n8n --}}
            <form action="{{ route('otp.send') }}" method="POST" class="space-y-5" id="sendOtpForm">
                @csrf
                <div>
                    <label class="form-label" for="email">
                        <i class="fa-solid fa-envelope mr-1.5 text-yellow-400/60"></i>Alamat Email
                    </label>
                    <input type="email" name="email" id="email" class="form-input"
                           placeholder="contoh@email.com"
                           value="{{ old('email') }}" required autocomplete="email">
                    <p class="text-white/30 text-[11px] mt-1.5">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Masukkan email yang digunakan saat mendaftar. Kode OTP berlaku 10 menit.
                    </p>
                </div>
                <button type="submit" class="primary-btn" id="sendBtn">
                    <i class="fa-solid fa-paper-plane mr-2"></i>KIRIM KODE OTP
                </button>
            </form>

            {{-- Footer Links --}}
            <div class="flex items-center gap-3 mt-6">
                <div class="flex-1 h-px bg-white/8"></div>
                <span class="text-white/20 text-xs">atau</span>
                <div class="flex-1 h-px bg-white/8"></div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center gap-2 border border-white/15 text-white/60 hover:text-white hover:border-yellow-400/40 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:bg-yellow-400/5">
                    <i class="fa-solid fa-right-to-bracket text-yellow-400/70"></i>Kembali ke Login
                </a>
            </div>
        </div>
    </div>

    <script>
        // Disable tombol saat form disubmit agar tidak double submit
        document.getElementById('sendOtpForm').addEventListener('submit', function() {
            const btn = document.getElementById('sendBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Mengirim OTP...';
        });
    </script>
</body>
</html>
