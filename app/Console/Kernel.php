<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     * [BARU] POIN 5: Task Scheduling untuk Auto-Cleanup Riwayat Tiket (Retention 6 Bulan).
     */
    protected function schedule(Schedule $schedule): void
    {
        // [BARU] POIN 5: Hapus otomatis tiket yang lebih tua dari 6 bulan
        // Dijalankan setiap bulan pada tanggal 1 jam 02:00 pagi
        $schedule->call(function () {
            $jumlahDihapus = DB::table('orders')
                ->where('created_at', '<', now()->subMonths(6))
                ->delete();

            \Log::info("[Auto-Cleanup] Berhasil menghapus {$jumlahDihapus} riwayat tiket yang lebih tua dari 6 bulan.");
        })->monthlyOn(1, '02:00')
          ->name('cleanup-old-tickets')
          ->withoutOverlapping()
          ->runInBackground();

        // [BARU] Catatan: Untuk menjalankan scheduler, tambahkan cron job di server:
        // * * * * * cd /path-ke-project && php artisan schedule:run >> /dev/null 2>&1
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
