<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;
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
            if ($staff->role === 'Zookeeper') return redirect()->route('zookeeper.dashboard');
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
    // LUPA PASSWORD PENGUNJUNG
    // ==========================================================

    public function showForgotPassword()
    {
        return view('forgot_password');
    }

    /**
     * Cari akun & tampilkan form reset di halaman yang sama
     */
    public function findAccount(Request $request)
    {
        $request->validate([
            'login_id' => 'required|string',
        ]);

        $loginId = trim($request->login_id);

        $user = User::where('email', $loginId)
                    ->orWhere('username', $loginId)
                    ->first();

        if (!$user) {
            return back()->with('find_error', 'Akun dengan email/username tersebut tidak ditemukan.');
        }

        // Tampilkan form reset dengan user_id tersembunyi
        return view('forgot_password', ['foundUser' => $user]);
    }

    /**
     * Proses reset password
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'user_id'              => 'required|exists:users,id',
            'password'             => 'required|min:6|confirmed',
        ], [
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->update(['password' => bcrypt($request->password)]);

        return redirect()->route('login')
                         ->with('success', 'Password berhasil diubah! Silakan login dengan password baru.');
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

        $orders = Order::where('user_id', session('user_id'))
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
