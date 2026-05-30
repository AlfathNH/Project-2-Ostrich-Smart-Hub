<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use App\Models\Order;
use App\Models\PasswordOtp;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http; //---test n8n---
use Barryvdh\DomPDF\Facade\Pdf;

class AuthController extends Controller
{
    // ==========================================================
    // HALAMAN LOGIN
    // ==========================================================

    public function showLogin()
    {
        return view('login');
    }

    // ==========================================================
    // PROSES LOGIN — Staff (username) & Pengunjung (email/username)
    // ==========================================================

    public function login(Request $request)
    {
        $loginId  = trim($request->login_id);
        $password = $request->password;

        // --- 1. CEK KE TABEL STAFF (Manager / Admin / Zookeeper) ---
        // Staff login pakai USERNAME
        $staff = Staff::where('username', $loginId)->first();
        if ($staff && Hash::check($password, $staff->password)) {
            session(['role' => $staff->role, 'name' => $staff->name, 'staff_id' => $staff->id]);

            if ($staff->role === 'Manager')   return redirect()->route('manager.dashboard');
            if ($staff->role === 'Admin')     return redirect()->route('admin.dashboard');
            if ($staff->role === 'Zookeeper') return redirect()->route('zookeeper.pakan');
        }

        // --- 2. CEK KE TABEL USERS (Pengunjung) — bisa pakai EMAIL atau USERNAME ---
        $user = User::where('email', $loginId)
                    ->orWhere('username', $loginId)
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            session([
                'role'    => 'Pengunjung',
                'name'    => $user->name,
                'user_id' => $user->id,
                'email'   => $user->email,
            ]);

            return redirect()->route('welcome')->with('success', 'Berhasil Login!');
        }

