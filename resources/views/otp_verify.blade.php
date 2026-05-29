<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP — Ostrich Smart Hub</title>
    <meta name="description" content="Masukkan kode OTP yang dikirim ke email kamu untuk mereset password.">

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
                <div class="step-dot done"></div>
                <div class="step-dot active"></div>
                <div class="step-dot"></div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-7">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                     style="background: linear-gradient(135deg, rgba(255,215,0,0.15), rgba(255,215,0,0.05)); border: 1px solid rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-shield-halved text-yellow-400 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black">
                    <span class="text-white">Masukkan Kode </span><span class="gold-gradient-text">OTP</span>
                </h1>
                <p class="text-white/40 text-sm mt-1">
                    Kode 6 digit telah dikirim ke
                    <span class="text-yellow-400/80 font-semibold">{{ session('otp_email') }}</span>
                    {{-- //---test n8n--- email dikirim melalui n8n + Mailtrap/Brevo --}}
                </p>
            </div>

            {{-- Notifikasi --}}
            @if(session('success'))
            <div class="mb-5 flex items-center gap-2 bg-emerald-900/25 border border-emerald-500/30 text-emerald-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-check text-emerald-400 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
            @endif

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

            {{-- ===== STEP 2: Form Verifikasi OTP ===== --}}
            <form action="{{ route('otp.check') }}" method="POST" id="otpForm">
                @csrf
                {{-- Input OTP tersembunyi yang akan diisi dari kotak-kotak di bawah --}}
                <input type="hidden" name="otp" id="otpHidden">

                {{-- Kotak 6 digit OTP --}}
                <div class="otp-inputs mb-6" id="otpBoxes">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp0" autocomplete="one-time-code">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp1">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp2">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp3">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp4">
                    <input class="otp-box" type="text" inputmode="numeric" maxlength="1" id="otp5">
                </div>

                <button type="submit" class="primary-btn" id="verifyBtn">
                    <i class="fa-solid fa-check-double mr-2"></i>VERIFIKASI KODE OTP
                </button>
            </form>

            {{-- Timer & Resend --}}
            <div class="text-center mt-5 text-sm text-white/40">
                Tidak menerima kode?
                <span id="timerWrapper">
                    Kirim ulang dalam <span id="countdown" class="text-yellow-400/80 font-semibold">10:00</span>
                </span>
                <span id="resendWrapper" class="hidden">
                    <a href="{{ route('forgot.password') }}" class="text-yellow-400 hover:text-yellow-300 font-semibold transition-colors">
                        Kirim Ulang OTP
                    </a>
                </span>
            </div>

            {{-- Footer --}}
            <div class="flex items-center gap-3 mt-6">
                <div class="flex-1 h-px bg-white/8"></div>
                <span class="text-white/20 text-xs">atau</span>
                <div class="flex-1 h-px bg-white/8"></div>
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('forgot.password') }}"
                   class="inline-flex items-center justify-center gap-2 border border-white/15 text-white/60 hover:text-white hover:border-yellow-400/40 text-sm font-semibold px-5 py-2.5 rounded-xl transition-all hover:bg-yellow-400/5">
                    <i class="fa-solid fa-arrow-left text-yellow-400/70"></i>Ganti Email
                </a>
            </div>
        </div>
    </div>

    <script>
        // ===== Navigasi antar kotak OTP =====
        const boxes = Array.from(document.querySelectorAll('.otp-box'));

        boxes.forEach((box, i) => {
            box.addEventListener('input', (e) => {
                // Hanya angka
                box.value = box.value.replace(/[^0-9]/g, '').slice(-1);
                if (box.value) {
                    box.classList.add('filled');
                    if (i < 5) boxes[i + 1].focus();
                } else {
                    box.classList.remove('filled');
                }
            });

            box.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !box.value && i > 0) {
                    boxes[i - 1].focus();
                }
            });

            // Paste OTP sekaligus
            box.addEventListener('paste', (e) => {
                e.preventDefault();
                const pasted = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
                pasted.split('').slice(0, 6).forEach((char, j) => {
                    if (boxes[j]) {
                        boxes[j].value = char;
                        boxes[j].classList.add('filled');
                    }
                });
                boxes[Math.min(pasted.length, 5)].focus();
            });
        });

        // ===== Submit: gabungkan 6 kotak ke hidden input =====
        document.getElementById('otpForm').addEventListener('submit', function(e) {
            const code = boxes.map(b => b.value).join('');
            if (code.length < 6) {
                e.preventDefault();
                alert('Harap isi semua 6 digit kode OTP.');
                boxes[0].focus();
                return;
            }
            document.getElementById('otpHidden').value = code;
            const btn = document.getElementById('verifyBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Memverifikasi...';
        });

        // ===== Fokus kotak pertama saat load =====
        boxes[0].focus();

        // ===== Countdown Timer 10 menit =====
        let seconds = 10 * 60;
        const countdownEl = document.getElementById('countdown');
        const timerWrapper = document.getElementById('timerWrapper');
        const resendWrapper = document.getElementById('resendWrapper');

        const timer = setInterval(() => {
            seconds--;
            const m = Math.floor(seconds / 60).toString().padStart(2, '0');
            const s = (seconds % 60).toString().padStart(2, '0');
            countdownEl.textContent = `${m}:${s}`;
            if (seconds <= 0) {
                clearInterval(timer);
                timerWrapper.classList.add('hidden');
                resendWrapper.classList.remove('hidden');
            }
        }, 1000);
    </script>
</body>
</html>
