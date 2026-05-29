<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru — Ostrich Smart Hub</title>
    <meta name="description" content="Buat password baru untuk akun Ostrich Smart Hub kamu.">

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
                <div class="step-dot done"></div>
                <div class="step-dot active"></div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-7">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4"
                     style="background: linear-gradient(135deg, rgba(255,215,0,0.15), rgba(255,215,0,0.05)); border: 1px solid rgba(255,215,0,0.25)">
                    <i class="fa-solid fa-lock-open text-yellow-400 text-2xl"></i>
                </div>
                <h1 class="text-2xl font-black">
                    <span class="text-white">Password </span><span class="gold-gradient-text">Baru</span>
                </h1>
                <p class="text-white/40 text-sm mt-1">
                    Identitas terverifikasi! Sekarang buat password baru untuk akun kamu.
                </p>
            </div>

            {{-- Notifikasi --}}
            @if(session('success'))
            <div class="mb-5 flex items-center gap-2 bg-emerald-900/25 border border-emerald-500/30 text-emerald-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-check text-emerald-400 flex-shrink-0"></i>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 flex items-center gap-2 bg-red-900/30 border border-red-500/30 text-red-300 px-4 py-3 rounded-xl text-sm">
                <i class="fa-solid fa-circle-exclamation text-red-400 flex-shrink-0"></i>
                {{ $errors->first() }}
            </div>
            @endif

            {{-- ===== STEP 3: Form Password Baru ===== --}}
            <form action="{{ route('forgot.reset') }}" method="POST" class="space-y-4" id="resetForm">
                @csrf
                <div>
                    <label class="form-label" for="pw1">
                        <i class="fa-solid fa-lock mr-1.5 text-yellow-400/60"></i>Password Baru
                    </label>
                    <div style="position:relative">
                        <input type="password" name="password" id="pw1" class="form-input" style="padding-right:44px"
                               placeholder="Minimal 6 karakter" required oninput="checkStrength(this.value)">
                        <button type="button" class="pw-toggle" onclick="togglePw('pw1','e1')">
                            <i class="fa-solid fa-eye" id="e1"></i>
                        </button>
                    </div>
                    {{-- Password strength indicator --}}
                    <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                    <p class="text-white/30 text-[11px] mt-1" id="strengthText"></p>
                </div>
                <div>
                    <label class="form-label" for="pw2">
                        <i class="fa-solid fa-lock mr-1.5 text-yellow-400/60"></i>Konfirmasi Password Baru
                    </label>
                    <div style="position:relative">
                        <input type="password" name="password_confirmation" id="pw2" class="form-input" style="padding-right:44px"
                               placeholder="Ulangi password baru" required>
                        <button type="button" class="pw-toggle" onclick="togglePw('pw2','e2')">
                            <i class="fa-solid fa-eye" id="e2"></i>
                        </button>
                    </div>
                </div>
                <button type="submit" class="primary-btn mt-2" id="saveBtn">
                    <i class="fa-solid fa-floppy-disk mr-2"></i>SIMPAN PASSWORD BARU
                </button>
            </form>

            {{-- Footer --}}
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
        function togglePw(fieldId, iconId) {
            const f = document.getElementById(fieldId);
            const i = document.getElementById(iconId);
            if (f.type === 'password') { f.type = 'text'; i.classList.replace('fa-eye','fa-eye-slash'); }
            else { f.type = 'password'; i.classList.replace('fa-eye-slash','fa-eye'); }
        }

        function checkStrength(val) {
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');
            let strength = 0;
            if (val.length >= 6) strength++;
            if (val.length >= 10) strength++;
            if (/[A-Z]/.test(val)) strength++;
            if (/[0-9]/.test(val)) strength++;
            if (/[^a-zA-Z0-9]/.test(val)) strength++;

            const levels = [
                { pct: '0%',   color: 'transparent', label: '' },
                { pct: '20%',  color: '#ef4444',      label: 'Sangat lemah' },
                { pct: '40%',  color: '#f97316',      label: 'Lemah' },
                { pct: '60%',  color: '#eab308',      label: 'Cukup' },
                { pct: '80%',  color: '#84cc16',      label: 'Kuat' },
                { pct: '100%', color: '#22c55e',      label: 'Sangat kuat!' },
            ];
            const lvl = val.length === 0 ? 0 : Math.max(1, strength);
            fill.style.width = levels[lvl].pct;
            fill.style.background = levels[lvl].color;
            text.textContent = levels[lvl].label;
            text.style.color = levels[lvl].color;
        }

        document.getElementById('resetForm').addEventListener('submit', function() {
            const btn = document.getElementById('saveBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i>Menyimpan...';
        });
    </script>
</body>
</html>
