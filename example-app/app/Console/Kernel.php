<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     // Xóa các token hết hạn sau 2 phút
        //     DB::table('password_reset_tokens')
        //         ->where('created_at', '<', now()->subMinutes(2))
        //         ->delete();
        // })->everyMinute();

        $schedule->command('delete:inactive_users')->dailyAt('16:14');
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

