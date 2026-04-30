<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// --- HALAMAN UMUM ---
Route::get('/', [AdminController::class, 'welcome'])->name('welcome');

// --- AUTHENTICATION ---
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);

// --- LUPA PASSWORD ---
Route::get('/lupa-password',   [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/lupa-password',  [AuthController::class, 'findAccount'])->name('forgot.find');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('forgot.reset');

// --- RIWAYAT TIKET PENGUNJUNG ---
Route::get('/riwayat-tiket', [AuthController::class, 'myOrders'])->name('ticket.history');
Route::get('/riwayat-tiket/{id}/pdf', [AuthController::class, 'downloadPdf'])->name('ticket.pdf');

// --- DASHBOARD MANAGER ---
Route::get('/manager',         [AdminController::class, 'managerDashboard'])->name('manager.dashboard');
Route::get('/manager/laporan', [AdminController::class, 'managerLaporan'])->name('manager.laporan');

// --- CRUD STAFF (Manager only) ---
Route::post('/manager/staff',        [AdminController::class, 'storeStaff'])->name('manager.staff.store');
Route::delete('/manager/staff/{id}', [AdminController::class, 'destroyStaff'])->name('manager.staff.destroy');

// --- DASHBOARD ADMIN ---
Route::get('/admin-panel',             [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/animal/create',     [AdminController::class, 'createAnimal'])->name('admin.animal.create');
Route::post('/admin/animal/store',     [AdminController::class, 'storeAnimal'])->name('admin.animal.store');
Route::delete('/admin/animal/{id}',    [AdminController::class, 'destroyAnimal'])->name('admin.animal.destroy');

// Manajemen Pakan
Route::post('/admin/pakan',            [AdminController::class, 'pakanStore'])->name('admin.pakan.store');
Route::delete('/admin/pakan/{id}',     [AdminController::class, 'pakanDestroy'])->name('admin.pakan.destroy');

// Manajemen Kesehatan Hewan
Route::post('/admin/kesehatan',        [AdminController::class, 'kesehatanStore'])->name('admin.kesehatan.store');
Route::delete('/admin/kesehatan/{id}', [AdminController::class, 'kesehatanDestroy'])->name('admin.kesehatan.destroy');

// --- PENGATURAN HARGA (ADMIN) ---
Route::get('/settings',        [AdminController::class, 'settings'])->name('settings.index');
Route::post('/settings/update',[AdminController::class, 'updateSettings'])->name('settings.update');
Route::post('/settings/hari-besar', [AdminController::class, 'storeHariBesar'])->name('hari-besar.store');
Route::delete('/settings/hari-besar/{id}', [AdminController::class, 'destroyHariBesar'])->name('hari-besar.destroy');

// --- DASHBOARD ZOOKEEPER ---
Route::get('/zookeeper', [AdminController::class, 'zookeeperDashboard'])->name('zookeeper.dashboard');

// --- CHECKOUT TIKET ---
Route::get('/checkout',  [AdminController::class, 'showCheckout'])->name('ticket.checkout');
Route::post('/checkout', [AdminController::class, 'storeTicket'])->name('ticket.purchase');