        // --- GAGAL ---
        return back()->withInput()->with('error', 'Username/Email atau Password salah!');
    }

    // ==========================================================
    // REGISTER PENGUNJUNG
    // ==========================================================

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username|alpha_dash',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ], [
            'username.unique'     => 'Username sudah digunakan, coba yang lain.',
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, tanda hubung, dan underscore.',
            'email.unique'        => 'Email sudah terdaftar.',
        ]);

        User::create([
            'name'     => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')
                         ->with('success', 'Akun berhasil dibuat! Silakan Login.');
    }

    // ==========================================================
    // LUPA PASSWORD — SISTEM OTP
    // ==========================================================

    /**
     * Tampilkan halaman Step 1: input email
     */
    public function showForgotPassword()
    {
        return view('forgot_password');
    }

    /**
     * Step 1 → Buat OTP & kirim via n8n → redirect ke halaman verifikasi OTP
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ]);

        $email = trim($request->email);

        // Cek apakah email terdaftar di tabel users (pengunjung)
        // Jika email tidak ditemukan, berikan notifikasi kustom agar pengguna membuat akun dengan email tersebut
        $user = User::where('email', $email)->first();
        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan, coba buat akun menggunakan email tersebut');
        }

        //---test n8n---
        // Buat kode OTP 6 digit acak
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Hapus OTP lama untuk email ini (kalau ada), lalu simpan yang baru
        PasswordOtp::where('email', $email)->delete();
        PasswordOtp::create([
            'email'      => $email,
            'otp'        => $otpCode,
            'expires_at' => now()->addMinutes(10), // OTP berlaku 10 menit
        ]);

        //---test n8n---
        // Kirim OTP ke n8n untuk diteruskan lewat email (Mailtrap/Brevo)
        $webhookUrl = 'http://localhost:5678/webhook-test/OTPMail'; //---test n8n---
        try {
            Http::timeout(10)->post($webhookUrl, [
                'email_user' => $email,
                'nama_user'  => $user->name,
                'kode_otp'   => $otpCode,
            ]);
        } catch (\Exception $e) {
            // Jika n8n tidak dapat dihubungi, tetap lanjut (bisa cek log)
            \Log::warning('Gagal kirim ke n8n: ' . $e->getMessage());
        }
        //---test n8n---

        // Simpan email ke session untuk dipakai di halaman berikutnya
        session(['otp_email' => $email]);

        return redirect()->route('otp.verify')
                         ->with('success', 'Kode OTP telah dikirim ke email ' . $email . '. Berlaku 10 menit.');
    }

    /**
     * Tampilkan halaman Step 2: input kode OTP
     */
    public function showVerifyOtp()
    {
        // Kalau tidak ada session email, lempar balik ke halaman lupa password
        if (!session()->has('otp_email')) {
            return redirect()->route('forgot.password')
                             ->with('error', 'Sesi habis. Silakan mulai ulang.');
        }
        return view('otp_verify');
    }

    /**
     * Step 2 → Verifikasi kode OTP → redirect ke halaman reset password
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => 'Kode OTP wajib diisi.',
            'otp.size'     => 'Kode OTP harus 6 digit.',
        ]);

        $email = session('otp_email');
        if (!$email) {
            return redirect()->route('forgot.password')
                             ->with('error', 'Sesi habis. Silakan mulai ulang.');
        }

        $otpRecord = PasswordOtp::where('email', $email)
                                 ->where('otp', trim($request->otp))
                                 ->first();

        // OTP tidak ditemukan
        if (!$otpRecord) {
            return back()->with('error', 'Kode OTP salah. Periksa kembali kode yang dikirim ke email kamu.');
        }

        // OTP sudah kedaluwarsa
        if (now()->greaterThan($otpRecord->expires_at)) {
            $otpRecord->delete();
            return back()->with('error', 'Kode OTP sudah kedaluwarsa. Silakan minta kode baru.');
        }

        // OTP valid → tandai di session, hapus record OTP dari DB
        $otpRecord->delete();
        session(['otp_verified_email' => $email]);
        session()->forget('otp_email');

        return redirect()->route('password.reset.form')
                         ->with('success', 'Kode OTP berhasil diverifikasi! Silakan buat password baru.');
    }

    /**
     * Tampilkan halaman Step 3: form reset password baru
     */
    public function showResetPassword()
    {
        if (!session()->has('otp_verified_email')) {
            return redirect()->route('forgot.password')
                             ->with('error', 'Akses tidak valid. Silakan mulai dari awal.');
        }
        return view('reset_password');
    }

    /**
     * Step 3 → Simpan password baru
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $email = session('otp_verified_email');
        if (!$email) {
            return redirect()->route('forgot.password')
                             ->with('error', 'Sesi habis. Silakan mulai ulang.');
        }

        $user = User::where('email', $email)->firstOrFail();
        $user->update(['password' => bcrypt($request->password)]);

        // Hapus session OTP
        session()->forget('otp_verified_email');

        return redirect()->route('login')
                         ->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
    }

    // ==========================================================
    // UPLOAD BUKTI PEMBAYARAN
    // ==========================================================

    public function showUploadBukti($orderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        $order = Order::where('id', $orderId)
                      ->where('user_id', session('user_id'))
                      ->firstOrFail();
        return view('upload_bukti', compact('order'));
    }

    public function uploadBukti(\Illuminate\Http\Request $request, $orderId)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'bukti_transfer.required' => 'Bukti transfer wajib diupload.',
            'bukti_transfer.image'    => 'File harus berupa gambar.',
            'bukti_transfer.mimes'    => 'Format gambar harus JPG, PNG, atau WEBP.',
            'bukti_transfer.max'      => 'Ukuran file maksimal 5 MB.',
        ]);

        $order = Order::where('id', $orderId)
                      ->where('user_id', session('user_id'))
                      ->firstOrFail();

        // Simpan file gambar
        $path = $request->file('bukti_transfer')->store('bukti_transfer', 'public');

        $order->update([
            'bukti_transfer' => $path,
            'status'         => 'pending',
        ]);

        //---test n8n---
        // Kirim notifikasi ke n8n → Telegram admin
        $webhookUrl = 'http://localhost:5678/webhook-test/pembayaran-ostrich'; //---test n8n---
        try {
            $imageContent = \Storage::disk('public')->get($path);
            Http::timeout(15)->attach(
                'bukti_foto',
                $imageContent,
                basename($path)
            )->post($webhookUrl, [
                'id_order'     => (string) $order->id,
                'kode_booking' => $order->kode_booking,
                'nama_user'    => $order->nama_pemesan,
                'phone'        => $order->phone,
                'jumlah_tiket' => (string) $order->jumlah_tiket, // cast string agar n8n tidak salah baca
                'total_harga'  => (string) $order->total_harga,
                'approve_url'  => url('/api/order/approve/' . $order->id),
                'reject_url'   => url('/api/order/reject/'  . $order->id),
            ]);
        } catch (\Exception $e) {
            \Log::warning('Gagal kirim bukti ke n8n: ' . $e->getMessage());
        }
        //---test n8n---

        return redirect()->route('order.upload', $order->id)
                         ->with('success', '✅ Bukti pembayaran berhasil dikirim! Admin akan mengkonfirmasi dalam 5-10 menit.');
    }

    // API untuk approve/reject dari Telegram (dipanggil oleh n8n)  //---test n8n---
    public function approveOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'confirmed']);
        return response()->json(['status' => 'success', 'message' => 'Order ' . $order->kode_booking . ' dikonfirmasi!']);
    }

    public function rejectOrder($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => 'rejected']);
        return response()->json(['status' => 'success', 'message' => 'Order ' . $order->kode_booking . ' ditolak.']);
    }

    // ==========================================================
    // RIWAYAT TIKET PENGUNJUNG
    // ==========================================================

    public function myOrders()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        // [BARU] POIN 5: Hanya tampilkan tiket dari 6 bulan terakhir
        $orders = Order::where('user_id', session('user_id'))
                       ->sixMonths()
                       ->orderByDesc('tanggal_order')
                       ->get();

        return view('riwayat_tiket', compact('orders'));
    }

    public function downloadPdf($id)
    {
        if (!session()->has('user_id')) {
            return redirect()->route('login');
        }

        $order = Order::where('id', $id)->where('user_id', session('user_id'))->firstOrFail();
        
        // Generate PDF
        $pdf = Pdf::loadView('pdf.ticket', compact('order'));
        // Set paper size & orientation (Optional, e.g. A4)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('OstrichHub_Ticket_' . str_replace(' ', '_', $order->nama_pemesan) . '_' . date('d-m-Y', strtotime($order->tanggal)) . '.pdf');
    }

    // ==========================================================
    // LOGOUT
    // ==========================================================

    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}
