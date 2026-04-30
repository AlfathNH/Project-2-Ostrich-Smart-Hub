<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Order;
use App\Models\PembelianPakan;
use App\Models\PenangananKesehatan;
use App\Models\Setting;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    // =========================================================
    // HALAMAN UTAMA (WELCOME)
    // =========================================================

    public function welcome()
    {
        $hargaTiket = Setting::where('key', 'harga_tiket_biasa')->first()->value ?? 25000;
        return view('welcome_ostrich', compact('hargaTiket'));
    }

    // =========================================================
    // AKSES MANAJER
    // =========================================================

    public function managerDashboard()
    {
        $totalSatwa = Animal::sum('amount');
        $staffs     = Staff::all();
        $stafAktif  = Staff::where('status', 'Bertugas')->count();
        $animals    = Animal::all();

        // Riwayat tiket terbaru untuk konfirmasi
        $recentOrders = Order::latest('tanggal_order')->take(20)->get();
        $orders       = Order::latest('tanggal_order')->get();

        return view('dashboard.manager', compact(
            'totalSatwa', 'staffs', 'stafAktif', 'animals', 'recentOrders', 'orders'
        ));
    }

    // =========================================================
    // CRUD STAFF (oleh Manager)
    // =========================================================

    public function storeStaff(Request $request)
    {
        // Hanya Manager yang boleh
        if (session('role') !== 'Manager') abort(403);

        $request->validate([
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:staff,username|alpha_dash',
            'password' => 'required|min:6',
            'role'     => 'required|in:Admin,Manager,Zookeeper',
        ], [
            'username.unique'     => 'Username sudah digunakan oleh staff lain.',
            'username.alpha_dash' => 'Username hanya boleh huruf, angka, tanda hubung, dan underscore.',
        ]);

        Staff::create([
            'name'     => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
            'status'   => 'Bertugas',
        ]);

        return redirect()->route('manager.dashboard')
                         ->with('success_staff', 'Akun Staff ' . $request->name . ' berhasil dibuat!');
    }

    public function destroyStaff($id)
    {
        if (session('role') !== 'Manager') abort(403);

        $staff = Staff::findOrFail($id);

        // Jangan hapus akun sendiri (proteksi dasar)
        if ($staff->id == session('staff_id')) {
            return redirect()->route('manager.dashboard')
                             ->with('error_staff', 'Tidak bisa menghapus akun sendiri.');
        }

        $staff->delete();
        return redirect()->route('manager.dashboard')
                         ->with('success_staff', 'Akun ' . $staff->name . ' berhasil dihapus.');
    }

    // =========================================================
    // LAPORAN KEUANGAN MANAGER — 3 Sumber Sistem
    // =========================================================

    public function managerLaporan(Request $request)
    {
        $tahunFilter = (int) $request->input('tahun', now()->year);
        $bulanFilter = $request->input('bulan', 'semua');

        $ordersQ    = Order::whereYear('tanggal_order', $tahunFilter);
        $pakanQ     = PembelianPakan::whereYear('tanggal', $tahunFilter);
        $kesehatanQ = PenangananKesehatan::whereYear('tanggal', $tahunFilter);

        if ($bulanFilter !== 'semua') {
            $ordersQ->whereMonth('tanggal_order', $bulanFilter);
            $pakanQ->whereMonth('tanggal', $bulanFilter);
            $kesehatanQ->whereMonth('tanggal', $bulanFilter);
        }

        $orders     = $ordersQ->orderBy('tanggal_order')->get();
        $pakans     = $pakanQ->orderBy('tanggal')->get();
        $kesehatans = $kesehatanQ->orderBy('tanggal')->get();

        $totalPemasukan   = $orders->sum('total_harga');
        $totalPakan       = $pakans->sum('total_harga');
        $totalKesehatan   = $kesehatans->sum('biaya');
        $totalPengeluaran = $totalPakan + $totalKesehatan;
        $saldoBersih      = $totalPemasukan - $totalPengeluaran;

        $tahunList = range(now()->year - 2, now()->year + 1);

        $bulanList = [
            'semua' => 'Semua Bulan (Tahunan)',
            '01' => 'Januari',  '02' => 'Februari', '03' => 'Maret',
            '04' => 'April',    '05' => 'Mei',       '06' => 'Juni',
            '07' => 'Juli',     '08' => 'Agustus',   '09' => 'September',
            '10' => 'Oktober',  '11' => 'November',  '12' => 'Desember',
        ];

        $periodeLabel = $bulanFilter === 'semua'
            ? 'Tahun ' . $tahunFilter
            : ($bulanList[$bulanFilter] ?? '?') . ' ' . $tahunFilter;

        return view('laporan.manager', compact(
            'orders', 'pakans', 'kesehatans',
            'totalPemasukan', 'totalPakan', 'totalKesehatan',
            'totalPengeluaran', 'saldoBersih',
            'tahunFilter', 'bulanFilter', 'tahunList', 'bulanList', 'periodeLabel'
        ));
    }

    // =========================================================
    // AKSES ADMIN
    // =========================================================

    public function adminDashboard()
    {
        $animals    = Animal::all();
        $pakans     = PembelianPakan::latest()->take(30)->get();
        $kesehatans = PenangananKesehatan::latest()->take(30)->get();

        // Riwayat tiket untuk konfirmasi pembelian
        $orders = Order::latest('tanggal_order')->take(50)->get();

        return view('dashboard.admin', compact('animals', 'pakans', 'kesehatans', 'orders'));
    }

    // ---------- SATWA ----------

    public function createAnimal()
    {
        return view('dashboard.admin_create');
    }

    public function storeAnimal(Request $request)
    {
        $request->validate([
            'name'           => 'required',
            'amount'         => 'required|numeric',
            'feeding_detail' => 'required',
        ]);

        Animal::create([
            'name'           => $request->name,
            'amount'         => $request->amount,
            'feeding_detail' => $request->feeding_detail,
            'health_status'  => 'Sehat',
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Data hewan berhasil ditambahkan!');
    }

    public function destroyAnimal($id)
    {
        Animal::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Data hewan berhasil dihapus!');
    }

    // ---------- MANAJEMEN PAKAN ----------

    public function pakanStore(Request $request)
    {
        $request->validate([
            'tanggal'      => 'required|date',
            'nama_pakan'   => 'required|string|max:100',
            'jumlah'       => 'required|numeric|min:0.01',
            'satuan'       => 'required|string|max:20',
            'harga_satuan' => 'required|integer|min:0',
            'pelapor'      => 'nullable|string|max:100',
            'keterangan'   => 'nullable|string',
        ]);

        $total = (float) $request->jumlah * (int) $request->harga_satuan;

        PembelianPakan::create([
            'tanggal'      => $request->tanggal,
            'nama_pakan'   => $request->nama_pakan,
            'jumlah'       => $request->jumlah,
            'satuan'       => $request->satuan,
            'harga_satuan' => $request->harga_satuan,
            'total_harga'  => (int) $total,
            'pelapor'      => $request->pelapor,
            'keterangan'   => $request->keterangan,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'pakan'])
                         ->with('success_pakan', 'Data pembelian pakan berhasil ditambahkan!');
    }

    public function pakanDestroy($id)
    {
        PembelianPakan::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'pakan'])
                         ->with('success_pakan', 'Data pakan berhasil dihapus!');
    }

    // ---------- MANAJEMEN KESEHATAN ----------

    public function kesehatanStore(Request $request)
    {
        $request->validate([
            'tanggal'          => 'required|date',
            'animal_id'        => 'required|exists:animals,id',
            'jenis_penanganan' => 'required|string|max:100',
            'biaya'            => 'required|integer|min:0',
            'nama_dokter'      => 'nullable|string|max:100',
            'keterangan'       => 'nullable|string',
        ]);

        $animal = Animal::findOrFail($request->animal_id);

        PenangananKesehatan::create([
            'tanggal'          => $request->tanggal,
            'animal_id'        => $request->animal_id,
            'nama_hewan'       => $animal->name,
            'jenis_penanganan' => $request->jenis_penanganan,
            'biaya'            => $request->biaya,
            'nama_dokter'      => $request->nama_dokter,
            'keterangan'       => $request->keterangan,
        ]);

        return redirect()->route('admin.dashboard', ['tab' => 'kesehatan'])
                         ->with('success_kesehatan', 'Data penanganan kesehatan berhasil ditambahkan!');
    }

    public function kesehatanDestroy($id)
    {
        PenangananKesehatan::findOrFail($id)->delete();
        return redirect()->route('admin.dashboard', ['tab' => 'kesehatan'])
                         ->with('success_kesehatan', 'Data kesehatan berhasil dihapus!');
    }

    // =========================================================
    // AKSES ZOOKEEPER
    // =========================================================

    public function zookeeperDashboard()
    {
        $animals = Animal::all();
        return view('dashboard.zookeeper', compact('animals'));
    }

    // =========================================================
    // PENGATURAN HARGA TIKET
    // =========================================================

    public function settings()
    {
        $hargaBiasa = Setting::where('key', 'harga_tiket_biasa')->first()->value ?? 25000;
        $hargaLibur = Setting::where('key', 'harga_tiket_libur')->first()->value ?? 30000;
        $hargaBesar = Setting::where('key', 'harga_tiket_besar')->first()->value ?? 35000;

        $hariBesars = \App\Models\HariBesar::orderBy('tanggal', 'asc')->get();

        return view('settings', compact('hargaBiasa', 'hargaLibur', 'hargaBesar', 'hariBesars'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'harga_biasa' => 'required|numeric|min:0',
            'harga_libur' => 'required|numeric|min:0',
            'harga_besar' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(['key' => 'harga_tiket_biasa'], ['value' => $request->harga_biasa]);
        Setting::updateOrCreate(['key' => 'harga_tiket_libur'], ['value' => $request->harga_libur]);
        Setting::updateOrCreate(['key' => 'harga_tiket_besar'], ['value' => $request->harga_besar]);

        return redirect()->route('settings.index')
                         ->with('success', 'Harga tiket berhasil diperbarui!');
    }

    public function storeHariBesar(Request $request)
    {
        $request->validate([
            'tanggal'         => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal',
            'keterangan'      => 'required|string|max:255'
        ]);

        \App\Models\HariBesar::create($request->only('tanggal', 'tanggal_selesai', 'keterangan'));
        return redirect()->route('settings.index')
                         ->with('success_hari_besar', 'Hari Besar berhasil ditambahkan!');
    }

    public function destroyHariBesar($id)
    {
        \App\Models\HariBesar::findOrFail($id)->delete();
        return redirect()->route('settings.index')
                         ->with('success_hari_besar', 'Hari Besar berhasil dihapus!');
    }

    // =========================================================
    // CHECKOUT TIKET
    // =========================================================

    private function getFlatHariBesars()
    {
        $hariBesars = \App\Models\HariBesar::all();
        $dates = [];
        
        // 1. Tambahkan Hari Libur Nasional Fix untuk tahun ini dan tahun depan
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;
        $fixedHolidays = ['-01-01', '-06-01', '-08-17', '-12-25']; // Tahun Baru, Pancasila, Kemerdekaan, Natal
        
        foreach ([$currentYear, $nextYear] as $yr) {
            foreach ($fixedHolidays as $md) {
                $dates[] = $yr . $md;
            }
        }

        // 2. Tambahkan rentang tanggal dari database event
        foreach ($hariBesars as $hb) {
            $start = \Carbon\Carbon::parse($hb->tanggal);
            $end = $hb->tanggal_selesai ? \Carbon\Carbon::parse($hb->tanggal_selesai) : $start->copy();
            
            while ($start->lte($end)) {
                $dates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        return array_values(array_unique($dates));
    }

    public function showCheckout()
    {
        if (!session()->has('role')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk memesan tiket.');
        }

        $hargaBiasa   = Setting::where('key', 'harga_tiket_biasa')->first()->value ?? 25000;
        $hargaLibur   = Setting::where('key', 'harga_tiket_libur')->first()->value ?? 30000;
        $hargaBesar   = Setting::where('key', 'harga_tiket_besar')->first()->value ?? 35000;
        $hariBesars   = $this->getFlatHariBesars();
        $tanggalHariIni = date('Y-m-d');

        return view('checkout', compact('hargaBiasa', 'hargaLibur', 'hargaBesar', 'hariBesars', 'tanggalHariIni'));
    }

    public function storeTicket(Request $request)
    {
        if (!session()->has('role')) {
            return redirect()->route('login');
        }

        $request->validate([
            'nama_pemesan' => 'required|string|max:100',
            'phone'        => 'required|string|max:20',
            'tanggal'      => 'required|date|after_or_equal:today',
            'jumlah_tiket' => 'required|integer|min:1|max:20',
            'metode_bayar' => 'required|in:qris,transfer,ewallet',
        ]);

        $hargaBiasa  = (int) (Setting::where('key', 'harga_tiket_biasa')->first()->value ?? 25000);
        $hargaLibur  = (int) (Setting::where('key', 'harga_tiket_libur')->first()->value ?? 30000);
        $hargaBesar  = (int) (Setting::where('key', 'harga_tiket_besar')->first()->value ?? 35000);

        $flatHariBesars = $this->getFlatHariBesars();
        $isHariBesar = in_array($request->tanggal, $flatHariBesars);
        $dayOfWeek   = date('N', strtotime($request->tanggal));
        $isWeekend   = ($dayOfWeek == 6 || $dayOfWeek == 7);

        if ($isHariBesar) {
            $hargaSatuan = $hargaBesar;
        } elseif ($isWeekend) {
            $hargaSatuan = $hargaLibur;
        } else {
            $hargaSatuan = $hargaBiasa;
        }

        $totalHarga = (int) $request->jumlah_tiket * $hargaSatuan;

        Order::create([
            'user_id'           => session('user_id'),   // nullable — bisa null kalau staff yang beli
            'tanggal_order'     => now()->toDateString(),
            'tanggal_kunjungan' => $request->tanggal,
            'nama_pemesan'      => $request->nama_pemesan,
            'phone'             => $request->phone,
            'jumlah_tiket'      => $request->jumlah_tiket,
            'harga_satuan'      => $hargaSatuan,
            'total_harga'       => $totalHarga,
            'metode_bayar'      => $request->metode_bayar,
            'catatan'           => $request->catatan ?? null,
            'status'            => 'confirmed',
        ]);

        return redirect()->route('welcome')
            ->with('success', '🎉 Pesanan berhasil! Total: Rp '
                . number_format($totalHarga, 0, ',', '.')
                . '. Kami akan menghubungi Anda via WhatsApp dalam 5 menit.');
    }
}
